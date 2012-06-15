<?php

class TagCloud extends CWidget
{
	public $tags;
	public function init(){
		$this->tags = Tag::model()->findAll(array(
			'limit'=>20,
			'order'=>'id asc',
		));
	}
	
	public function run()
	{
		foreach ($this->tags as $tag) {
			echo '<span class="label label-info">'.CHtml::link($tag->name,array('project/tagged','tag'=>trim($tag->name))).'</span> ';
		}
	}
}