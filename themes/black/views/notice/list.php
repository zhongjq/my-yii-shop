<div class="content_title">
	<?php echo $this->title?>
</div>

<div class="products">
    <?php foreach($models as $n=>$model): ?>
		<div class="feat_prod_box">
			<table cellspacing="0">
				<tr>
					<td>
						<div class="prod_bg"><?php echo CHtml::link(CHtml::image($model->icon,$model->icon,array('class'=>product_img_small)),array('show','id'=>$model->id)); ?></div>
					</td>
					<td valign="middle" class="vmiddle" width="400">
						<div class="prod_title"><?php echo CHtml::encode($model->title);?><div>
					</td>
					<td valign="middle" class="vmiddle" >
						<?php echo CHtml::link('Click for details >> ',array('show','id'=>$model->id)); ?>
					</td>
				</tr>
			</table>
		</div>
    <?php endforeach; ?>

</div>
<div class="clear"></div>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>