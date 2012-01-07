<?php $this->breadcrumbs=array(
    '走进华科', $content->title,
);?>
<div class="content_title">
	<?php echo $content->title;?>
</div>
<div class="content_main">
	<?php echo $content->content;?>

	<?php
	if($this->action->id == 'contact')
	{
		echo $this->renderPartial('feedback',array('model'=>$model));
	}
	?>
</div>
