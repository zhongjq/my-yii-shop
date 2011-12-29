<?php
	$action = $this->action->id;
	$cate_id = !empty($model) ? $model->cate_id : $_GET['id'];
	$cate_name = tree::model()->findByPk($cate_id)->name;

?>
<h2>产品中心</h2>

<div class="actionBar">
<?php
	echo CHtml::link('添加',array('create','id'=>$cate_id));

	if($action == 'show')
		echo CHtml::link('修改',array('update','id'=>$model->id)) . CHtml::linkButton('删除',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?'));
	if($action == 'create' OR $action == 'update' OR $action == 'show' )
		echo CHtml::link('返回',array('admin','id'=>$cate_id));
?>
</div>

<?php if($action == 'admin'){ ?>
<div class="actionBar">
	<?php echo CHtml::beginForm(); ?>
		<div>
			产品分类:<?php echo CHtml::dropDownList('cate_id', $_POST['cate_id'], $this->cate_list);?>
			产品名称:<input type="input" name="title" value="<?php echo $_POST['title']?>" />
			<input type="submit" value="搜索" />
		</div>
	<?php echo CHtml::endForm(); ?>
</div>
<?php }?>
