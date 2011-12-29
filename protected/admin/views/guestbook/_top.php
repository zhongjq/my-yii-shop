<?php
	$action = $this->action->id;
?>
<h2>留言簿</h2>

<div class="actionBar">
<?php
	echo CHtml::link('添加',array('create'));

	if($action == 'show')
		echo CHtml::link('修改',array('update','id'=>$model->id)) . CHtml::linkButton('删除',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?'));
	if($action == 'create' OR $action == 'update' OR $action == 'show' )
		echo CHtml::link('返回',array('admin'));
?>
</div>

<?php if($action == 'admin'){ ?>
<div class="actionBar">
	<?php echo CHtml::beginForm(); ?>
		<div>
			职位名称:<input type="input" name="title" value="<?php echo $_POST['title']?>" />
			<input type="submit" value="搜索" />
		</div>
	<?php echo CHtml::endForm(); ?>
</div>
<?php }?>
