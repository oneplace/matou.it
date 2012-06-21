<?php
class GithubScraper extends Scraper
{
	public function scrap()
	{
		$path = parse_url($this->url,PHP_URL_PATH);
		$path = rtrim($path,'/');
		$infoJson = file_get_contents('https://api.github.com/repos'.$path);
		$info = json_decode($infoJson,true);
		$readmeJson = file_get_contents('https://api.github.com/repos'.$path.'/readme');
		$readme = json_decode($readmeJson,true);
		$info['intro'] = $info['description'];
		$markdownParser = new CMarkdownParser;
		$info['description'] = $markdownParser->transform(base64_decode($readme['content']));
		
		$this->model->name = $info['name'];
		$this->model->description = $info['description'];
		$this->model->repo = $info['html_url'];
		$this->model->url = $info['homepage'];
		$this->model->doc = $readme['_links']['html'];
		$this->model->intro = $info['intro'];
		$this->model->author = CHtml::link($info['owner']['login'],$info['owner']['url']);
		$this->model->preTags = array($info['language']);
	}
}