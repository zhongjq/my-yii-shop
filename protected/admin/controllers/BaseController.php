<?php

class BaseController extends SBaseController
{
	const PAGE_SIZE=10;
	
	public $defaultAction='index';
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',

				'maxLength'=>'4',
				'minLength'=>'4',
			),
		);
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
	
	
}
