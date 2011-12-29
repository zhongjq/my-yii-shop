<div class="yiiForm">

<p>
带*号为必填项
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'title'); ?>
<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'content'); ?>
<?php echo CHtml::activeTextArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'reply'); ?>
<?php echo CHtml::activeTextArea($model,'reply',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple hidden">
<?php echo CHtml::activeLabelEx($model,'userid'); ?>
<?php echo CHtml::activeTextField($model,'userid'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'username'); ?>
<?php echo CHtml::activeTextField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'email'); ?>
<?php echo CHtml::activeTextField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'qq'); ?>
<?php echo CHtml::activeTextField($model,'qq',array('size'=>15,'maxlength'=>15)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'homepage'); ?>
<?php echo CHtml::activeTextField($model,'homepage',array('size'=>25,'maxlength'=>25)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'hidden'); ?>
<?php echo CHtml::activeTextField($model,'hidden'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'passed'); ?>
<?php echo CHtml::activeTextField($model,'passed'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'ip'); ?>
<?php echo CHtml::activeTextField($model,'ip',array('size'=>15,'maxlength'=>15)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'create_time'); ?>
<?php echo CHtml::activeTextField($model,'create_time'); ?>
<?php $this->widget('application.extensions.JSCal2.SCalendar',
    array(
    'inputField'=>'guestbook_create_time',
	'trigger'=>"guestbook_create_time",
    'ifFormat'=>'%Y-%m-%d %H:%M',
    'showTime'=>'12',
));
?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'replyer'); ?>
<?php echo CHtml::activeTextField($model,'replyer',array('size'=>20,'maxlength'=>20)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'reply_time'); ?>
<?php echo CHtml::activeTextField($model,'reply_time'); ?>
<?php $this->widget('application.extensions.JSCal2.SCalendar',
    array(
    'inputField'=>'guestbook_reply_time',
	'trigger'=>"guestbook_reply_time",
    'ifFormat'=>'%Y-%m-%d %H:%M',
    'showTime'=>'12',
));
?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
