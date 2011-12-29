<h2>站点设置</h2>
<style>
	.long_input {
		width:400px;
	}
</style>
<?php echo CHtml::beginForm(); ?>

	<div id="usual1" class="usual">
		<ul>
			<li><a class="selected" href="#tab1">网站设置</a></li>
			<li><a href="#tab2">其他设置</a></li>
		</ul>
		<div id="tab1">
			<table class="dataGrid" cellspacing="0">
				<tr>
					<th width="100">网站名称：</th><td><input type="text" name="sitename" id="sitename" class="long_input" value="<?php echo $rs['sitename']?>">
				<span class="clue_on">[填写站点的名称]</span> </td>
				</tr>
				<tr>
					<th>SEO-关键字：</th><td><input type="text" name="keywords" id="keywords" class="long_input" value="<?php echo $rs['keywords']?>">
				<span class="clue_on">[多个关键字用英文逗号隔开]</span> </td>
				</tr>
				<tr>
					<td>SEO-网站描述：</td><td><input type="text" name="description" id="description" class="long_input" value="<?php echo $rs['description']?>">
				<span class="clue_on">[简单描述一下站点的信息]</span> </td>
				</tr>
				<tr>
					<td>网站版权信息：</td><td>
					<textarea type="text" name="copyright" value="1" class="long_input" ><?php echo $rs['copyright']?></textarea>
				<span class="clue_on">[© 2009 - 2009 domail.com All rights reserved.]</span> </td>
				</tr>
				<tr><td>&nbsp</td><td></td></tr>
				<tr>
					<td>网站状态</td>
					<td>
					开启<input type="radio" name="webstate" value="1" <?php if($rs['webstate']) echo "checked"?>>  &nbsp;
							关闭<input type="radio" name="webstate" value="0" <?php if(!$rs['webstate']) echo "checked"?>>
					</td>
				</tr>
				<tr>
					<td>关闭原因</td>
					<td>
					<textarea type="text" name="closereason" value="1" class="long_input" ><?php echo $rs['closereason']?></textarea>
					<span class="clue_on">[如:网站维护!升级]</span>
					</td>
				</tr>
				<tr>
					<td></td><td> </td>
				</tr>
			</table>
		</div>
		<div id="tab2">

			<table class="dataGrid" cellspacing="0">
				<tr>
					<th width="100">顶部地址：</th><td><input type="text" name="address" id="address" class="long_input" value="<?php echo $rs['address']?>">
				<span class="clue_on"></span> </td>
				</tr>
				<tr>
					<th>顶部电话：</th><td><input type="text" name="phone" id="phone" class="long_input" value="<?php echo $rs['phone']?>">
				<span class="clue_on"></span> </td>
				</tr>
				<tr>
					<td>电子邮箱：</td><td><input type="text" name="email" id="email" class="long_input" value="<?php echo $rs['email']?>">
				<span class="clue_on"></span> </td>
				</tr>
				<tr>
					<td>底部地址信息：</td><td>
					<textarea type="text" name="footer_address" value="1" class="long_input" ><?php echo $rs['footer_address']?></textarea>
				<span class="clue_on"></span> </td>
				</tr>
				<tr>
					<td></td><td> </td>
				</tr>
			</table>
		</div>
	</div>
	<input type="submit" value="设 置" class="mybutton_01" id="button1"/>


<?php echo CHtml::endForm(); ?>



<?php echo CHtml::endForm(); ?>
    <script type="text/javascript">
    $(function() {
        $("#usual1 ul").idTabs();
    });
    </script>
