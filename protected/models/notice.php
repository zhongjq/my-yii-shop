<?php

class notice extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'notice':
	 * @var integer $id
	 * @var string $title
	 * @var string $content
	 * @var string $datetime
	 * @var integer $top
	 * @var integer $digest
	 * @var integer $state
	 * @var integer $sort
	 * @var integer $view
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
		return 'notice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title','length','max'=>255),
			array('title, content, cate_id, datetime', 'required'),
			array('top, digest, state, sort, view', 'numerical', 'integerOnly'=>true),
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
			'cate'=>array(self::BELONGS_TO, 'tree', 'cate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '新闻id',
			'title' => '新闻标题',
			'content' => '新闻内容',
			'cate_id' => '新闻分类',
			'datetime' => '日期',
			'top' => '置顶',
			'digest' => '精华',
			'state' => '显示',
			'sort' => '排序',
			'view' => '浏览量',
		);
	}
}