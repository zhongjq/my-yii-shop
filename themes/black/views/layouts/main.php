<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo Yii::app()->params['keywords']; ?>">
<meta name="description" content="<?php echo Yii::app()->params['description']; ?>">
<meta name="author" content="huanghuibin@gmail.com"/>
<meta name="copyright" content="http://www.hobertech.com" />
<meta name="language" content="en" />
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<title><?php echo Yii::app()->params['sitename']; ?></title>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cms.js" type="text/javascript"></script>
</head>
<body>


<div id="warp">
	<div id="header">
		<div id="logo">
			<?php echo CHtml::link(CHtml::image('/images/logo.gif','logo',array('class'=>product_img_small)),$model->icon); ?>
		</div>
		<div id="contact_top">
			<div class="address"><?php echo Yii::app()->params['address']; ?></div>
			<div class="phone"><?php echo Yii::app()->params['phone']; ?></div>
		</div>
		<div id="right_top">
			<div id="favorite">
				<a class="email_icon" href="mailto:<?php echo Yii::app()->params['email']; ?>">Email Us </a>
				<a class="favorite_icon" rel="sidebar" title="hobertech" onclick="window.external.addFavorite(this.href,this.title);return false;" href="http://www.hobertech.com">Add to Favorite</a>
			</div>
			<div id="search_top">
				<?php echo CHtml::beginForm(array('product/list')); ?>
				<input type="text" onfocus="this.value=''" size="18" value="Keywords or Item#" class="T4_box" name="keyword"/>
				<input type="image" border="0" align="absmiddle" alt="Search Products" src="/images/i_search_go.gif" name="imageField"/>
				<?php echo CHtml::endForm(); ?>
			</div>
		</div>
		<div class="clear"></div>

<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'首页', 'url'=>array('/site/index')),
                array('label'=>'走进华科', 'url'=>array('/content/about'),
                  'items'=>array(
                    array('label'=>'集团简介'),
                    array('label'=>'董事长致辞'),
                    array('label'=>'华科之路'),
                    array('label'=>'发展战略'),
                    array('label'=>'经营理念'),
                    array('label'=>'社会责任'),
                  ),
                ),
                array('label'=>'华科产品', 'url'=>array('/product/index')),
                array('label'=>'新闻中心', 'url'=>array('/notice'),
                  'items'=>array(
                    array('label'=>'华科要闻', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'媒体报道', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'行业动态', 'url'=>array('/site/page','view'=>'sub1')),
                    ),
                  ),
                array('label'=>'华科文化',
                  'items'=>array(
                    array('label'=>'文化理念', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'华科报', 'url'=>array('/site/page','view'=>'sub1')),
                    ),
                  ),
                array('label'=>'人力资源',
                  'items'=>array(
                    array('label'=>'人才理念', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'招聘信息', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'员工发展', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'在线应聘', 'url'=>array('/site/page','view'=>'sub1')),
                    ),
                  ),
                array('label'=>'商务合作',
                  'items'=>array(
                    array('label'=>'项目开发合作', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'招商合作', 'url'=>array('/site/page','view'=>'sub1')),
                    array('label'=>'招标采购', 'url'=>array('/site/page','view'=>'sub1')),
                    ),
                  ),
                ),
            )); ?>
		
			<?php /*$this->widget('application.components.MainMenu',array(
				'items'=>array(
			        //array('label'=>'HOME', 'url'=>array('/site')),
                    array('label'=>'走进华科', 'url'=>array('/content/about')),
					
					array('label'=>'华科产品', 'url'=>array('/product/index')),
					
					array('label'=>'新闻中心', 'url'=>array('/notice')),
					array('label'=>'华科文化', 'url'=>array('/content/culture')),
					array('label'=>'人力资源', 'url'=>array('/content/')),
					array('label'=>'商务合作', 'url'=>array('/content/')),
					//array('label'=>'NEW PRODUCTS', 'url'=>array('/product/new')),
					//array('label'=>'SERVICE', 'url'=>array('/content/service')),
					//array('label'=>'CONTACT US', 'url'=>array('/content/contact')),
				),
			)); */?>
		
		<div class="clear"></div>
	</div>
	<div id="contain">
		<div id="sidebar">
			<?php $this->widget('application.components.MainSidebar');?>
		</div>
		<!--end of sidebar-->
		<div id="primary">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            	'links'=>$this->breadcrumbs,
            )); ?>
			<?php echo $content; ?>
		</div><!-- content -->
		<div class="clear"></div>
	</div>
</div>
	<div id="footer">
		<div id="contact_bottom">
		   <?php echo Yii::app()->params['footer_address']; ?>
		</div>
		<div id="nav_bottom">
			<div id="copyright"><?php echo Yii::app()->params['copyright']; ?><?php echo Yii::powered(); ?></div>
			<?php $this->widget('application.components.MainMenu',array(
				'items'=>array(
					array('label'=>'HOME', 'url'=>array('/site')),
					array('label'=>'PRODUCTS', 'url'=>array('/product/index')),
					array('label'=>'ABOUT US', 'url'=>array('/content/about')),
					array('label'=>'NEWS', 'url'=>array('/notice')),
					array('label'=>'SERVICE', 'url'=>array('/content/service')),
					array('label'=>'CONTACT US', 'url'=>array('/content/contact')),
				),
			)); ?>
		</div>

<?php if($this->beginCache('cate_id16', array('duration'=>3600))) {
		//轮播图片
		$criteria=new CDbCriteria;
		$criteria->condition = "cate_id = 16";
		$criteria->order = 'sort ';
		$criteria->limit = 10;
		$ads = ad::model()->findAll($criteria);
?>
	<div id="linker">
		<?php foreach($ads as $model) {

			echo CHtml::link(CHtml::image($model->icon,$model->title),$model->url);
		}?>
	</div>
<?php $this->endCache(); } ?>	
	</div>
</body>
</html>
