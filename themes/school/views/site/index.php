	<div class="bigbox clearfix">
		<div class="bar1">
			<span>资讯</span>
		</div>
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
		<div id="school_news">
			<div class="xbox_main">
				<ul>
					<?php if(!empty($notices)) foreach($notices as $key => $model){?>
						<li><?php echo CHtml::link($model->title,array('content/about','id'=>$model->id));?></li>
					<?php }?>
				</ul>
				<a href="#" class="more">more</a>
			</div>

		</div>
	</div>

	<div class="clearfix">
		<div class="xbox showpadding">
			<h3><span>学校概况</span></h3>
			<div class="xbox_main">
				<ul>
					<?php if(!empty($abouts)) foreach($abouts as $key => $model){?>
						<li><?php echo CHtml::link($model->title,array('content/about','id'=>$model->id));?></li>
					<?php }?>
				</ul>
				<?php echo CHtml::link('more',array('content/about'),array('class'=>'more'));?>
			</div>
		</div>
		<div class="xbox">
			<h3><span>教育科研</span></h3>
			<div class="xbox_main">
				<ul>
					<?php if(!empty($edus)) foreach($edus as $key => $model){?>
						<li><?php echo CHtml::link($model->title,array('content/about','id'=>$model->id));?></li>
					<?php }?>
				</ul>
				<?php echo CHtml::link('more',array('content/education'),array('class'=>'more'));?>
			</div>
		</div>
		<div class="xbox showbottom showpadding">
			<h3><span>教师园地</span></h3>
			<div class="xbox_main">
				<ul>
					<?php if(!empty($tlives)) foreach($tlives as $key => $model){?>
						<li><?php echo CHtml::link($model->title,array('content/about','id'=>$model->id));?></li>
					<?php }?>
				</ul>
				<?php echo CHtml::link('more',array('content/honor'),array('class'=>'more'));?>
			</div>
		</div>
		<div class="xbox showbottom">
			<h3><span>杏坛硕果</span></h3>
			<div class="xbox_main">
				<ul>
					<?php if(!empty($slives)) foreach($slives as $key => $model){?>
						<li><?php echo CHtml::link($model->title,array('content/about','id'=>$model->id));?></li>
					<?php }?>
				</ul>
				<?php echo CHtml::link('more',array('content/life'),array('class'=>'more'));?>
			</div>
		</div>
	</div>
	<div id="index_content">
		<?php echo $content->content;?>
	</div>
	<div id="index_product">
		<div class="product_title">
			学校名师
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

