<?php
class OschinaScraper extends Scraper
{
	public function scrap()
	{
		$url = rtrim($this->url,'/');
		$project = Oschina::model()->find('oschina_intro=:oschina_intro',array(':oschina_intro'=>$url));
		if(!$project) return;
		$arr = $this->splitName($project->name);
		
		$this->model->name = $arr['name'];
		$this->model->description = $project->intro;
		//$this->model->repo = '';
		$this->model->url = $project->url;
		//$this->model->doc = $readme['_links']['html'];
		$this->model->intro = $arr['intro'];
		//$this->model->author = CHtml::link($info['owner']['login'],'https://github.com/'.$info['owner']['login']);
		$this->model->preTags = array($project->language);
	}
	
	private function splitName($pName)
	{
		$blank = strrpos($pName,' ');
		if($blank){
			$intro = substr($pName,0,$blank);
			$name = substr($pName,$blank+1);
		}else{
			$name = $pName;
			$intro = '';
		}
		return array(
			'name'=>$name,
			'intro'=>$intro,
		);
	}
}