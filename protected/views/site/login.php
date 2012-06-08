<div class="modal" id="login-panel">
  <div class="modal-header">
    <h3>登录</h3>
  </div>
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'type'=>'horizontal',
)); ?>
  <div class="modal-body">
    <?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
		<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
  </div>
  <div class="modal-footer">
    <?php echo CHtml::htmlButton('Login', array('class'=>'btn btn-primary', 'type'=>'submit')); ?>
  </div>
</div>
<?php $this->endWidget(); ?>