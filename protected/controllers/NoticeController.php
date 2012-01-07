<?php

class NoticeController extends Controller
{

	const PAGE_SIZE=16;
	public $defaultAction='list';

	private $_model;
	public $title;
	public $cate_id;

	public function actionList()
	{

		$criteria=new CDbCriteria;
		$this->title = '新闻中心';

		if(!empty($_GET['cate_id']))
		{
			$this->cate_id  = $cate_id = $_GET['cate_id'];
			$cate = tree::model()->findByPk($cate_id);
			if(!empty($cate))
			{
				//分类标题
				$this->title = $cate->name;
				//指定类别
				$criteria->condition = "cate_id = $cate_id";
				//是否有子类
				$childrens = $cate->getChildNodes();
				if(!empty($childrens))
				{
					foreach($childrens as $child)
					{
						$cate_id = $child->id;
						$criteria->condition .= " OR cate_id = $cate_id";
					}
				}
			}
			else
			{
				$_GET['cate_id'] ='';
			}
		}

		if(!empty($_POST['keyword']))
		{
			$this->title = 'search';
			$keyword = $_POST['keyword'];
			$criteria->condition .= " title like '%$keyword%'";
		}

		$pages=new CPagination(product::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=notice::model()->findAll($criteria);

		$this->render('index',array(
			'models'=>$models,
			'pages'=>$pages,
		));

	}

	public function actionShow()
	{
		$model = $this->loadnotice();
		$this->cate_id = $model->cate_id;
		$this->render('show',array('model'=>$model));
	}

	public function loadnotice($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=notice::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
