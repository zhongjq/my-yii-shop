<?php
/**
 * assign.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The Assign tabview view
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.0.0
 */
 ?>
<div>
<?php
$this->renderPartial("frontpage");

$tabs = array(
    'tab1'=>array(
          'title'=>Helper::translate('srbac','Users'),
          'view'=>'tabViews/roleToUser',
    ),
    'tab2'=>array(
          'title'=>Helper::translate('srbac','Roles'),
          'view'=>'tabViews/taskToRole',
    ),
    'tab3'=>array(
          'title'=>Helper::translate('srbac','Tasks'),
          'view'=>'tabViews/operationToTask',
    ),
);

$this->widget('system.web.widgets.CTabView',
  array('tabs'=>$tabs,
        'viewData'=>array('model'=>$model,'userid'=>$userid,'message'=>$message,'data'=>$data),
        'cssFile'=>$this->module->css,
      ));
?>
</div>