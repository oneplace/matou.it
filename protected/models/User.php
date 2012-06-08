<?php

class User extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'user';
	}
	
	public function rules()
	{
		return array(
			array('username,email,password','required'),
			array('email,username','unique'),
			array('id,username,email','safe','on'=>'search'),
		);
	}
	
	public function hashPassword($password)
	{
		return md5($password.USER_SALT);
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password) === $this->password;
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->email=strtolower($this->email);
			$this->username=strtolower($this->username);
			if($this->isNewRecord)
			{				
				$this->password = $this->hashPassword($this->password);
			}
			return true;
		}
		else
			return false;
	}
	
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
		);
	}
	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}