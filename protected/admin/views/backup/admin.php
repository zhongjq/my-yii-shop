<?php include('_top.php');?>

<?php echo CHtml::beginForm(array('backup/export'),'GET'); ?>


<table class="dataGrid">
	<tr>
		<th>备份数据</th>
		<td><input type="radio" onclick="$('showtables').style.display='none'" checked="" value="web" name="type"/>全部数据</td>
	</tr>
	<tr>
		<th>备份方式</th>
		<td><input type="radio" onclick="this.form.sqlcompat[2].disabled=false; this.form.sizelimit.disabled=false; for(var i=1; i<=5; i++) {if(this.form.sqlcharset[i]) this.form.sqlcharset[i].disabled=false;}" checked="" value="multivol" name="method"/>分卷备份: 文件长度限制 <input type="text" name="sizelimit" value="100" size="5"/> kb</td>
	</tr>
	<tr>
		<th>使用扩展插入</th>
		<td><input type="radio" checked="" name="extendins" value="1"/>是 <input type="radio" checked="" name="extendins" value="0"/>否</td>		
	</tr>
	<tr>
		<th>备份文件名</th>
		<td><input type="text" name="filename" value="<?php echo $filename?>" size="40"/>.sql</td>
	</tr>
</table>

<?php echo CHtml::submitButton('备份'); ?>

<?php echo CHtml::endForm(); ?>
<br/>

<table class="dataGrid">
  <thead>
  <tr>	 	 	 	
    <th>文件名</th>

    <th>版本</th>
    <th>类型</th>
	<th>操作</th>
  </tr>
  </thead>
  <tbody>
<?php if(!empty($models)) foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
	<td>
		<?php echo CHtml::link($model['filename'],'backup/'.$model['filename']);?>
	<?php echo '('.$model['filesize'].')<br/>'.$model['dateline'] ?></td>
	<td><?php echo $model['version'] ?></td>
	<td><?php echo $model['type'] ?></td>
    <td>
		[<?php echo CHtml::link('导入',array('import','filename'=>$model['filename']));?>]
		[<?php echo CHtml::linkButton('删除',array(
		  'submit'=>'',
		  'params'=>array('command'=>'delete','filename'=>$model['filename']),
		  'confirm'=>"确定删除 #{$model['filename']}?")); ?>]
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
