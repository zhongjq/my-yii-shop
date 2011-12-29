(function($) {
$.fn.EJFValidate = {
	version : 1.0,
	spice : 'EJSv_',
	normalizedNames : false,
	uniqueName : function(){
		
		if($.fn.EJFValidate.normalizedNames == false)
		{
			//alert('uniqueName : '+$.fn.EJFValidate.normalizedNames);
			$('input[type="hidden"]').each(function(){		
				// this causes a problem with hidden fields insert on purpose (and not automatically 
				// by yii. All hidden input fields names are changed.
				var e = $(this);
				e.attr('name',$.fn.EJFValidate.spice+e.attr('name'));
			});	
			$.fn.EJFValidate.normalizedNames = true;	
		}
	},
	restoreName:function(){		
		if($.fn.EJFValidate.normalizedNames == true)
		{
			//alert('restoreName'+$.fn.EJFValidate.normalizedNames);
			$('input[type="hidden"]').each(function(){		
				var e = $(this);
				e.attr('name',e.attr('name').substring($.fn.EJFValidate.spice.length));
			});	
			$.fn.EJFValidate.normalizedNames=false;
		}		
	},
	submitHandler:function(form){		
		//alert("submitHandler ...");		
		$.fn.EJFValidate.restoreName();		
		form.submit();		
	}
};	
})(jQuery);
jQuery.validator.addMethod("equalToConst", function(value, element, params) { 
    return this.optional(element) || value == params; 
}, "Please enter value {0}"); 
/**
 * params options : 
 * 		integerOnly : (boolean)
 * 		max         : (number)
 *      min         : (number)
 *      tooBig      : (string)
 *      tooSmall    : (string)
 *      notInt      : (string)
 *      msg         : (string)      
 */
jQuery.validator.addMethod("numerical", function(value, element, params) { 

	if(value === undefined || value == '')
		return true;
	if( params.integerOnly == true && /^[-+]?[0-9]*[0-9]+$/.test(value) == false)
	{
    	//alert('no match : not integer');
    	$(element).attr('msgId',1);	// not integer
    	return false;
    }
    else if( /^[-+]?[0-9]*\.?[0-9]+$/.test(value) == false) 
    {
    	//alert('no match : not number');
    	$(element).attr('msgId',2);	// not numerical
    	return false;
    } 
	if( params.max && ( 
    		(params.integerOnly && parseInt(value) > params.max) ||
    		(parseFloat(value) > params.max)
		)){
    	//alert('out of range (over max)');
    	$(element).attr('msgId',3);	// tooBig
    	return false;
    }
	if( params.min != null && ( 
			(params.integerOnly && parseInt(value) < params.min) ||
			(parseFloat(value) < params.min)
		)){
		//alert('out of range (below min)');
		$(element).attr('msgId',4);	// tooSmall
		return false;
	}
    return true;

}, function(params, element){
		var msgId = parseInt($(element).attr('msgId'));
		$(element).removeAttr('msgId');
			
		if( msgId == 3 && params.tooBig !== undefined )
			return params.tooBig;
		if( msgId == 4 && params.tooSmall !== undefined )
			return params.tooSmall;
		if( msgId == 1 && params.notInt !== undefined)
			return params.notInt;
		if(params.msg !== undefined )	
			return params.msg;
		else
			return "please enter a numerical value";
	
	}
);
/**
 * params : the regexp pattern to apply to 'value'
 */
jQuery.validator.addMethod("match", function(value, element, params) { 
	if(value === undefined || value == '')
		return true;
	//alert('pattern = '+params+' value = '+value+' result = '+eval(params).test(value));
	return eval(params).test(value);
}, "Please enter value {0}"); 



