<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="huanghuibin@gmail.com"/>
<title><?php echo $this->pageTitle; ?></title>
<?php
		$resources = dirname(Yii::app()->controllerPath).DIRECTORY_SEPARATOR.'media';
		// publish the files
		$baseUrl = Yii::app()->assetManager->publish($resources);
		// register the files
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/admin.js');
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.idTabs.min.js');
		// If skin
		Yii::app()->clientScript->registerCssFile($baseUrl.'/admin.css');
		//colorbox
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/colorbox/colorbox/jquery.colorbox-min.js');
		Yii::app()->clientScript->registerCssFile($baseUrl.'/js/colorbox/example1/colorbox.css');
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".colorbox").colorbox({opacity:0.4});
	});			
</script>
</head>
<body>
<div id="warp">
	<div id="header">
		<ul id="toolbar">
			<div id="logo"><a href="#" title="Kohana Content Manager System!">CMS</a></div>
			<div class="info">
			<?php if(!Yii::app()->user->isGuest) { ?>
			<?php echo CHtml::link('退出',array('/site/logout'),array('id'=>'logout')); ?> |
			用户: <span class="username"><?php echo CHtml::link(Yii::app()->user->username,array('/user/show','id'=>Yii::app()->user->id));?></span> |
			角色: <?php echo  Yii::app()->user->role;?> |
			上次登录时间: <?php echo  Yii::app()->user->lastLoginTime;?>
			
			<?php echo CHtml::link('清空缓存',array('/website/CleanCache'));?>	
			
			<?php }?>
			
					
			</div>
		</ul>
	</div>
	<div id="mainarea">
		<div id="sidebar">
	<?php
	
	
    //md5生成key
    $userid=Yii::app()->user->id;

	//班级列表
	$cache_key=md5("getOpeartionList".$userid);
	if(!$data=Yii::app()->cache->get($cache_key))
	{
	
		if(Yii::app()->user->checkAccess('用户管理'))
		{
			$data['user'] = array(
				"text"=> "用户中心",
				"expanded"=> true,
				"classes" => "important",
				"icon"=>"user",
				"children" => array(
					'list' => array(
						'text'=> CHtml::link('用户列表',array('/user/')),
					),
				),
			);
		}
		if(Yii::app()->user->checkAccess('新闻管理'))
		{
			$root = tree::model()->findByPK(2);
			$arr = $root->getChildNodes();
			$data['notice']['text'] = $root->name;
		
			if(!empty($arr))
			{
				foreach($arr as $node)
				{
					$array['text']=CHtml::link($node->name,array('/notice/admin','cate_id'=>$node->id));
					$data['notice']['children'][] = $array;
				}
			}	
		}
		if(Yii::app()->user->checkAccess('信息中心管理'))
		{
			$root = tree::model()->findByPK(3);
			$arr = $root->getChildNodes();
			$data['content']['text'] = $root->name;
		
			if(!empty($arr))
			{
				foreach($arr as $node)
				{
					$array['text']=CHtml::link($node->name,array('/content/admin','id'=>$node->id));
					$data['content']['children'][] = $array;
				}
			}
		}
		if(Yii::app()->user->checkAccess('产品管理'))
		{
			$data['product'] = array(
				"text"=> "产品中心",
				"expanded"=> true,
				"classes" => "important",
				'icon' => 'report',
				"children" => array(
					0 => array(
						'text'=> CHtml::link('列表',array('/product/')),
					),
					1 => array(
						'text'=> CHtml::link('添加',array('/product/create')),
					),
					2 => array(
						'text'=> CHtml::link('分类',array('/tree/product')),
					),
				),
			);
		}
		if(Yii::app()->user->checkAccess('广告管理'))
		{
		
			$root = tree::model()->findByPK(5);
			$arr = $root->getChildNodes();
			$data['ad'] = array(
				'icon' => 'find',
				'text' => $root->name,
			);
		
			if(!empty($arr))
			{
				foreach($arr as $node)
				{
					$array['text']=CHtml::link($node->name,array('/ad/admin','id'=>$node->id));
					$data['ad']['children'][] = $array;
				}
			}	

		}
		if(Yii::app()->user->checkAccess('网站设置'))
		{
			$data['website'] = array(
				"text"=> "系统设置",
				"expanded"=> true,
				"classes" => "important",
				"icon"=>'house',
				"children" => array(
					'index' => array(
						'icon'=>'coins',
						'text'=> CHtml::link('网站信息',array('/website/index')),
					),
					'website' => array(
						'text'=> CHtml::link('网站设置',array('/website/website')),
					),				
				),
			);
		}
		if(Yii::app()->user->checkAccess('备份管理'))
		{
			$data['website']['children']['backup'] = array(
						'icon'=>'date',			
						'text'=> CHtml::link('备份管理',array('/backup/admin/')),
			);
		}
		
		if(Yii::app()->user->checkAccess('Authority'))
		{
			$data['website']['children']['srbac'] = array(
						'text'=> CHtml::link('权限设置',array('/srbac/authitem/assign/')),
			);
		}
	
		
		Yii::app()->cache->set($cache_key,$data);
	}
		
		



		$this->widget('CTreeView',array('persist'=>'cookie','data'=>$data,'htmlOptions'=>array('id'=>'treeview','class'=>'filetree  treeview-famfamfam')));
?>

		</div>

		<div id="primary">
			<?php echo $content; ?>
		</div>
		<div class="clear"></div>
	</div>
			<div id="footer">
				<div id="copyright">Copyright ©  2009 biner Limited. All Rights <?php echo Yii::powered(); ?></div>
			</div>
</div>
</body>
</html>
