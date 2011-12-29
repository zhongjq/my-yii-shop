<div>
	<h2>CMS信息</h2>
	<br/>
	<?php
		$themes = Yii::app()->themeManager->themeNames;
		foreach($themes as $name)
		{
			$theme = Yii::app()->themeManager->getTheme($name);
			var_dump($theme);
			
		}
var_dump(Yii::app()->themeManager->themeNames);
?>

	<h3>统计信息</h3>
	<ul class="memlist">
		<li>
			<em><?php echo CHtml::link('管理员数量',array('user/'))?>:</em>	
			<em class="memcont"><?PHP echo $admin_count; ?></em>
		</li>	
		<li>
			<em><?php echo CHtml::link('产品总数',array('product/'))?>:</em>	
			<em class="memcont"><?PHP echo $product_count; ?></em>
		</li>
		<li>
			<em><?php echo CHtml::link('新闻总数',array('notice/'))?>:</em>	
			<em class="memcont"><?PHP echo $notice_count; ?></em>
		</li>								
	</ul>
	
	<h3>系统信息</h3>
	<ul class="memlist">
		<li>
			<em>PHP程式版本:</em>	
			<em class="memcont"><?PHP echo PHP_VERSION; ?></em>
		</li>
		<li>
			<em>ZEND版本:</em>	
			<em class="memcont"><?PHP echo zend_version(); ?></em>
		</li>
		<li>
			<em>服务器操作系统:</em>	
			<em class="memcont"><?PHP echo PHP_OS; ?></em>
		</li>
		<li>
			<em>服务器端信息:</em>	
			<em class="memcont"><?PHP echo $_SERVER['SERVER_SOFTWARE']; ?></em>
		</li>
		<li>
			<em>最大上传限制:</em>	
			<em class="memcont"><?PHP echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"; ?></em>
		</li>	
		<li>
			<em>最大执行时间:</em>	
			<em class="memcont"><?PHP echo get_cfg_var("max_execution_time")."秒"; ?></em>
		</li>
		<li>
			<em>运行占用最大内存:</em>	
			<em class="memcont"><?PHP echo get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无" ?></em>
		</li>									
	</ul>
</div>
