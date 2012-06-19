<div class="container">
    <div class="row" id="project-overview">
      <div class="span3" id="project-logo">
      <?php echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$project->logo) ?>
      </div>
      <div class="span9" id="project-info">
        <h1><?php echo $project->name ?></h1>
				<span id="intro"><?php echo $project->intro ?></span>
        <div class="row">
          <div class="span6">
            <dl class="clearfix">
              <dt>官方网站：</dt>
              <dd><?php echo CHtml::link($project->url,$project->url) ?></dd>
							<?php if ($project->author): ?>
							<dt>作者：</dt>
	            <dd><?php echo $project->author ?></dd>
							<?php endif ?>
							<?php if ($project->repo): ?>
							<dt>repo：</dt>
	            <dd><?php echo CHtml::link($project->repo,$project->repo) ?></dd>
							<?php endif ?>
							<?php if ($project->doc): ?>
							<dt>文档：</dt>
	            <dd><?php echo CHtml::link($project->doc,$project->doc) ?></dd>
							<?php endif ?>
							<?php if ($project->demo): ?>
							<dt>示例：</dt>
	            <dd><?php echo CHtml::link($project->demo,$project->demo) ?></dd>
							<?php endif ?>
            </dl>
            <h4>标签：</h4>
            <ul id="tag-list">
							<?php foreach ($project->tags as $tag): ?>
							<li><?php echo CHtml::link($tag->name,array('project/tagged','tag'=>$tag->name),array('class'=>'label label-info')) ?></li>	
							<?php endforeach ?>
            </ul>
          </div>
          <div class="span2">
						<?php echo CHtml::link('更新信息',array('project/update','id'=>$project->id),array('class'=>'btn span1 btn-primary')) ?>
						<?php if ($project->repo): ?>
            <a href="<?php echo $project->repo ?>" class="btn span1 btn-info">Github</a>
						<?php endif ?>
						<?php if ($project->demo): ?>
            <a href="<?php echo $project->demo ?>" class="btn span1 btn-info">Demo</a>
						<?php endif ?>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="span8" id="introduction">
        <h3>简介：</h3>
        <div id="introduction-main"><?php echo $project->description ?></div>
      </div>
      <div class="span4">
        <h3>相关文章：</h3>
        <ul id="article-list" class="clearfix">
          <li><a href="#">Designed for everyone, everywhere.</a></li>
        </ul>
      </div>
      <div class="span8" id="screen-shot">
        <h3>截图：</h3>
        <ul id="screen-shot-list" class="clearfix">
              <!-- <li>
              <a href="http://movie.douban.com/photos/photo/1496584372/"><img src="http://img1.douban.com/view/photo/albumicon/public/p1496584372.jpg" /></a>
          </li> -->
        </ul>
      </div>

    </div>
</div>