<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=user::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(md5($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->userid;

			$this->setState('lastLoginTime', $user->lastLoginTime ? $user->lastLoginTime : '');
			$this->setState('username', $user->username);

			$this->setState('role', '管理员');
			$arr = array(
				lastLoginTime => date('Y-m-d H:i:s'),
				lastLoginIp => Yii::app()->request->userHostAddress,
			);

			$user->saveAttributes($arr);

            $this->errorCode=self::ERROR_NONE;
			//ckfinder
			$_SESSION['ckfinder'] == true;
			


		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
