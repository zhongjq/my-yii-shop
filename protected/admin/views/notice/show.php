<?php include('_top.php');?>
<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>
</th>
    <td><?php echo CHtml::encode($model->title); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('content')); ?>
</th>
    <td><?php echo ($model->content); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cate_id')); ?>
</th>
    <td><?php echo CHtml::encode($model->cate->name); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('datetime')); ?>
</th>
    <td><?php echo CHtml::encode($model->datetime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('top')); ?>
</th>
    <td><?php echo CHtml::encode($model->top); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('digest')); ?>
</th>
    <td><?php echo CHtml::encode($model->digest); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>
</th>
    <td><?php echo CHtml::encode($model->state); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('sort')); ?>
</th>
    <td><?php echo CHtml::encode($model->sort); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('view')); ?>
</th>
    <td><?php echo CHtml::encode($model->view); ?>
</td>
</tr>
</table>
