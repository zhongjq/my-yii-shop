<?php

class WebsiteController extends BaseController
{
	const PAGE_SIZE=10;
	public $defaultAction='index';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */

	private $_model;

	/**
	 * @return array action filters
	 */

	/**
	 * Shows a particular model.
	 */
	//数组转换成字串
	function arrayeval($array, $level = 0) {
		$space = '';
		for($i = 0; $i <= $level; $i++) {
			$space .= "\t";
		}
		$evaluate = "Array\n$space(\n";
		$comma = $space;
		foreach($array as $key => $val) {
			$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
			$val = !is_array($val) && (!preg_match("/^\-?\d+$/", $val) || strlen($val) > 12 || substr($val, 0, 1)=='0') ? '\''.addcslashes($val, '\'\\').'\'' : $val;
			if(is_array($val)) {
				$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
			} else {
				$evaluate .= "$comma$key => $val";
			}
			$comma = ",\n$space";
		}
		$evaluate .= "\n$space)";
		return $evaluate;
	}

	//写入文件
	function swritefile($filename, $writetext, $openmod='w') {
		if($fp = fopen($filename, $openmod)) {
			flock($fp, 2);
			fwrite($fp, $writetext);
			fclose($fp);
			return true;
		} else {
			runlog('error', "File: $filename write error.");
			return false;
		}
	}

	public function actionIndex()
	{
		$data = array();
		
		$data['product_count'] = product::model()->count();
		$data['notice_count'] = notice::model()->count();
		$data['admin_count'] = user::model()->count();
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',$data);
	}
	
	public function actionWebsite()
	{
		$do = Yii::app()->request->getParam('do');
		if($do == 'cleancache')
		{
			Yii::app()->cache->flush();
		}
			
		$models=website::model()->findAll();

		$rs = array();
		foreach($models as $tmp){
			$rs[$tmp->name] = $tmp->value;
		}

		if(!empty($_POST))
		{
			foreach($_POST as $name => $value)
			{
				$model = website::model()->findByAttributes(array('name'=>$name));
				if(!empty($model))
				{
					$model->value = $value;
					$model->save();
				}
			}

			//更新网站设置,写文件保存
			$data = $_POST;
			$path = Yii::app()->getBasePath();
			$cachefile = $path.'/config/params.php';
			$cachetext = "<?php //本配置文件由后台生成 WebSiteController ".date(NOW)." \r\n".
				'return '.$this->arrayeval($data).
				";\r\n";
				//var_dump($cachetext);die($cachefile);
			if(!$this->swritefile($cachefile, $cachetext)) {
				die("File: $cachefile write error.");
			}else{
			

				$this->redirect(array());
			}
		}

		$this->render('website',array(
			'rs'=>$rs,
		));
	}
	/**
	 * Shows a particular model.
	 */
	public function actionShow()
	{
		$this->render('show',array('model'=>$this->loadwebsite()));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate()
	{
		$model=new website;
		if(isset($_POST['website']))
		{
			$model->attributes=$_POST['website'];
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
		$model=$this->loadwebsite();
		if(isset($_POST['website']))
		{
			$model->attributes=$_POST['website'];
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
			$this->loadwebsite()->delete();
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

		$pages=new CPagination(website::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=website::model()->findAll($criteria);

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

		$pages=new CPagination(website::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$sort=new CSort('website');
		$sort->applyOrder($criteria);

		$models=website::model()->findAll($criteria);

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
	public function loadwebsite($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=website::model()->findbyPk($id!==null ? $id : $_GET['id']);
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
			$this->loadwebsite($_POST['id'])->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}
	}
	
	public function actionCleanCache()
	{
		# code...
		Yii::app()->cache->flush();
		
		$request = Yii::app()->request;

		$url = $request->url != $request->urlReferrer ? $request->urlReferrer : array('site/index'); 
		$this->redirect($url);
	}
}
