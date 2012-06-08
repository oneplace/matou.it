<h2>所有用户</h2>

<?php
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'user-grid',
	'template'=>"{items}\n{summary}\n{pager}",
	'itemsCssClass'=>'table table-striped table-bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('class'=>'bootstrap.widgets.BootPager','displayFirstAndLast'=>true),
	'ajaxUpdate'=>false,
	'columns'=>array(
		array('name'=>'id','htmlOptions'=>array('style'=>'width:30px;'),'filter'=>false),
		'username',
		'email',
		array(
        'class'=>'bootstrap.widgets.BootButtonColumn',
        // 'htmlOptions'=>array('style'=>'width: 50px'),
    ),
	),
));
?>