<?php $this->pageTitle=Yii::app()->name . ' - 登录'; ?>

<div class="yiiForm c_form">
	<?php $this->widget('UserLogin',array('visible'=>Yii::app()->user->isGuest)); ?>
</div><!-- yiiForm -->

<div class="c_form">

<div class="caption">
<h2>还没有注册吗？</h2>
<p>如果还没有本站的通行帐号，请先注册一个属于自己的帐号吧。</p>
</div>

<?php echo Chtml::link('立即注册',array('site/register'),array('class'=>'gotoreg'))?>
</div>