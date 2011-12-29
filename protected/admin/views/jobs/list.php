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
<?php echo CHtml::encode($model->getAttributeLabel('descript')); ?>:
<?php echo CHtml::encode($model->descript); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('number')); ?>:
<?php echo CHtml::encode($model->number); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>:
<?php echo CHtml::encode($model->createtime); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('start_date')); ?>:
<?php echo CHtml::encode($model->start_date); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('end_date')); ?>:
<?php echo CHtml::encode($model->end_date); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('sex')); ?>:
<?php echo CHtml::encode($model->sex); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('education')); ?>:
<?php echo CHtml::encode($model->education); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('place')); ?>:
<?php echo CHtml::encode($model->place); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
