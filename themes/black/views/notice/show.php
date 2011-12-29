<div class="content_title">
	<?php echo $model->title;?>

</div>
<div class="center">
	<?php echo CHtml::encode($model->title,array('class'=>product_img_big)); ?><br/>
	<?php echo CHtml::encode($model->datetime); ?><br/>
</div>

<div class="content_main">
	<?php echo $model->content;?><br/>
</div>

<div class="center">
	<input type="button" value=" Back " onclick="javascript:window.history.go(-1);" class="box_01" name="button2"/>
</div>