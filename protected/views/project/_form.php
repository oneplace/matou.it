<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><span class="required">*</span>为必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'repo',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>64)); ?>
	
	<?php echo $form->textFieldRow($model,'intro',array('class'=>'span7','maxlength'=>256)); ?>
	
	<?php echo $form->labelEx($model,'description'); ?>
		<?php
		$this->widget('ext.cleditor.ECLEditor', array(
		        'model'=>$model,
		        'attribute'=>'description', 
		        'options'=>array(
		            'width'=>535,
		            'height'=>200,
								'controls' => "bold italic underline strikethrough | bullets numbering | image link | pastetext source | undo redo | ",
		        ),
		    ));
		?>
		<?php echo $form->error($model,'description'); ?>
	<label>项目标签</label>
	<!-- <input name="project_tags" id="project-tags" value="foo,bar,baz" /> -->
	<?php $this->widget('ext.STagsInput.STagsInput',array(
		'value'=>implode(',',$model->tagStrings),
		'name'=>'project_tags',
		'options'=>array(
			'defaultText'=>'加标签',
		),
	)) ?>
	<?php echo $form->labelEx($model,'logo'); ?>
	<div class="input-append">
		<input class="span5" size="2566" name="logo_url" id="logo_url" type="text"><button id="btn_remote_logo" class="btn" type="button">复制网络图片</button>
	</div>
	&nbsp;&nbsp;或者<?php
	$this->widget('ext.suploadify.SUploadify',array(
		'uploader'=>$this->createUrl('/file/logo'),
		'options'=>array(
			'buttonText'=>'从本地上传',
			'height'=>16,
			'width'=>80,
			'onUploadSuccess'=>'js:function(file, data, response){$("#logo-container").html(data);}',
			// 'onUploadError' => 'js:function(file, errorCode, errorMsg, errorString){console.log(errorString);}',
		),
	));
	?>
	<span id="logo-container">
		<?php if ($model->logo): ?>
			<?php echo CHtml::image(Yii::app()->baseUrl.'/upload/logo/'.$model->logo) ?>
		<?php endif ?>
	</span>

	<?php echo $form->textFieldRow($model,'doc',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'demo',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'author',array('class'=>'span5','maxlength'=>64)); ?>
	
	<?php echo $form->labelEx($model,'licenseID'); ?>
	<?php echo $form->dropDownList($model,'licenseID',CHtml::listData(License::model()->findAll(), 'id', 'name')); ?>
	<?php echo $form->error($model,'licenseID'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
