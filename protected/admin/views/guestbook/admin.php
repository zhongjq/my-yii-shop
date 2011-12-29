<?php include('_top.php');?>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('id'); ?></th>
    
    <th><?php echo $sort->link('title'); ?></th>
    <th><?php echo $sort->link('content'); ?></th>

    <th><?php echo $sort->link('hidden'); ?></th>
    <th><?php echo $sort->link('passed'); ?></th>

    <th><?php echo $sort->link('create_time'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    
	<td class="author column-author">

		
		<?php echo CHtml::link($model->username,$model->homepage)?><br/>
		<?php echo CHtml::link($model->homepage,$model->homepage)?><br/>
		<?php echo CHtml::mailto($model->email,$model->email)?><br/>
		<?php echo CHtml::encode($model->ip)?><br/>
	</td>

    <td><?php echo CHtml::encode($model->content); ?><br/>
    
    	<?php if(!empty($model->reply)) echo CHtml::encode($model->reply,$model->reply_time); ?>
    </td>

    <td><?php echo CHtml::encode($model->hidden); ?></td>
    <td><?php echo CHtml::encode($model->passed); ?></td>

    <td><?php echo CHtml::encode($model->create_time); ?></td>
    <td>
      <?php echo CHtml::link('修改',array('update','id'=>$model->id)); ?>
      <?php echo CHtml::linkButton('删除',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"确认删除 #{$model->id}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
