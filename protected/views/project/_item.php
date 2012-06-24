<li class="clearfix">
	<?php if ($project->logo == 'default.png'): ?>
		<div class="default-logo"><?php echo CHtml::encode($project->name) ?></div>
	<?php else: ?>
		<?php echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$project->logo) ?>
	<?php endif ?>
  <h4>
		<?php echo CHtml::link($project->name,array('project/view','id'=>$project->id)) ?>
		<span class="intro"><?php echo CHtml::encode($project->intro) ?></span>
	</h4>
  <p><?php echo mb_substr(strip_tags($project->description),0,200) ?></p>
  <ul class="tag-list">
		<?php foreach ($project->tags as $tag): ?>
		<li><?php echo CHtml::link($tag->name,array('project/tagged','tag'=>$tag->name),array('class'=>'label label-info')) ?></li>	
		<?php endforeach ?>
  </ul>
</li>