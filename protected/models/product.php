<?php

class product extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'product':
	 * @var integer $id
	 * @var integer $cate_id
	 * @var string $icon
	 * @var string $title
	 * @var string $content
	 * @var integer $createtime
	 * @var integer $updatetime
	 * @var integer $top
	 * @var integer $digest
	 * @var integer $state
	 * @var integer $sort
	 * @var string $date
	 * @var integer $hit
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_id, title, content, ', 'required'),
			array('cate_id, createtime, updatetime, top, digest, state, sort, hit', 'numerical', 'integerOnly'=>true),
			array('icon, title', 'length', 'max'=>255),
			array('number, weight, date', 'safe'),
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
			'id' => 'Id',
			'cate_id' => '分类',
			'icon' => '图片',
			'title' => '产品名称',
			'content' => '产品介绍',
			'createtime' => '创建时间',
			'updatetime' => '修改时间',
			'top' => '首页滚动',
			'digest' => '特色产品',
			'state' => '显示',
			'sort' => '排序',
			'date' => '日期',
			'hit' => '点击',
			'number' => '产品编号',
			'weight' => '重量'
		);
	}

	public function beforeSave() {
		if($this->isNewRecord){
			$this->createtime = strtotime(NOW);
		}else{
			$this->updatetime = strtotime(NOW);
		}
		return true;
	}

	public function getPicThumbs()
	{

	}
}
