<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'项目列表','url'=>array('index')),
	array('label'=>'提交项目','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('project-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理项目</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'project-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id', 'headerHtmlOptions'=>array('width'=>'22px')),
		array(
			'header'=>'logo',
			'value'=>'Yii::app()->baseUrl."/upload/logo/".$data->logo',
			'type'=>'image',
			'htmlOptions'=>array('style'=>'width: 60px'),
		),
		'name',
		array(
			'header'=>'url',
			'class'=>'CLinkColumn',
			'labelExpression'=>'$data->name',
			'urlExpression'=>'$data->url',
		),
		// 'url',
		// 'logo',
		// 'doc',
		// 'demo',
		/*
		'repo',
		'author',
		'licenseID',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
