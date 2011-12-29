
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Dialog box 1',
        'autoOpen'=>false,
    ),
));

    echo 'dialog content here';

$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('open dialog', '#', array(
   'onclick'=>'$("#mydialog").dialog("open"); return false;',
));



?>
<?php $this->pageTitle=Yii::app()->name . ' - Register'; ?>
<div class="yiiForm c_form">
	<div class="caption">
		<h2>注册本站帐号</h2>
		<p>请完整填写以下信息进行注册。<br/>注册完成后，该帐号将作为您在本站的通行帐号，您可以享受本站提供的各种服务。</p>
	</div>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<?php if(extension_loaded('gd')): ?>
<div class="simple">
	<?php echo CHtml::activeLabel($form,'verifyCode'); ?>
	<div>
	<?php $this->widget('CCaptcha'); ?><br/>
	<?php echo CHtml::activeTextField($form,'verifyCode',array('class'=>'t_input')); ?>
	</div>
	<p class="hint">请输入上面的4位字母或数字，看不清可刷新</p>
</div>
<?php endif; ?>

<div class="simple">
<?php echo CHtml::activeLabel($form,'username'); ?>
<?php echo CHtml::activeTextField($form,'username',array('class'=>'t_input')) ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'password'); ?>
<?php echo CHtml::activePasswordField($form,'password',array('class'=>'t_input')) ?>
<p class="hint">
Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
</p>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($form,'password2'); ?>
<?php echo CHtml::activePasswordField($form,'password2',array('class'=>'t_input')) ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($form,'email'); ?>
<?php echo CHtml::activeTextField($form,'email',array('class'=>'t_input')) ?>
<p class="hint">
请准确填入您的邮箱，在忘记密码，或者您使用邮件通知功能时，会发送邮件到该邮箱。
</p>
</div>
<div class="simple">
	<div>
	<?php echo CHtml::submitButton('注册新用户',array('class'=>'submit')); ?>
	</div>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
