<h2>New plan</h2>

<div class="actionBar">
[<?php echo CHtml::link('plan List',array('list')); ?>]
[<?php echo CHtml::link('Manage plan',array('admin')); ?>]
</div>
<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>