<h2>Update plan <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('plan List',array('list')); ?>]
[<?php echo CHtml::link('New plan',array('create')); ?>]
[<?php echo CHtml::link('Manage plan',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>