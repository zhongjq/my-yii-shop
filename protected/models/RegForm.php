<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegForm extends CFormModel
{
	public $username;
	public $password;
	public $password2;
	public $rememberMe;
	public $verifyCode;
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
		    array('username, password, verifyCode, email', 'required'),
		    array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		    array('username', 'length', 'min'=>3, 'max'=>15),
		    array('password', 'compare', 'compareAttribute'=>'password2'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode' => '验证码',
			'username' => '用户名',
			'password' => '注册密码',
			'password2' => '再次输入密码',
			'email' => '邮箱',
		);
	}
}
