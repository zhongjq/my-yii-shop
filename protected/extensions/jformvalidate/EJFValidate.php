<?php
/**
 * This extension allows client side form validation. It is based on the JQuery plugin validation.
 *  
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 *
 * @author Raoul
 * @version 1.0.8
 * 
 */

class EJFValidate extends CApplicationComponent {

	const ID_PREFIX='EJS_';
	public static $count=0;
	/**
	 * @var array JQuery validation plugin initialisation options defined in the yii configuration file when extension gets loaded
	 */
	public $pluginOptions = array();
	/**
	 * @var boolean enable/disable the JS form validation. 
	 */
	public $enable = true;
	const  CUSTOM_JS_VALIDATOR = 'application.extensions.jformvalidate.ECustomJsValidator';
	
	/**
	 * @var array list of supported Yii built-in validators.
	 */
	private $_supportedYiiValidators = array (
			EJFValidate::CUSTOM_JS_VALIDATOR,
			'required',
			'length',
			'email',
			'url',
			'compare',
			'numerical',
			'match',
		);
	private $_yiiValidatorDefaultMessage = array ();
	private $_rules;
	private $_messages;
	/**
	*@var integer form index, incremented each time the method endForm in invoked. This value is used to create form Id when not provided by htmlOptions
	*/
	private $_formIdx = 1;
	/**
	*@var string Id of the form currently processed. Initialized when method form is invoked.
	*/
	private $_formId;
	/**
	*@var array JQuery alidation plugin initialisation options that can be set with method setOptions. These options will overwrite options that were set
	* when the extension was loaded (see pluginOptions).
	*/
	private $_pluginOptions = array();
	private $_model;
	/**
	 * @var string scenario name or null if no scenario is used
	 */
	private $_scenario				= null;
	private $_attributeLabels 		= array();
	private $_jqueryPluginFile 		= 'jquery.validate.min.js';	
	private $_additionalMethodFile 	= 'additional-methods.js';
	private $_helperFile 			= 'jquery.jfvalidate.helper.js';
	/**
	 * @var boolean true when custom submit handler has been installed to client
	 */
	private $_isNormalized = false;
	/**
	 * Initialisation method called by Yii when the component os loaded.
	 * Publish client script and initialize internal class members.
	 */
	public function init(){
		
		if( $this->enable === true)
		{		
			$cs=Yii::app()->clientScript;
			$am = Yii::app()->getAssetManager();
			$this->_jqueryPluginFile 		= $am->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.$this->_jqueryPluginFile);
			$this->_additionalMethodFile 	= $am->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.$this->_additionalMethodFile);
			$this->_helperFile 				= $am->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.$this->_helperFile);
	
			$cs->registerCoreScript('jquery');
			$cs->registerScriptFile($this->_jqueryPluginFile);
			$cs->registerScriptFile($this->_additionalMethodFile);
			$cs->registerScriptFile($this->_helperFile);
			
			
			$this->_yiiValidatorDefaultMessage = array(
				'minlength' => Yii::t('yii','{attribute} is too small (minimum is {min}).'),
				'maxlength' => Yii::t('yii','{attribute} is too big (maximum is {max}).'),
				'required' 	=> Yii::t('yii','{attribute} cannot be blank.'),
				'email' 	=> Yii::t('yii','{attribute} is not a valid email address.'),
				'equalTo' 	=> Yii::t('yii','{attribute} must be repeated exactly.'),
				'tooBig' 	=> Yii::t('yii','{attribute} is too big (maximum is {max}).'),
				'tooSmall' 	=> Yii::t('yii','{attribute} is too small (minimum is {min}).'),
				'notInt' 	=> Yii::t('yii','{attribute} must be an integer.'),
				'numerical' => Yii::t('yii','{attribute} must be a number.'),
				'match'		=> Yii::t('yii','{attribute} is invalid.'),
			);
		}
		
		parent::init();
	}
	/**
	 * Options set here will overload options that have been set when the extension
	 * was loaded (Yii configuration file).
	 * 
	 * @param array opt JQuery Validate Plugin options
	 */
	public function setOptions($opt){
		if( count($opt))
			$this->_pluginOptions = $opt;		
	}
	/**
	 * Use this method to set the scenario name that should be used to select Yii validation
	 * rules.
	 * 
	 * @var string name scenario name
	 */
	public function setScenario($name){
		$this->_scenario = $name;
		
		//CHtml::$scenario  = $name;
	}
	/**
	 * Initiates the process of collecting informations on validation rules until endForm() is called.
	 * 
	 */
	public function beginForm($action='',$method='post',$htmlOptions=array())
	{
		if( $this->enable === true)
		{
			if( ! isset($htmlOptions['id']))
				$htmlOptions['id'] = $this->getCurrentFormId() ;
			$this->_formId   = $htmlOptions['id'];
			$this->_scenario = null;
			$this->_rules    = array();
			$this->_messages = array();	
		}
		return CHtml::beginForm($action,$method,$htmlOptions);		
	}
	/**
	 * shortcut for the beginForm method.
	 */ 
	public function form($action='',$method='post',$htmlOptions=array()) 
	{
		return $this->beginForm($action,$method,$htmlOptions);
	}	
	/**
	* Initializes the JQuery Validate plugin with all settings collected for the current form.
	* This method generates the actual JS code and send it to the client.
	*/
	public function endForm()
	{	
		// if no rule applies on the client-side or if the extension has been disabled,
		// no initialisation is done.
		if( $this->enable === true and count($this->_rules) != 0)
		{
			$jsInitCode =  $this->prepareOptions();
			if( $jsInitCode != null )
			{
				Yii::app()->clientScript->registerScript($this->_formId, $this->prepareOptions());		
				$this->_formIdx++;				
			}
		}
		return CHtml::endForm();
	}
	////////////////////////////////////////////////////////////////////////////////////
	// All methods below are defined in CHtml helpers class - the method signature
	// remains unchanged
	
	/**
	 * wrapper class for the CHtml::activeTextField method (same signature).
	 * 
	 */
	public function activeTextField($model,$attribute,$htmlOptions=array())
	{
		if( $this->enable === true)
			$this->addValidator($model,$attribute);
		return CHtml::activeTextField($model,$attribute,$htmlOptions);
	}
	public function activePasswordField($model,$attribute,$htmlOptions=array())
	{
		if( $this->enable === true)
			$this->addValidator($model,$attribute);
		return CHtml::activePasswordField($model,$attribute,$htmlOptions);
	}	
	public  function activeCheckBox($model,$attribute,$htmlOptions=array())	
	{		
		if( $this->enable === true)
		{
			$this->addValidator($model,$attribute);
			$this->normalize();				
		}
		return CHtml::activeCheckBox($model,$attribute,$htmlOptions);
	}	
	public function activeCheckBoxList($model, $attribute, $data, $htmlOptions=array())
	{	
		if( $this->enable === true)	
			$this->addValidator($model,$attribute, true);
		return CHtml::activeCheckBoxList($model, $attribute, $data, $htmlOptions);		
	}	
	public function activeRadioButtonList($model, $attribute, $data, $htmlOptions=array())
	{
		if( $this->enable === true)
		{		
			$this->addValidator($model,$attribute);
			$this->normalize();
		}
		return CHtml::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
	}
	public function activeDropDownList($model, $attribute, $data, $htmlOptions=array())
	{	
		if( $this->enable === true)	
			$this->addValidator($model,$attribute);
		return CHtml::activeDropDownList($model, $attribute, $data, $htmlOptions);		
	}	
	public function activeListBox($model, $attribute, $data, $htmlOptions=array())
	{	
		if( $this->enable === true)	
			$this->addValidator($model,$attribute);
		return CHtml::activeListBox($model, $attribute, $data, $htmlOptions);		
	}	

	public function activeTextArea($model, $attribute, $htmlOptions=array ( ))	
	{
		if( $this->enable === true)	
			$this->addValidator($model,$attribute);
		return CHtml::activeTextArea($model, $attribute, $htmlOptions);		
	}
	/**
	 * Wraps CHtml::ajaxSubmitButton and provides client-side validation functions
	 * when a form is ajax submited.
	 * The HTML control returned is a regular button (type=button) and a handler on the
	 * click event is attached to it. This handler first invoke the validate JQuery plugin
	 * and if the form is valid, it restores original names (if they were previously normalized)
	 * and then it submits (ajax) the form.
	 */
	public function ajaxSubmitButton($label,$url,$ajaxOptions=array(),$htmlOptions=array())
	{
		if( $this->enable === true)
		{
			$ajaxOptions['type']='POST';
			if(!isset($htmlOptions['id']))
				$htmlOptions['id']=self::ID_PREFIX.self::$count++;
			$buttonId=$htmlOptions['id'];
			$ajaxOptions=$this->prepareAjaxOptions($ajaxOptions);
			$strAjaxOptions=CJavaScript::encode($ajaxOptions);
			$ajaxSubmitHandler= <<<END
jQuery("#$buttonId").click(function()
	{
		var form = jQuery(this).parents('form');
		var isValid=form.valid();
		if( isValid ){
			$.fn.EJFValidate.restoreName();
			jQuery.ajax($strAjaxOptions);			
		}
		return isValid;
	}
);
END;

		 	Yii::app()->clientScript->registerScript($buttonId,$ajaxSubmitHandler);		 
			return CHtml::button($label,$htmlOptions);
		} else
		{
			return CHtml::ajaxSubmitButton($label,$url,$ajaxOptions,$htmlOptions);
		}			
	}	
	//
	////////////////////////////////////////////////////////////////////////////////////
	
	/**
	* Returns the id of the currently processed form. This method is called because the JQuery plugin needs an id
	* for the form to validate, and if the user does not set an id in the htmlOptions, then it must be created.
	*/
	public function getCurrentFormId(){
		return 'ejsvformid'.$this->_formIdx ;
	}
	/**
	 * Normalization is required because for some Yii active controls (e.g activeCheckboxList), Yii generates
	 * duplicate names for input elements. The underlying JQuery plugin uses the name attribute to validate a form
	 * and so, duplicate name would mess up. To avoid this problem, the normalize method is called. It modifies
	 * duplicate name attributes onLoad, and restore original value on submit.
	 */
	protected function normalize(){
		if( $this->_isNormalized == false)
		{
			if( isset($this->_pluginOptions['submitHandler'])  == false and 
				isset($this->pluginOptions['submitHandler'])   == false)
				{
					$this->_pluginOptions['submitHandler'] = 'function(form){$.fn.EJFValidate.submitHandler(form);}';
				}
				
			// This script is called on page load
			
			Yii::app()->clientScript->registerScript('chkhandler','$.fn.EJFValidate.uniqueName();');
			
			// normalization is also needed on ajax submition. Following script
			// handles ajaxComplete event and normalize names.
			
			$normalizeHandler= <<<END
$('body').bind("ajaxComplete", function(){
	$.fn.EJFValidate.uniqueName();
});
END;
		 	Yii::app()->clientScript->registerScript('normalizeOnAjax',$normalizeHandler);			
			$this->_isNormalized = true;			
		}				
	}
	/**
	 * Add each supported yii validaion rules defined in the model for this 
	 * attribute, to the _rules and _messages arrays. These arrays will be used
	 * to produce the JQuery plugin initialisation structure.
	 * 
	 * @param CModel model model definition
	 * @param string attribute model attribute which validation rules are processed
	 * @param boolean checkBoxList the validator to add refers to a check box list
	 */
	protected function addValidator(&$model, &$attribute, $checkBoxList=false){
		
		// load model and attributelabels for future use.
		//TODO : optimize this so the CModel.attributeLabels() doesn't get called each time
				
		$this->_model = $model;
		if(method_exists($this->_model,'attributeLabels')){
			$this->_attributeLabels = $this->_model->attributeLabels();
		} else {
			$this->_attributeLabels = array();
		}
				
		foreach($model->rules() as $rule){
			if(isset($rule[0],$rule[1]) and in_array($rule[1], $this->_supportedYiiValidators)){
				$attributes=$rule[0];
				if(is_string($attributes))
					$attributes=preg_split('/[\s,]+/',$attributes,-1,PREG_SPLIT_NO_EMPTY);
				foreach ( $attributes as $attributeName ) {
       				if( $attributeName != $attribute)
       					continue;
       				$ruleName   = $rule[1];
       				$ruleParams = array_slice($rule,2);
       				
					// check if this rules applies to the current scenario, if a scenario was defined
					// when the form() method was called.
					
					if( $this->applyToScenario($ruleName,$ruleParams))	{
						$this->addValidatorRule($attributeName,$ruleName,$ruleParams,$checkBoxList);									
					}					
				}				
			}
		}		
	}
	/**
	 * Convert the yii rule defined for attribute $attrName into a JS input parameter
	 * that is used initialize the JQuery Form Validation plugin.
	 * to Populates the _rules and _message member arrays. 
	 * 
	 * @param string attrName attribute name as defined in the model rules
	 * @param string ruleName rule name as defined in the model rules
	 * @param array ruleParams rule parameters
	 * @param boolean checkBoxList the validator to add refers to a check box list
	 */
	protected function addValidatorRule($attrName, $ruleName, $ruleParams,$checkBoxList){


		// the $attrActiveName is used by the plugin, to identity HTML form elements
		// to validate.
		
		$attrActiveName=CHtml::activeName($this->_model,$attrName);		
		
		// in cas of a checkBoxList, as more than one value can be select, yii adds a
		// dimension to the form array. The element name is then "modelName[attributeName][]"
		
		if($checkBoxList===true) 
			$attrActiveName.="[]";
			
		// convert supported Yii validators into their equivalent for the JQuery plugin
		if( isset($ruleParams['allowEmpty']) and $ruleParams['allowEmpty']===false) {
			$this->_rules[$attrActiveName]['required'] = true;
			$this->addValidatorMessage($attrName,$attrActiveName,'required',$ruleParams);
		}
			
		if($ruleName == 'required' ){
			$this->_rules[$attrActiveName]['required'] = true;
			$this->addValidatorMessage($attrName,$attrActiveName,'required',$ruleParams);
		}
		elseif($ruleName == 'length')
		{
			// This rule has no direct equivalent in the plugin, it must be splited
			// into 2 JS rules : min and max
			
			if( isset($ruleParams['min']) ) {
				$this->_rules[$attrActiveName]['minlength'] = $ruleParams['min'];
				$this->addValidatorMessage($attrName,$attrActiveName,'minlength',$ruleParams);
			}	
			if( isset($ruleParams['max'])) {
				$this->_rules[$attrActiveName]['maxlength'] = $ruleParams['max'];
				$this->addValidatorMessage($attrName,$attrActiveName,'maxlength',$ruleParams);
			}				
		}
		elseif($ruleName == 'email')
		{
			$this->_rules[$attrActiveName]['email'] = true;
			$this->addValidatorMessage($attrName,$attrActiveName,'email',$ruleParams);			
		}	
		elseif($ruleName == 'url')
		{
			$this->_rules[$attrActiveName]['url'] = true;
			$this->addValidatorMessage($attrName,$attrActiveName,'url',$ruleParams);			
		}	
		elseif($ruleName == 'numerical'){
			
			// This validator is not implemented in the JQuery Validate plugin, it is part of the
			// jfvvalidate.helper.js library.
			// Note that it doesn't set any message in the separate _message array : all messages are
			// part of the option object, passed to this JS validator.			 
			
			$numParams=array();
			$numParams['integerOnly'] = (  isset($ruleParams['integerOnly']) ?  (bool)$ruleParams['integerOnly'] : false);
			
			if( isset($ruleParams['max'])){
				$numParams['max'] = $ruleParams['max'];	
				$errorMsg = (isset($ruleParams['tooBig'])?$ruleParams['tooBig']:null);			
				$numParams['tooBig'] = $this->addValidatorMessage($attrName,$attrActiveName,'tooBig',$ruleParams,$errorMsg,true); 
			}
			if( isset($ruleParams['min'])){
				$numParams['min'] = $ruleParams['min'];
				$errorMsg = (isset($ruleParams['tooSmall'])?$ruleParams['tooSmall']:null);
				$numParams['tooSmall'] = $this->addValidatorMessage($attrName,$attrActiveName,'tooSmall',$ruleParams,$errorMsg,true); 
			}
			if( isset($numParams['integerOnly']) and $numParams['integerOnly'] === true ){
				$numParams['notInt'] = $this->addValidatorMessage($attrName,$attrActiveName,'notInt',$ruleParams,null,true);
			}			
			$errorMsg = (isset($ruleParams['message'])?$ruleParams['message']:null);			
			$numParams['msg'] = $this->addValidatorMessage($attrName,$attrActiveName,'numerical',$ruleParams,$errorMsg,true);
						
			$this->_rules[$attrActiveName]['numerical'] = $numParams;
		}		
		elseif($ruleName == 'compare' )
		{					
			// The Yii built-in COMPARE validator can be converted into 2 different
			// JS validator : equalToConst (compare with a constant value) and equalTo
			// (compare with another editbox value)
			
			if( isset($ruleParams['compareValue'])){
				$this->_rules[$attrActiveName]['equalToConst'] = $ruleParams['compareValue'];
				$this->addValidatorMessage($attrName,$attrActiveName,'equalToConst',$ruleParams);
			}else {
				if( isset($ruleParams['compareAttribute'])){
					$compareAttr = CHtml::activeId($this->_model,$ruleParams['compareAttribute']);
				}				
				else
					$compareAttr = CHtml::activeId($this->_model,$attrName.'_repeat');	
				$this->_rules[$attrActiveName]['equalTo'] = '#'.$compareAttr;
				$this->addValidatorMessage($attrName,$attrActiveName,'equalTo',$ruleParams);
			}
		}	
		elseif($ruleName == 'match' )
		{					
			
			if( isset($ruleParams['pattern'])){
				$this->_rules[$attrActiveName]['match'] = $ruleParams['pattern'];
				$this->addValidatorMessage($attrName,$attrActiveName,'match',$ruleParams);
			}
		}		
		elseif($ruleName == EJFValidate::CUSTOM_JS_VALIDATOR){
			
			// this validator is provided with the extension. It does not perform any 
			// server side validation, but it is used as a wrapper for client-side-only
			// js validators.
				
			if( isset($ruleParams['rules']) ) {
				foreach ( $ruleParams['rules'] as $name => $param ) {
       				$this->_rules[$attrActiveName][$name] = $param;
				}

				// only the {attribute} placeholder is replaced by its value
				$replace['{attribute}'] = ( isset($this->_attributeLabels[$attrName])
					? $this->_attributeLabels[$attrName]
					: $this->_model->generateAttributeLabel($attrName)); 
				foreach ( $ruleParams['messages'] as $name => $msg ) {
       				$this->_messages[$attrActiveName][$name] = CHtml::encode(strtr($msg,$replace));
				}															
			}
		}	
	}
	/**
	 * Set the error message for this validator. The error message is retrieved in the
	 * following order :
	 * 
	 * 1. the 'message' parameter from the rule array defined by the model
	 * 2. the defaultMsg argument
	 * 3. the default yii validator error message. These messages are defined
	 *    in the class (init) and refer to hardcoded messages as they are defined
	 *    by the yii built-in validator classes.
	 * 4. the message defined by the JQuery plugin
	 * 
	 * Messages from 1,2 and 3. may contain special fields which are replaces by their
	 * value. If $returnMsg is FALASE, the result message is stored in _message and will be 
	 * outputed in the 'messages' option of the JQuery Validate plugin. Otherwise the message
	 * is returned.
	 * 
	 * @param attrName attribute name as it is send to client for js validation initialization
	 * @param attrActiveName displayed name for the attribute
	 * @param ruleName the js rule or parameter rule name (e.g. minlength, required, ...)
	 * @param ruleParams parameters for the yii rules (defined by the model)
	 * @param string defaultMsg if no msg is set in the ruleParams, use this message
	 * @param returnMsg bool if true, the message is not added to _messages but returned
	 */
	protected function addValidatorMessage($attrName,$attrActiveName,$ruleName,$ruleParams,$defaultMsg=null,$returnMsg = false){
		$msg='';
		if( isset($ruleParams['message']))
			$msg = $ruleParams['message'];
		elseif($defaultMsg != null)
			$msg = $defaultMsg;
		elseif( isset($this->_yiiValidatorDefaultMessage[$ruleName]) )
			$msg = $this->_yiiValidatorDefaultMessage[$ruleName];
			
		if( $msg != '')
		{
			foreach ( $ruleParams as $key => $value ) {
       			$params['{'.$key.'}'] = $value;
			}
			$params['{attribute}'] = ( isset($this->_attributeLabels[$attrName])
				? $this->_attributeLabels[$attrName]
				: $this->_model->generateAttributeLabel($attrName));
			if($returnMsg === true)
				return CHtml::encode(strtr($msg,$params));
			else
				$this->_messages[$attrActiveName][$ruleName] = CHtml::encode(strtr($msg,$params));
		}
	}
	
	public function normalizeUrl($url) { return CHtml::normalizeUrl($url); }
	/**
	 * This method check that ajax options passed as arguments are valid and set
	 * default values. 
	 * THIS IS A COPY OF THE CHTML::ajax($options) method
	 * @see http://docs.jquery.com/Ajax/jQuery.ajax#options
	 */
	protected function prepareAjaxOptions($options)
	{
		if(!isset($options['url']))
			$options['url']='js:location.href';
		else
			$options['url']=self::normalizeUrl($options['url']);
		if(!isset($options['cache']))
			$options['cache']=false;
		if(!isset($options['data']) && isset($options['type']))
			$options['data']='js:jQuery(this).parents("form").serialize()';
		foreach(array('beforeSend','complete','error','success') as $name)
		{
			if(isset($options[$name]) && strpos($options[$name],'js:')!==0)
				$options[$name]='js:'.$options[$name];
		}
		if(isset($options['update']))
		{
			if(!isset($options['success']))
				$options['success']='js:function(html){jQuery("'.$options['update'].'").html(html)}';
			unset($options['update']);
		}
		if(isset($options['replace']))
		{
			if(!isset($options['success']))
				$options['success']='js:function(html){jQuery("'.$options['replace'].'").replaceWith(html)}';
			unset($options['replace']);
		}
		return $options;		
	}	
	
	/**
	 * This method is called when it is time to generate the JS code to
	 * invoke the JQuery Validate Plugin. Constants options are jsonEconded but
	 * this can't be done for handler options (that cannot be JSonEncoded because
	 * they are not strings).
	 * If an option value begins with 'function' then it is assumed to contain an 
	 * anonymous function.
	 * 
	 * @return string js initialisation code
	 */
	protected function prepareOptions(){

		$options = array_merge($this->pluginOptions, $this->_pluginOptions);
		
		// split options in 2 arrays :
		// $optionsHandler : contains calls to anonymous functions (e.g. handler)
		// $optionsReady   : contains options with a constant value.
		
		$optionsHandler = array();
		$optionsReady = array();
		foreach ( $options as $optName => $optValue ) {
       		if( preg_match('/[ \t\r\n\v\f]*function\(/', $optValue)){
       			$optionsHandler[] = $optName.':'.$optValue;
       		} else {
       			$optionsReady[$optName] = $optValue;
       		}
		}

		$jsOptionsReady = 	CJavaScript::jsonEncode((count($optionsReady) != 0 ? $optionsReady : array()) +
							array('rules'    => $this->_rules)+
							(count($this->_messages) != 0 ? array('messages' => $this->_messages) : array()));

			
		$hasHandler = (count($optionsHandler) != 0);
		$hasConstOption = (strlen(trim($jsOptionsReady)) != 0);

		$js = '$("#'.$this->_formId . '").validate('
			.'{'
			. ($hasHandler ? implode($optionsHandler,',') : '')
			. ( ($hasHandler and $hasConstOption) ? ',':'')
			. ($hasConstOption ? substr($jsOptionsReady,1) : '')	// remove the first opening brace
		.');';	
		return $js;		
	}
	/**
	 * Check if the rule applies to the current scenario. The current scenario name 
	 * must be set at the begining of the form construction. It is reseted by the endForm() 
	 * methode.
	 * @return boolean true if the rule applies
	 */
	protected function applyToScenario(&$ruleName, &$ruleParams){
		if( ! isset($ruleParams['on'] )){
			// a rule with no scenario attribute always apply
			return true;
		} elseif( isset($ruleParams['on']) and empty($this->_scenario)) {
			// when no scenario is active, a rule with a scenario attribute
			// never applies
			return false;
		}

		if(is_array($ruleParams['on']))
			$on=$ruleParams['on'];
		else
			$on=preg_split('/[\s,]+/',$ruleParams['on'],-1,PREG_SPLIT_NO_EMPTY);
		
		return in_array($this->_scenario,$on);	
	}
}
?>
