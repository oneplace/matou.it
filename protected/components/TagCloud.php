<?php

class TagCloud extends CWidget
{
	public $tags;
	public function init(){
		$this->tags = Tag::model()->findAll();
	}
	
	public function run()
	{
		foreach ($this->tags as $tag) {
			echo '<span class="label label-info">'.CHtml::link($tag->name,array('project/tagged','tag'=>$tag->name)).'</span> ';
		}
	}
}