<div class="content_title">
	<?php echo $this->title ?>
</div>

<div class="new_products">

    <?php foreach($models as $n=>$model): ?>
        <div class="new_prod_box <?php echo $n%2?'even':'odd';?>">
            <div class="prod_bg">
                <?php echo CHtml::link(CHtml::image($model->icon,$model->title,array('class'=>product_img_small)),array('show','id'=>$model->id)); ?>
            </div>
            <?php echo CHtml::link($model->title,array('product/show','id'=>$model->id)); ?>
        </div>

    <?php endforeach; ?>

</div>
<div class="clear"></div>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>