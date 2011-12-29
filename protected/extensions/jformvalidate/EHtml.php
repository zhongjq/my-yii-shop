<?php
class EHtml extends CHtml {
	
	protected static $CS=null;
	public static function getJValidateInstance(){
		if( self::$CS == null)
			self::$CS = Yii::app()->jformvalidate;
		return self::$CS;
	}
	public static function form($action='',$method='post',$htmlOptions=array())
	{
		return self::getJValidateInstance()->beginForm($action,$method,$htmlOptions);		
	}	
	public static function beginForm($action='',$method='post',$htmlOptions=array()){
		return self::getJValidateInstance()->beginForm($action,$method,$htmlOptions);
	}	

	public static function endForm(){
		self::getJValidateInstance()->endForm();
		return CHtml::endForm();
	}	
	public static function activeTextField($model,$attribute,$htmlOptions=array()){
		return self::getJValidateInstance()->activeTextField($model,$attribute,$htmlOptions);
	}
	public static function activePasswordField($model,$attribute,$htmlOptions=array()){
		return self::getJValidateInstance()->activePasswordField($model,$attribute,$htmlOptions);
	}
	public  static function activeCheckBox($model,$attribute,$htmlOptions=array()){
		return self::getJValidateInstance()->activeCheckBox($model,$attribute,$htmlOptions);
	}
	public static function activeCheckBoxList($model, $attribute, $data, $htmlOptions=array()){
		return self::getJValidateInstance()->activeCheckBoxList($model, $attribute, $data, $htmlOptions);		
	}
	public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions=array()){
		return self::getJValidateInstance()->activeRadioButtonList($model, $attribute, $data, $htmlOptions);
	}
	public static function activeDropDownList($model, $attribute, $data, $htmlOptions=array()){
		return self::getJValidateInstance()->activeDropDownList($model, $attribute, $data, $htmlOptions);
	}
	public static function activeListBox($model, $attribute, $data, $htmlOptions=array()){
		return self::getJValidateInstance()->activeListBox($model, $attribute, $data, $htmlOptions);
	}
	public static function activeTextArea($model, $attribute, $htmlOptions=array ( )){
		return self::getJValidateInstance()->activeTextArea($model, $attribute, $htmlOptions);
	}
	public static function ajaxSubmitButton($label,$url,$ajaxOptions=array(),$htmlOptions=array()){
		return self::getJValidateInstance()->ajaxSubmitButton($label,$url,$ajaxOptions,$htmlOptions);
	}
	
	public static function setScenario($scenario)
	{
		self::getJValidateInstance()->setScenario($scenario);		
	}
	public static function setOptions($opt){
		self::getJValidateInstance()->setOptions($opt);
	}	
}
?>
