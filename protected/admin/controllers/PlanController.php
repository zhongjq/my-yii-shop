<?php

class PlanController extends BaseController
{
	const PAGE_SIZE=10;

	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction='list';

	public $type_arr = array(
			'1' => '工作计划',
			'2' => '学习任务',
		);
	public $state_arr = array(
			'0' => '进行中',
			'1' => '完成',
			'2' => '取消',
		);
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Shows a particular model.
	 */
	public function actionShow()
	{
		$this->render('show',array('model'=>$this->loadplan()));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate()
	{
		$model=new plan;
		if(isset($_POST['plan']))
		{
			$_POST['plan']['uid'] = Yii::app()->user->id;
			$_POST['plan']['createtime'] = date('Y-m-d H:i:s');
			$model->attributes=$_POST['plan'];

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
		$model=$this->loadplan();

		if(strtotime($model->startdate) < time())
		{
			//die('计划已经开始!');
		}
		if(isset($_POST['plan']))
		{
			$model->attributes=$_POST['plan'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->id));
		}
		$this->render('update',array('model'=>$model));
	}

	public function actionFinish()
	{
		$model=$this->loadplan();

		if(strtotime($model->startdate) < time())
		{
			//die('计划已经开始!');
		}
		if(isset($_POST['plan']))
		{
			$model->attributes=$_POST['plan'];
			$model->overdate = date('Y-m-d H:i:s');
			$model->state = 1;
			if($model->save())
				$this->redirect(array('show','id'=>$model->id));
		}
		$this->render('finish',array('model'=>$model));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$plan = $this->loadplan();
			if(strtotime($plan->startdate) < time()){
				die('计划已经开始,不允许删除!');
			}
			// we only allow deletion via POST request
			$this->loadplan()->delete();
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

		$pages=new CPagination(plan::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=plan::model()->findAll($criteria);

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

		if(!empty($_GET['uid']))
		{
			$criteria->condition = "uid = :uid";
			$criteria->params = array(':uid'=>$_GET['uid']);
		}
		$pages=new CPagination(plan::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$sort=new CSort('plan');
		$sort->applyOrder($criteria);

		$models=plan::model()->findAll($criteria);

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
	public function loadplan($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=plan::model()->findbyPk($id!==null ? $id : $_GET['id']);
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
			$this->loadplan($_POST['id'])->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}
	}
}
