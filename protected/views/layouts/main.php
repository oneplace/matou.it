<!DOCTYPE html>
<html lang="zh">
  <head>
	<meta charset="utf-8">
	<title>码头 - 程序员的聚集地</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<style>
	  body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	  }
	</style>


	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->

  </head>

  <body>

	<?php $this->widget('bootstrap.widgets.BootNavbar', array(
		// 'fixed'=>true,
		'brand'=>Yii::app()->name,
		'brandUrl'=>'#',
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=>array('project/index')),
					array('label'=>'项目管理', 'url'=>array('project/admin')),
					array('label'=>'其他设置', 'url'=>'#', 'items'=>array(
						array('label'=>'开源许可证', 'url'=>array('license/admin')),
					)),
				),
			),
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					'---',
					array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
						array('label'=>'设置', 'url'=>'#'),
						'---',
						array('label'=>'登出', 'url'=>array('site/logout')),
					)),
				),
			),
			'<form class="navbar-search pull-right" action=""><input type="text" class="search-query span3" placeholder="Search"></form>',
		),
	)); ?>

	<div class="container">
	<?php echo $content ?>
	</div> <!-- /container -->

  </body>
</html>
