<div id="primary">
		<ul id="themes">
<?php if(!empty($themes)) foreach($themes as $theme_dir =>$row){ ?>
		<li<? if($theme_curr == $theme_dir) echo ' class="select"'?>>
			<a href="<?=url::site($this->tpl)."/themes/".$theme_dir?>" title="<?=$row['desc']?>">
				<img class="product_img" src="<?=$GLOBALS['theme_web'].$theme_dir."/screenshot.png"?>" /></a>
			<h6><a href="<?=url::site($this->tpl)."/themes/".$theme_dir?>" title="<?=$row['desc']?>"><?=$row['name']?></a> <em><?=$row['version']?></em></h6>
			<p><a><strong>by:<?=$row[author] ? $row[author] : "free"?></strong></a></p>
<? }?>
		</li>
	</ul>
</div>