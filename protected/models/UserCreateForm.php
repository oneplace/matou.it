<?php
class UserCreateForm extends CFormModel
{
	public $email;
	public $username;
	public $password;
	
	public function rules()
	{
		return array(
			array('email,username,password','required'),
			array('email','email'),
			array('email','unique','attributeName'=>'email','className'=>'application.models.User'),
			array('username','unique','attributeName'=>'username','className'=>'application.models.User'),
		);
	}
	
	public function attributeLabels()
	{
	}
}