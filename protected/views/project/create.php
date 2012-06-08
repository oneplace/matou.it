<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'项目列表','url'=>array('index')),
	array('label'=>'管理项目','url'=>array('admin')),
);
?>

<h1>添加项目</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>