<?php

class NoticeController extends BaseController
{
	const PAGE_SIZE=18;

	private $cate_id = 2;
	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction='admin';

	public $cate_list = array(
		'1' => '公司新闻',
		'2' => '企业新闻',
	);
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function init() {
		$this->cate_list = $this->getCateList();
	}

	public function getCateList()
	{
	
		$cate_id = Yii::app()->request->getParam('cate_id');
		
		if(empty($cate_id))
		{
			$cate_id = $this->cate_id;
		}
		$root = tree::model()->findByPK($cate_id);
		if($root->level == 3)
		{
			$root = $root->getParentNode();
		}
		$tree2 = $root->getLevelTree();
		$data = CHtml::listData($tree2, 'id', 'name');
		return $data;
	}

	/**
	 * Shows a particular model.
	 */
	public function actionShow()
	{
		$this->render('show',array('model'=>$this->loadnotice()));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate()
	{
		$model=new notice;
		if(isset($_POST['notice']))
		{
			$model->attributes=$_POST['notice'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->id));
		}
		$this->render('create',array('model'=>$model));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadnotice();
		if(isset($_POST['notice']))
		{
			$model->attributes=$_POST['notice'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->id));
		}
		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadnotice()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		$criteria=new CDbCriteria;

		$pages=new CPagination(notice::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=notice::model()->findAll($criteria);

		$this->render('list',array(
			'models'=>$models,
			'pages'=>$pages,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$criteria=new CDbCriteria;
		//添加搜索功能
		$criteria->condition = "1";

		$cate_id = Yii::app()->request->getParam('cate_id');
		$title = Yii::app()->request->getParam('title');

		//$cate_id = !$_GET['cate_id'] ? $_POST['cate_id'] : $_GET['cate_id'];

		if(!empty($cate_id))
		{
			$criteria->condition .= " AND cate_id=:cate_id ";
			$criteria->params = array(':cate_id'=>$cate_id);
		}

		if(!empty($title))
		{
			$criteria->condition .= " AND title like '%$title%'";
		}

		$pages=new CPagination(product::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);
		
		$pages=new CPagination(notice::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$sort=new CSort('notice');
		$sort->applyOrder($criteria);

		$models=notice::model()->findAll($criteria);

		$this->render('admin',array(
			'models'=>$models,
			'pages'=>$pages,
			'sort'=>$sort,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
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

	/**
	 * Executes any command triggered on the admin page.
	 */
	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			$this->loadnotice($_POST['id'])->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}

		if(isset($_POST['command'], $_POST['id'], $_POST['type']) && $_POST['command']==='changeState')
		{
			$model = $this->loadnotice($_POST['id']);
			$model->$_POST['type'] = 1 -  $model->$_POST['type'];
			$model->save();
			$this->refresh();
		}
	}

	protected function getCateList22() {

		$root = tree::model()->findByPK($this->cate_id);

		$tree2 = $root->getTree(false);

		$result = $this->totree($tree2);
		return $result;
	}


	function totree(array $categorys) {

		if ($categorys) {
			$Right = array ();
			foreach($categorys as $key => $row ) {
				$row = $row->attributes;
				$cid = $row['id'];

				switch ($row ['depth']) {
					case "0" :
						$sp = "";
						break;
					case "1" :
						$sp = "+ ";
						break;
					default :
						$sp = "|- ";
				}
				$result[$cid] = str_repeat (' &nbsp &nbsp', $row ['depth']) . $sp . $row ['name'];

			}
		}
		return $result;
	}

}
