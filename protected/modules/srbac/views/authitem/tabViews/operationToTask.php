<?php
/**
 * operationToTask.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The tab view for assigning operations to tasks
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.tabViews
 * @since 1.0.0
 */
 ?>
<!-- TASKS -> OPERATIONS -->
<div class="srbac">
  <?php echo CHtml::beginForm(); ?>
  <?php echo CHtml::errorSummary($model); ?>
  <table>
    <tr><th colspan="2"><?php echo Helper::translate('srbac','Assign Operations to Tasks') ?></th></tr>
    <tr>
      <th width="50%">
      <?php echo CHtml::label(Helper::translate('srbac',"Task"),'task'); ?></th>
      <td width="50%" rowspan="2">
        <div id="operations">
          <?php
          $this->renderPartial('tabViews/taskAjax',
              array('model'=>$model,'userid'=>$userid,'data'=>$data,'message'=>$message));
          ?>
        </div>
      </td>
    </tr>
    <tr valign="top">
      <td><?php echo CHtml::activeDropDownList(Assignments::model(),'itemname',
        Chtml::listData(AuthItem::model()->findAll('type=1'), 'name', 'name'),
        array('size'=>$this->module->listBoxNumberOfLines,'class'=>'dropdown','ajax' => array(
        'type'=>'POST',
        'url'=>array('getOpers'),
        'update'=>'#operations',
        'beforeSend' => 'function(){
                      $("#loadMessTask").addClass("srbacLoading");
                  }',
        'complete' => 'function(){
                      $("#loadMessTask").removeClass("srbacLoading");
                  }',
        ),
        )); ?>
      </td>
    </tr>
  </table>
  <br />
  <div class="message" id="loadMessTask">
    <?php echo $message ?>
  </div>
  <?php echo CHtml::endForm(); ?>
</div>