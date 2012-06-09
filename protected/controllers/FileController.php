<?php

class FileController extends CController
{
	public $layout=null;
	public static $ImageExt = array('jpg','png','gif','jpeg');
	public static $VideoExt = array('flv');
	
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('upload'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionLogo()
	{
		$file = CUploadedFile::getInstanceByName('Filedata');
		if(!$file)throw new CHttpException(400,'no image uploaded');
		if(in_array($file->extensionName,self::$ImageExt)===FALSE){
			throw new CHttpException(400,'not a image file');
		}
		$thumb=Yii::app()->phpThumb->create($file->tempName);
		$thumb->resize(200,200);
		$newfilename = md5(time().mt_rand()).'.'.$file->extensionName;
		if($thumb->save('./upload/logo/'.$newfilename)){
			echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$newfilename)
				.CHtml::hiddenField('Project[logo]',$newfilename);
		}else{
			throw new CHttpException(400,'upload failed');
		}		
	}
	
	
	public function actionThumbnail()
	{
		$file = CUploadedFile::getInstanceByName('Filedata');
		if(!$file)throw new CHttpException(400,'no file uploaded');
		$thumb=Yii::app()->phpThumb->create($file->tempName);
		$thumb->adaptiveResize(120,90);
		$newfilename = time().mt_rand().'.jpg';
		$thumb->save('./upload/thumbnail/'.$newfilename);
		echo '缩略图：'.CHtml::image(Yii::app()->baseUrl.'/upload/thumbnail/'.$newfilename)
			.CHtml::hiddenField('Post[thumbnail]',$newfilename);
	}
	
	public function actionAttach()
	{
		$file = CUploadedFile::getInstanceByName('Filedata');
		if(!$file)throw new CHttpException(400,'no file uploaded');
		if(in_array($file->extensionName,array('php'))){
			throw new CHttpException(400,'not a valid file');
		}
		$newfilename = time().mt_rand().'.'.$file->extensionName;
		// $file->saveAs('./upload/'.$newfilename);
		if($file->saveAs('./attach/'.$newfilename) ){
			$postAttach = new PostAttach;
			$postAttach->name = $file->name;
			$postAttach->file = $newfilename;
			if($postAttach->save()){
				echo CHtml::link($postAttach->name,Yii::app()->baseUrl.'/attach/'.$postAttach->file)
				.CHtml::hiddenField('attach[]',$postAttach->id);
			}
		}
	}
}