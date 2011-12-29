<?php include('_top.php');?>

<table class="dataGrid">
  <thead>
  <tr>
	<th><?php echo $sort->link('title'); ?></th>
	<th><?php echo $sort->link('number'); ?></th>
	<th><?php echo $sort->link('start_date'); ?></th>
	<th><?php echo $sort->link('end_date'); ?></th>
	<th><?php echo $sort->link('sex'); ?></th>
	<th><?php echo $sort->link('education'); ?></th>
	<th><?php echo $sort->link('place'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
	<td><?php echo CHtml::link($model->title,array('show','id'=>$model->id)); ?></td>
	<td><?php echo CHtml::encode($model->number); ?></td>
	<td><?php echo CHtml::encode($model->start_date); ?></td>
	<td><?php echo CHtml::encode($model->end_date); ?></td>
	<td><?php echo CHtml::encode($model->sex); ?></td>
	<td><?php echo CHtml::encode($model->education); ?></td>
	<td><?php echo CHtml::encode($model->place); ?></td>
	<td>
	  <?php echo CHtml::link('修改',array('update','id'=>$model->id)); ?>
	  <?php echo CHtml::linkButton('删除',array(
	  	  'submit'=>'',
	  	  'params'=>array('command'=>'delete','id'=>$model->id),
	  	  'confirm'=>"确定删除 #{$model->id}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
