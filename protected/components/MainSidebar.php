<?php
/**
 * MainMenu is a widget displaying main menu items.
 *
 * The menu items are displayed as an HTML list. One of the items
 * may be set as active, which could add an "active" CSS class to the rendered item.
 *
 * To use this widget, specify the "items" property with an array of
 * the menu items to be displayed. Each item should be an array with
 * the following elements:
 * - visible: boolean, whether this item is visible;
 * - label: string, label of this menu item. Make sure you HTML-encode it if needed;
 * - url: string|array, the URL that this item leads to. Use a string to
 *   represent a static URL, while an array for constructing a dynamic one.
 * - pattern: array, optional. This is used to determine if the item is active.
 *   The first element refers to the route of the request, while the rest
 *   name-value pairs representing the GET parameters to be matched with.
 *   When the route does not contain the action part, it is treated
 *   as a controller ID and will match all actions of the controller.
 *   If pattern is not given, the url array will be used instead.
 */
class MainSidebar extends CWidget
{
	public $items=array();

	public function run()
	{
		$items=array();
		$controller=$this->controller;
		$action=$controller->action;

		if($controller->id == 'content')
		{
			switch($action->id){
				case 'about':$cate_id = 11;break;
				case 'education':$cate_id = 13;break;
				case 'honor':$cate_id = 12;break;
			}
			
			
			
			$message .= '<dt>'.CHtml::encode($root->name).'</dt>';
			$content = content::model()->findAll($criteria);
			$message .= '<dd'.$class_name.'>'.CHtml::link('集团简介', array('/site/page','view'=>'intro')).'</dd>';
			$message .= '<dd'.$class_name.'>'.CHtml::link('董事长致辞', array('/site/page','view'=>'intro')).'</dd>';
			$message .= '<dd'.$class_name.'>'.CHtml::link('华科之路', array('/site/page','view'=>'intro')).'</dd>';
			$message .= '<dd'.$class_name.'>'.CHtml::link('发展战略', array('/site/page','view'=>'intro')).'</dd>';
			$message .= '<dd'.$class_name.'>'.CHtml::link('经营理念', array('/site/page','view'=>'intro')).'</dd>';
			$message .= '<dd'.$class_name.'>'.CHtml::link('社会责任', array('/site/page','view'=>'intro')).'</dd>';
/*            $root = tree::model()->findByPK($cate_id);
			$criteria=new CDbCriteria;
			$criteria->condition = "cate_id = $cate_id";
			$criteria->order = "sort desc";*/
/*			foreach($content as $tree)
			{
				$class_name = $tree->id == $_GET['id'] ? ' class = "show"' : '';
				$message .= '<dd'.$class_name.'>'.CHtml::link($tree->title,array('/content/'.$action->id,'id'=>$tree->id)).'</dd>';
			}*/
			$message = '<dl>'.$message.'</dl>';
		}elseif ($controller->id == 'product'){
		    
		    $cate_id = 4;
			$root = tree::model()->findByPK($cate_id);
			$message .= '<dt>'.CHtml::encode($root->name).'</dt>';
		    
			$criteria=new CDbCriteria;
			$criteria->order = "sort desc";
		    $products = product::model()->findAll($criteria);
			foreach($products as $tree){
				$class_name = $tree->id == $_GET['id'] ? ' class = "show"' : '';
				$message .= '<dd'.$class_name.'>'.CHtml::link($tree->title,array('/product/'.$action->id,'id'=>$tree->id)).'</dd>';
			}
			$message = '<dl>'.$message.'</dl>';
		}
		else
		{
			if($controller->id == 'notice')
			{
				$cate_id = Yii::app()->request->getParam('cate_id') ? Yii::app()->request->getParam('cate_id') : 2;
				$cate_id =  2;
			}
			else
			{
				$cate_id = Yii::app()->request->getParam('cate_id') ? Yii::app()->request->getParam('cate_id') : 4;
			}
			

			$root = tree::model()->findByPK($cate_id);
            $message .= '<dt>'.CHtml::encode($root->name).'</dt>';

			if($root->level == 3)
			{
				$root = $root->getParentNode();
			}
			
			
			$tree2 = $root->getTree();
			
			foreach($tree2 as $key => $subtree)
			{
				$message .= $this->printNestedTree($subtree);
			}
			$message = '<dl>'.$message.'</dl>';
		}

		echo $message;
	}

	private function printNestedTree($tree)
	{

		$url = '/product';
		
		if($this->controller->id == 'product')
		{
			$cate_id = $this->controller->cate_id;
			$class_name = $tree->id == $cate_id ? ' class = "show"' : '';
		}


		if($this->controller->id == 'notice')
		{
			$cate_id = $this->controller->cate_id;
			$class_name = $tree->id == $cate_id ? ' class = "show"' : '';
			$url = '/notice';
		}

		if($tree->level == '2')
		{
			$data = '<dd'.$class_name.'>'.CHtml::link($tree->name,array($url,'cate_id'=>$tree->id)).'</dd>';
		}
		elseif($tree->level == '3')
		{
		    $data = '<dd'.$class_name.'>'.CHtml::link($tree->name,array($url,'cate_id'=>$tree->id)).'</dd>';
		}
		return $data;
	}

}
