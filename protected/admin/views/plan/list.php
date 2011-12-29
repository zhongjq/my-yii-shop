<h2>plan List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New plan',array('create')); ?>]
[<?php echo CHtml::link('Manage plan',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<label><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</label>
<?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('uid')); ?>:</label>
<?php echo CHtml::encode($model->user->realname); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>:</label>
<?php echo CHtml::encode($this->type_arr[$model->type]); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('startdate')); ?>:</label>
<?php echo CHtml::encode($model->startdate); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('enddate')); ?>:</label>
<?php echo CHtml::encode($model->enddate); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>:</label>
<?php echo CHtml::encode($this->state_arr[$model->state]); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('overdate')); ?>:</label>
<?php echo CHtml::encode($model->overdate); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('plan')); ?>:</label>
<?php echo $model->plan; ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('memo')); ?>:</label>
<?php echo CHtml::encode($model->memo); ?>
<br/>
<label><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>:</label>
<?php echo CHtml::encode($model->createtime); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>