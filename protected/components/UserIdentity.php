<?php
class UserIdentity extends CUserIdentity
{
  /**
   *
   * @var int Id of the User
   */
  private $_id;
  
  /**
   * This function check the user Authentication 
   * 
   * @return int 
   */
  public function authenticate()
  {
    $username = strtolower($this->username);
    
    if (strpos($username, '@') !== false) {
      $user = User::model()->find('LOWER(email)=?', array( $username ));
    } else {
      $user = User::model()->find('LOWER(username)=?', array( $username ));
    }
    
    if ($user === null) {
      $this->errorCode = self::ERROR_USERNAME_INVALID;
    } else if (!$user->validatePassword($this->password)) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    } else {
      $this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
    }
    return $this->errorCode==self::ERROR_NONE;
  }
  
  /**
   * Return the property _id of the class
   * @return bigint
   */
  public function getId()
  {
    return $this->_id;
  }

}