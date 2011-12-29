<div class="yiiForm">

<p>
带 <span class="required">*</span> 的项目为必填
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple<?php echo !empty($_GET['id']) ? ' hidden':''?>">
<?php echo CHtml::activeLabelEx($model,'cate_id'); ?>
<?php echo CHtml::activeDropDownList($model,'cate_id',$this->cate_list); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'icon'); ?>
<?php echo CHtml::activeTextField($model,'icon',array('size'=>40,'maxlength'=>255,'id'=>'xFilePath')); ?>
<input type="button" id="browseServer" value="上传图片"/>
</div>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'title'); ?>
<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'url'); ?>
<?php echo CHtml::activeTextField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'sort'); ?>
<?php echo CHtml::activeTextField($model,'sort'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? '修改' : '添加'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->