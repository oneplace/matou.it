<?php
Abstract class Scraper 
{
	public $model;
	public $url;
	public $html;
	
	function __construct($url,$model)
	{
		$this->model = $model;
		$this->url = $url;
		$this->fetchHtml();
	}
	
	public function fetchHtml()
	{
		$ch = curl_init($this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$this->html = curl_exec($ch);
		curl_close($ch);
	}
	
	public static $scrapers = array(
		'code.google.com'=>'GoogleCode',
		'github.com'=>'Github',
	);
	
	public static function doScrap($url,$model)
	{
		$host = parse_url($url,PHP_URL_HOST);
		if(!isset(Scraper::$scrapers[$host])) return false;
		$scraperName = Scraper::$scrapers[$host].'Scraper';
		$scraper = new $scraperName($url,$model);
		$scraper->scrap();
		return true;
	}
}
