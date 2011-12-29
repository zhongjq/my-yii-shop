<?php
/**
 * show.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The auth items information view. Also this view is used for deleting
 * confirmation.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.manage
 * @since 1.0.0
 */
 ?>
<?php if($deleted) :?>
<script language="javascript">
  <?php echo CHtml::ajax(array(
  'type'=>'POST',
  'url'=>array('manage'),
  'update'=>'#list',
  )); ?>
</script>
<?php else : ?>
<h2><?php echo $model->name; ?></h2>

<table class="srbacDataGrid">
  <tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('type')); ?></th>
    <td><?php echo CHtml::encode(AuthItem::$TYPES[$model->type]); ?></td>
  </tr>
  <tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('description')); ?></th>
    <td><?php echo CHtml::encode($model->description); ?></td>
  </tr>
  <tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('bizrule')); ?></th>
    <td><?php echo CHtml::encode($model->bizrule); ?></td>
  </tr>
  <tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('data')); ?></th>
    <td><?php echo CHtml::encode($model->data); ?></td>
  </tr>
</table>
<div class="simple">
    <?php if($delete) :?>
    <?php echo Helper::translate('srbac','Really delete')?> <?php echo $model->name; ?> ?
      <?php echo CHtml::ajaxButton(Helper::translate('srbac','Yes'),
      array('delete','id'=>$model->name),
      array(
      'type'=>'POST',
      'update'=>'#preview'
      ), array('id'=>'deleteButton')) ?>
    <?php endif ?>
</div>
<?php endif ?>