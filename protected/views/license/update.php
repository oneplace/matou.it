<?php
$this->breadcrumbs=array(
	'Licenses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List License','url'=>array('index')),
	array('label'=>'Create License','url'=>array('create')),
	array('label'=>'View License','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage License','url'=>array('admin')),
);
?>

<h1>Update License <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>