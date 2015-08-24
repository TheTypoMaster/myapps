<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	

	/*Yang nie nak view Income Statement*/
	public function actionGeneralLedger()
	{
		$this->render('generalLedger');
	}


	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$sql='SELECT * FROM tbl_pic order by id desc';
		$dataProvider2=new CSqlDataProvider($sql,array(
			'keyField' => 'id',
			'pagination'=>array(
				'pageSize'=>4,
			),
		));
		$this->render('index',
			array(
				'dataProvider2'=>$dataProvider2
			)
		);
	}

	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
			//$attachment = Yii::app()->baseUrl.'/images/ban_admin.JPG';
			$images = CUploadedFile::getInstancesByName('images');
			$attachement=Yii::getPathOfAlias('webroot.files') . $model->file;
		   $mail=Yii::app()->Smtpmail;		
		   $mail->SetFrom('admin@cads.mys', $model->name);
		   $mail->Subject = $model->subject;
           $msg = $model->body.'<br />'.$model->email.'<br/>'.$model->name;
           $mail->MsgHTML($msg);
           $mail->CharSet="UTF-8";
           $mail->AddAddress('zmahazhir@gmail.com',"CADS Programmer"); 
           $mail->AddAddress($model->email, "CADS Programmer");	  
           $mail->AddAttachment($attachement);		   
		   if(!$mail->Send()){
		        Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
               
			  }
				Yii::app()->user->setFlash('contact','You Email have been Sent');
				
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	
  
	   

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}