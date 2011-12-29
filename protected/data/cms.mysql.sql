-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 11 月 02 日 19:48
-- 服务器版本: 5.0.81
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lockphp1_hobertech`
--

-- --------------------------------------------------------

--
-- 表的结构 `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(11) NOT NULL auto_increment,
  `cate_id` tinyint(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort` tinyint(1) NOT NULL default '0',
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `ad`
--

INSERT INTO `ad` (`id`, `cate_id`, `url`, `title`, `sort`, `icon`) VALUES
(1, 15, 'http://test.com', 'aaa', 0, '/uploads/images/img.jpg'),
(2, 15, 'http://localhost/uploads/images/img.jpg', 'fasd', 0, '/uploads/images/img.jpg'),
(3, 15, 'http://localhost/uploads/images/img.jpg', 'fasfasfasfas2312', 0, '/uploads/images/img.jpg'),
(4, 16, 'http://www.boc.cn', '中国银行', 0, '/uploads/images/links/boc.gif'),
(5, 16, 'http://www.dhl.com', 'DHL', 0, '/uploads/images/links/dhl.gif'),
(6, 16, 'http://www.ems.com.cn/english-main.jsp', 'EMS', 0, '/uploads/images/links/ems.gif'),
(7, 16, 'http://www.MoneyGram.com', 'Money', 0, '/uploads/images/links/moneygram.gif'),
(8, 16, 'http://www.paypal.com', 'PAYPAL', 0, '/uploads/images/links/paypal.gif'),
(9, 16, 'http://www.tnt.com', 'TNT', 0, '/uploads/images/links/tnt.gif'),
(10, 16, 'http://www.ups.com', 'UPS', 0, '/uploads/images/links/ups.gif'),
(11, 16, 'http://www.westernunion.com', 'westem', 0, '/uploads/images/links/wetern.gif'),
(12, 16, '#', 'GOOD', 0, '/uploads/images/links/1.gif  '),
(13, 16, '#', 'GOOD', 0, '/uploads/images/links/2.gif  ');

-- --------------------------------------------------------

--
-- 表的结构 `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY  (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('系统管理员 ', '2', NULL, 's:0:"";'),
('一般管理员 ', '11', NULL, 's:0:"";'),
('Authority', '2', NULL, 's:0:"";');

-- --------------------------------------------------------

--
-- 表的结构 `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Authority', 2, NULL, NULL, NULL),
('Administrator', 2, NULL, NULL, NULL),
('用户', 2, NULL, NULL, NULL),
('一般管理员 ', 2, '一般管理员,录入资料.', NULL, NULL),
('Delete Post', 0, NULL, NULL, NULL),
('Create Post', 0, NULL, NULL, NULL),
('Edit Post', 0, NULL, NULL, NULL),
('View Post', 0, NULL, NULL, NULL),
('Delete User', 0, NULL, NULL, NULL),
('Create User', 0, NULL, NULL, NULL),
('Edit User', 0, NULL, NULL, NULL),
('View User', 0, NULL, NULL, NULL),
('信息中心管理', 1, NULL, NULL, NULL),
('ContentShow', 0, NULL, NULL, NULL),
('ContentCreate', 0, NULL, NULL, NULL),
('ContentUpdate', 0, NULL, NULL, NULL),
('ContentDelete', 0, NULL, NULL, NULL),
('ContentList', 0, NULL, NULL, NULL),
('ContentAdmin', 0, NULL, NULL, NULL),
('新闻管理', 1, NULL, NULL, NULL),
('NoticeShow', 0, NULL, NULL, NULL),
('NoticeCreate', 0, NULL, NULL, NULL),
('NoticeUpdate', 0, NULL, NULL, NULL),
('NoticeDelete', 0, NULL, NULL, NULL),
('NoticeList', 0, NULL, NULL, NULL),
('NoticeAdmin', 0, NULL, NULL, NULL),
('工作计划管理', 1, NULL, NULL, NULL),
('PlanShow', 0, NULL, NULL, NULL),
('PlanCreate', 0, NULL, NULL, NULL),
('PlanUpdate', 0, NULL, NULL, NULL),
('PlanFinish', 0, NULL, NULL, NULL),
('PlanDelete', 0, NULL, NULL, NULL),
('PlanList', 0, NULL, NULL, NULL),
('PlanAdmin', 0, NULL, NULL, NULL),
('产品管理', 1, NULL, NULL, NULL),
('ProductShow', 0, NULL, NULL, NULL),
('ProductCreate', 0, NULL, NULL, NULL),
('ProductUpdate', 0, NULL, NULL, NULL),
('ProductDelete', 0, NULL, NULL, NULL),
('ProductList', 0, NULL, NULL, NULL),
('ProductCate', 0, NULL, NULL, NULL),
('ProductAdmin', 0, NULL, NULL, NULL),
('分类管理', 1, NULL, NULL, NULL),
('TreeIndex', 0, NULL, NULL, NULL),
('TreeProduct', 0, NULL, NULL, NULL),
('TreeCreate', 0, NULL, NULL, NULL),
('TreeUpdate', 0, NULL, NULL, NULL),
('用户管理', 1, NULL, NULL, NULL),
('UserShow', 0, NULL, NULL, NULL),
('UserCreate', 0, NULL, NULL, NULL),
('UserUpdate', 0, NULL, NULL, NULL),
('UserDelete', 0, NULL, NULL, NULL),
('UserList', 0, NULL, NULL, NULL),
('UserAdmin', 0, NULL, NULL, NULL),
('网站设置', 1, NULL, NULL, NULL),
('用户管理员 ', 2, '管理用户', NULL, NULL),
('WebsiteIndex', 0, NULL, NULL, NULL),
('WebsiteShow', 0, NULL, NULL, NULL),
('WebsiteCreate', 0, NULL, NULL, NULL),
('WebsiteUpdate', 0, NULL, NULL, NULL),
('WebsiteDelete', 0, NULL, NULL, NULL),
('WebsiteList', 0, NULL, NULL, NULL),
('WebsiteAdmin', 0, NULL, NULL, NULL),
('系统管理员 ', 2, '拥有任命管理员的权限', NULL, NULL),
('广告管理', 1, NULL, NULL, NULL),
('AdShow', 0, NULL, NULL, NULL),
('AdCreate', 0, NULL, NULL, NULL),
('AdUpdate', 0, NULL, NULL, NULL),
('AdDelete', 0, NULL, NULL, NULL),
('AdList', 0, NULL, NULL, NULL),
('AdAdmin', 0, NULL, NULL, NULL),
('TreeNotice', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY  (`parent`,`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('一般管理员', '产品管理'),
('一般管理员', '信息中心管理'),
('一般管理员', '分类管理'),
('一般管理员', '工作计划管理'),
('一般管理员', '广告管理'),
('一般管理员', '新闻管理'),
('一般管理员', '网站设置'),
('产品管理', 'ProductAdmin'),
('产品管理', 'ProductCate'),
('产品管理', 'ProductCreate'),
('产品管理', 'ProductDelete'),
('产品管理', 'ProductList'),
('产品管理', 'ProductShow'),
('产品管理', 'ProductUpdate'),
('信息中心管理', 'ContentAdmin'),
('信息中心管理', 'ContentCreate'),
('信息中心管理', 'ContentDelete'),
('信息中心管理', 'ContentList'),
('信息中心管理', 'ContentShow'),
('信息中心管理', 'ContentUpdate'),
('分类管理', 'TreeCreate'),
('分类管理', 'TreeIndex'),
('分类管理', 'TreeNotice'),
('分类管理', 'TreeProduct'),
('分类管理', 'TreeUpdate'),
('工作计划管理', 'PlanAdmin'),
('工作计划管理', 'PlanCreate'),
('工作计划管理', 'PlanDelete'),
('工作计划管理', 'PlanFinish'),
('工作计划管理', 'PlanList'),
('工作计划管理', 'PlanShow'),
('工作计划管理', 'PlanUpdate'),
('广告管理', 'AdAdmin'),
('广告管理', 'AdCreate'),
('广告管理', 'AdDelete'),
('广告管理', 'AdList'),
('广告管理', 'AdShow'),
('广告管理', 'AdUpdate'),
('新闻管理', 'NoticeAdmin'),
('新闻管理', 'NoticeCreate'),
('新闻管理', 'NoticeDelete'),
('新闻管理', 'NoticeList'),
('新闻管理', 'NoticeShow'),
('新闻管理', 'NoticeUpdate'),
('用户管理', 'UserAdmin'),
('用户管理', 'UserCreate'),
('用户管理', 'UserDelete'),
('用户管理', 'UserList'),
('用户管理', 'UserShow'),
('用户管理', 'UserUpdate'),
('用户管理员 ', '用户管理'),
('系统管理员 ', '产品管理'),
('系统管理员 ', '信息中心管理'),
('系统管理员 ', '分类管理'),
('系统管理员 ', '工作计划管理'),
('系统管理员 ', '广告管理'),
('系统管理员 ', '新闻管理'),
('系统管理员 ', '用户管理'),
('系统管理员 ', '网站设置'),
('网站设置', 'WebsiteAdmin'),
('网站设置', 'WebsiteCreate'),
('网站设置', 'WebsiteDelete'),
('网站设置', 'WebsiteIndex'),
('网站设置', 'WebsiteList'),
('网站设置', 'WebsiteShow'),
('网站设置', 'WebsiteUpdate');

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL auto_increment,
  `cate_id` int(11) NOT NULL,
  `icon` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `content` text NOT NULL,
  `sort` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `content`
--

INSERT INTO `content` (`id`, `cate_id`, `icon`, `title`, `content`, `sort`) VALUES
(1, 11, 'Profile', 'Company Profile', '<p> <font style="font-family: Arial;">Established in 2005,&nbsp;Ningbo Siming&nbsp;Imp. &amp; Exp.&nbsp;Co., Ltd ., is a professional modern company integrating design, manufacture and sale together, located in Ningbo, China. Our product range amounts more than 1000 Items in various categories for buyer&#39;s selection. Our product range mainly covers:&nbsp;outdoor rattan furniture,&nbsp;gazebo,&nbsp;solar LED lamps,&nbsp;etc. <br style="" /> <br style="" /> We have more than ten VIP material suppliers that guarantee us favorable terms of supplies due to our high output providing us in the same time with major competitive advantage - low price for high quality of our products.<br style="" /> <br style="" /> After&nbsp;5 years experience in global trade , our major clients are in Europe (40%), Southeast Asia and Africa (40%), South America and North America (20%).Our average production output is 60 containers.<br style="" /> <br style="" /> Our strong Quality Control department guarantees high quality by applying AQL standards for inspection of each bulk of goods. Each month our R&amp;D team is able to launch one new item.<br style="" /> <br style="" /> We are specialized in OEM and ODM service for our customers. And always meet customers&#39; various &amp; special requirements with original design, consummate quality, reasonable price, competitive after-sales service &ampon-time delivery time.<br style="" /> <br style="" /> We are sincerely expected to be one of your perfect long-term business partner !<br style="" /> If you have any further inquiries, please contact us at your earliest convenience.</font></p> ', 0),
(2, 12, 'contact', 'contat us', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td height="50"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody> <tr> <td class="T2" colspan="2" height="22"> Ningbo Siming Imp. &amp; Exp. Co.,Ltd.</td> </tr> <tr> <td width="14%"> &nbsp;</td> <td width="86%"> &nbsp;</td> </tr> <tr> <td height="20"> Address:</td> <td height="18"> R1501-1503 A1 Building, 203# Lantian Road, Ningbo, Zhejiang, China</td> </tr> <tr> <td height="20"> Phone:</td> <td height="18"> 0086-574-87103682</td> </tr> <tr> <td height="20"> Fax:</td> <td height="18"> 0086-574-88020867</td> </tr> <tr> <td height="20"> Contact:</td> <td height="18"> Jack Xu</td> </tr> <tr> <td height="20"> E-mail:</td> <td height="18"> <a class="email" href="mailto:sales@siming-craft.com?subject=Inquiry%20online%28www.siming-craft.com%29&amp;cc=jack@siming-craft.com">sales@siming-craft.com</a></td> </tr> <tr> <td height="20"> &nbsp;</td> <td> <a class="email" href="mailto:jack@siming-craft.com?subject=Inquiry%20online%28www.siming-craft.com%29&amp;cc=sales@siming-craft.com">jack@siming-craft.com</a></td> </tr> <tr> <td height="20"> Website:</td> <td height="18"> <a class="email" href="http://www.siming-craft.com" target="_blank">http://www.siming-craft.com</a></td> </tr> <tr> <td height="20"> Skype:</td> <td height="18"> jack_siming</td> </tr> </tbody> </table> </td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="30"> &nbsp;</td> </tr> </tbody> </table>', 0),
(3, 13, 'service', 'service', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="main_title2" height="32"> Service &amp; Support</td> </tr> <tr> <td height="4"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 1. Patone Color &amp; Logo printting</td> </tr> <tr> <td> <span class="content_main">The only tool recognized by international standards that recognized the product colors accurately . We shall use it to match the color of your logo and artwork to be placed on the unit or packing box at no additional costs.</span></td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 2. Technical (Rohs)</td> </tr> <tr> <td> <span class="content_main"><img border="0" src="http://www.siming-craft.com/admin/pic_display.asp?code=miscell&amp;keyno=484" /> To follow the new standard RoHS &amp; WEEE in Europe, we have invested on the newest RoHS test machine to make sure of our goods quality. Each production we&#39;ll test by ourselves with a detailed inspection report, to ensure the goods are qualified with the international standard. <br /> <br /> ROHS: Means Reduction of Hazardous Substance in electrical and electronic equipment. Good News: To safe guard buyers interest and ship goods on time. We have purchased the Testing Equipment.We use raw material suppliers &amp; Vendors who comply with RoHS Standards. All raw material is tested before the planned production schedule. Second Test is made when goods are on production line. The Third and final Test is made once goods are being packed for exports.<br /> <br /> FYI: It takes only 2 minutes or less to make these tests. The unit is connected to the computer and the computer analysis and decides to pass or fail one of the 6 components. Same test to be performed with SGS takes about 2 weeks and very expensive. Attached is picture of this machinery and Report.<br /> <br /> WEEE: Waste Electrical and Electronic Equipment&quot;under the Eurpoean Parliament it guranteess our products as Environmental Friendly and recycled energy for its components giving our Clients the best advantage and being one step ahead of the other competitors for imports and a speedy process in Customs &amp; Duty Clearance in their countries.<br /> <br /> Dozens of languages were spoken at the Global Medical Devices Conference in Portugal, But it was a Latin phrase that got the attention of the attendees. &quot;Perhaps the famous CE mark should mean caveat emptor CE mark translation should be? buyer beware&quot;it was the European Union&#39;s safety standards but not it has been recognised world wide maybe more than 160 countries and more.</span></td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 3. Samples are offered within 10 days and dispatched by express couriers, air or post as per customer&#39;s requirement. Delivery fees are on the account of the client</td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> <td class="T2" height="24"> 4. Logo on the unit and package is acceptable.</td> </tr> <tr> <td> &nbsp;</td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table>', 0),
(4, 11, 'payment', 'Payment Details', '<p> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=481"><font color="#333333">Payment Details</font></a></p> ', 0),
(5, 11, 'OEM', 'OEM & ODM', '<p> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=437"><font color="#333333">OEM &amp; ODM</font></a> <a class="menu_21" href="http://www.siming-craft.com/about.asp?x=1&amp;pageno=1&amp;keyno=437"><font color="#333333">OEM &amp; ODM</font></a></p> ', 0),
(6, 14, 'homepage', 'homepage', '<p> 这段话首页会显示</p> <p> Welcome to Siming-Craft.com <strong>Ningbo Siming Imp. &amp; Exp. Co., Ltd.</strong> is a professional modern company integrating design, manufacture and sale together. Our company mainly produces and sells high quality outdoor furniture, gazebos and solar LED lamps.Our products bring taste, fashion, freedom and leisure to your rooms, gardens, villas, entertainment areas. <br /> <br /> Our products sell well in Europe, North America, the Middle East and Australia. We will sincerely serve our customers all the time. In order to meet our customers&#39; varied requirements, we will continuously improve the ability of research and development, strictly control the quality and cordially provide comfortable and eco-friendly environment.</p> ', 0);

-- --------------------------------------------------------

--
-- 表的结构 `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `cate_id` int(11) NOT NULL,
  `datetime` date default NULL,
  `top` tinyint(1) NOT NULL default '0',
  `digest` tinyint(1) NOT NULL default '0',
  `state` tinyint(1) NOT NULL default '1',
  `sort` tinyint(1) NOT NULL default '0',
  `view` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `notice`
--

INSERT INTO `notice` (`id`, `title`, `content`, `cate_id`, `datetime`, `top`, `digest`, `state`, `sort`, `view`) VALUES
(3, '购买HostMonster遇阻', '<p>\r\n	面对购买美国主机，特别是<a href="http://www.beishan.info/hostmonster/20090112/hostmonster-featured-foreign-trade-website.html" title="为什么推荐HostMonster主机做外贸网站空间？">HostMonster主机</a>，北山没有想到过的情况，今天却在自己最熟悉的HostMonster上遇到了。</p>\r\n<p>\r\n	本来今天下班挺早，也有时间有计划的购买个HostMonster主机，HostMonster在<a href="http://www.beishan.info" title="北山虚拟主机评论">北山虚拟主机评论</a>的首页排在第一，但是一直没有弄个合适的演示网站，让访问者参考参考。可是当我打算用自己已有的域名<a href="http://www.review-hostmonster.com" title="HostMonster Reviews"><span id="general_error">review-hostmonster.com</span></a>购买HostMonster主机时，没有预想到的情况出现了，用图片说话。</p>\r\n<p style="text-align: center;">\r\n	<img alt="购买HostMonster遇阻" class="alignnone size-full wp-image-1779" height="210" src="http://www.beishan.info/wp-content/uploads/2009/10/failed-to-purchase-hostmonster-hosting.gif" title="购买HostMonster遇阻" width="500" /></p>\r\n<p>\r\n	域名review-hostmonster.com是购买<a href="http://www.beishan.info/ixwebhosting/20090519/ixwebhosting-coupon.html" title="IXWebHosting Coupon/优惠码/优惠券 -- 优惠20%">IXWebHosting</a>主机时，使用IXWebHosting提供的两个免费域名中的一个。因为时间关系这个域名基本上是闲置着的。万万没有想到，这个域名竟然被人绑定到HostMonster主机上了，让人想不通，搞得我有点莫名奇妙。</p>\r\n<p>\r\n	马上点击HostMonster的Live Chat找他们的客服，一开始以为这是销售方面的事情，就找sales，NND~~sales直接告诉我得找support，晕~~还以为是在踢皮球了。 不管了，找support就找support，support问了一堆问题也说了很多，摘几句：</p>\r\n<p style="padding-left: 30px;">\r\n	&ldquo;so you purchased the domain but its associated with another account&hellip; I see.&rdquo;<br />\r\n	&ldquo;Are you associated with the owner of the hostmonster account at all?&rdquo;<br />\r\n	&ldquo;Was he your webmaster for a while or anything like that?&rdquo;</p>\r\n<p>\r\n	显然那个帐号跟我北山没什么关系，直接回答说&rdquo;NO&rdquo;。最后support告诉北山:</p>\r\n<p>\r\n	&ldquo;You would need to make a support request to our legal team to get that domain released. If you send an email to legal@hostmonster.com They can help you get this straightened out.&rdquo;</p>\r\n<p>\r\n	路漫漫啊，还得跟legal team联系，看来购买HostMonster又要拖一拖了，但愿不要太久。</p>\r\n<p>\r\n	欲了解HostMonster美国主机详细信息，现在就访问一下HostMonster官方网</p>\r\n', 23, '2009-10-24', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `state` tinyint(1) default NULL,
  `overdate` datetime default NULL,
  `plan` text,
  `memo` text,
  `createtime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `plan`
--

INSERT INTO `plan` (`id`, `uid`, `type`, `startdate`, `enddate`, `state`, `overdate`, `plan`, `memo`, `createtime`) VALUES
(2, 1, 1, '2009-10-01', '2009-10-16', 1, '2009-10-10 09:44:11', '222', '发大水发生11', '2009-10-10 09:26:19'),
(3, 2, 2, '2009-10-14', '2009-10-23', 1, '2009-10-10 11:10:03', '13213', 'fdasfdsa', '2009-10-10 11:05:02'),
(4, 2, 1, '2009-10-09', '2009-10-10', 0, NULL, '<p>rn 完成 plan 工作计划!</p>rn<ol>rn <li>rn 各人能创建自己的工作计划. </li>rn <li>rn 只能编辑自己的工作计划.</li>rn <li>rn 工作计划开始时不得修改. </li>rn</ol>rn', NULL, '2009-10-10 14:02:57');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL auto_increment,
  `cate_id` int(11) NOT NULL,
  `icon` varchar(255) default NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `top` tinyint(1) NOT NULL default '0',
  `digest` tinyint(1) NOT NULL default '0',
  `state` tinyint(1) NOT NULL default '1',
  `sort` tinyint(1) NOT NULL default '0',
  `date` date default NULL,
  `hit` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- 导出表中的数据 `product`
--

INSERT INTO `product` (`id`, `cate_id`, `icon`, `title`, `content`, `createtime`, `updatetime`, `top`, `digest`, `state`, `sort`, `date`, `hit`) VALUES
(71, 25, '/uploads/images/img.jpg', 'VIP 999', '<p>\r\n	&nbsp;&nbsp;&nbsp; Item#:&lt;?php echo $model-&gt;title;?&gt;<br />\r\n	&nbsp;</p>\r\n', 1255659106, 1257212140, 0, 1, 1, 0, '2009-10-16', 99),
(72, 10, '/uploads/images/img.jpg', '夏日山产品', '<p> 222</p> ', 1255677552, 1255963415, 1, 0, 1, 0, '2009-10-17', 0),
(73, 9, '/uploads/images/img.jpg', '范德萨', '<p> 发大水</p> ', 1255963459, 0, 0, 0, 1, 0, NULL, 0),
(74, 9, '/uploads/images/img.jpg', '312', '<p> 312</p> ', 1255963469, 0, 0, 0, 1, 0, NULL, 0),
(75, 9, '/uploads/images/img.jpg', '12312', '<table align="center" border="0" cellpadding="0" cellspacing="0" width="660"> <tbody> <tr> </tr> <tr> </tr> <tr> <td class="content_main"> <p> <font face="Verdana">Steel wicker lounge</font></p> <p> <font face="Verdana">size:63x61x95cm,leg tube size:Dia.28x1.0mm.<br /> Frame:w/powder coating,color:match wicker<br /> Wicker:PP rattan.</font></p> </td> </tr> <tr> <td height="20"> &nbsp;</td> </tr> </tbody> </table>', 1255963702, 1255964425, 0, 0, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(11) NOT NULL auto_increment,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) default NULL,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 导出表中的数据 `tree`
--

INSERT INTO `tree` (`id`, `lft`, `rgt`, `level`, `name`) VALUES
(1, 0, 51, 0, '企业新闻'),
(2, 3, 8, 1, 'News Center'),
(3, 21, 30, 1, '学校风采'),
(4, 9, 20, 1, '产品中心'),
(5, 31, 40, 1, '广告中心'),
(6, 41, 42, 1, '广告图片'),
(7, 43, 44, 1, '链接管理'),
(8, 45, 46, 1, '企业招聘'),
(9, 47, 48, 1, '未定义'),
(10, 49, 50, 1, '未定义'),
(11, 22, 23, 2, '关于我们'),
(12, 24, 25, 2, '联系我们'),
(13, 26, 27, 2, '技术支持'),
(14, 28, 29, 2, 'Homepage'),
(15, 32, 33, 2, '首页中间切换 banner'),
(16, 34, 35, 2, '底部友情链接 '),
(17, 36, 37, 2, '右侧'),
(18, 38, 39, 2, '其他'),
(23, 4, 5, 2, '企业新闻'),
(24, 6, 7, 2, '公司新闻'),
(25, 10, 15, 2, 'New Cate One'),
(26, 16, 19, 2, 'New Cate Two'),
(27, 11, 12, 3, 'small 1'),
(28, 13, 14, 3, 'small 2'),
(29, 17, 18, 3, 'small 3');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `realname` varchar(16) default NULL,
  `email` varchar(32) NOT NULL,
  `profile` text,
  `regIp` char(15) NOT NULL,
  `regTime` datetime NOT NULL,
  `lastLoginIp` char(15) default NULL,
  `lastLoginTime` datetime default NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `realname`, `email`, `profile`, `regIp`, `regTime`, `lastLoginIp`, `lastLoginTime`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '张三', 'demo@demo.com', '', '', '1899-12-30 00:00:00', '127.0.0.1', '2009-10-17 20:15:54'),
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '李四', 'huanghuibin@gmail.com', 'dfsafdas', '', '1899-12-30 00:00:00', '121.15.88.15', '2009-11-03 09:15:54'),
(11, 'test', 'e10adc3949ba59abbe56e057f20f883e', '测试', '12345@163.com', '', '127.0.0.1', '2009-09-14 16:36:51', '127.0.0.1', '2009-10-17 20:15:44'),
(12, '22233', '123456', NULL, 'ada@gam.com', NULL, '127.0.0.1', '2009-10-27 13:50:33', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) default NULL,
  `value` varchar(255) default NULL,
  `autoload` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `website`
--

INSERT INTO `website` (`id`, `name`, `value`, `autoload`) VALUES
(1, 'webstate', '1', 1),
(2, 'closereason', '关闭原因', 1),
(3, 'footer', '&#169; 2009 - 2009 hopejy.com All rights reserved.', 1),
(4, 'sitename', 'school', 1),
(5, 'keywords', 'helloword', 1),
(6, 'description', 'hope,hopehk,hopedkdk', 1),
(7, 'seotitle', '11122', 1),
(8, 'address', 'school', 1),
(9, 'phone', '0086-574-12', 1),
(10, 'email', 'huanghuibin@gmail.com', 1),
(11, 'timezone', '+8', 1),
(12, 'timeformat', 'Y-m-d', 1),
(13, 'booklength', '200', 1),
(14, 'theme', 'default', 1),
(17, 'copyright', '© 2009 - 2009 biner.com All rights reserved.', 1),
(18, 'footer_address', 'Address: R1501-1503 A1 Building, 203# Lantian Road, Ningbo, Zhejiang, China Tel: 0086-574-87103682 Fax: 0086-574-88020867 E-mail: sales@siming-craft.com', 1);
