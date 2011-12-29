<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo Yii::app()->params['keywords']; ?>">
<meta name="description" content="<?php echo Yii::app()->params['description']; ?>">
<meta name="author" content="huanghuibin@gmail.com"/>
<meta name="copyright" content="http://www.zxdhk.com" />
<meta name="language" content="en" />
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<title><?php echo $this->pageTitle; ?></title>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cms.js" type="text/javascript"></script>
</head>
<body>


<div id="warp">

	<div id="header">
		<div id="logo">
			<?php echo CHtml::link(CHtml::image('images/logo.png','logo',array('class'=>product_img_small)),$model->icon); ?>
		</div>

		<div id="right_top">
			<div id="favorite">
				<a class="email_icon" href="mailto:<?php echo Yii::app()->params['email']; ?>">Email Us </a>
				<a class="favorite_icon" rel="sidebar" title="Siming-Craft" onclick="window.external.addFavorite(this.href,this.title);return false;" href="http://www.testt.com">Add to Favorite</a>
			</div>
			<div id="search_top" class="hidden">
				<?php echo CHtml::beginForm(array('product/list')); ?>
				<input type="text" onfocus="this.value=''" size="18" value="Keywords or Item#" class="T4_box" name="keyword"/>
				<input type="image" border="0" align="absmiddle" alt="Search Products" src="images/i_search_go.gif" name="imageField"/>
				<?php echo CHtml::endForm(); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
		<div id="nav">
			<?php 
			$data = array(
				'items'=>array(
					array('label'=>'首页', 'url'=>array('/site')),
					array('label'=>'教师风采', 'url'=>array('/teacher')),
					array('label'=>'学校概况', 'url'=>array('/content/about')),
					array('label'=>'青春学子', 'url'=>array('/student')),
				),
			);
			
			
			$root = tree::model()->findByPK(2);
			$arr = $root->getChildNodes();

		
			if(!empty($arr))
			{
				foreach($arr as $node)
				{
					$data['items'][] = array(
						'label' => $node->name,
						'url' => array('/notice','cate_id'=>$node->id)
					);
				}
			}			

			$this->widget('application.components.MainMenu',$data);
			
			?>
		</div>
	<div id="contain">
		<div id="sidebar">
			<?php $this->widget('application.components.MainSidebar');?>

			<div>
				<div class="bar1">
							<span>学校概况</span>
				</div>

				<div id="l3cont">
						  <ul>
							<li><a target="_blank" href="jyjy/jy1/1.htm">要成才先成仁，要成仁先诚信--学校诚信教育的思考</a></li>
							<li><a target="_blank" href="jyjy/jy2/1.htm">在美国社会文化背景下的中小学生品格教育</a></li>
							<li><a target="_blank" href="jyjy/jy2/2.htm">教师人格对学生态度的影响</a></li>
							<li><a target="_blank" href="jyjy/jy3/2.htm">学生考试焦虑及其辅导方法</a></li>
							<li><a target="_blank" href="jyjy/jy4/2.htm">发挥“三层级”学生自主管理模式的作用（德育领导小组）</a></li>
							<li><a target="_blank" href="jyjy/jy4/1.htm">注重德育创新，增强班级内聚力</a></li>
							<li><a target="_blank" href="jyjy/jy4/3.htm">学生自主管理的实践探索</a></li>
							<li><a target="_blank" href="jyjy/jy4/8.htm">研究性学习和学校德育工作的整合</a></li>
							<li><a href="rmwz/1.ppt">中小学生交通安全知识讲稿</a></li>
						  </ul>
				</div>
			</div>
			

			<div>
				<div class="bar1">
							<span>校内资源</span>
				</div>

				<div id="l3cont">
						  <ul>
							<li><a target="_blank" href="jyjy/jy1/1.htm">要成才先成仁，要成仁先诚信--学校诚信教育的思考</a></li>
							<li><a target="_blank" href="jyjy/jy2/1.htm">在美国社会文化背景下的中小学生品格教育</a></li>
							<li><a target="_blank" href="jyjy/jy2/2.htm">教师人格对学生态度的影响</a></li>
							<li><a target="_blank" href="jyjy/jy3/2.htm">学生考试焦虑及其辅导方法</a></li>
							<li><a target="_blank" href="jyjy/jy4/2.htm">发挥“三层级”学生自主管理模式的作用（德育领导小组）</a></li>
							<li><a target="_blank" href="jyjy/jy4/1.htm">注重德育创新，增强班级内聚力</a></li>
							<li><a target="_blank" href="jyjy/jy4/3.htm">学生自主管理的实践探索</a></li>
							<li><a target="_blank" href="jyjy/jy4/8.htm">研究性学习和学校德育工作的整合</a></li>
							<li><a href="rmwz/1.ppt">中小学生交通安全知识讲稿</a></li>
						  </ul>
				</div>
			</div>			
		</div>

		<!--end of sidebar-->
		<div id="primary">
			<?php echo $content; ?>
		</div><!-- content -->
		<div class="clear"></div>
	</div>

	<div id="linker">
		<?php if($this->beginCache('cate_id16', array('duration'=>60))) {
			//轮播图片
			$criteria=new CDbCriteria;
			$criteria->condition = "cate_id = 16";
			$criteria->order = 'sort ';
			$criteria->limit = 10;
			$ads = ad::model()->findAll($criteria);
		?>
		<?php foreach($ads as $model) {

			echo CHtml::link(CHtml::image($model->icon,$model->title),$model->url);
		}?>


		<?php $this->endCache(); } ?>
	</div>


	<div id="footer">
		<div id="nav_bottom">
			<?php echo Yii::app()->params['footer_address']; ?>
		</div>
		<div id="copyright"><?php echo Yii::app()->params['copyright']; ?><br/><?php echo Yii::powered(); ?></div>
	</div>
</div>

</body>
</html>
