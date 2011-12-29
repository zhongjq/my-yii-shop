<?php include('_top.php');?>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('id'); ?></th>
	<?php if(empty($_GET['id'])){ ?>
    <th><?php echo $sort->link('cate_id'); ?></th>
	<?php }?>
    <th><?php echo $sort->link('title'); ?></th>
    <th><?php echo $sort->link('icon'); ?></th>
    <th><?php echo $sort->link('sort'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
	<?php if(empty($_GET['id'])){ ?>
    <td><?php echo CHtml::encode($model->cate->name); ?></td>
	<?php }?>
    <td><?php echo CHtml::link($model->title,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->icon); ?></td>
    <td><?php echo CHtml::encode($model->sort); ?></td>
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