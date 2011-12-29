<?php include('_top.php');?>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>
</th>
    <td><?php echo CHtml::encode($model->username); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('profile')); ?>
</th>
    <td><?php echo CHtml::encode($model->profile); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('regIp')); ?>
</th>
    <td><?php echo CHtml::encode($model->regIp); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('regTime')); ?>
</th>
    <td><?php echo CHtml::encode($model->regTime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastLoginIp')); ?>
</th>
    <td><?php echo CHtml::encode($model->lastLoginIp); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastLoginTime')); ?>
</th>
    <td><?php echo CHtml::encode($model->lastLoginTime); ?>
</td>
</tr>
</table>
