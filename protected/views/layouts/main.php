<!DOCTYPE html>
<html lang="zh">
  <head>
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
	    'httpEquivs'=>array(
	        'Content-Type'=>'text/html; charset=utf-8',
	        'Content-Language'=>'zh-CN'
	    ),
	    'defaultDescription'=>'码头，开源代码的集散地。程序员的充电房',
	    'defaultKeywords'=>'开源，代码，分享，码头，创业',
	)); ?>

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
		'brandUrl'=>Yii::app()->createAbsoluteUrl('/'),
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=>array(
					array('label'=>'Home', 'url'=>array('project/index')),
					array('label'=>'项目管理', 'url'=>array('project/admin')),
					array('label'=>'用户管理', 'url'=>array('user/index')),
					array('label'=>'其他设置', 'url'=>'#', 'items'=>array(
						array('label'=>'开源许可证', 'url'=>array('license/admin')),
					)),
				),
			),
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>'登录','url'=>array('site/login'),'visible'=>Yii::app()->user->isGuest),
					array('label'=>'MarkTou↥','url'=>"javascript:(function(){h = 'http://matou.it/mark?';u = h + 'url=' + encodeURIComponent(window.location.href)+'&title=' + encodeURIComponent(document.title);window.open(u, 'MarkTou','location=yes,links=no,scrollbars=yes,toolbar=no,width=600,height=600')})();"),
					'---',
					array('label'=>Yii::app()->user->name, 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
						array('label'=>'设置', 'url'=>'#'),
						'---',
						array('label'=>'登出', 'url'=>array('site/logout')),
					)),
				),
			),
			// '<form class="navbar-search pull-right" action=""><input type="text" class="search-query span3" placeholder="Search"></form>',
		),
	)); ?>

	<div class="container">
	<?php echo $content ?>
	</div> <!-- /container -->
	<a id="feedback" target="_blank" class="btn btn-primary" href="http://ideaworks.cn/v/index.php?p=/categories/matou-it">开发建议</a>
  </body>
</html>
