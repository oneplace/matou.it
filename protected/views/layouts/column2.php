<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class='span3'>
		<div class='well sidebar-nav'>
	<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>$this->menu,
		'htmlOptions'=>array('class'=>'nav nav-list')
	));
	?>
		</div>
	</div>
	<div class='span9'>
		<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
		<?php echo $content ?>
	</div>
</div>
<?php $this->endContent(); ?>