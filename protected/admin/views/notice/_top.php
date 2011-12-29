<?php
	
	$action = $this->action->id;
	$cate_id = !empty($model->cate_id) ? $model->cate_id : Yii::app()->request->getParam('cate_id');
	
	$cate_name = tree::model()->findByPk($cate_id)->name;

?>
<h2>新闻中心 <?php echo $cate_name;?></h2>

<div class="actionBar">
<?php
	echo CHtml::link('添加',array('create','cate_id'=>$cate_id));

	if($action == 'show')
		echo CHtml::link('修改',array('update','id'=>$model->id)) . CHtml::linkButton('删除',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure?'));
	if($action == 'create' OR $action == 'update' OR $action == 'show' )
		echo CHtml::link('返回',array('admin','cate_id'=>$cate_id));
?>
</div>

<?php if($action == 'admin'){ ?>
<div class="actionBar">
	<?php echo CHtml::beginForm('','GET'); ?>
		<div>
			新闻分类:<?php echo CHtml::dropDownList('cate_id', Yii::app()->request->getParam('cate_id'), $this->cate_list);?>
			新闻标题:<input type="input" name="title" value="<?php echo Yii::app()->request->getParam('title');?>" />
			
			<input type="submit" value="搜索" />
		</div>
	<?php echo CHtml::endForm(); ?>
</div>
<?php }?>
