<div class="yiiForm">

<p>
带 <span class="required">*</span> 的项目为必填
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'name'); ?>
<?php echo CHtml::activeTextField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'value'); ?>
<?php echo CHtml::activeTextField($model,'value',array('size'=>60,'maxlength'=>255)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'autoload'); ?>
<?php echo CHtml::activeTextField($model,'autoload'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->