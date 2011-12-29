<div class="content_title">
	<div class="span">
	<?php echo $model->title;?>
	</div>
</div>
<div class="center">
	<?php echo CHtml::link(CHtml::image($model->icon,$model->icon,array('class'=>product_img_big)),$model->icon); ?><br/>
	<?php echo $model->title;?><br/>
</div>

<div class="content_main">
	<?php echo $model->content;?><br/>
</div>

<div class="center">
	<input type="button" value=" Back " onclick="javascript:window.history.go(-1);" class="box_01" name="button2"/>
</div>