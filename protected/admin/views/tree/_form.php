<?php echo CHtml::beginForm(); ?>
<?php
	if(Yii::app()->request->isAjaxRequest){
		echo CHtml::hiddenField('url',Yii::app()->request->urlReferrer);
	}
?>
<?php echo CHtml::errorSummary($model); ?>
<div class="simple">
<label for="Tree_name">上级名称</label>
<?php echo CHtml::textField('name',$father['name'],array('size'=>30,'maxlength'=>255,'name'=>'name','disabled'=>'disabled')); ?>
</div>
<div class="simple">
<label for="Tree_name">分类名称</label>
<?php echo CHtml::activeTextField($model,'name',array('size'=>30,'maxlength'=>255,)); ?>
</div>
<div class="action">
<?php echo CHtml::submitButton($update ? '修改' : '添加'); ?>
</div>

<?php echo CHtml::endForm(); ?>