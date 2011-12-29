<?php

class TreeController extends BaseController
{

	private $_model;
	private $_cate;

	public function actionIndex()
	{

			$this->processAdminCommand();
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'

			$root = tree::model()->findByPK(1);

			$tree2 = $root->getNestedtree();
			foreach($tree2 as $key => $subtree)
			{
				$message .= $this->showNestedtree($subtree);
			}

			$this->render('index',array('message' => $message));

	}
	public function actionProduct()
	{
			$this->processAdminCommand();
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'
			$cate = 4;
			$root = tree::model()->findByPK($cate);

			$tree2 = $root->getNestedtree();
			foreach($tree2 as $key => $subtree)
			{
				$message .= $this->showNestedtree($subtree);
			}

			$this->render('index',array('message' => $message));
	}

	public function actionNotice()
	{
			$this->processAdminCommand();
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'
			$cate = 2;
			$root = tree::model()->findByPK($cate);

			$tree2 = $root->getNestedtree();
			foreach($tree2 as $key => $subtree)
			{
				$message .= $this->showNestedtree($subtree);
			}

			$this->render('index',array('message' => $message));
	}

	public function actionCreate()
	{
		$father = $this->loadtree();
		$model = new tree();
		if(isset($_POST['tree']))
		{
			$model->name = $_POST['tree']['name'];

			$result = $father->appendChild($model);

			if($result){
				if(!empty($_POST['url'])) {
					$this->redirect($_POST['url']);
				}else{
					$this->redirect(array('index','id'=>$model->id));
				}
			}
		}
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create',array('father'=>$father,'model'=>$model));
		}else{
			$this->render('create',array('father'=>$father,'model'=>$model));
		}
	}

	public function actionUpdate()
	{
		$model=$this->loadtree();
		$father = $model->getParentNode();
		if(isset($_POST['tree']))
		{

			$model->name=$_POST['tree']['name'];
			if($model->save())
			{
				if(!empty($_POST['url'])) {
					$this->redirect($_POST['url']);
				}else{
					$this->redirect(array('index'));
				}
			}
		}
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('update',array('father'=>$father,'model'=>$model));
		}else{
			$this->render('update',array('father'=>$father,'model'=>$model));
		}

	}

	private function showNestedtree($tree)
	{
		if(!empty($tree['node']))
		{
			$node_id = $tree['node']->getIDValue();
			$level = $tree['node']->getLevelValue();

			if($level < 3)
			{
				$array['add_msg'] = CHtml::link('添加子类',
									array('create','id'=>$node_id,'width'=>'380'),
									array('class'=>'colorbox','title'=>'产品中心')
									);
			}
			$array['edit_msg'] = CHtml::link('编辑',array('update','id'=>$node_id,'width'=>'380'),array('class'=>'colorbox','title'=>'产品中心'));
			if($level > 1)
			{
				$array['delete_msg'] =  CHtml::linkButton('删除',array(
							  'submit'=>'',
							  'params'=>array('command'=>'delete','id'=>$node_id),
							  'confirm'=>"确认删除? #{$tree['node']->name}?"));
			}

			$link = implode(",", $array);


			$result = "<strong>".$tree['node']->name."</strong> (".$link.")";

			if($tree['node']->getLevelValue() == 1){
				$result = $node_id .'. '. $result;
			}
		}
		if(is_array($tree['children']))
		{
			$result .= "<ul>";
			foreach($tree['children'] as $key => $child)
			{
				$result .= "<li>";
				$result .= $this->showNestedtree($child);
				$result .= "</li>";
			}
			$result .= "</ul>";
		}

		return $result;
	}

	private function printNestedtree($tree)
	{

		$result = "<strong>".$tree['node']->name."</strong> (".$tree['node']->getLeftValue()."".$tree['node']->getRightValue().")";
		if(is_array($tree['children']))
		{
			$result .= "<ul>";
			foreach($tree['children'] as $key => $child)
			{
				$result .= "<li>";
				$result .= $key.": ".$this->printNestedtree($child);
				$result .= "</li>";
			}
			$result .= "</ul>";
		}

		return $result;
	}

	public function loadtree($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=tree::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			if($_POST['id']!='1')
			{
				$node = $this->loadtree($_POST['id']);
				$node->deleteNode();
				//加上参数true,会删除子类
				//$node->deleteNode(TRUE);
			}
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
}
