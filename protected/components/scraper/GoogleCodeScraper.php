<?php
class GoogleCodeScraper extends Scraper
{
	public function scrap()
	{
		phpQuery::newDocumentHTML($this->html);
		$this->model->name = pq('#pname span')->text();
		$this->model->description = pq('#wikicontent')->html();
		$this->model->repo = $this->model->url = 'http://code.google.com'.pq('#pname a')->attr('href');
		$this->model->doc = $this->model->url.'w/list';
		$this->model->intro = pq('#project_summary_link span')->text();
		$this->model->preTags = $this->getLabels();
		$logo = pq('#plogo img')->attr('src');
		if(!strpos($logo,'defaultlogo.png'))
			$this->model->logo = 'http://code.google.com'.$logo;
	}
	
	private function getLabels()
	{
		$labels = array();
		$count = 0;
		foreach (pq('#project_labels a') as $link) {
			if(++$count>3) break;
			$labels[]=pq($link)->text();
		}
		return $labels;
	}
}