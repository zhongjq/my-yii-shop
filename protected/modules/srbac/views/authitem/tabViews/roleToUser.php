<?php
/**
 * roleToUser.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The tab view for assigning roles to users
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.tabViews
 * @since 1.0.0
 */
 ?>
<!-- USER -> ROLES -->
<div class="srbac">
  <?php echo CHtml::beginForm(); ?>
  <?php echo CHtml::errorSummary($model); ?>
  <table>
    <tr><th colspan="2"><?php echo Helper::translate('srbac','Assign Roles to Users')?></th></tr>
    <tr>
      <th width="50%">
      <?php echo CHtml::label(Helper::translate('srbac',"User"),'user'); ?></th>
      <td width="50%" rowspan="2">
        <div id="roles">
          <?php
          $this->renderPartial(
            'tabViews/userAjax',
            array('model'=>$model,'userid'=>$userid,'data'=>$data,'message'=>$message)
          );
          ?>
        </div>
      </td>
    </tr>
    <tr valign="top">
      <td><?php echo CHtml::activeDropDownList($this->module->getUserModel(),$this->module->userid,
        Chtml::listData($this->module->getUserModel()->findAll(), $this->module->userid, $this->module->username),
        array('size'=>$this->module->listBoxNumberOfLines,'class'=>'dropdown','ajax' => array(
        'type'=>'POST',
        'url'=>array('getRoles'),
        'update'=>'#roles',
        'beforeSend' => 'function(){
                      $("#loadMess").addClass("srbacLoading");
                  }',
        'complete' => 'function(){
                      $("#loadMess").removeClass("srbacLoading");
                  }',
        ),
        )); ?>
      </td>
    </tr>
  </table>
  <br/>
  <?php echo CHtml::endForm(); ?>
</div>
