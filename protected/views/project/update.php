<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'项目列表','url'=>array('index')),
	array('label'=>'提交新项目','url'=>array('create')),
	array('label'=>'查看项目','url'=>array('view','id'=>$model->id)),
	array('label'=>'管理项目','url'=>array('admin')),
);
?>

编辑项目:<?php echo $model->id ?><h3><?php echo $model->name ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>