<?php
$this->breadcrumbs=array(
	'Languages',
);

$this->menu=array(
	array('label'=>'Create Language','url'=>array('create')),
	array('label'=>'Manage Language','url'=>array('admin')),
);
?>

<h1>Languages</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
