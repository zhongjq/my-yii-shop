<div class="content_title">
	Feedback
</div>
<div class="content_main feedback">

	<?php if(Yii::app()->user->hasFlash('contact')): ?>
	<div class="confirmation">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>
	<?php else: ?>

	<p>
	If you have business inquries or other questions, please fill out the following form to contact us. Thank you.
	</p>


	<div class="yiiForm">

	<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'name'); ?>
	<?php echo CHtml::activeTextField($model,'name'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'email'); ?>
	<?php echo CHtml::activeTextField($model,'email'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'company'); ?>
	<?php echo CHtml::activeTextField($model,'company'); ?>
	</div>

	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'phone'); ?>
	<?php echo CHtml::activeTextField($model,'phone'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'fax'); ?>
	<?php echo CHtml::activeTextField($model,'fax'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'product'); ?>
	<?php echo CHtml::activeTextField($model,'product'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'message'); ?>
	<?php echo CHtml::activeTextArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'other'); ?>
	<?php echo CHtml::activeTextArea($model,'other',array('rows'=>6, 'cols'=>50)); ?>
	</div>
	<div class="action">
	<?php echo CHtml::submitButton('Send'); ?>
	<?php echo CHtml::ResetButton('Clear'); ?>

	</div>

	<?php echo CHtml::endForm(); ?>

	</div><!-- yiiForm -->
	<?php endif; ?>

</div>