<?php

class guestbook extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'guestbook':
	 * @var integer $id
	 * @var string $title
	 * @var string $content
	 * @var string $reply
	 * @var integer $userid
	 * @var string $username
	 * @var integer $gender
	 * @var integer $head
	 * @var string $email
	 * @var string $qq
	 * @var string $homepage
	 * @var integer $hidden
	 * @var integer $passed
	 * @var string $ip
	 * @var integer $create_time
	 * @var string $replyer
	 * @var integer $reply_time
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
		return 'guestbook';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('userid, gender, head, hidden, passed', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>80),
			array('username, replyer', 'length', 'max'=>20),
			array('email', 'length', 'max'=>40),
			array('email', 'email'),
			array('qq, ip', 'length', 'max'=>15),
			array('homepage', 'length', 'max'=>25),
			array('reply，create_time， reply_time','safe')
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
			'id' => 'Id',
			'title' => '标题',
			'content' => '内容',
			'reply' => '回复',
			'userid' => 'Userid',
			'username' => '留言人',
			'gender' => 'Gender',
			'head' => 'Head',
			'email' => 'Email',
			'qq' => 'Qq',
			'homepage' => 'Homepage',
			'hidden' => '隐藏',
			'passed' => 'Passed',
			'ip' => 'Ip',
			'create_time' => '发表时间',
			'replyer' => '回复人',
			'reply_time' => '回复时间',
		);
	}
}
