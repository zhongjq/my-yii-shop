<div class="yiiForm">

<p>
带 <span class="required">*</span> 的项目为必填
</p>
<?php

	$CS=Yii::app()->jformvalidate;
	echo $CS->beginForm(); 

	$CS->setOptions(array(
		'errorElement'=> "span",
		'errorClass' => "error",		
		'onkeyup' => TRUE,
		'onfocusout' => TRUE,
		'submitHandler' => 'function(form){$.fn.EJFValidate.submitHandler(form);
		location.reload();}'
	));
?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'username'); ?>
<?php echo $CS->activeTextField($model,'username',array('size'=>15,'maxlength'=>15)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'password'); ?>
<?php echo $CS->activePasswordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'email'); ?>
<?php echo $CS->activeTextField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'profile'); ?>
<?php echo $CS->activeTextArea($model,'profile',array('rows'=>6, 'cols'=>50)); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo $CS->endForm(); ?>

</div><!-- yiiForm -->
