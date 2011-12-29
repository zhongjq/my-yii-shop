<?php include('_top.php');?>


<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cate_id')); ?>
</th>
    <td><?php echo CHtml::encode($model->cate->name); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('icon')); ?>
</th>
    <td><?php echo CHtml::encode($model->icon); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>
</th>
    <td><?php echo CHtml::encode($model->title); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('content')); ?>
</th>
    <td><?php echo $model->content; ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('sort')); ?>
</th>
    <td><?php echo CHtml::encode($model->sort); ?>
</td>
</tr>
</table>
