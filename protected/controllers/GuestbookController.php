<?php

class GuestbookController extends CController
{

	const PAGE_SIZE=10;
	
	public function actionIndex()
	{
	
		$model = new guestbook;
		//guestbook
		$criteria=new CDbCriteria;

		$pages=new CPagination($model->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=$model->findAll($criteria);
		

		if(isset($_POST['guestbook']))
		{
			$model->attributes=$_POST['guestbook'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}


		$this->render('guestbook',array('models'=>$models,'model'=>$model));
	}
}
