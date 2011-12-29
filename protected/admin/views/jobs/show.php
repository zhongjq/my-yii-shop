<?php include('_top.php');?>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>
</th>
	<td><?php echo CHtml::encode($model->title); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('descript')); ?>
</th>
	<td><?php echo CHtml::encode($model->descript); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('number')); ?>
</th>
	<td><?php echo CHtml::encode($model->number); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
	<td><?php echo CHtml::encode($model->createtime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('start_date')); ?>
</th>
	<td><?php echo CHtml::encode($model->start_date); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('end_date')); ?>
</th>
	<td><?php echo CHtml::encode($model->end_date); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('sex')); ?>
</th>
	<td><?php echo CHtml::encode($model->sex); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('education')); ?>
</th>
	<td><?php echo CHtml::encode($model->education); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('place')); ?>
</th>
	<td><?php echo CHtml::encode($model->place); ?>
</td>
</tr>
</table>
