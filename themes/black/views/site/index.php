<div id="index_right">
	<h3 class="title">New Products</h3>
	<div class="new_products" id="scrollDiv">
		<ul>
		<?php foreach($tops as $n=>$model): ?>
			<li>
			<div class="new_prod_box <?php echo $n%2?'even':'odd';?>">
				<div class="prod_bg">
					<?php echo CHtml::link(CHtml::image($model->icon,$model->title,array('class'=>product_img_small)),array('/product/show','id'=>$model->id)); ?>
				</div>
				<?php echo CHtml::link($model->title,array('/product/show','id'=>$model->id)); ?>
			</div>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>

<div id="index_center">
	<div id="banner">
		<?php if(!empty($ads)) {?>
			<div id="play_text">
				<ul>
				<?php foreach($ads as $key => $ad){?>
					<li><?=$key+1?></li>
				<?php }?>
				</ul>
			</div>
			<div id="play_list">
				<?php foreach($ads as $model){
					
					 echo CHtml::link(CHtml::image($model->icon,$model->title),$model->url);
					
			 	}	?>
			</div>
		<?php } ?>
	</div>
	<div id="index_content">
		<?php echo $content->content;?>
	</div>
	<div id="index_product">
		<div class="product_title">
			Featured Products
		</div>
		<div class="new_products">
			<?php foreach($digest as $n=>$model): ?>
				<div class="new_prod_box <?php echo $n%2?'even':'odd';?>">
					<div class="prod_bg">
						<?php echo CHtml::link(CHtml::image($model->icon,$model->title,array('class'=>product_img_small)),array('/product/show','id'=>$model->id)); ?>
					</div>
					<?php echo CHtml::link($model->title,array('/product/show','id'=>$model->id)); ?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>
</div>