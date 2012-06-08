<div class="row">
	<div class="span4" id="sidebar">
	  <div class="well">
	    <a href="<?php echo $this->createUrl('project/create') ?>" class="btn btn-large" id="add-btn">添加项目</a>
	  </div>
	  <div class="well" id="tag-filter">
	    <h3>标签云</h3>
	    <span class="label label-info"><a href="#">JavaScript</a></span>
	    <span class="label label-info"><a href="#">Python</a></span>
	    <span class="label label-info"><a href="#">ActionScript</a></span>
	    <span class="label label-info"><a href="#">Backbone</a></span>
	    <span class="label label-info"><a href="#">jQuery</a></span>
	    <span class="label label-info"><a href="#">WhatEver</a></span>
	    <span class="label label-info"><a href="#">AnyThing</a></span>
    
	  </div>
	</div>
	<div class="span8">
	  <ul id="project-list">
		<?php foreach ($dataProvider->getData() as $project): ?>
			<?php $this->renderPartial('_item',array('project'=>$project)) ?>
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
