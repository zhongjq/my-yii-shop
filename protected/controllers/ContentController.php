<?php

class ContentController extends Controller
{

    public $cate_id = 11;

	public function actionAbout()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->cate_id = 11;
        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content));
	}

	public function actionService() {
		$this->cate_id = 13;
        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content));
	}

	public function actionEducation() {
		$this->cate_id = 13;
        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content));
	}
	
	public function actionHonor() {
		$this->cate_id = 12;
        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content));
	}	

	public function actionLife() {
		$this->cate_id = 14;
        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content));
	}


	public function actionContact() {
		$this->cate_id = 12;
		//feedback

		$form=new FeedbackForm;
		if(isset($_POST['FeedbackForm']))
		{
			$form->attributes=$_POST['FeedbackForm'];
			if($form->validate())
			{
				/*
				$headers="From: {$form->email}\r\nReply-To: {$contact->email}";
				mail(Yii::app()->params['email'],$form->company.'-'.$form->name,$form->message,$headers);
				*/
				$message = '<table cellspacing="0">';
				foreach($form as $name => $value)
				{
					
					$message .= '<tr><td>'.$name.'</td><td>'.$value.'</td></tr>';
				}
				$message .= '</table>';
				
				$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
				
				$mailer->IsSMTP();
				$mailer->SMTPAuth= true;// enable SMTP authentication
				$mailer->SMTPSecure = "ssl";// sets the prefix to the servier
				$mailer->Host= "smtp.gmail.com";// sets GMAIL as the SMTP server
				$mailer->Port= 465;// set the SMTP port for the GMAIL server

				$mailer->Username     = "huanghuibin@hobertech.com";     // GMAIL username
				$mailer->Password     = "zxc1zxc1";                 // GMAIL password
				
				
				$mailer->From = $form->email;
				
				$mail->IsHTML(true);
				$mailer->AddAddress('manager@hobertech.com');
				//$mailer->AddReplyTo('huanghuibin@gmail.com');
				
				$mailer->FromName = $form->name;
				$mailer->CharSet = 'UTF-8';
				
				$mailer->Subject = Yii::t('demo', 'website feedback!');
				$mailer->Body = $message;
				$mailer->Send();
				
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}

        $content=content::model()->getContent($_GET['id'],$this->cate_id);
		$this->render('content',array('content'=>$content,'model'=>$form));
	}
}
