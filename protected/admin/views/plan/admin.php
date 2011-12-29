<h2>Managing plan</h2>

<div class="actionBar">
[<?php echo CHtml::link('plan List',array('list')); ?>]
[<?php echo CHtml::link('New plan',array('create')); ?>]
</div>

<table class="dataGrid" cellspacing="0">
  <thead>
  <tr>
    <th><?php echo $sort->link('id'); ?></th>
    <th><?php echo $sort->link('uid'); ?></th>
    <th><?php echo $sort->link('type'); ?></th>
    <th><?php echo $sort->link('startdate'); ?></th>
    <th><?php echo $sort->link('enddate'); ?></th>
    <th><?php echo $sort->link('state'); ?></th>
    <th><?php echo $sort->link('overdate'); ?></th>
    <th><?php echo $sort->link('createtime'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->user->realname); ?></td>
    <td><?php echo CHtml::encode($this->type_arr[$model->type]); ?></td>
    <td><?php echo CHtml::encode($model->startdate); ?></td>
    <td><?php echo CHtml::encode($model->enddate); ?></td>
    <td><?php echo CHtml::encode($this->state_arr[$model->state]); ?></td>
    <td><?php echo CHtml::encode($model->overdate); ?></td>
    <td><?php echo CHtml::encode($model->createtime); ?></td>
    <td>
		<?php if(strtotime($model->startdate) > time())
		{
			echo CHtml::link('修改',array('update','id'=>$model->id));
			echo CHtml::linkButton('删除',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"Are you sure to delete #{$model->id}?"));
			echo CHtml::link('修改计划',array('finish','id'=>$model->id));
		}
		?>
		<?php echo CHtml::link('查看详情',array('show','id'=>$model->id)); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>