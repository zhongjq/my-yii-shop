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
    <td><?php echo CHtml::link(CHtml::image($model->icon,$model->icon,array('class'=>product_img_big)),$model->icon); ?>
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
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('number')); ?>
</th>
    <td><?php echo CHtml::encode($model->number); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('weight')); ?>
</th>
    <td><?php echo CHtml::encode($model->weight); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo CHtml::encode(date('Y-m-d H:i:s',$model->createtime)); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('updatetime')); ?>
</th>
    <td><?php echo CHtml::encode(date('Y-m-d H:i:s',$model->updatetime)); ?>
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
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('date')); ?>
</th>
    <td><?php echo CHtml::encode($model->date); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('hit')); ?>
</th>
    <td><?php echo CHtml::encode($model->hit); ?>
</td>
</tr>
</table>
