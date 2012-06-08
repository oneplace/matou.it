<?php
class STagsInput extends CWidget
{	
	const SCRIPTFILE = 'jquery.tagsinput.min.js';
	const CSSFILE = 'jquery.tagsinput.css';
	public $htmlOptions = array();
	public $options = array();
	public $name = 'tags';
	public $value = '';
	
	public function init()
	{
		parent::init();
		$this->htmlOptions['id']=$this->getId();
		$this->publishAssets();
	}
	
	protected function publishAssets()
	{
		$assets = dirname(__FILE__) . '/assets';
		$assetsUrl = Yii::app()->assetManager->publish($assets);
		if (is_dir($assets)) {
			Yii::app()->clientScript->registerScriptFile($assetsUrl . '/' . STagsInput::SCRIPTFILE, CClientScript::POS_END);
			Yii::app()->clientScript->registerCssFile($assetsUrl . '/' . STagsInput::CSSFILE);
		} else {
			throw new CHttpException(500, 'STagsInput - Error: Couldn\'t find assets to publish.');
		}
	}
	
	protected function generateScript()
	{
		$id=$this->getId();
		$options = array(
			'width'=>'auto',
			'height'=>'auto',
		);
		$options = array_merge($options,$this->options);
		$jsOptions=CJavaScript::encode($options);
		Yii::app()->clientScript->registerScript(__CLASS__.'#'.$id, "jQuery('#{$id}').tagsInput({$jsOptions});", CClientScript::POS_READY);
	}
	
	public function run()
	{
		$this->generateScript();
		echo CHtml::textField($this->name,$this->value,$this->htmlOptions);
	}
}