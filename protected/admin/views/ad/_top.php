<?php
	$action = $this->action->id;
	$cate_id = !empty($model) ? $model->cate_id : $_GET['id'];
	$cate_name = tree::model()->findByPk($cate_id)->name;

?>
<h2><?php echo $cate_name;?></h2>

<div class="actionBar">
<?php
	echo CHtml::link('添加',array('create','id'=>$cate_id));

	if($action == 'show')
		echo CHtml::link('修改',array('update','id'=>$model->id)) . CHtml::linkButton('删除',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?'));
	if($action == 'create' OR $action == 'update' OR $action == 'show' )
		echo CHtml::link('返回',array('admin','id'=>$cate_id));
?>
</div>