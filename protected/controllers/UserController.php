<?php

class UserController extends Controller
{
	public $layout='//layouts/column2';
	
	public $menu = array(
		array('label'=>'用户列表', 'url'=>array('user/index')),
		array('label'=>'添加用户', 'url'=>array('user/create')),
	);
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','update','delete','create'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreate()
	{
		$model = new UserCreateForm;
		if(isset($_POST['UserCreateForm'])){
			$model->attributes = $_POST['UserCreateForm'];
			if($model->validate()){
				//Yii::app()->user->setFlash('success', '<strong>Well done!</strong>');
				$user = new User;
				$user->username = $model->username;
				$user->email = $model->email;
				$user->password = $model->password;
				if($user->save()){
					Yii::app()->user->setFlash('success', '<strong>User created !</strong>');
				}
				$model = new UserCreateForm;
				$this->redirect(array('create'));
			}
		}
		$this->render('create',array('model'=>$model));
	}
	
	public function actionIndex()
	{
		$model = new User('search');
		$model->unsetAttributes();
		if(isset($_GET['User']))
			$model->attributes = $_GET['User'];
			
		$this->render('index',array('model'=>$model));
	}
	
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->render('view',array('model'=>$model));
	}
	
	public function actionUpdate($id)
	{
		$user = $this->loadModel($id);
		$model = new ChangePasswordForm;
		$model->userID = $user->id;
		if(isset($_POST['ChangePasswordForm'])){
			$model->attributes = $_POST['ChangePasswordForm'];
			if($model->validate()){
				$user->password = $user->hashPassword($model->newPassword);
				if($user->save()){
					Yii::app()->user->setFlash('success','Password Changed !');
				}
				$model = new ChangePasswordForm;
			}
		}
		$this->render('update',array('model'=>$model,'user'=>$user));
	}
	
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}