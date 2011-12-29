<?php

class tree extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors(){
        return array(
            'TreeBehavior' => array(
                'class' => 'application.extensions.nestedset.TreeBehavior'
            )
        );
    }

	public function rules()
	{
		return array(
			array('name', 'required'),
		);
	}

}