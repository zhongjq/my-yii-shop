<div id="primary">

<form name="qgform" id="qgform" method="post">
<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">网站名称：<span style="color:red;">*</span></div>
	<div class="right">
		<input type="text" name="sitename" id="sitename" class="long_input" value="<?=$rs[sitename]?>">
		<span class="clue_on">[填写站点的名称]</span>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">SEO-关键字：</div>
	<div class="right">
		<input type="text" name="keywords" id="keywords" class="long_input" value="<?=$rs[keywords]?>">
		<span class="clue_on">[多个关键字用英文逗号隔开]</span>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">SEO-网站描述：</div>
	<div class="right">
		<input type="text" name="description" id="description" class="long_input" value="<?=$rs[description]?>">
		<span class="clue_on">[简单描述一下站点的信息]</span>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">SEO-标题附加字：</div>
	<div class="right">
		<input type="text" name="seotitle" id="seotitle" class="long_input" value="<?=$rs[seotitle]?>">
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">缓存时间：</div>
	<div class="right">
		<input type="text" name="mintime" id="mintime" class="short_input" value="<?=$rs[mintime]?>">
		－
		<input type="text" name="maxtime" id="maxtime" class="short_input" value="<?=$rs[maxtime]?>">
		<span class="clue_on">[填写缓存时间的范围，左边是最小值，右边是最大值，不缓存请都设为0，单位是秒]</span>
	</div>
	<div style="clear:both;"></div>
</div>
<div class="table">
	<div class="left">&nbsp;</div>
	<div class="right clue_on">1小时等于3600秒，IP流量小于3000时建议不要使用缓存，启用缓存时建议最小缓存时间不要小于3600秒</div>
	<div style="clear:both;"></div>
</div>
<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">时间较正：</div>
	<div class="right">
		<input type="text" name="timerevise" id="timerevise" class="short_input" value="<?=$rs[timerevise]?>">
		<span class="clue_on">[如果服务器时间与客户端时间不一致，请添加误差，支持负值，单位是分钟]</span>
	</div>
	<div style="clear:both;"></div>
</div>
<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">时区：</div>
	<div class="right">
		<input type="text" name="timezone" id="timezone" class="short_input" value="<?=$rs[timezone]?>">
		<span class="clue_on">[填写时区，北京使用 +8 区，支持负值]</span>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">格式化时间：</div>
	<div class="right">
		<select name="timeformat" id="timeformat">
		<option value="Y-m-d"<? if($rs[timeformat] == "Y-m-d") echo "selected"; ?> ><?=date("Y-m-d")?></option>
		<option value="Y-m-d H:i"<? if($rs[timeformat] == "Y-m-d H:i") echo "selected"; ?> ><?=date("Y-m-d H:i")?></option>
		<option value="Y-m-d H:i:s"<? if($rs[timeformat] == "Y-m-d H:i:s") echo "selected"; ?> ><?=date("Y-m-d H:i:s")?></option>
		</select>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
	<div class="left">留言标题长度：</div>
	<div class="right">
		<input type="text" name="booklength" id="booklength" class="short_input" value="<?=$rs[booklength]?>">
		<span class="clue_on">[用于显示列表防止过长撑开现象，仅限于留言列表中有效]</span>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="table">
	<div class="left">&nbsp;</div>
	<div class="right"><input type="submit" id="qgbutton" class="mybutton_01" value="设 置"></div>
	<div style="clear:both;"></div>
</div>
</form>
</div>

