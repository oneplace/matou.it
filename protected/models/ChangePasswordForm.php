<?php
class ChangePasswordForm extends CFormModel
{
	public $userID;
	public $oldPassword;
	public $newPassword;
	
	public function rules()
	{
		return array(
			array('oldPassword,newPassword','required'),
			array('oldPassword','checkOldPassword'),
		);
	}
	
	public function checkOldPassword($attribute,$params)
	{
		$user = User::model()->findByPk($this->userID);
		if(!$user){
			$this->addError($attribute,'the user does not exsit');
			return false;
		}
		if(!$user->validatePassword($this->oldPassword)){
			$this->addError($attribute,'Old password is not correct');
			return false;
		}
	}
	
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>'旧密码',
			'newPassword'=>'新密码',
		);
	}
}