<h2>View website <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('website List',array('list')); ?>]
[<?php echo CHtml::link('New website',array('create')); ?>]
[<?php echo CHtml::link('Update website',array('update','id'=>$model->id)); ?>]
[<?php echo CHtml::linkButton('Delete website',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage website',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>
</th>
    <td><?php echo CHtml::encode($model->name); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('value')); ?>
</th>
    <td><?php echo CHtml::encode($model->value); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('autoload')); ?>
</th>
    <td><?php echo CHtml::encode($model->autoload); ?>
</td>
</tr>
</table>
