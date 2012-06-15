<?php

class ProjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('apply','index','view','tagged'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','repo','remotelogo'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = '/layouts/main';
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/front.css');
		$this->render('view',array(
			'project'=>$this->loadModel($id),
		));
	}
	
	public function actionApply()
	{
		$model = new Project;
		$model->attributes=$_POST;
		if($model->logo){
			$logo = $this->getRemoteLogo($model->logo);
			$model->logo = $logo ? $logo : '';
		}
		if(!$model->save()){
			header("HTTP/1.0 400 bad request");
			echo json_encode($model->errors);
			Yii::app()->end();
		}
		$tags = Yii::app()->request->getParam('tags');
		if($tags) $model->attachTags($tags);
		$model->setDefaultLogo();
		echo 'created '.$model->id;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;
		// $this->performAjaxValidation($model);
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			$model->status = 1;
			if($model->save()){
				$this->attachTags($model);
				$model->setDefaultLogo();
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/create_project.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/remote_logo.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScript('tagsInput',
			'$("#project-tags").tagsInput({"height":"auto","width":"auto"});');
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionRepo()
	{
		$repo = Yii::app()->request->getParam('repo');
		if(!$repo) throw new CHttpException(400,'no repo parameter');
		//echo file_get_contents('https://api.github.com/repos/coreyti/showdown');
		$urlInfo = parse_url($repo);
		if(isset($urlInfo['host'])&&$urlInfo['host']=='github.com'){
			echo file_get_contents('https://api.github.com/repos'.$urlInfo['path']);
		}
	} 
	
	public function actionRemotelogo()
	{
		$logoUrl = Yii::app()->request->getParam('logo');
		if(!$logoUrl) throw new CHttpException(400,'no logo parameter');		
		if($newfilename = $this->getRemoteLogo($logoUrl)){
			echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$newfilename)
				.CHtml::hiddenField('Project[logo]',$newfilename);
		}else{
			throw new CHttpException(400,'upload failed');
		}
	}
	
	protected function getRemoteLogo($logoUrl)
	{
		if(!Utils::remoteFileExists($logoUrl)) return false;
		$thumb=Yii::app()->phpThumb->create($logoUrl);
		$thumb->resize(200,200);
		$newfilename = md5(time().mt_rand()).'.png';
		if($thumb->save('./upload/logo/'.$newfilename))
			return $newfilename;
		else
			return false;
	}
	
	protected function attachTags($model)
	{
		$tags = Yii::app()->request->getParam('project_tags');
		if($tags) $model->attachTags($tags);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->attachTags($model);
				$model->setDefaultLogo();
				$this->redirect(array('view','id'=>$model->id));
		}
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/remote_logo.js',CClientScript::POS_END);
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = '/layouts/main';
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/front.css');
		$dataProvider=new CActiveDataProvider('Project',array(
			'criteria'=>array(
				'condition'=>'status=1',
				'order'=>'id desc',
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionTagged($tag)
	{
		$this->layout = '/layouts/main';
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/front.css');
		if(intval($tag)) $tag = Tag::model()->findByPk($tag);
		else $tag = Tag::model()->find('name=:name',array(':name'=>$tag));
		if($tag===null) throw new CHttpException(404,'The requested page does not exist.');
		$dataProvider=new CActiveDataProvider('ProjectTag',array(
			'criteria'=>array(
				'order'=>'t.id asc',
				'condition'=>'tagID=:tagID',
				'params'=>array(':tagID'=>$tag->id),
				'with'=>array('project'),
			),
		));
		$this->render('tagged',array(
			'dataProvider'=>$dataProvider,
			'tag'=>$tag,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
