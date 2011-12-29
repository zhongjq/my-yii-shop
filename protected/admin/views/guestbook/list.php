<?php include('_top.php');?>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:
<?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('title')); ?>:
<?php echo CHtml::encode($model->title); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('content')); ?>:
<?php echo CHtml::encode($model->content); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('reply')); ?>:
<?php echo CHtml::encode($model->reply); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('userid')); ?>:
<?php echo CHtml::encode($model->userid); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('username')); ?>:
<?php echo CHtml::encode($model->username); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('gender')); ?>:
<?php echo CHtml::encode($model->gender); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('head')); ?>:
<?php echo CHtml::encode($model->head); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:
<?php echo CHtml::encode($model->email); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('qq')); ?>:
<?php echo CHtml::encode($model->qq); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('homepage')); ?>:
<?php echo CHtml::encode($model->homepage); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('hidden')); ?>:
<?php echo CHtml::encode($model->hidden); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('passed')); ?>:
<?php echo CHtml::encode($model->passed); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('ip')); ?>:
<?php echo CHtml::encode($model->ip); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('create_time')); ?>:
<?php echo CHtml::encode($model->create_time); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('replyer')); ?>:
<?php echo CHtml::encode($model->replyer); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('reply_time')); ?>:
<?php echo CHtml::encode($model->reply_time); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
