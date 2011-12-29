
	<? if (isset($errors)) {?>
	<ul class="error">
		<?php foreach($errors as $key => $error) {?>
			<li><?=$error?></li>
		<? } ?>
	</ul>
	<? } ?>
<div id="primary">

<form method="post" action="" >
	<table class="table_article">
		<tr>
			<td width="80">旧密码：</td><td><input type="password" name="password_old" id="old">
		<span class="clue_on">[修改新密码前请先输入旧密码用于检查]</span></td>
		</tr>
		<tr>
			<td>新密码：</td><td><input type="password" name="password_new" id="new">
		<span class="clue_on">[请输入一个新的密码，建议使用字母 + 数字]</span></td>
		</tr>
		<tr>
			<td>确认密码：</td><td><input type="password" name="password_chk" id="chk">
		<span class="clue_on">[请再输入一次密码]</span></td>
		</tr>
		<tr>
			<td></td><td><input type="submit" value="更改密码"></td>
		</tr>									
	</table>
</form>
</div>
