<h2>修改密码</h2>

<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	//'htmlOptions'=>array('class'=>'well'),
	//'enableAjaxValidation'=>true,
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->passwordFieldRow($model, 'oldPassword', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'newPassword', array('class'=>'span3')); ?>
<div class="form-actions">
<?php echo CHtml::htmlButton('确认', array('class'=>'btn btn-primary', 'type'=>'submit')); ?>
</div>
 
<?php $this->endWidget(); ?>