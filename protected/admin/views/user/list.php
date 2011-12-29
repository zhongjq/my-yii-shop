<?php include('_top.php');?>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('userid')); ?>:
<?php echo CHtml::link($model->userid,array('show','id'=>$model->userid)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('username')); ?>:
<?php echo CHtml::encode($model->username); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('password')); ?>:
<?php echo CHtml::encode($model->password); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:
<?php echo CHtml::encode($model->email); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('profile')); ?>:
<?php echo CHtml::encode($model->profile); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('regIp')); ?>:
<?php echo CHtml::encode($model->regIp); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('regTime')); ?>:
<?php echo CHtml::encode($model->regTime); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('lastLoginIp')); ?>:
<?php echo CHtml::encode($model->lastLoginIp); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('lastLoginTime')); ?>:
<?php echo CHtml::encode($model->lastLoginTime); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>