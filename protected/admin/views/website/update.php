<h2>Update website <?php echo $model->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('website List',array('list')); ?>]
[<?php echo CHtml::link('New website',array('create')); ?>]
[<?php echo CHtml::link('Manage website',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>