<div class="content_title">
	<?php echo $this->title ?>
</div>

<div class="new_products">

	<ul id="notice">
		<?php foreach($models as $n=>$model): ?>
			<li class="post" id="post-<?php echo $model->id;?>">
				<?php echo CHtml::link( CHtml::label(date('Y-m-d',strtotime($model->datetime)),'',array('class'=>'notice_time')).$model->title,array('show','id'=>$model->id)); ?>
			</li>		
		<?php endforeach; ?>
	</ul>
					
					


</div>
<div class="clear"></div>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>