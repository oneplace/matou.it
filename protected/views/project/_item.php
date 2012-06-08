<li class="clearfix">
  <?php echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$project->logo) ?>
  <h4><?php echo CHtml::link($project->name,array('project/view','id'=>$project->id)) ?></h4>
  <p><?php echo $project->intro ?></p>
  <ul class="tag-list">
		<?php foreach ($project->tags as $tag): ?>
		<li><?php echo CHtml::link($tag->name,array('project/tagged','tag'=>$tag->name),array('class'=>'label label-info')) ?></li>	
		<?php endforeach ?>
  </ul>
</li>