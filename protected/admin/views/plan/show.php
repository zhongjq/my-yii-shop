<h2>View plan <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('plan List',array('list')); ?>]
[<?php echo CHtml::link('New plan',array('create')); ?>]
[<?php echo CHtml::link('Update plan',array('update','id'=>$model->id)); ?>]
[<?php echo CHtml::linkButton('Delete plan',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage plan',array('admin')); ?>]
</div>

<table class="dataGrid" cellspacing="0">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('uid')); ?>
</th>
    <td><?php echo CHtml::encode($model->user->realname); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>
</th>
    <td><?php echo CHtml::encode($this->type_arr[$model->type]); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('startdate')); ?>
</th>
    <td><?php echo CHtml::encode($model->startdate); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('enddate')); ?>
</th>
    <td><?php echo CHtml::encode($model->enddate); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>
</th>
    <td><?php echo CHtml::encode($this->state_arr[$model->state]); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('overdate')); ?>
</th>
    <td><?php echo CHtml::encode($model->overdate); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('plan')); ?>
</th>
    <td><?php echo $model->plan; ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('memo')); ?>
</th>
    <td><?php echo CHtml::encode($model->memo); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo CHtml::encode($model->createtime); ?>
</td>
</tr>
</table>
