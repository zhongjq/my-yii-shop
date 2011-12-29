<div class="content_title">
	<div class="span">
	<?php echo $content->title;?>
	</div>
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
