<h2>User Details</h2>
<?php
$this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'username',
	),
));
?>