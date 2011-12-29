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
<?php echo CHtml::encode($model->getAttributeLabel('cate_id')); ?>:
<?php echo CHtml::encode($model->cate->name); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('datetime')); ?>:
<?php echo CHtml::encode($model->datetime); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('top')); ?>:
<?php echo CHtml::encode($model->top); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('digest')); ?>:
<?php echo CHtml::encode($model->digest); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('state')); ?>:
<?php echo CHtml::encode($model->state); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('sort')); ?>:
<?php echo CHtml::encode($model->sort); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('view')); ?>:
<?php echo CHtml::encode($model->view); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>