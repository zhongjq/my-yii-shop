<?php include('_top.php');?>
<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('id'); ?></th>
    <th><?php echo $sort->link('cate_id'); ?></th>
    <th><?php echo $sort->link('title'); ?></th>
    <th><?php echo $sort->link('datetime'); ?></th>
    <th><?php echo $sort->link('top'); ?></th>
    <th><?php echo $sort->link('digest'); ?></th>
    <th><?php echo $sort->link('state'); ?></th>
    <th><?php echo $sort->link('sort'); ?></th>
    <th><?php echo $sort->link('view'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->cate->name); ?></td>
	<td><?php echo CHtml::link($model->title,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->datetime); ?></td>
    <td><?php echo CHtml::linkButton($model->top,array('params'=>array('command'=>'changeState','id'=>$model->id,'type'=>'top'))); ?></td>
	<td><?php echo CHtml::linkButton($model->digest,array('params'=>array('command'=>'changeState','id'=>$model->id,'type'=>'digest'),)); ?></td>
	<td><?php echo CHtml::linkButton($model->state,array('params'=>array('command'=>'changeState','id'=>$model->id,'type'=>'state'),)); ?></td>

    <td><?php echo CHtml::encode($model->sort); ?></td>
    <td><?php echo CHtml::encode($model->view); ?></td>
    <td>
      <?php echo CHtml::link('修改',array('update','id'=>$model->id)); ?>
      <?php echo CHtml::linkButton('删除',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"确认删除? #{$model->id}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
