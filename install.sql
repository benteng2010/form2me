-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2008 年 05 月 02 日 16:41
-- 服务器版本: 5.0.27
-- PHP 版本: 5.2.0
--
-- 数据库: `GOOTOP-CMS`
--

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_ad`
--

CREATE TABLE `qinggan_ad` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `typeid` mediumint(8) unsigned NOT NULL COMMENT '广告分类ID号',
  `subject` varchar(255) NOT NULL COMMENT '广告题头，用于后台管理',
  `content` text NOT NULL COMMENT '广告内容',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为未审核，1为正常',
  `start_date` date NOT NULL default '2008-02-29' COMMENT '广告开始时间',
  `end_date` date NOT NULL default '2020-02-29' COMMENT '广告结束时间',
  PRIMARY KEY  (`id`),
  KEY `typeid` (`typeid`),
  KEY `start_date` (`start_date`,`end_date`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告管理' AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `qinggan_ad`
--

INSERT INTO `qinggan_ad` (`id`, `typeid`, `subject`, `content`, `status`, `start_date`, `end_date`) VALUES
(1, 1, '头部468X60广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n//网站头部Banner\r\ngoogle_ad_slot = "1910316539";\r\ngoogle_ad_width = 468;\r\ngoogle_ad_height = 60;\r\n//--></script><script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-02-28', '2009-02-22'),
(2, 0, '内容广告代码', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n//300x250, 创建于 07-12-18\r\ngoogle_ad_slot = "9462447949";\r\ngoogle_ad_width = 300;\r\ngoogle_ad_height = 250;\r\n//--></script><script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(3, 0, '下载内容广告代码', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n//250x250, 创建于 07-12-8\r\ngoogle_ad_slot = "8651687383";\r\ngoogle_ad_width = 250;\r\ngoogle_ad_height = 250;\r\n//--></script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(4, 0, '产品详细信息页左侧广告代码', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(5, 0, '图片内容左侧Google广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(6, 0, '产品列表Google左侧广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(7, 0, '图片列表右侧Google广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(8, 0, '留言本右侧Google广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-04-25', '2009-04-20'),
(9, 0, '登录页Google广告', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-7611496534887215";\r\n/* 160x600, 创建于 08-2-21 */\r\ngoogle_ad_slot = "7405661709";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script><script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 1, '2008-05-01', '2009-04-26');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_admin`
--

CREATE TABLE `qinggan_admin` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `typer` enum('system','manager','editor') NOT NULL default 'editor',
  `user` varchar(100) NOT NULL default '',
  `pass` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `modulelist` text NOT NULL COMMENT '可管理的模块，系统管理员无效',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `qinggan_admin`
--

INSERT INTO `qinggan_admin` (`id`, `typer`, `user`, `pass`, `email`, `modulelist`) VALUES
(1, 'system', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'max.zhang@gootop.net', '');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_book`
--

CREATE TABLE `qinggan_book` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `typeid` mediumint(8) unsigned NOT NULL default '0' COMMENT '留言分类ID',
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `user` varchar(255) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL default '0',
  `email` varchar(255) NOT NULL default '',
  `ifcheck` tinyint(3) unsigned NOT NULL default '0' COMMENT '0为未审核，1为已审核所有人可以看，2为已审核但仅限会员能查看',
  `language` mediumint(8) unsigned NOT NULL default '0',
  `reply` text NOT NULL,
  `replydate` int(10) unsigned NOT NULL default '0' COMMENT '回复时间',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`),
  KEY `typeid` (`typeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `qinggan_book`
--

INSERT INTO `qinggan_book` (`id`, `typeid`, `userid`, `user`, `subject`, `content`, `postdate`, `email`, `ifcheck`, `language`, `reply`, `replydate`) VALUES
(1, 0, 0, '谷铂', '测试留言主题', '这是测试的留言主题，安装成功后请到后台删除', 1209700581, 'max.zhang@gootop.net', 1, 1, '<div>测试回复</div>', 1209700608),
(2, 0, 0, 'gootop', 'It is test', 'testing...', 1209700656, 'max.zhang@gootop.net', 1, 2, '<div>testing...</div>', 1209700706);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_category`
--

CREATE TABLE `qinggan_category` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是分类ID号',
  `sysgroupid` mediumint(8) unsigned NOT NULL default '0' COMMENT '系统组ID',
  `rootid` mediumint(8) unsigned NOT NULL default '0' COMMENT '根分类ID号',
  `parentid` mediumint(8) unsigned NOT NULL default '0' COMMENT '父分类ID号',
  `catename` varchar(255) NOT NULL default '' COMMENT '分类名称',
  `catestyle` varchar(255) NOT NULL default '' COMMENT '样式',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `tpl_index` varchar(255) NOT NULL default '' COMMENT '封面模板',
  `tpl_list` varchar(255) NOT NULL default '' COMMENT '列表模板',
  `tpl_msg` varchar(255) NOT NULL default '' COMMENT '内容模板',
  `note` varchar(255) NOT NULL default '' COMMENT '描述',
  `status` tinyint(1) unsigned NOT NULL default '1' COMMENT '1为正常，0为隐藏',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言ID',
  `psize` tinyint(3) unsigned NOT NULL default '30' COMMENT '分类列表每页显示个数，默认是30',
  `isrefreshcount` tinyint(1) unsigned NOT NULL default '1' COMMENT '是否更新数量统计，0为不更新，1为要更新',
  `msgcount` int(10) unsigned NOT NULL default '0' COMMENT '内容数量',
  `showtype` tinyint(1) unsigned NOT NULL default '0' COMMENT '0按orderdate排序，1按postdate最新排序，2点击量最多排前，3点击量少排前',
  PRIMARY KEY  (`id`),
  KEY `status` (`status`,`language`),
  KEY `rootid` (`rootid`,`status`,`language`),
  KEY `parentid` (`parentid`,`status`,`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类管理' AUTO_INCREMENT=25 ;

--
-- 导出表中的数据 `qinggan_category`
--

INSERT INTO `qinggan_category` (`id`, `sysgroupid`, `rootid`, `parentid`, `catename`, `catestyle`, `taxis`, `tpl_index`, `tpl_list`, `tpl_msg`, `note`, `status`, `language`, `psize`, `isrefreshcount`, `msgcount`, `showtype`) VALUES
(1, 1, 0, 0, '站内新闻', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(2, 1, 1, 1, '公司新闻', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(3, 1, 1, 1, '行业新闻', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(4, 2, 0, 0, '图片展示', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(5, 2, 4, 4, '企业环境', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(6, 2, 4, 4, '活动照片', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(7, 3, 0, 0, '下载中心', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(8, 3, 7, 7, '资料下载', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(9, 3, 7, 7, '驱动下载', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(10, 4, 0, 0, '产品展示', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(11, 4, 10, 10, '产品分类一', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(12, 4, 10, 10, '产品分类二', '', 255, '', '', '', '', 1, 1, 30, 1, 0, 0),
(13, 1, 0, 0, 'NEWS', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(14, 1, 13, 13, 'Company News', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(15, 1, 13, 13, 'Business News', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(16, 2, 0, 0, 'PICTURES', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(17, 2, 16, 16, 'Environmental', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(18, 2, 16, 16, 'Photos', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(19, 3, 0, 0, 'DOWNLOAD', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(20, 3, 19, 19, 'Information', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(21, 3, 19, 19, 'Driver', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(22, 4, 0, 0, 'PRODUCTS', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(23, 4, 22, 22, 'Product Cate 1', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0),
(24, 4, 22, 22, 'Product Cate 2', '', 255, '', '', '', '', 1, 2, 30, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_feedback`
--

CREATE TABLE `qinggan_feedback` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `userid` mediumint(8) unsigned NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL default '0',
  `reply` text NOT NULL,
  `replydate` int(10) unsigned NOT NULL default '0' COMMENT '回复时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_feedback`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_job`
--

CREATE TABLE `qinggan_job` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是应聘链接的ID',
  `jobname` varchar(255) NOT NULL default '' COMMENT '职位名称',
  `usercount` tinyint(3) unsigned NOT NULL default '0' COMMENT '0表示不限个数',
  `age` varchar(255) NOT NULL default '' COMMENT '年龄阶段要求',
  `experience` varchar(255) NOT NULL default '' COMMENT '是否要求有工作经验',
  `height` varchar(255) NOT NULL default '' COMMENT '身高范围',
  `gender` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为不限，1表示男性，2表示女性',
  `content` text NOT NULL COMMENT '其他说明要求',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `enddate` int(10) unsigned NOT NULL default '0' COMMENT '为0表示长期招聘',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言ID',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='招聘信息' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_job`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_jobapp`
--

CREATE TABLE `qinggan_jobapp` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `jobid` mediumint(8) unsigned NOT NULL default '0' COMMENT '对应的招聘的ID号！',
  `userid` mediumint(8) unsigned NOT NULL default '0' COMMENT '会员ID号，非会员为0',
  `jobname` varchar(255) NOT NULL default '' COMMENT '应聘的职位，对应招聘的jobname',
  `name` varchar(100) NOT NULL default '' COMMENT '应聘者姓名',
  `age` tinyint(2) unsigned NOT NULL default '0' COMMENT '应聘者年龄',
  `height` tinyint(3) unsigned NOT NULL default '150' COMMENT '身高',
  `schoolage` varchar(255) NOT NULL default '' COMMENT '学历',
  `contact` varchar(255) NOT NULL default '' COMMENT '联系方式',
  `photo` varchar(255) NOT NULL default '' COMMENT '照片',
  `note` text NOT NULL COMMENT '个人说明',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '应聘时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应聘信息' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_jobapp`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_lang`
--

CREATE TABLE `qinggan_lang` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `sign` varchar(30) NOT NULL default '' COMMENT '语言标识',
  `name` varchar(200) NOT NULL default '' COMMENT '语言名称',
  `ifuse` tinyint(3) unsigned NOT NULL default '0' COMMENT '是否使用，1为使用，0为停用',
  `ifdefault` tinyint(3) unsigned NOT NULL default '0' COMMENT '默认语言包',
  `ifsystem` tinyint(3) unsigned NOT NULL default '0' COMMENT '是否系统默认，0为否，1为是',
  `template` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言对应的默认模板',
  `langc` longtext NOT NULL COMMENT '语言变量内容',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `qinggan_lang`
--

INSERT INTO `qinggan_lang` (`id`, `sign`, `name`, `ifuse`, `ifdefault`, `ifsystem`, `template`, `langc`) VALUES
(1, 'zh', '简体中文', 1, 1, 1, 11, 'reg_ok{,}会员注册成功！\nempty_user{,}会员账号不允许为空！\nempty_pass{,}会员密码不允许为空！\nnotuser{,}找不到会员信息\nuserloginok{,}会员成功登录,请稍候...\nuserlogoutok{,}会员成功退出,请稍候...\nlogintitle{,}会员登录\nreg_emptyuser{,}会员账号为空...\nreg_emptypass{,}会员密码为空...\nreg_emptychkpass{,}认证密码为空...\nreg_difpass{,}两次输入的密码不一致\nreg_emptyemail{,}邮箱为空\nreg_erroremail{,}邮箱不符合系统要求\nreg_user_exist{,}会员账号已经存在\nreg_ok{,}会员注册成功...\nreg_title{,}会员注册\nreg_disabled{,}您已经是本站的会员的，无需再注册\nnotice_title{,}站点公告\nnotice_empty{,}暂无公告...\nmsg_emptyid{,}操作非法,没有指定内容ID号\nmsg_empty{,}找不到相关主题信息...\nmsg_tc_err{,}主题内容与分类不符合...\nsysgroupid_empty{,}无法找到与之相符的系统组...\nfile_not_exists{,}文件不存在....\nsysgroupsign_empty{,}系统组未设置标识符,无法正常浏览...\nnot_tpl{,}系统组里没有找到相匹配的模板...\nlist_emptyid{,}操作非法，没有指定分类ID号...\nlist_emptyrs{,}无法找到分类信息...\npage_first{,}首页\npage_front{,}上一页\npage_back{,}下一页\npage_last{,}最后一页\nspecial_emptyid{,}操作非法,没有指定专题ID号...\nspecial_emptymsg{,}没有找到专题信息...\nvote_emptyid{,}操作非法，没有指定投票ID号...\nvote_emptyrs{,}找不到相关投票主题信息...\nvote_subjectpre{,}投票：\nvote_submitok{,}恭喜您，您的投票已经成功！\nvote_isvotetrue{,}您已经投票过了，可以直接查看...\nbookname{,}留言本\nbook_add{,}添加新留言\nbook_nouser{,}姓名不允许为空...\nbook_noemail{,}邮箱不允许为空\nbook_notemail{,}邮箱格式不正确\nbook_sendok{,}恭喜您的留言已发成功，只有在管理员审核后才能查看...\nbook_subjectempty{,}主题不允许为空...\nbook_msgempty{,}内容不允许为空...\ndfile_error{,}下载文件错误,请检查传递的参数是否正确...\ndfile_empty{,}要下载的文件已丢失,请联系管理员...\nbuy_empty{,}您要购买的商品信息已经失效,请联系网站管理员...\nbuy_emptypro{,}请填写您要购买的商品...\nbuy_emptycount{,}请填写购买商品的数量,如果您是大量订购，请联系我们...\nbuy_ok{,}您好，您的订单已经生成,如果您是会员，请到控制面板查看您的订单信息...\nbuy_ok_error_email{,}您的订单已生成,由于您的邮箱格式不正确,无法给正常发送邮件,请联系管理员...\nbuy_title{,}购买商品：\nbuy_title2{,}购买商品\nmy_order{,}我的订单\nmy_usercp{,}我的个人中心\nmy_error{,}对不起，您还不是会员，不允许操作操作面板，敬请见谅...\nmy_email_wrong{,}邮箱格式不正确...\npass_not_same{,}两次输入的密码不一致...\nmy_updateok{,}您的资料已经更新...\nmy_update_msg{,}查看/更新我的资料\nsearchok{,}搜索结果\njob_ok{,}您的应聘信息已存档，我们会尽快取得和你们联系的\nmy_feedback{,}反馈信息\nmy_fb_subject_content_empty{,}反馈主题或内容为空\nmy_fb_sendok{,}反馈信息发送成功\nmy_fb_sendfail{,}反馈信息发送失败，请返回重新填写\nmy_fb_deleteok{,}反馈信息删除成功\njob_list{,}人才招聘\njob_app{,}填写应聘信息\njob_appok{,}应聘信息已发送成功，请稍候...\njob_apperr{,}应聘信息发送失败，请检查...'),
(2, 'en', 'English', 1, 0, 0, 6, 'reg_ok{,}User Register OK!\nempty_user{,}User Name is Empty!\nempty_pass{,}Password is Empty!\nnotuser{,}Not User Message\nuserloginok{,}Login OK, Please Waiting...\nuserlogoutok{,}Logout OK,Please Waiting...\nlogintitle{,}User Login\nreg_emptyuser{,}User Name is Empty...\nreg_emptypass{,}Password is Empty...\nreg_emptychkpass{,}Check Code is Empty...\nreg_difpass{,}Password is not same...\nreg_emptyemail{,}Email is Empty...\nreg_erroremail{,}Email is Wrong...\nreg_user_exist{,}User is Exists!\nreg_title{,}User Register\nreg_disabled{,}You are a memeber,not register again!\nnotice_title{,}Notice\nnotice_empty{,}Notice Empty...\nmsg_emptyid{,}Not ID!\nmsg_empty{,}Not Subject...\nmsg_tc_err{,}Error...\nsysgroupid_empty{,}Group Error...\nfile_not_exists{,}File Exitsts!\nsysgroupsign_empty{,}Not Sign!\nnot_tpl{,}Not Tpl...\nlist_emptyid{,}Not ID...\nlist_emptyrs{,}Not Category...\npage_first{,}FirstPage\npage_front{,}PrePage\npage_back{,}NextPage\npage_last{,}LastPage\nspecial_emptyid{,}Not ID!\nspecial_emptymsg{,}Not Message...\nvote_emptyid{,}Not ID!\nvote_emptyrs{,}Not Message...\nvote_subjectpre{,}Vote:\nvote_submitok{,}Well,It is OK!\nvote_isvotetrue{,}Not Voting Again...\nbookname{,}Guest Book\nbook_add{,}Add Book\nbook_nouser{,}Name is Empty...\nbook_noemail{,}Email is Empty\nbook_notemail{,}Email is Wrong\nbook_sendok{,}Well,Your Message is Send,You will see when admin checked...\nbook_subjectempty{,}Subject Empty...\nbook_msgempty{,}Content Empty...\ndfile_error{,}File Error...\ndfile_empty{,}File Error...\nbuy_empty{,}Product is Error...\nbuy_emptypro{,}Name is Empty...\nbuy_emptycount{,}Count Empty...\nbuy_ok{,}Well,Order is OK!\nbuy_ok_error_email{,}Well,Your Order is OK,But Your email is wrong, so you can&#39;t get email...\nbuy_title{,}Buy Service:\nbuy_title2{,}Buy Service\nmy_order{,}My Order\nmy_usercp{,}User CP\nmy_error{,}You Are Not a member!\nmy_email_wrong{,}Email is Wrong\npass_not_same{,}Password is Wring!\nmy_updateok{,}Message is Updated...\nmy_update_msg{,}View/Update My message');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_link`
--

CREATE TABLE `qinggan_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `picture` varchar(255) default NULL,
  `taxis` tinyint(3) unsigned default '255',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_mailmsg`
--

CREATE TABLE `qinggan_mailmsg` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言包',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题',
  `content` text NOT NULL COMMENT '内容',
  `usetype` varchar(100) NOT NULL default '' COMMENT '应用类型',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='邮件内容设置' AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `qinggan_mailmsg`
--

INSERT INTO `qinggan_mailmsg` (`id`, `language`, `subject`, `content`, `usetype`) VALUES
(1, 1, '您成功订购了本站以下产品信息', '<p>您好，{username}：</p>\n<p>　　您于&nbsp;{postdate} 成功订购了我们的产品，以下是您的订购信息：</p>\n<blockquote dir="ltr" style="margin-right: 0px"><blockquote dir="ltr" style="margin-right: 0px">\n<p>订单号：{ordersn}</p>\n<p>商品名称：{subject}</p>\n<p>订购数量：{ordercount}</p>\n</blockquote>\n<p dir="ltr">&nbsp;</p>\n<p dir="ltr">您可以访问我们的网站了解该商品的详细信息，我们的网站地址是：{siteurl}</p>\n<p dir="ltr">我们的客服邮箱是：{adminemail}，您可以随时发送邮件告知我们</p>\n</blockquote>', 'ordermsg_to_user'),
(2, 1, '恭喜您又有一个订单了，请查收', '<p>客户&nbsp;{username} 于&nbsp;{postdate} 订购了产品：{subject}，请您及时登录网站后台查看！</p>', 'ordermsg_to_admin');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_mailstatus`
--

CREATE TABLE `qinggan_mailstatus` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，在这里无效',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1为开启邮件通知，0为不开启邮件通知',
  `sign` varchar(100) NOT NULL default '' COMMENT '签名，自动附加在邮件通知的最后内容',
  `language` mediumint(8) unsigned NOT NULL default '1' COMMENT '语言ID',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='是否开启邮件通知' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `qinggan_mailstatus`
--

INSERT INTO `qinggan_mailstatus` (`id`, `status`, `sign`, `language`) VALUES
(1, 1, '谷铂软件', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_msg`
--

CREATE TABLE `qinggan_msg` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '信息自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类ID对应category表的自增ID号',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题',
  `style` varchar(255) NOT NULL default '' COMMENT '主题CSS样式',
  `author` varchar(50) NOT NULL default '' COMMENT '作者名称',
  `authorid` mediumint(8) unsigned NOT NULL default '0' COMMENT '作者ID号',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `modifydate` int(10) unsigned NOT NULL default '0' COMMENT '更改时间',
  `thumb` mediumint(8) unsigned NOT NULL default '0' COMMENT '缩略图图片ID号',
  `tplfile` varchar(255) NOT NULL default '' COMMENT '模板文件，为空使用系统默认',
  `hits` int(10) unsigned NOT NULL default '0' COMMENT '点击率',
  `orderdate` int(10) unsigned NOT NULL default '0' COMMENT '排序时间，时间越大越往前排',
  `istop` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否置顶，0为普通，1－9为不同级别的置顶',
  `isvouch` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否推荐，0为不推荐，1－9为不同级别的推荐',
  `isbest` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否精华，0为普通，1－9为不同级别的精华',
  `onlysign` varchar(50) NOT NULL default '' COMMENT '唯一标识符，该标识符是在程序中创建，在数据库里没有对唯一性进行检查',
  `ext_url` varchar(255) NOT NULL default '' COMMENT '自定义链接',
  `ext_docket` varchar(255) NOT NULL default '' COMMENT '自定义接要',
  `ext_marketprice` float unsigned NOT NULL default '0' COMMENT '自定义市场价',
  `ext_shopprice` float unsigned NOT NULL default '0' COMMENT '商城价',
  `ext_standard` varchar(255) NOT NULL default '' COMMENT '商品规格',
  `ext_number` varchar(255) NOT NULL default '' COMMENT '商品型号',
  `ext_size` varchar(255) NOT NULL default '' COMMENT '软件大小，单位记得填写单位KB，MB等',
  `ext_0` varchar(255) NOT NULL default '' COMMENT '自定义字段0',
  `ext_1` varchar(255) NOT NULL default '' COMMENT '自定义字段1',
  `ext_2` varchar(255) NOT NULL default '' COMMENT '自定义字段2',
  `ext_3` varchar(255) NOT NULL default '' COMMENT '自定义字段3',
  `ext_4` varchar(255) NOT NULL default '' COMMENT '自定义字段4',
  `ext_5` varchar(255) NOT NULL default '' COMMENT '自定义字段5',
  `ext_6` varchar(255) NOT NULL default '' COMMENT '自定义字段6',
  `ext_7` varchar(255) NOT NULL default '' COMMENT '自定义字段7',
  `ext_8` varchar(255) NOT NULL default '' COMMENT '自定义字段8',
  `ext_9` varchar(255) NOT NULL default '' COMMENT '自定义字段9',
  `ifcheck` tinyint(1) unsigned NOT NULL default '1' COMMENT '1为已审核，0为未审核',
  PRIMARY KEY  (`id`,`cateid`),
  KEY `cateid` (`cateid`,`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='主题信息主表' AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `qinggan_msg`
--

INSERT INTO `qinggan_msg` (`id`, `cateid`, `subject`, `style`, `author`, `authorid`, `postdate`, `modifydate`, `thumb`, `tplfile`, `hits`, `orderdate`, `istop`, `isvouch`, `isbest`, `onlysign`, `ext_url`, `ext_docket`, `ext_marketprice`, `ext_shopprice`, `ext_standard`, `ext_number`, `ext_size`, `ext_0`, `ext_1`, `ext_2`, `ext_3`, `ext_4`, `ext_5`, `ext_6`, `ext_7`, `ext_8`, `ext_9`, `ifcheck`) VALUES
(1, 2, 'GOOTOPCMS程序说明', '', 'admin', 1, 1209618731, 1209619543, 0, '', 2, 1209618731, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(2, 3, 'GOOTOPCMS管理平台常用连接方法', '', 'admin', 1, 1209619664, 1209621091, 0, '', 0, 1209619664, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(3, 8, '测试下载信息', '', 'admin', 1, 1209624713, 1209624826, 0, '', 3, 1209624713, 0, 0, 0, '', '', '本信息是测试的下载信息，安装完后请删除或修改该主题', 0, 0, '', '', '', '简体中文', '免费版', 'windows', '', '', 'http://www.gootopsoft.cn', 'max.zhang@gootop.net', '', '', '', 1),
(4, 5, '列表页展示页', '', 'admin', 1, 1209625236, 1209627477, 1, '', 10, 1209625236, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(5, 5, '单页面展示', '', 'admin', 1, 1209626760, 1209626837, 2, '', 1, 1209626760, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(6, 11, '测试产品信息一', '', 'admin', 1, 1209632122, 1209632298, 3, '', 0, 1209632122, 0, 0, 0, '', '', '产品内容简单介绍', 600, 550, 'GOOTOP-2008', 'P20080501', '', '', '', '', '', '', '', '', '', '', '', 1),
(7, 12, '产品二', '', 'admin', 1, 1209640171, 1209640298, 11, '', 0, 1209640171, 1, 0, 0, '', '', '这是测试产品二，安装后请修改或删除掉该信息', 650.5, 580.8, 'GOOTOP-2008', 'P20080501-02', '', '', '', '', '', '', '', '', '', '', '', 1),
(8, 14, 'Hello,It is testing...', '', 'admin', 1, 1209641715, 1209641864, 0, '', 0, 1209641715, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(9, 15, 'Business News Testing...', '', 'admin', 1, 1209641910, 1209641931, 0, '', 5, 1209641910, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(10, 23, 'Product 1', '', 'admin', 1, 1209643768, 1209644281, 11, '', 0, 1209643768, 0, 0, 0, '', '', 'demo', 150, 135, 'GOOTOP-2008', 'D20080501-01', '', '', '', '', '', '', '', '', '', '', '', 1),
(11, 23, 'Demo 2', '', 'admin', 1, 1209644283, 1209644349, 11, '', 0, 1209644283, 0, 0, 0, '', '', 'demo 2', 420.45, 400.5, 'GOOTOP-2008', 'D20080501-02', '', '', '', '', '', '', '', '', '', '', '', 1),
(12, 17, 'demo 001', '', 'admin', 1, 1209644477, 1209644536, 5, '', 0, 1209644477, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(13, 18, 'demo 02', '', 'admin', 1, 1209644538, 1209644574, 2, '', 0, 1209644538, 0, 0, 0, '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(14, 20, 'demo 001', '', 'admin', 1, 1209648332, 1209648394, 0, '', 2, 1209648332, 0, 0, 0, '', '', 'demo 001', 0, 0, '', '', '120KB', 'Chinese', 'Free', 'Windows/Linux', '', 'http://www.gootopsoft.cn', 'http://www.gootopsoft.cn', 'max.zhang@gootop.net', '', '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_msg_content`
--

CREATE TABLE `qinggan_msg_content` (
  `id` int(10) unsigned NOT NULL default '0' COMMENT '主题ID号，对应msg表中的自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类ID号，用于索引',
  `content` longtext NOT NULL COMMENT '内容信息',
  PRIMARY KEY  (`id`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容信息';

--
-- 导出表中的数据 `qinggan_msg_content`
--

INSERT INTO `qinggan_msg_content` (`id`, `cateid`, `content`) VALUES
(1, 2, '<div>GOOTOPCMS程序促使企业建站更轻松，操作更简单！</div>\r\n<ul>\r\n    <li>提供了新闻文章、图片、下载及产品四大模块，并可以自己增加模块功能</li>\r\n    <li>提供企业站单页面信息管理功能（实现在线管理如企业简介，联系我们等单页面信息）</li>\r\n    <li>简单的订购系统，有效提供产品网上下单的功能</li>\r\n    <li>简洁留言本功能让客户可以自由发表自己的观点，以利于信息的收集</li>\r\n    <li>提供了简单便捷的会员功能，并实现了针对会员的反馈功能，利于企业与用户的交流</li>\r\n    <li>简洁的投票系统</li>\r\n    <li>多语言多风格功能的实现，让企业站更有效展示平台</li>\r\n    <li>IE用户支持Xuploadfile大文件上传，让大文件上传更简单</li>\r\n    <li>招聘应聘功能的实现，促使企业更有效挖掘人才</li>\r\n    <li>简洁在线广告管理功能（熟悉的用户可以使用该功能的大量未实现的一些复杂的功能^o^）</li>\r\n</ul>\r\n<div>&nbsp;</div>'),
(2, 3, '<ol>\r\n    <li>首页链接：home.php</li>\r\n    <li>会员链接：my.php</li>\r\n    <li>招聘链接：job.php</li>\r\n    <li>会员注册：register.php</li>\r\n    <li>会员登录：login.php</li>\r\n    <li>列表页链接：list.php?id=[ID]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 查看方法：内容管理&gt;&gt;（文章／图片&hellip;&hellip;）分类</li>\r\n    <li>内页面链接：msg.php?id=[ID]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 查看方法：内容管理&gt;&gt;（文章／图片&hellip;&hellip;）信息管理，即可以看到</li>\r\n    <li>投票页链接：vote.php?id=[ID]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 查看方法：其他管理&gt;&gt;投票管理</li>\r\n    <li>单页面链接：special.php?id=[ID]&nbsp;&nbsp;&nbsp;&nbsp; 查看方法：其他管理&gt;&gt;单页面管理</li>\r\n    <li>留言本链接：book.php</li>\r\n</ol>\r\n<div>这是系统常用的链接页，感谢您对GOOTOP-CMS企业站的关注</div>'),
(3, 8, '<div>本信息是测试的下载信息，安装完后请删除或修改该主题</div>'),
(4, 5, '<div>\r\n<div>\r\n<div>\r\n<div>\r\n<div style="text-align: center"><img alt="" border="0" src="upfiles/200805/01/mark_1209626477_44.jpg" /></div>\r\n<div style="text-align: center">新闻文章列表</div>\r\n<div style="text-align: left">[:page:]</div>\r\n<div style="text-align: center">\r\n<div style="text-align: center"><img alt="" border="0" src="upfiles/200805/01/mark_1209627217_46.jpg" /></div>\r\n<div style="text-align: center">下载列表页</div>\r\n<div style="text-align: left">[:page:]</div>\r\n<div>\r\n<div style="text-align: center"><img alt="" border="0" src="upfiles/200805/01/mark_1209627372_20.jpg" /></div>\r\n<div style="text-align: center">图片列表页</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>'),
(5, 5, '<div>\r\n<div style="text-align: center"><img border="0" alt="" src="upfiles/200805/01/mark_1209626817_12.jpg" /></div>\r\n</div>'),
(6, 11, '<div>这里是产品的内容介绍页信息~~~</div>'),
(7, 12, '<div>这是测试产品二，安装后请修改或删除掉该信息</div>'),
(8, 14, '<div>This is Testing.....</div>\r\n<div>You can delete it.</div>'),
(9, 15, '<div>Business News Testing...</div>\r\n<div>Business News Testing...</div>\r\n<div>&nbsp;</div>\r\n<div>Business News Testing...</div>'),
(10, 23, '<div>demo</div>'),
(11, 23, '<div>demo 2</div>'),
(12, 17, '<div>\r\n<div style="text-align: center"><img border="0" alt="" src="upfiles/200805/01/mark_1209626817_12.jpg" /></div>\r\n<div style="text-align: center">demo</div>\r\n<div style="text-align: center">[:page:],</div>\r\n<div style="text-align: center"><img border="0" alt="" src="upfiles/200805/01/mark_1209626477_44.jpg" /></div>\r\n<div style="text-align: center">demo</div>\r\n</div>'),
(13, 18, '<div>\r\n<div style="text-align: center"><img border="0" alt="" src="upfiles/200805/01/mark_1209627372_20.jpg" /></div>\r\n,</div>'),
(14, 20, '<div>demo 001</div>');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_nav`
--

CREATE TABLE `qinggan_nav` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `css` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` tinyint(3) unsigned NOT NULL default '0',
  `taxis` tinyint(3) unsigned NOT NULL default '255',
  `language` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 导出表中的数据 `qinggan_nav`
--

INSERT INTO `qinggan_nav` (`id`, `name`, `css`, `url`, `target`, `taxis`, `language`) VALUES
(1, '网站首页', '', 'home.php', 0, 1, 1),
(2, '站内新闻', '', 'list.php?id=1', 0, 10, 1),
(3, '公司简介', '', 'special.php?id=1', 0, 20, 1),
(4, '图片展示', '', 'list.php?id=4', 0, 30, 1),
(5, '下载中心', '', 'list.php?id=7', 0, 40, 1),
(6, '产品展示', '', 'list.php?id=10', 0, 50, 1),
(7, '留言本', '', 'book.php', 0, 60, 1),
(8, '联系我们', '', 'special.php?id=2', 0, 70, 1),
(9, 'HOME', '', 'home.php', 0, 10, 2),
(10, 'NEWS', '', 'list.php?id=13', 0, 20, 2),
(11, 'Company Intro', '', 'special.php?id=4', 0, 30, 2),
(12, 'PICTURES', '', 'list.php?id=16', 0, 40, 2),
(13, 'DOWNLOAD', '', 'list.php?id=19', 0, 50, 2),
(14, 'PRODUCTS', '', 'list.php?id=22', 0, 60, 2),
(15, 'Book', '', 'book.php', 0, 70, 2),
(16, 'Contact Us', '', 'special.php?id=5', 0, 80, 2);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_notice`
--

CREATE TABLE `qinggan_notice` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `language` mediumint(8) unsigned NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '' COMMENT '公告链接的网址',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `qinggan_notice`
--

INSERT INTO `qinggan_notice` (`id`, `language`, `subject`, `url`, `content`, `postdate`) VALUES
(1, 1, '欢迎您使用GOOTOPCMS', '', '<div>如果您碰到任何问题，请登录：<a   href="www.gootopsoft.cn" target=''_blank''>www.gootopsoft.cn</a> 进行咨询</div>', 1209623070),
(2, 1, '欢迎进入GOOTOPCMS帮助论坛', '', '<div>官方论坛：<a   href="http://www.gootopsoft.cn" target=''_blank''>www.gootopsoft.cn</a> 您需要注册一个账号才能正常登录</div>', 1209623181),
(3, 2, 'DEMO 001', '', '<div>DEMO 001</div>', 1209650420),
(4, 2, 'DEMO 002', '', '<div>DEMO 002</div>', 1209650434);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_order`
--

CREATE TABLE `qinggan_order` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `sn` varchar(100) NOT NULL default '' COMMENT '订单唯一编号',
  `userid` mediumint(8) unsigned NOT NULL default '0' COMMENT '会员ID号，非会员为0',
  `user` varchar(255) NOT NULL default '' COMMENT '会员账号，非会员为联系人姓名',
  `msgid` mediumint(8) unsigned NOT NULL default '0' COMMENT '主题ID号，对msg表中的id，无关联为0',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题',
  `msgcount` varchar(30) NOT NULL default '0' COMMENT '订购数量',
  `unitprice` float unsigned NOT NULL default '0' COMMENT '商品单价',
  `totalprice` varchar(30) NOT NULL default '' COMMENT '商品总价格',
  `note` varchar(255) NOT NULL default '' COMMENT '简单的备注说明',
  `contactmode` varchar(100) NOT NULL default '' COMMENT '联系方式，可填写手机、电话或邮箱',
  `address` varchar(255) NOT NULL default '' COMMENT '联系地址',
  `zipcode` varchar(30) NOT NULL default '' COMMENT '邮政编码',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '操作时间',
  `email` varchar(255) NOT NULL default '' COMMENT '联系邮箱',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为未查看，1为已查看',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_order`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_special`
--

CREATE TABLE `qinggan_special` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是专题ID号',
  `typeid` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类ID号',
  `subject` varchar(255) NOT NULL default '' COMMENT '专题名称',
  `style` varchar(255) NOT NULL default '' COMMENT 'CSS样式',
  `content` text NOT NULL COMMENT '专题内容',
  `url` varchar(255) NOT NULL default '' COMMENT '跳转网址',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言分类',
  `ifcheck` tinyint(1) unsigned NOT NULL default '1' COMMENT '专题状态，0为锁定，1为正常',
  PRIMARY KEY  (`id`),
  KEY `typeid` (`typeid`),
  KEY `language` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='专题管理' AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `qinggan_special`
--

INSERT INTO `qinggan_special` (`id`, `typeid`, `subject`, `style`, `content`, `url`, `taxis`, `language`, `ifcheck`) VALUES
(1, 0, '公司简介', '', '<div>&nbsp;</div>\r\n<blockquote>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>公司简介信息页，请在后台：其他管理 》单页面管理 对内容进行编辑&hellip;&hellip;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</blockquote>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>', '', 10, 1, 1),
(2, 1, '联系我们', '', '<p style="margin-left: 40px">联系邮箱：</p>\r\n<blockquote dir="ltr" style="margin-right: 0px">\r\n<p style="margin-left: 40px"><a   target=''_blank''>max.zhang@gootop.net</a></p>\r\n</blockquote>\r\n<p dir="ltr" style="margin-left: 40px">联系QQ：</p>\r\n<blockquote dir="ltr" style="margin-right: 0px">\r\n<p dir="ltr" style="margin-left: 40px">435937201</p>\r\n<p dir="ltr" style="margin-left: 40px">435937201</p>\r\n</blockquote>\r\n<p dir="ltr" style="margin-left: 40px">联系电话：</p>\r\n<blockquote dir="ltr" style="margin-right: 0px">\r\n<p dir="ltr" style="margin-left: 40px">15900940447</p>\r\n<p dir="ltr" style="margin-left: 40px">13603513153（taiyuan）</p>\r\n</blockquote>\r\n<div>&nbsp;&nbsp;&nbsp;</div>', '', 20, 1, 1),
(4, 0, 'Company Intro', '', '<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>\r\n<div>Demo Demo...</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '', 10, 2, 1),
(5, 0, 'Contact Us', '', '<div>Contact Us</div>\r\n<div>Contact Us</div>\r\n<div>Contact Us</div>', '', 20, 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_sysgroup`
--

CREATE TABLE `qinggan_sysgroup` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是组ID号',
  `groupname` varchar(100) NOT NULL default '' COMMENT '组名称',
  `isext_url` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否自定义网址',
  `isext_docket` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否使用摘要',
  `isext_price` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否使用价格',
  `isext_standard` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否启用规格',
  `isext_number` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否启用编号',
  `isext_size` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否启用大小，一般用于软件下载',
  `isext_download` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否启用下载网址管理',
  `ext_0_name` varchar(255) NOT NULL default '' COMMENT '自定义字段0的名称',
  `ext_1_name` varchar(100) NOT NULL default '' COMMENT '自定义字段1的名称',
  `ext_2_name` varchar(100) NOT NULL default '' COMMENT '自定义字段2的名称',
  `ext_3_name` varchar(100) NOT NULL default '' COMMENT '自定义字段3的名称',
  `ext_4_name` varchar(100) NOT NULL default '' COMMENT '自定义字段4的名称',
  `ext_5_name` varchar(100) NOT NULL default '' COMMENT '自定义字段5的名称',
  `ext_6_name` varchar(100) NOT NULL default '' COMMENT '自定义字段6的名称',
  `ext_7_name` varchar(100) NOT NULL default '' COMMENT '自定义字段7的名称',
  `ext_8_name` varchar(100) NOT NULL default '' COMMENT '自定义字段8的名称',
  `ext_9_name` varchar(100) NOT NULL default '' COMMENT '自定义字段9的名称',
  `sign` varchar(50) NOT NULL default '' COMMENT '唯一标识',
  `tplindex` varchar(100) NOT NULL default '' COMMENT '默认封面模板',
  `tpllist` varchar(100) NOT NULL default '' COMMENT '默认列表模板',
  `tplmsg` varchar(100) NOT NULL default '' COMMENT '默认内容模板',
  `is_thumb` tinyint(1) unsigned NOT NULL default '1' COMMENT '是否启用内容',
  PRIMARY KEY  (`id`),
  KEY `sign` (`sign`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='组信息管理' AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `qinggan_sysgroup`
--

INSERT INTO `qinggan_sysgroup` (`id`, `groupname`, `isext_url`, `isext_docket`, `isext_price`, `isext_standard`, `isext_number`, `isext_size`, `isext_download`, `ext_0_name`, `ext_1_name`, `ext_2_name`, `ext_3_name`, `ext_4_name`, `ext_5_name`, `ext_6_name`, `ext_7_name`, `ext_8_name`, `ext_9_name`, `sign`, `tplindex`, `tpllist`, `tplmsg`, `is_thumb`) VALUES
(1, '文章', 0, 1, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'article', 'article.index.htm', 'article.list.htm', 'article.msg.htm', 1),
(2, '图片', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'picture', 'picture.index.htm', 'picture.list.htm', 'picture.msg.htm', 1),
(4, '产品', 0, 1, 1, 1, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', 'product', 'product.index.htm', 'product.list.htm', 'product.msg.htm', 1),
(3, '下载', 1, 1, 0, 0, 0, 1, 0, '软件语言', '授权方式', '系统平台', '', '程序演示', '官方网站', '联系信息', '', '', '', 'download', '', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_tpl`
--

CREATE TABLE `qinggan_tpl` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `name` varchar(255) NOT NULL default '' COMMENT '风格名称',
  `folder` varchar(255) NOT NULL default '' COMMENT '文件夹',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言ID',
  `isdefault` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否默认',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `qinggan_tpl`
--

INSERT INTO `qinggan_tpl` (`id`, `name`, `folder`, `taxis`, `language`, `isdefault`) VALUES
(1, '默认风格', 'default', 1, 1, 1),
(2, 'Default', 'default', 1, 2, 1),
(3, '水晶蓝', 'crystal_blue', 10, 1, 0),
(4, 'Crystal Blue', 'crystal_blue', 20, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_upfiles`
--

CREATE TABLE `qinggan_upfiles` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是附件的ID号',
  `filetype` varchar(10) NOT NULL COMMENT '文件格式，如jpg,gif等',
  `tmpname` varchar(255) NOT NULL default '' COMMENT '原文件名称，即在客户端显示的名称',
  `filename` varchar(255) NOT NULL default '' COMMENT '新文件名称，这是以时间及随机数整合生成的唯一值',
  `folder` varchar(255) NOT NULL default '' COMMENT '文件目录，基于网站的根目录的路径',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '上传时间',
  `thumbfile` varchar(255) NOT NULL default '' COMMENT '缩略图文件，假如附件是图片的话',
  `markfile` varchar(255) NOT NULL default '' COMMENT '水印图文件，假如附件是图片的话',
  PRIMARY KEY  (`id`),
  KEY `filetype` (`filetype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件管理' AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `qinggan_upfiles`
--

INSERT INTO `qinggan_upfiles` (`id`, `filetype`, `tmpname`, `filename`, `folder`, `postdate`, `thumbfile`, `markfile`) VALUES
(1, 'jpg', '001.jpg', '1209626477_44.jpg', 'upfiles/200805/01/', 1209626477, 'thumb_1209626477_44.jpg', 'mark_1209626477_44.jpg'),
(2, 'jpg', '002.jpg', '1209626817_12.jpg', 'upfiles/200805/01/', 1209626817, 'thumb_1209626817_12.jpg', 'mark_1209626817_12.jpg'),
(3, 'jpg', '003.jpg', '1209627217_46.jpg', 'upfiles/200805/01/', 1209627217, 'thumb_1209627217_46.jpg', 'mark_1209627217_46.jpg'),
(4, 'jpg', '004.jpg', '1209627230_51.jpg', 'upfiles/200805/01/', 1209627230, 'thumb_1209627230_51.jpg', 'mark_1209627230_51.jpg'),
(5, 'jpg', '005.jpg', '1209627277_32.jpg', 'upfiles/200805/01/', 1209627277, 'thumb_1209627277_32.jpg', 'mark_1209627277_32.jpg'),
(6, 'jpg', '006.jpg', '1209627372_20.jpg', 'upfiles/200805/01/', 1209627372, 'thumb_1209627372_20.jpg', 'mark_1209627372_20.jpg'),
(10, 'jpg', 'PHPOK2.jpg', '1209633952_1.jpg', 'upfiles/200805/01/', 1209633952, 'thumb_1209633952_1.jpg', 'mark_1209633952_1.jpg'),
(11, 'jpg', '1206403071_3.jpg', '1209635233_47.jpg', 'upfiles/200805/01/', 1209635233, 'thumb_1209635233_47.jpg', 'mark_1209635233_47.jpg'),
(12, 'jpg', '730_01_en.jpg', '1209644890_55.jpg', 'upfiles/200805/01/', 1209644890, 'thumb_1209644890_55.jpg', 'mark_1209644890_55.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `qinggan_user`
--

CREATE TABLE `qinggan_user` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user` varchar(100) NOT NULL default '',
  `nickname` varchar(255) NOT NULL default '',
  `realname` varchar(255) NOT NULL default '',
  `pass` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `phone` varchar(30) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `postmail` varchar(30) NOT NULL default '',
  `regdate` int(10) unsigned NOT NULL default '0' COMMENT '注册时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `qinggan_user`
--


-- --------------------------------------------------------

--
-- 表的结构 `qinggan_vote`
--

CREATE TABLE `qinggan_vote` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `voteid` mediumint(8) unsigned NOT NULL default '0' COMMENT '是否是主题，0为主题，其他ID为选项',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题或被选项名称',
  `vtype` enum('single','pl') NOT NULL default 'pl' COMMENT '投票类型，single单选，pl是复选',
  `vcount` int(10) unsigned NOT NULL default '0' COMMENT '票数',
  `language` mediumint(8) unsigned NOT NULL default '0' COMMENT '语言包ID',
  `ifcheck` tinyint(1) unsigned NOT NULL default '0' COMMENT '默认是否选中，0为不选中，1为选中',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `qinggan_vote`
--

INSERT INTO `qinggan_vote` (`id`, `voteid`, `subject`, `vtype`, `vcount`, `language`, `ifcheck`) VALUES
(1, 0, '您是从哪里知道GOOTOP-CMS的', 'pl', 0, 1, 0),
(2, 1, '从百度或Google等搜索到的', 'pl', 2, 1, 1),
(3, 1, '朋友介绍过来的', 'pl', 0, 1, 0),
(4, 1, '论坛贴子里看到了', 'pl', 1, 1, 0),
(5, 1, '从源码站里看到的', 'pl', 2, 1, 1),
(6, 1, '其他……', 'pl', 0, 1, 0),
(7, 0, 'Demo Vote', 'pl', 0, 2, 0),
(8, 7, 'Demo 001 Demo...', 'pl', 0, 2, 0),
(9, 7, 'Demo 002 My Demo...', 'pl', 0, 2, 1),
(10, 7, 'Demo 003', 'pl', 0, 2, 0),
(11, 7, 'Demo 004', 'pl', 0, 2, 0),
(12, 7, 'Demo 005 OK?', 'pl', 0, 2, 1);
