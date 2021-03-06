<div class="row">
	<div class="span4" id="sidebar">
	  <div class="well">
	    <a href="<?php echo $this->createUrl('project/create') ?>" class="btn btn-large" id="add-btn">添加项目</a>
	  </div>
	  <div class="well" id="tag-filter">
	    <h3>标签云</h3>
    	<?php $this->widget('TagCloud') ?>
	  </div>
	</div>
	<div class="span8">
		<h3>标签：<?php echo $tag->name ?></h3>
	  <ul id="project-list">
		<?php foreach ($dataProvider->getData() as $projectTag): ?>
			<?php $this->renderPartial('_item',array('project'=>$projectTag->project)) ?>
		<?php endforeach ?>
    </ul>
		<?php $this->widget('CLinkPager', array(
		    'pages' => $dataProvider->pagination,
				'htmlOptions'=>array(
					'class'=>'pagination',
				),
		)) ?>
  </div>
</div>
