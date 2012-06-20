<?php
class AutoController extends CController
{
	public function actionRepo()
	{
		$repo = Yii::app()->request->getParam('repo');
		if(!$repo) throw new CHttpException(400,'no repo parameter');
		//echo file_get_contents('https://api.github.com/repos/coreyti/showdown');
		$urlInfo = parse_url($repo);
		if(isset($urlInfo['host'])&&$urlInfo['host']=='github.com'){
			$infoJson = file_get_contents('https://api.github.com/repos'.$urlInfo['path']);
			$info = json_decode($infoJson,true);
			$readmeJson = file_get_contents('https://api.github.com/repos'.$urlInfo['path'].'/readme');
			$readme = json_decode($readmeJson,true);
			$info['intro'] = $info['description'];
			$markdownParser = new CMarkdownParser;
			$info['description'] = $markdownParser->transform(base64_decode($readme['content']));
			echo json_encode($info);
		}
	}
}
//https://api.github.com/repos/%s/readme