<style>
	#sidebar {
		display:none;
	}
	#primary {
		width: 880px;
	}
</style>

<div class="content_title">
	<?php echo $model->title;?>

</div>
<div class="center">

</div>

<div class="content_main">
	<div style="width:340px;float:left;">
	<?php echo CHtml::link(CHtml::image($model->icon,$model->icon,array('class'=>product_img_big)),$model->icon); ?><br/>
	<?php echo $model->title;?><br/>
	</div>
	<div style="float:left;width:540px">
							<div class="product_option">
								<label>Product Name:</label><?php echo CHtml::encode($model->title);?>
							</div>
							<div class="product_option">
								<label>Part No:</label><?php echo CHtml::encode($model->number);?>
							</div>
							<div class="product_option">
								<label>Net Weight:</label><?php echo CHtml::encode($model->weight);?>
							</div>
							<br/>
	<?php echo $model->content;?><br/>
	</div>
</div>
<div class="clearfix"></div>
<div class="center">
	<input type="button" value=" Back " onclick="javascript:window.history.go(-1);" class="box_01" name="button2"/>
</div>