<div class="caption">
	<h2>帐号登录</h2>
	<p>如果您在本站已拥有帐号，请使用已有的帐号信息直接进行登录即可，不需重复注册。</p>
</div>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<?php if(extension_loaded('gd')): ?>
<div class="simple">
	<?php echo CHtml::activeLabel($form,'verifyCode'); ?>
	<div class="pt">
		<?php $this->widget('CCaptcha'); ?><br/>
		<?php echo CHtml::activeTextField($form,'verifyCode',array('class'=>'t_input')); ?>
	</div>
	<p class="hint">请输入上面的4位字母或数字，看不清可刷新</p>
</div>
<?php endif; ?>

<div class="simple">
<?php echo CHtml::activeLabel($form,'username'); ?>
<?php echo CHtml::activeTextField($form,'username',array('class'=>'t_input',)) ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'password'); ?>
<?php echo CHtml::activePasswordField($form,'password',array('class'=>'t_input',)) ?>
<p class="hint">
</p>
</div>


<div class="action">
<?php echo CHtml::activeCheckBox($form,'rememberMe'); ?>
<?php echo CHtml::activeLabel($form,'rememberMe'); ?>
<br/>
<?php echo CHtml::submitButton('登录',array('class'=>'submit')); ?>
	<?php //echo CHtml::link('忘记密码',array('site/forget')); ?>
</div>

<?php echo CHtml::endForm(); ?>