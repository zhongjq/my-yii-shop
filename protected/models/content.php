<?php

class content extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'content':
	 * @var integer $id
	 * @var integer $cate_id
	 * @var string $icon
	 * @var string $title
	 * @var string $content
	 * @var integer $sort
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
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_id, title, content', 'required'),
			array('cate_id, sort', 'numerical', 'integerOnly'=>true),
			array('icon, title', 'length', 'max'=>255),
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
			'icon' => '标识码',
			'title' => '标题',
			'content' => '内容',
			'sort' => '排序',
		);
	}

	public function getContent($id,$cate_id)
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'cate_id = '. $cate_id ;

		if(!empty($id))
		{
			if(is_numeric($id))
			{
				$criteria->condition .= ' AND id = '. $id ;
			}
			else
			{
				 $criteria->condition .= ' AND icon = '. $id ;
			}
		}
		$content=content::model()->find($criteria);

		return $content;
	}
}
