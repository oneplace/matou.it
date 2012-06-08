<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'logo',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'doc',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'demo',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'repo',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'author',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'licenseID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
