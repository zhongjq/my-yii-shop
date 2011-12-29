<?php
	$action = $this->action->id;
?>
<h2>用户中心</h2>

<div class="actionBar">
<?php
	echo CHtml::link('添加',array('create','id'=>$cate_id),array('class'=>'thickbox'));

	if($action == 'show')
		echo CHtml::link('修改',array('update','id'=>$model->userid)) . CHtml::linkButton('删除',array('submit'=>array('delete','id'=>$model->userid),'confirm'=>'Are you sure?'));
	if($action == 'create' OR $action == 'update' OR $action == 'show' )
		echo CHtml::link('返回',array('admin','id'=>$cate_id));
?>
</div>
