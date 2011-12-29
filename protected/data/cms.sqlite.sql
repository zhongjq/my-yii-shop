/******************/
/*                */
/* cms.sqlite.sql */
/*                */
/******************/

/* Table structure [ad] */
CREATE TABLE [ad] (
  [id] integer NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [cate_id] tinyint(1) NOT NULL, 
  [url] varchar(255) NOT NULL, 
  [title] varchar(255) NOT NULL, 
  [sort] tinyint(1) NOT NULL DEFAULT 0, 
  [icon] varchar(255) NOT NULL);

/* Data [ad] */
insert into [ad] values(1, 5, 'http://test.com', 'aaa', 0, '/uploads/images/img.jpg');
insert into [ad] values(2, 5, 'http://localhost/uploads/images/img.jpg', 'fasd', 0, '/uploads/images/img.jpg');
insert into [ad] values(3, 5, 'http://localhost/uploads/images/img.jpg', 'fasfasfasfas2312', 0, '/uploads/images/img.jpg');


/* Table structure [AuthAssignment] */
CREATE TABLE [AuthAssignment] (
  [itemname] varchar(64) NOT NULL, 
  [userid] varchar(64) NOT NULL, 
  [bizrule] text, 
  [data] text, 
  CONSTRAINT [sqlite_autoindex_AuthAssignment_1] PRIMARY KEY ([itemname], [userid]));

/* Data [AuthAssignment] */
insert into [AuthAssignment] values('系统管理员 ', '2', null, '');
insert into [AuthAssignment] values('一般管理员 ', '11', null, '');
insert into [AuthAssignment] values('Authority', '2', null, '');


/* Table structure [AuthItem] */
CREATE TABLE [AuthItem] (
  [name] varchar(64) NOT NULL, 
  [type] integer NOT NULL, 
  [description] text, 
  [bizrule] text, 
  [data] text, 
  CONSTRAINT [sqlite_autoindex_AuthItem_1] PRIMARY KEY ([name]));

/* Data [AuthItem] */
insert into [AuthItem] values('Authority', 2, null, null, null);
insert into [AuthItem] values('Administrator', 2, null, null, null);
insert into [AuthItem] values('用户', 2, null, null, null);
insert into [AuthItem] values('一般管理员 ', 2, '一般管理员,录入资料.', null, null);
insert into [AuthItem] values('Delete Post', 0, null, null, null);
insert into [AuthItem] values('Create Post', 0, null, null, null);
insert into [AuthItem] values('Edit Post', 0, null, null, null);
insert into [AuthItem] values('View Post', 0, null, null, null);
insert into [AuthItem] values('Delete User', 0, null, null, null);
insert into [AuthItem] values('Create User', 0, null, null, null);
insert into [AuthItem] values('Edit User', 0, null, null, null);
insert into [AuthItem] values('View User', 0, null, null, null);
insert into [AuthItem] values('信息中心管理', 1, null, null, null);
insert into [AuthItem] values('ContentShow', 0, null, null, null);
insert into [AuthItem] values('ContentCreate', 0, null, null, null);
insert into [AuthItem] values('ContentUpdate', 0, null, null, null);
insert into [AuthItem] values('ContentDelete', 0, null, null, null);
insert into [AuthItem] values('ContentList', 0, null, null, null);
insert into [AuthItem] values('ContentAdmin', 0, null, null, null);
insert into [AuthItem] values('新闻管理', 1, null, null, null);
insert into [AuthItem] values('NoticeShow', 0, null, null, null);
insert into [AuthItem] values('NoticeCreate', 0, null, null, null);
insert into [AuthItem] values('NoticeUpdate', 0, null, null, null);
insert into [AuthItem] values('NoticeDelete', 0, null, null, null);
insert into [AuthItem] values('NoticeList', 0, null, null, null);
insert into [AuthItem] values('NoticeAdmin', 0, null, null, null);
insert into [AuthItem] values('工作计划管理', 1, null, null, null);
insert into [AuthItem] values('PlanShow', 0, null, null, null);
insert into [AuthItem] values('PlanCreate', 0, null, null, null);
insert into [AuthItem] values('PlanUpdate', 0, null, null, null);
insert into [AuthItem] values('PlanFinish', 0, null, null, null);
insert into [AuthItem] values('PlanDelete', 0, null, null, null);
insert into [AuthItem] values('PlanList', 0, null, null, null);
insert into [AuthItem] values('PlanAdmin', 0, null, null, null);
insert into [AuthItem] values('产品管理', 1, null, null, null);
insert into [AuthItem] values('ProductShow', 0, null, null, null);
insert into [AuthItem] values('ProductCreate', 0, null, null, null);
insert into [AuthItem] values('ProductUpdate', 0, null, null, null);
insert into [AuthItem] values('ProductDelete', 0, null, null, null);
insert into [AuthItem] values('ProductList', 0, null, null, null);
insert into [AuthItem] values('ProductCate', 0, null, null, null);
insert into [AuthItem] values('ProductAdmin', 0, null, null, null);
insert into [AuthItem] values('分类管理', 1, null, null, null);
insert into [AuthItem] values('TreeIndex', 0, null, null, null);
insert into [AuthItem] values('TreeProduct', 0, null, null, null);
insert into [AuthItem] values('TreeCreate', 0, null, null, null);
insert into [AuthItem] values('TreeUpdate', 0, null, null, null);
insert into [AuthItem] values('用户管理', 1, null, null, null);
insert into [AuthItem] values('UserShow', 0, null, null, null);
insert into [AuthItem] values('UserCreate', 0, null, null, null);
insert into [AuthItem] values('UserUpdate', 0, null, null, null);
insert into [AuthItem] values('UserDelete', 0, null, null, null);
insert into [AuthItem] values('UserList', 0, null, null, null);
insert into [AuthItem] values('UserAdmin', 0, null, null, null);
insert into [AuthItem] values('网站设置', 1, null, null, null);
insert into [AuthItem] values('用户管理员 ', 2, '管理用户', null, null);
insert into [AuthItem] values('WebsiteIndex', 0, null, null, null);
insert into [AuthItem] values('WebsiteShow', 0, null, null, null);
insert into [AuthItem] values('WebsiteCreate', 0, null, null, null);
insert into [AuthItem] values('WebsiteUpdate', 0, null, null, null);
insert into [AuthItem] values('WebsiteDelete', 0, null, null, null);
insert into [AuthItem] values('WebsiteList', 0, null, null, null);
insert into [AuthItem] values('WebsiteAdmin', 0, null, null, null);
insert into [AuthItem] values('系统管理员 ', 2, '拥有任命管理员的权限', null, null);
insert into [AuthItem] values('广告管理', 1, null, null, null);
insert into [AuthItem] values('AdShow', 0, null, null, null);
insert into [AuthItem] values('AdCreate', 0, null, null, null);
insert into [AuthItem] values('AdUpdate', 0, null, null, null);
insert into [AuthItem] values('AdDelete', 0, null, null, null);
insert into [AuthItem] values('AdList', 0, null, null, null);
insert into [AuthItem] values('AdAdmin', 0, null, null, null);
insert into [AuthItem] values('TreeNotice', 0, null, null, null);


/* Table structure [AuthItemChild] */
CREATE TABLE [AuthItemChild] (
  [parent] varchar(64) NOT NULL, 
  [child] varchar(64) NOT NULL, 
  CONSTRAINT [sqlite_autoindex_AuthItemChild_1] PRIMARY KEY ([parent], [child]));

/* Data [AuthItemChild] */
insert into [AuthItemChild] values('一般管理员', '产品管理');
insert into [AuthItemChild] values('一般管理员', '信息中心管理');
insert into [AuthItemChild] values('一般管理员', '分类管理');
insert into [AuthItemChild] values('一般管理员', '工作计划管理');
insert into [AuthItemChild] values('一般管理员', '广告管理');
insert into [AuthItemChild] values('一般管理员', '新闻管理');
insert into [AuthItemChild] values('一般管理员', '网站设置');
insert into [AuthItemChild] values('产品管理', 'ProductAdmin');
insert into [AuthItemChild] values('产品管理', 'ProductCate');
insert into [AuthItemChild] values('产品管理', 'ProductCreate');
insert into [AuthItemChild] values('产品管理', 'ProductDelete');
insert into [AuthItemChild] values('产品管理', 'ProductList');
insert into [AuthItemChild] values('产品管理', 'ProductShow');
insert into [AuthItemChild] values('产品管理', 'ProductUpdate');
insert into [AuthItemChild] values('信息中心管理', 'ContentAdmin');
insert into [AuthItemChild] values('信息中心管理', 'ContentCreate');
insert into [AuthItemChild] values('信息中心管理', 'ContentDelete');
insert into [AuthItemChild] values('信息中心管理', 'ContentList');
insert into [AuthItemChild] values('信息中心管理', 'ContentShow');
insert into [AuthItemChild] values('信息中心管理', 'ContentUpdate');
insert into [AuthItemChild] values('分类管理', 'TreeCreate');
insert into [AuthItemChild] values('分类管理', 'TreeIndex');
insert into [AuthItemChild] values('分类管理', 'TreeNotice');
insert into [AuthItemChild] values('分类管理', 'TreeProduct');
insert into [AuthItemChild] values('分类管理', 'TreeUpdate');
insert into [AuthItemChild] values('工作计划管理', 'PlanAdmin');
insert into [AuthItemChild] values('工作计划管理', 'PlanCreate');
insert into [AuthItemChild] values('工作计划管理', 'PlanDelete');
insert into [AuthItemChild] values('工作计划管理', 'PlanFinish');
insert into [AuthItemChild] values('工作计划管理', 'PlanList');
insert into [AuthItemChild] values('工作计划管理', 'PlanShow');
insert into [AuthItemChild] values('工作计划管理', 'PlanUpdate');
insert into [AuthItemChild] values('广告管理', 'AdAdmin');
insert into [AuthItemChild] values('广告管理', 'AdCreate');
insert into [AuthItemChild] values('广告管理', 'AdDelete');
insert into [AuthItemChild] values('广告管理', 'AdList');
insert into [AuthItemChild] values('广告管理', 'AdShow');
insert into [AuthItemChild] values('广告管理', 'AdUpdate');
insert into [AuthItemChild] values('新闻管理', 'NoticeAdmin');
insert into [AuthItemChild] values('新闻管理', 'NoticeCreate');
insert into [AuthItemChild] values('新闻管理', 'NoticeDelete');
insert into [AuthItemChild] values('新闻管理', 'NoticeList');
insert into [AuthItemChild] values('新闻管理', 'NoticeShow');
insert into [AuthItemChild] values('新闻管理', 'NoticeUpdate');
insert into [AuthItemChild] values('用户管理', 'UserAdmin');
insert into [AuthItemChild] values('用户管理', 'UserCreate');
insert into [AuthItemChild] values('用户管理', 'UserDelete');
insert into [AuthItemChild] values('用户管理', 'UserList');
insert into [AuthItemChild] values('用户管理', 'UserShow');
insert into [AuthItemChild] values('用户管理', 'UserUpdate');
insert into [AuthItemChild] values('用户管理员', '用户管理');
insert into [AuthItemChild] values('系统管理员', '一般管理员');
insert into [AuthItemChild] values('系统管理员 ', '产品管理');
insert into [AuthItemChild] values('系统管理员 ', '信息中心管理');
insert into [AuthItemChild] values('系统管理员 ', '分类管理');
insert into [AuthItemChild] values('系统管理员 ', '工作计划管理');
insert into [AuthItemChild] values('系统管理员 ', '广告管理');
insert into [AuthItemChild] values('系统管理员 ', '新闻管理');
insert into [AuthItemChild] values('系统管理员 ', '用户管理');
insert into [AuthItemChild] values('系统管理员', '用户管理员');
insert into [AuthItemChild] values('系统管理员 ', '网站设置');
insert into [AuthItemChild] values('网站设置', 'WebsiteAdmin');
insert into [AuthItemChild] values('网站设置', 'WebsiteCreate');
insert into [AuthItemChild] values('网站设置', 'WebsiteDelete');
insert into [AuthItemChild] values('网站设置', 'WebsiteIndex');
insert into [AuthItemChild] values('网站设置', 'WebsiteList');
insert into [AuthItemChild] values('网站设置', 'WebsiteShow');
insert into [AuthItemChild] values('网站设置', 'WebsiteUpdate');


/* Table structure [content] */
CREATE TABLE [content] (
  [id] integer NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [cate_id] integer NOT NULL, 
  [icon] varchar(255), 
  [title] varchar(255), 
  [content] text NOT NULL, 
  [sort] tinyint(1) NOT NULL DEFAULT 0);

/* Data [content] */
insert into [content] values(1, 11, 'Profile', 'Company Profile', '<p> <font style="font-family: Arial;">Established in 2005,&nbsp;Ningbo Siming&nbsp;Imp. &amp; Exp.&nbsp;Co., Ltd ., is a professional modern company integrating design, manufacture and sale together, located in Ningbo, China. Our product range amounts more than 1000 Items in various categories for buyer&#39;s selection. Our product range mainly covers:&nbsp;outdoor rattan furniture,&nbsp;gazebo,&nbsp;solar LED lamps,&nbsp;etc. <br style="" /> <br style="" /> We have more than ten VIP material suppliers that guarantee us favorable terms of supplies due to our high output providing us in the same time with major competitive advantage - low price for high quality of our products.<br style="" /> <br style="" /> After&nbsp;5 years experience in global trade , our major clients are in Europe (40%), Southeast Asia and Africa (40%), South America and North America (20%).Our average production output is 60 containers.<br style="" /> <br style="" /> Our strong Quality Control department guarantees high quality by applying AQL standards for inspection of each bulk of goods. Each month our R&amp;D team is able to launch one new item.<br style="" /> <br style="" /> We are specialized in OEM and ODM service for our customers. And always meet customers&#39; various &amp; special requirements with original design, consummate quality, reasonable price, competitive after-sales service &ampon-time delivery time.<br style="" /> <br style="" /> We are sincerely expected to be one of your perfect long-term business partner !<br style="" /> If you have any further inquiries, please contact us at your earliest convenience.</font></p> ', 0);
insert into [content] values(2, 12, 'contact', 'contat us', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td height="50"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody> <tr> <td class="T2" colspan="2" height="22"> Ningbo Siming Imp. &amp; Exp. Co.,Ltd.</td> </tr> <tr> <td width="14%"> &nbsp;</td> <td width="86%"> &nbsp;</td> </tr> <tr> <td height="20"> Address:</td> <td height="18"> R1501-1503 A1 Building, 203# Lantian Road, Ningbo, Zhejiang, China</td> </tr> <tr> <td height="20"> Phone:</td> <td height="18"> 0086-574-87103682</td> </tr> <tr> <td height="20"> Fax:</td> <td height="18"> 0086-574-88020867</td> </tr> <tr> <td height="20"> Contact:</td> <td height="18"> Jack Xu</td> </tr> <tr> <td height="20"> E-mail:</td> <td height="18"> <a class="email" href="mailto:sales@siming-craft.com?subject=Inquiry%20online%28www.siming-craft.com%29&amp;cc=jack@siming-craft.com">sales@siming-craft.com</a></td> </tr> <tr> <td height="20"> &nbsp;</td> <td> <a class="email" href="mailto:jack@siming-craft.com?subject=Inquiry%20online%28www.siming-craft.com%29&amp;cc=sales@siming-craft.com">jack@siming-craft.com</a></td> </tr> <tr> <td height="20"> Website:</td> <td height="18"> <a class="email" href="http://www.siming-craft.com" target="_blank">http://www.siming-craft.com</a></td> </tr> <tr> <td height="20"> Skype:</td> <td height="18"> jack_siming</td> </tr> </tbody> </table> </td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="30"> &nbsp;</td> </tr> </tbody> </table>', 0);
insert into [content] values(3, 13, 'service', 'service', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="main_title2" height="32"> Service &amp; Support</td> </tr> <tr> <td height="4"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 1. Patone Color &amp; Logo printting</td> </tr> <tr> <td> <span class="content_main">The only tool recognized by international standards that recognized the product colors accurately . We shall use it to match the color of your logo and artwork to be placed on the unit or packing box at no additional costs.</span></td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 2. Technical (Rohs)</td> </tr> <tr> <td> <span class="content_main"><img border="0" src="http://www.siming-craft.com/admin/pic_display.asp?code=miscell&amp;keyno=484" /> To follow the new standard RoHS &amp; WEEE in Europe, we have invested on the newest RoHS test machine to make sure of our goods quality. Each production we&#39;ll test by ourselves with a detailed inspection report, to ensure the goods are qualified with the international standard. <br /> <br /> ROHS: Means Reduction of Hazardous Substance in electrical and electronic equipment. Good News: To safe guard buyers interest and ship goods on time. We have purchased the Testing Equipment.We use raw material suppliers &amp; Vendors who comply with RoHS Standards. All raw material is tested before the planned production schedule. Second Test is made when goods are on production line. The Third and final Test is made once goods are being packed for exports.<br /> <br /> FYI: It takes only 2 minutes or less to make these tests. The unit is connected to the computer and the computer analysis and decides to pass or fail one of the 6 components. Same test to be performed with SGS takes about 2 weeks and very expensive. Attached is picture of this machinery and Report.<br /> <br /> WEEE: Waste Electrical and Electronic Equipment&quot;under the Eurpoean Parliament it guranteess our products as Environmental Friendly and recycled energy for its components giving our Clients the best advantage and being one step ahead of the other competitors for imports and a speedy process in Customs &amp; Duty Clearance in their countries.<br /> <br /> Dozens of languages were spoken at the Global Medical Devices Conference in Portugal, But it was a Latin phrase that got the attention of the attendees. &quot;Perhaps the famous CE mark should mean caveat emptor CE mark translation should be? buyer beware&quot;it was the European Union&#39;s safety standards but not it has been recognised world wide maybe more than 160 countries and more.</span></td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 3. Samples are offered within 10 days and dispatched by express couriers, air or post as per customer&#39;s requirement. Delivery fees are on the account of the client</td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 4. Logo on the unit and package is acceptable.</td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table>', 0);
insert into [content] values(4, 11, 'payment', 'Payment Details', '<p> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=481"><font color="#333333">Payment Details</font></a></p> ', 0);
insert into [content] values(5, 11, 'OEM', 'OEM & ODM', '<p> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=437"><font color="#333333">OEM &amp; ODM</font></a> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=437"><font color="#333333">OEM &amp; ODM</font></a></p> ', 0);
insert into [content] values(6, 14, 'homepage', 'homepage', '<p> 这段话首页会显示</p> <p> Welcome to Siming-Craft.com <strong>Ningbo Siming Imp. &amp; Exp. Co., Ltd.</strong> is a professional modern company integrating design, manufacture and sale together. Our company mainly produces and sells high quality outdoor furniture, gazebos and solar LED lamps.Our products bring taste, fashion, freedom and leisure to your rooms, gardens, villas, entertainment areas. <br /> <br /> Our products sell well in Europe, North America, the Middle East and Australia. We will sincerely serve our customers all the time. In order to meet our customers&#39; varied requirements, we will continuously improve the ability of research and development, strictly control the quality and cordially provide comfortable and eco-friendly environment.</p> ', 0);


/* Table structure [notice] */
CREATE TABLE [notice] (
  [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [title] VARCHAR(255) NOT NULL, 
  [content] TEXT NOT NULL, 
  [cate_id] INTEGER NOT NULL, 
  [datetime] DATE, 
  [top] TINYINT(1) NOT NULL DEFAULT 0, 
  [digest] TINYINT(1) NOT NULL DEFAULT 0, 
  [state] TINYINT(1) NOT NULL DEFAULT 1, 
  [sort] TINYINT(1) NOT NULL DEFAULT 0, 
  [view] INTEGER NOT NULL DEFAULT 1);

/* Data [notice] */
insert into [notice] values(3, '购买HostMonster遇阻', '<p>
	面对购买美国主机，特别是<a href="http://www.beishan.info/hostmonster/20090112/hostmonster-featured-foreign-trade-website.html" title="为什么推荐HostMonster主机做外贸网站空间？">HostMonster主机</a>，北山没有想到过的情况，今天却在自己最熟悉的HostMonster上遇到了。</p>
<p>
	本来今天下班挺早，也有时间有计划的购买个HostMonster主机，HostMonster在<a href="http://www.beishan.info" title="北山虚拟主机评论">北山虚拟主机评论</a>的首页排在第一，但是一直没有弄个合适的演示网站，让访问者参考参考。可是当我打算用自己已有的域名<a href="http://www.review-hostmonster.com" title="HostMonster Reviews"><span id="general_error">review-hostmonster.com</span></a>购买HostMonster主机时，没有预想到的情况出现了，用图片说话。</p>
<p style="text-align: center;">
	<img alt="购买HostMonster遇阻" class="alignnone size-full wp-image-1779" height="210" src="http://www.beishan.info/wp-content/uploads/2009/10/failed-to-purchase-hostmonster-hosting.gif" title="购买HostMonster遇阻" width="500" /></p>
<p>
	域名review-hostmonster.com是购买<a href="http://www.beishan.info/ixwebhosting/20090519/ixwebhosting-coupon.html" title="IXWebHosting Coupon/优惠码/优惠券 -- 优惠20%">IXWebHosting</a>主机时，使用IXWebHosting提供的两个免费域名中的一个。因为时间关系这个域名基本上是闲置着的。万万没有想到，这个域名竟然被人绑定到HostMonster主机上了，让人想不通，搞得我有点莫名奇妙。</p>
<p>
	马上点击HostMonster的Live Chat找他们的客服，一开始以为这是销售方面的事情，就找sales，NND~~sales直接告诉我得找support，晕~~还以为是在踢皮球了。 不管了，找support就找support，support问了一堆问题也说了很多，摘几句：</p>
<p style="padding-left: 30px;">
	&ldquo;so you purchased the domain but its associated with another account&hellip; I see.&rdquo;<br />
	&ldquo;Are you associated with the owner of the hostmonster account at all?&rdquo;<br />
	&ldquo;Was he your webmaster for a while or anything like that?&rdquo;</p>
<p>
	显然那个帐号跟我北山没什么关系，直接回答说&rdquo;NO&rdquo;。最后support告诉北山:</p>
<p>
	&ldquo;You would need to make a support request to our legal team to get that domain released. If you send an email to legal@hostmonster.com They can help you get this straightened out.&rdquo;</p>
<p>
	路漫漫啊，还得跟legal team联系，看来购买HostMonster又要拖一拖了，但愿不要太久。</p>
<p>
	欲了解HostMonster美国主机详细信息，现在就访问一下HostMonster官方网</p>
', 7, '2009-10-24', 0, 0, 0, 0, 0);


/* Table structure [plan] */
CREATE TABLE [plan] (
  [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [uid] INTEGER NOT NULL, 
  [type] TINYINT(1) NOT NULL, 
  [startdate] DATE NOT NULL, 
  [enddate] DATE NOT NULL, 
  [state] TINYINT(1), 
  [overdate] DATETIME, 
  [plan] TEXT, 
  [memo] TEXT, 
  [createtime] DATETIME NOT NULL);

/* Data [plan] */
insert into [plan] values(2, 1, 1, '2009-10-01', '2009-10-16', 1, '2009-10-10 09:44:11.000', '222', '发大水发生11', '2009-10-10 09:26:19.000');
insert into [plan] values(3, 2, 2, '2009-10-14', '2009-10-23', 1, '2009-10-10 11:10:03.000', '13213', 'fdasfdsa', '2009-10-10 11:05:02.000');
insert into [plan] values(4, 2, 1, '2009-10-09', '2009-10-10', 0, null, '<p>rn 完成 plan 工作计划!</p>rn<ol>rn <li>rn 各人能创建自己的工作计划. </li>rn <li>rn 只能编辑自己的工作计划.</li>rn <li>rn 工作计划开始时不得修改. </li>rn</ol>rn', null, '2009-10-10 14:02:57.000');


/* Table structure [product] */
CREATE TABLE [product] (
  [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [cate_id] INTEGER NOT NULL, 
  [icon] VARCHAR(255), 
  [title] VARCHAR(255) NOT NULL, 
  [content] TEXT NOT NULL, 
  [createtime] INTEGER NOT NULL, 
  [updatetime] INTEGER NOT NULL, 
  [top] TINYINT(1) NOT NULL DEFAULT 0, 
  [digest] TINYINT(1) NOT NULL DEFAULT 0, 
  [state] TINYINT(1) NOT NULL DEFAULT 1, 
  [sort] TINYINT(1) NOT NULL DEFAULT 0, 
  [date] DATE, 
  [hit] INTEGER NOT NULL DEFAULT 1);

/* Data [product] */
insert into [product] values(71, 9, '/uploads/images/img.jpg', 'VIP 999', '<p> &nbsp;&nbsp;&nbsp; Item#:&lt;?php echo $model-&gt;title;?&gt;<br /> &nbsp;</p> ', 1255659106, 1256357220, 0, 1, 1, 0, '2009-10-16', 99);
insert into [product] values(72, 10, '/uploads/images/img.jpg', '夏日山产品', '<p> 222</p> ', 1255677552, 1255963415, 1, 0, 1, 0, '2009-10-17', 0);
insert into [product] values(73, 9, '/uploads/images/img.jpg', '范德萨', '<p> 发大水</p> ', 1255963459, 0, 0, 0, 1, 0, null, 0);
insert into [product] values(74, 9, '/uploads/images/img.jpg', '312', '<p> 312</p> ', 1255963469, 0, 0, 0, 1, 0, null, 0);
insert into [product] values(75, 9, '/uploads/images/img.jpg', '12312', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> </tr> <tr> </tr> <tr> <td class="content_main"> <p> <font face="Verdana">Steel wicker lounge</font></p> <p> <font face="Verdana">size:63x61x95cm,leg tube size:Dia.28x1.0mm.<br /> Frame:w/powder coating,color:match wicker<br /> Wicker:PP rattan.</font></p> </td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table>', 1255963702, 1255964425, 0, 0, 1, 0, null, 0);


/* Table structure [tree] */
CREATE TABLE [tree] (
  [id] integer NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [lft] integer NOT NULL, 
  [rgt] integer NOT NULL, 
  [level] integer, 
  [name] varchar(255));

/* Data [tree] */
insert into [tree] values(1, 0, 51, 0, '企业新闻');
insert into [tree] values(2, 3, 8, 1, '新闻中心');
insert into [tree] values(3, 21, 30, 1, '信息中心');
insert into [tree] values(4, 9, 20, 1, '产品中心');
insert into [tree] values(5, 31, 40, 1, '广告中心');
insert into [tree] values(6, 41, 42, 1, '广告图片');
insert into [tree] values(7, 43, 44, 1, '链接管理');
insert into [tree] values(8, 45, 46, 1, '企业招聘');
insert into [tree] values(9, 47, 48, 1, '未定义');
insert into [tree] values(10, 49, 50, 1, '未定义');
insert into [tree] values(11, 22, 23, 2, 'About');
insert into [tree] values(12, 24, 25, 2, 'Contact');
insert into [tree] values(13, 26, 27, 2, 'Support');
insert into [tree] values(14, 28, 29, 2, 'Homepage');
insert into [tree] values(15, 32, 33, 2, '首页中间切换 banner');
insert into [tree] values(16, 34, 35, 2, '左侧');
insert into [tree] values(17, 36, 37, 2, '右侧');
insert into [tree] values(18, 38, 39, 2, '其他');
insert into [tree] values(23, 4, 5, 2, '公司新闻');
insert into [tree] values(24, 6, 7, 2, '企业新闻');
insert into [tree] values(25, 10, 15, 2, 'New Cate One');
insert into [tree] values(26, 16, 19, 2, 'New Cate Two');
insert into [tree] values(27, 11, 12, 3, 'small 1');
insert into [tree] values(28, 13, 14, 3, 'small 2');
insert into [tree] values(29, 17, 18, 3, 'small 3');


/* Table structure [user] */
CREATE TABLE [user] (
  [userid] integer NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [username] varchar(15) NOT NULL, 
  [password] varchar(32) NOT NULL, 
  [realname] varchar(16), 
  [email] varchar(32) NOT NULL, 
  [profile] text, 
  [regIp] char(15) NOT NULL, 
  [regTime] datetime NOT NULL, 
  [lastLoginIp] char(15), 
  [lastLoginTime] datetime);

/* Data [user] */
insert into [user] values(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '张三', 'demo@demo.com', '', '', '1899-12-30 00:00:00.000', '127.0.0.1', '2009-10-17 20:15:54.000');
insert into [user] values(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '李四', 'huanghuibin@gmail.com', 'dfsafdas', '', '1899-12-30 00:00:00.000', '127.0.0.1', '2009-10-27 10:30:25.000');
insert into [user] values(11, 'test', 'e10adc3949ba59abbe56e057f20f883e', '测试', '12345@163.com', '', '127.0.0.1', '2009-09-14 16:36:51.000', '127.0.0.1', '2009-10-17 20:15:44.000');
insert into [user] values(12, '22233', '123456', null, 'ada@gam.com', null, '127.0.0.1', '2009-10-27 13:50:33.000', null, null);


/* Table structure [website] */
CREATE TABLE [website] (
  [id] integer NOT NULL PRIMARY KEY AUTOINCREMENT, 
  [name] varchar(64), 
  [value] varchar(255), 
  [autoload] tinyint(1) NOT NULL DEFAULT 1);

/* Data [website] */
insert into [website] values(1, 'webstate', '0', 1);
insert into [website] values(2, 'closereason', '关闭原因', 1);
insert into [website] values(3, 'footer', '&#169; 2009 - 2009 hopejy.com All rights reserved.', 1);
insert into [website] values(4, 'sitename', 'hope', 1);
insert into [website] values(5, 'keywords', 'mobile,hk,phone,handset, combined set, mobile phone', 1);
insert into [website] values(6, 'description', 'hope,hopehk,hopedkdk', 1);
insert into [website] values(7, 'seotitle', '11122', 1);
insert into [website] values(8, 'address', 'where are you', 1);
insert into [website] values(9, 'phone', '0086-574-12345678', 1);
insert into [website] values(10, 'email', 'huanghuibin@gmail.com', 1);
insert into [website] values(11, 'timezone', '+8', 1);
insert into [website] values(12, 'timeformat', 'Y-m-d', 1);
insert into [website] values(13, 'booklength', '200', 1);
insert into [website] values(14, 'theme', 'default', 1);
insert into [website] values(17, 'copyright', '&#169; 2009 - 2009 biner.com All rights reserved.', 1);
insert into [website] values(18, 'footer_address', 'Address: R1501-1503 A1 Building, 203# Lantian Road, Ningbo, Zhejiang, China Tel: 0086-574-87103682 Fax: 0086-574-88020867 E-mail: sales@siming-craft.com', 1);


