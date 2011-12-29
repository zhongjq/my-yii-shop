<h2>website List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New website',array('create')); ?>]
[<?php echo CHtml::link('Manage website',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:
<?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:
<?php echo CHtml::encode($model->name); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('value')); ?>:
<?php echo CHtml::encode($model->value); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('autoload')); ?>:
<?php echo CHtml::encode($model->autoload); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>