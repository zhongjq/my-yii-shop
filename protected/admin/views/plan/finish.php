<h2>Update plan <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('plan List',array('list')); ?>]
[<?php echo CHtml::link('New plan',array('create')); ?>]
[<?php echo CHtml::link('Manage plan',array('admin')); ?>]
</div>

<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<?php echo CHtml::activeHiddenField($model,'uid'); ?>
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
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('plan')); ?>
</th>
    <td><?php echo CHtml::encode($model->plan); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo CHtml::encode($model->createtime); ?>
</td>
</tr>
</table>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'memo'); ?>
<?php echo CHtml::activeTextArea($model,'memo',array('rows'=>6, 'cols'=>50)); ?>
</div>


<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : '完成计划'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->