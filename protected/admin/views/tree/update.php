<h2>编辑 分类</h2>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'father'=>$father,
	'update'=>true,
)); ?>