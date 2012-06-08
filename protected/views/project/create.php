<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Project','url'=>array('index')),
	array('label'=>'Manage Project','url'=>array('admin')),
);
?>

<h1>添加项目</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>