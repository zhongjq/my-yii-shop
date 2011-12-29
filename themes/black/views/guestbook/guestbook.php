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
	<?php foreach($models as $n=>$guestbook): ?>
<div class="item">
<?php echo CHtml::encode($guestbook->getAttributeLabel('id')); ?>:
<?php echo CHtml::link($guestbook->id,array('show','id'=>$guestbook->id)); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('title')); ?>:
<?php echo CHtml::encode($guestbook->title); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('content')); ?>:
<?php echo CHtml::encode($guestbook->content); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('reply')); ?>:
<?php echo CHtml::encode($guestbook->reply); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('userid')); ?>:
<?php echo CHtml::encode($guestbook->userid); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('username')); ?>:
<?php echo CHtml::encode($guestbook->username); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('gender')); ?>:
<?php echo CHtml::encode($guestbook->gender); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('head')); ?>:
<?php echo CHtml::encode($guestbook->head); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('email')); ?>:
<?php echo CHtml::encode($guestbook->email); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('qq')); ?>:
<?php echo CHtml::encode($guestbook->qq); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('homepage')); ?>:
<?php echo CHtml::encode($guestbook->homepage); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('hidden')); ?>:
<?php echo CHtml::encode($guestbook->hidden); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('passed')); ?>:
<?php echo CHtml::encode($guestbook->passed); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('ip')); ?>:
<?php echo CHtml::encode($guestbook->ip); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('create_time')); ?>:
<?php echo CHtml::encode($guestbook->create_time); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('replyer')); ?>:
<?php echo CHtml::encode($guestbook->replyer); ?>
<br/>
<?php echo CHtml::encode($guestbook->getAttributeLabel('reply_time')); ?>:
<?php echo CHtml::encode($guestbook->reply_time); ?>
<br/>

</div>
	<?php endforeach; ?>

	<div class="yiiForm">
	<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'username'); ?>
	<?php echo CHtml::activeTextField($model,'username'); ?>
	</div>
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'title'); ?>
	<?php echo CHtml::activeTextField($model,'title'); ?>
	</div>	
	<div class="simple">
	<?php echo CHtml::activeLabelEx($model,'content'); ?>
	<?php echo CHtml::activeTextArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="action">
	<?php echo CHtml::submitButton('Send'); ?>
	<?php echo CHtml::ResetButton('Clear'); ?>

	</div>

	<?php echo CHtml::endForm(); ?>


	</div><!-- yiiForm -->
	<?php endif; ?>

</div>
