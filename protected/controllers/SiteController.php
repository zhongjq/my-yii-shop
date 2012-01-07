<?php

class SiteController extends Controller
{

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
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{

		$model = new product();
		$criteria=new CDbCriteria;
		$criteria->condition = "state = 1";
		$criteria->order = 'digest DESC,sort ';
		$criteria->limit = 3;

		//三张最近
		$digest = $model->findAll($criteria);

		//首页往上滚动图片
		$criteria->order = 'top DESC,sort ';
		$criteria->limit = 10;
		$tops = $model->findAll($criteria);

		//中间信息
		$cate_id = 14;
        $content=content::model()->getContent($_GET['id'],$cate_id);

		//轮播图片
		$criteria=new CDbCriteria;
		$criteria->condition = "cate_id = 15";
		$criteria->order = 'sort ';
		$criteria->limit = 3;
		$ads = ad::model()->findAll($criteria);

		//学校新闻 notice
		$criteria=new CDbCriteria;		
		$criteria->condition = "";
		$criteria->order = 'sort ';
		$criteria->limit = 8;
		$notices = notice::model()->findAll($criteria);		
		
		//学校概况 content/about
		$criteria->condition = "cate_id = 11";
		$criteria->order = 'sort ';
		$criteria->limit = 8;
		$abouts = content::model()->findAll($criteria);
		//教育教研
		$criteria->condition = "cate_id = 21";
		$criteria->order = 'sort ';
		$criteria->limit = 8;
		$edus = notice::model()->findAll($criteria);
		//教师园地
		$criteria->condition = "cate_id = 22";
		$criteria->order = 'sort ';
		$criteria->limit = 8;
		$tlives = notice::model()->findAll($criteria);
		//杏坛硕果
		$criteria->condition = "cate_id = 23";
		$criteria->order = 'sort ';
		$criteria->limit = 8;
		$slifes = notice::model()->findAll($criteria);				
		
		$data = array(
			'digest' => $digest,
			'tops' => $tops,
			'content' => $content,
			'ads' => $ads,
			'notices'=> $notices,
			'abouts' => $abouts,
			'edus' => $edus,
			'honers' => $honers,
			'lifes' => $lifes
		);
		$this->render('index',$data);
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$form=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$form->attributes=$_POST['LoginForm'];
			// validate user input and redirect to previous page if valid
			if($form->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('form'=>$form));
	}

	/**
	 * Logout the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister()
	{
		$form=new RegForm;
		if(isset($_POST['RegForm']))
		{
			$form->attributes=$_POST['RegForm'];
			// validate user input and redirect to previous page if valid
			if($form->validate())
			{
				$user = new user();
				$user->attributes = $form->attributes;
				$user->regIp = Yii::app()->request->userHostAddress;
				$user->regTime = date('Y-m-d H:i:s');
				$user->save();
				if(!empty($user->errors)){
					var_dump($user->errors);
					die;
				}
				$this->redirect(Yii::app()->user->returnUrl);
			}

		}
		// display the login form
		$this->render('register',array('form'=>$form));
	}

	public function actionForget() {

		$this->render('forget',array('form'=>$form));
	}
}
