<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'title'); ?>
<?php echo CHtml::activeTextField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'number'); ?>
<?php echo CHtml::activeTextField($model,'number'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'start_date'); ?>
<?php echo CHtml::activeTextField($model,'start_date'); ?>
<?php $this->widget('application.extensions.JSCal2.SCalendar',
    array(
    'inputField'=>'jobs_start_date',
	'trigger'=>"jobs_start_date",
    'ifFormat'=>'%Y-%m-%d %H:%M',
    'showTime'=>'12',
));
?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'end_date'); ?>
<?php echo CHtml::activeTextField($model,'end_date'); ?>
</div>
<?php $this->widget('application.extensions.JSCal2.SCalendar',
    array(
    'inputField'=>'jobs_end_date',
	'trigger'=>"jobs_end_date",
    'ifFormat'=>'%Y-%m-%d %H:%M',
    'showTime'=>'12',
));
?>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'sex'); ?>
<?php echo CHtml::activeDropDownList($model,'sex',array('不限'=>'不限','男'=>'男','女'=>'女')); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'education'); ?>
<?php echo CHtml::activeTextField($model,'education'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'place'); ?>
<?php echo CHtml::activeTextField($model,'place',array('size'=>50,'maxlength'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'descript'); ?>
<?php echo CHtml::activeTextArea($model,'descript',array('rows'=>6, 'cols'=>50, 'fmt'=>'fck')); ?>
</div>
<div class="action">
<?php echo CHtml::submitButton($update ? '保存' : '添加'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
