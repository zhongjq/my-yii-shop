<?php

class plan extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'plan':
	 * @var integer $id
	 * @var integer $uid
	 * @var string $type
	 * @var string $startdate
	 * @var string $enddate
	 * @var integer $state
	 * @var string $overdate
	 * @var string $plan
	 * @var string $memo
	 * @var string $createtime
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
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('type','length','max'=>16),
			array('uid, type, startdate, enddate, plan, createtime', 'required'),
			array('uid, state', 'numerical', 'integerOnly'=>true),
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
			'user'=>array(self::BELONGS_TO, 'user', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'uid' => '用户',
			'type' => '类型',
			'startdate' => '计划开始时间',
			'enddate' => '计划完成时间',
			'state' => '完成情况',
			'overdate' => '完成时间',
			'plan' => '计划内容',
			'memo' => '备注',
			'createtime' => '创建时间',
		);
	}

	public function beforeSave() {
		if(!$this->isNewRecord)
		{
			if($this->uid != Yii::app()->user->id)
			{
				die('非本人!');
			}
		}

		return true;
	}
}