<?php
/**
 * taskToRole.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The tab view for assigning tasks to roles
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.tabViews
 * @since 1.0.0
 */
 ?>
<!-- ROLES -> TASKS -->
<div class="srbac">
  <?php echo CHtml::beginForm(); ?>
  <?php echo CHtml::errorSummary($model); ?>
  <table>
    <tr><th colspan="2"><?php echo Helper::translate('srbac','Assign Tasks to Roles') ?></th></tr>
    <tr>
      <th width="50%">
      <?php echo CHtml::label(Helper::translate('srbac',"Role"),'role'); ?></th>
      <td width="50%" rowspan="2">
        <div id="tasks">
          <?php
          $this->renderPartial('tabViews/roleAjax',
              array('model'=>$model,'userid'=>$userid,'data'=>$data,'message'=>$message));
          ?>
        </div>
      </td>
    </tr>
    <tr valign="top">
      <td><?php echo CHtml::activeDropDownList(AuthItem::model(),'name',
        Chtml::listData(AuthItem::model()->findAll('type=2'), 'name', 'name'),
        array('size'=>$this->module->listBoxNumberOfLines,'class'=>'dropdown','ajax' => array(
        'type'=>'POST',
        'url'=>array('getTasks'),
        'update'=>'#tasks',
        'beforeSend' => 'function(){
                      $("#loadMessRole").addClass("srbacLoading");
                  }',
        'complete' => 'function(){
                      $("#loadMessRole").removeClass("srbacLoading");
                  }',
        ),
        )); ?>
      </td>
    </tr>
  </table>
  <br />
  <?php echo CHtml::endForm(); ?>
</div>
