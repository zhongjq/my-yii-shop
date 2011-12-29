
<div class="yiiForm">

<p>
带 <span class="required">*</span> 的项目为必填
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'type'); ?>
<?php echo CHtml::activeDropDownList($model,'type',$this->type_arr); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'startdate'); ?>
<?php echo CHtml::activeTextField($model,'startdate',array("id"=>"startdate")); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'enddate'); ?>
<?php echo CHtml::activeTextField($model,'enddate',array("id"=>"enddate")); ?>
</div>
    <?php $this->widget('application.extensions.JSCal2.SCalendar',
        array(
        'inputField'=>'startdate',
		'trigger'=>"startdate",
        'ifFormat'=>'%Y-%m-%d %H:%M',
    ));
    ?>
    <?php $this->widget('application.extensions.JSCal2.SCalendar',
        array(
        'inputField'=>'enddate',
		'trigger'=>"enddate",
        'ifFormat'=>'%Y-%m-%d %H:%M',
    ));
    ?>


<?php echo CHtml::activeTextArea($model,'plan',array('rows'=>6, 'cols'=>50)); ?>

<script type="text/javascript">
CKEDITOR.replace('plan_plan');
</script>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->