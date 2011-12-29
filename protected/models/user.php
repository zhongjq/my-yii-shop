<?php

class user extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'user':
	 * @var integer $userid
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 * @var string $regIp
	 * @var string $regTime
	 * @var string $lastLoginIp
	 * @var string $lastLoginTime
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, email', 'required'),
			array('username','length','min'=>4,'max'=>15),
			array('password','length','min'=>6,'max'=>32),

			array('password', 'required', 'on' => 'create'),

			array('username','unique'),

			array('email','email'),
			array('email','length','max'=>32),

			/* update user */
			array('passwordNew','required', 'on' => 'newpass'),
			array('passwordNew2', 'required', 'on' => 'newpass'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => '用户ID',
			'username' => '用户名',
			'password' => '密码',
			'email' => 'Email',
			'profile' => '用户信息',
			'regIp' => '注册IP',
			'regTime' => '注册时间',
			'lastLoginIp' => '上次登录IP',
			'lastLoginTime' => '上次登录时间',
		);
	}

	public function beforeSave() {
		if($this->isNewRecord)
		{
			$this->password = md5($this->password);
			$this->regIp = Yii::app()->request->userHostAddress;
			$this->regTime = Date('Y-m-d H:i:s');
		}

		return true;
	}
}
