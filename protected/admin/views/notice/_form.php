<div class="yiiForm">

<p>
带 <span class="required">*</span> 的项目为必填
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cate_id'); ?>
<?php echo CHtml::activeDropDownList($model,'cate_id',$this->cate_list); ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'title'); ?>
<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'datetime'); ?>
<?php echo CHtml::activeTextField($model,'datetime'); ?>
</div>
    <?php $this->widget('application.extensions.JSCal2.SCalendar',
        array(
        'inputField'=>'notice_datetime',
		'trigger'=>"notice_datetime",
        'ifFormat'=>'%Y-%m-%d %H:%M',
        'showTime'=>24,
    ));
    ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'sort'); ?>
<?php echo CHtml::activeTextField($model,'sort'); ?>
</div>
<div class="action">
<?php echo CHtml::activeLabelEx($model,'top'); ?>
<?php echo CHtml::activeCheckBox($model,'top',array('class'=>'vmiddel')); ?>

<?php echo CHtml::activeLabel($model,'digest'); ?>
<?php echo CHtml::activeCheckBox($model,'digest',array('class'=>'vmiddel')); ?>

<?php echo CHtml::activeLabelEx($model,'state'); ?>
<?php echo CHtml::activeCheckBox($model,'state',array('class'=>'vmiddel')); ?>
</div>


<div class="simple">
<?php //echo CHtml::activeLabelEx($model,'content'); ?>
<?php echo CHtml::activeTextArea($model,'content',array('rows'=>6, 'cols'=>50,'fmt'=>'fck')); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? '修改' : '添加'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
