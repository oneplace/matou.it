<?php
	class SiteController extends Controller
	{
		public $layout='//layouts/main';
		public function actionLogin()
		{
			$model = new LoginForm;

			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(array('project/index'));
			}

			$this->render('login',array('model'=>$model));
		}

		public function actionLogout()
		{
			Yii::app()->user->logout();
			$this->redirect(array('site/login'));
		}
		
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
		
	}