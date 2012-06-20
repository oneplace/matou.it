<?php
Yii::import('application.components.scraper.*');
class MarkController extends CController
{
	public $layout = 'mark';
	public function actionIndex()
	{
		$model=new Project;
		$url = Yii::app()->request->getParam('url');
		if(!$url) throw new CHttpException(400,'where is url?');
		
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			$model->status = 1;
			if($model->logo){
				$logo = $this->getRemoteLogo($model->logo);
				$model->logo = $logo ? $logo : '';
			}
			if($model->save()){
				$tags = Yii::app()->request->getParam('project_tags');
				if($tags) $model->attachTags($tags);
				$model->setDefaultLogo();
				$this->redirect(array('success','id'=>$model->id));
			}
		}
		$scraped = Scraper::doScrap($url,$model);
		if(!$scraped) { 
			echo 'sorry! this site is not supported.';
			return;
		}
		$this->render('form',array(
			'model'=>$model,
		));
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
	
	public function actionSuccess($id)
	{
		$project = Project::model()->findByPk($id);
		$this->render('success',array('project'=>$project));
	}
}
