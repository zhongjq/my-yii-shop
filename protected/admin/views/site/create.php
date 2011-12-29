<div id="primary">
	<? if (isset($errors)) {?>
	<ul class="error">
		<?php foreach($errors as $key => $error) {?>
			<li><?=$error?></li>
		<? } ?>
	</ul>
	<? } ?>
	<form method="post" action="" >
		<table class="table_article">
			<tr>
				<td width="80">username</td><td><input type="text" value="<?=$this->input->post('username')?>" maxlength="20" name="username"/></td>
			</tr>
			<tr>
				<td>password</td><td><input type="text" value="<?=$this->input->post('password')?>" maxlength="18" name="password"/></td>
			</tr>
			<tr>
				<td>email：</td><td><input type="text" value="<?=$this->input->post('email')?>" maxlength="50" name="email"/></td>
			</tr>
			<tr>
				<td></td><td><input type="submit" class="long_btn" value="Create New User"/></td>
			</tr>									
		</table>
	</form>
</div>
