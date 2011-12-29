<?php

class jobs extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'jobs':
	 * @var integer $id
	 * @var string $title
	 * @var string $descript
	 * @var integer $number
	 * @var string $createtime
	 * @var string $start_date
	 * @var string $end_date
	 * @var integer $sex
	 * @var integer $education
	 * @var string $place
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
		return 'jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, descript, number, sex, education, place', 'required'),
			array('id, number', 'numerical', 'integerOnly'=>true),
			array('title, place, education', 'length', 'max'=>50),
			array('start_date, end_date', 'safe'),
			
			//array('start_date','compare', 'compareAttribute' => 'mobile', 'on' => 'AddParentForm'),
			array('end_date','compare', 'compareAttribute' => 'start_date', 'operator' => '>', 'message' => '错误的开始结束日期'),
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
			'title' => '职位名称',
			'descript' => '详细',
			'number' => '需要人数',
			'createtime' => '创建时间',
			'start_date' => '开始日期',
			'end_date' => '结束日期',
			'sex' => '性别',
			'education' => '学历',
			'place' => '工作地点',
		);
	}
}
