<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<base href="http://localhost/yiicms/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo Yii::app()->params['keywords']; ?>">
<meta name="description" content="<?php echo Yii::app()->params['description']; ?>">
<meta name="author" content="huanghuibin@gmail.com"/>
<meta name="copyright" content="http://www.hobertech.com" />
<meta name="language" content="en" />
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
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
		<div id="nav">
			<?php $this->widget('application.components.MainMenu',array(
				'items'=>array(
					array('label'=>'HOME', 'url'=>array('/site')),
					array('label'=>'PRODUCTS', 'url'=>array('/product/index')),
					array('label'=>'ABOUT US', 'url'=>array('/content/about')),
					array('label'=>'NEWS', 'url'=>array('/notice')),
					array('label'=>'NEW PRODUCTS', 'url'=>array('/product/new')),
					array('label'=>'SERVICE', 'url'=>array('/content/service')),
					array('label'=>'CONTACT US', 'url'=>array('/content/contact')),
				),
			)); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="contain">
		<div id="sidebar">
			<?php $this->widget('application.components.MainSidebar');?>
		</div>
		<!--end of sidebar-->
		<div id="primary">
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
