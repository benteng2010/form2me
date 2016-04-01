<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head_web","","0");?>
<div id="banner">
	<div class="banners">
    	<div class="banner_left">
        	<div class="banner_text">
            	<p class="banner_t">
                	From2.m<br />
					自助邮件表单
                </p>
                <p class="banner_e">
                	个人用户可以免费使用<br />
					自助表单生成器 生成你的自定义表单
                </p>
                <div class="banner_x">
                	<a href="#" class="yssp"></a>
                    <a href="register.php" class="mfzc"></a>
                </div>
            </div>
        </div>
        <div class="banner_right">
        	<a href="#"><img src="templates/zh/default/images/banner_img.jpg" /></a>
        </div>
    </div>
</div>
<div id="content">
	<div class="contents">
    	<div class="contents_left">
        	<div class="zdybd">
            	<h1>激活网站服务，Form2Me：自由定制网站表单</h1>
                <h2>什么是Form（表单）？</h2>
                <p>
                　　几乎公司网站都有"留言板"，留言板其实就是一种表单，它和一般页面的区别是表单用于数据的提交和收集。这也意味着表单后台有一个数据库在收集整理表单数据。<br />
                　　表单除了在网站使用，亦可由邮件等独立页面来使用。
                </p>
            </div>
            <div class="wsmxybd">
            	<h2>为什么需要Form2.me表单？</h2>
                <ul class="wsmxybd_ul">
                	<li class="wsmx_1">
                    	<h3>无需编程经验：</h3>
                        　　表单不只有在线留言板一种，当一个公司的网站做好后，有时需要更多的互动表单，例如在线报告、优惠领取、活动征集、招生招聘、表格填报……这些复杂的表单如果可以在线提交，会给网站营销带来巨大的好处。但是，网站管理员会发现，当您需要这些表单的时候，往往需要重新请人对网站二次开发。
                    </li>
                    <li class="wsmx_2">
                        　　有了Form2Me，你随时可以在线订制各种复杂的Form表单，并把它们插入到你的页面中即可使用。它不但解决了表单设计的问题，还解决了表单收集、整理分析的问题，它使用我们强大的邮件服务器，即时把客户的提交发送到你的邮箱，它还提供了整个表单的后台数据备份，你随时可以把表单数据导出并整理使用。
                    </li>
                    <li class="wsmx_3">
                            　　我们提供可以自定义更多字段，更复杂的表单，如询价函或者报名表之类的。<br />
                        　　我们提供集中服务的邮件系统，确保你可以收到客户提交的表单，而免去邮箱设置的问题。另外客户提交表单后收到回复确认邮件，会更安心的使用表单服务。<br />
                        　　所有表单数据库有集中管理的后台系统，供随时查阅、导出。
                    </li>
                </ul>
            </div>
        </div>
        <div class="contents_right">
        	<div class="contents_weibo">
            	<a href="#" class="xlwb">新浪微博</a>
                <a href="#" class="tewb">腾讯微博</a>
            </div>
            <div class="index_login">
            	<ul class="login_menu">
                	<li><a href="#" class="login_hover">登　录</a></li>
                    <li><a href="register.php">快速注册</a></li>
                </ul>
                <div class="clear"></div>
                <div class="login_i">
                <form name="logon_form" action="login.php?act=loginok" method="post">
                	<p class="login_dl">
                    	<input name="username" class="login_a" type="text" value="username"  onfocus="if(this.value=='username')this.value='';" onblur="if(this.value=='')this.value='username';" />
                    </p>
                    <p class="login_mm">
                    	<input name="password" class="login_a" type="password" value="password"  onfocus="if(this.value=='password')this.value='';" onblur="if(this.value=='')this.value='password';" />
                    </p>
                    <p class="login_wjmm">
                    	<span><input class="loginbtn" type="image" src="templates/zh/default/images/login_an.jpg"  /></span>
                    	<a href="login.php?act=forget">忘记密码</a>
                    </p>
                    </form>
                </div>								
            </div>
            <div class="clear"></div>
            <div class="index_r1"></div>
            <div class="index_r2"></div>
            <div class="zzk">
            	<a>张知楷</a>
                <p>上海谷铂软件有限公司总经理</p>
            </div>
        </div>
        <div class="clear"></div>
        <div class="w1">
            <div class="w2">
                <p class="w3">
                	<span><a href="#" class="w1_06"></a></span>
                	没有网站亦可使用：
                </p>
                <p class="w4">
                	有时候，您只是希望发送一个邮件给客户进行订购表、调查表、邀请函等，这时，使用我们的Form2.me吧，您不需要建立网页，直接拷贝我们提供的代码到邮件中即可使用。
                </p>
            </div>
            <div class="w5">
            	<img src="templates/zh/default/images/w1_03.jpg" />
            </div>
        </div>
    </div>
</div>
<?php QG_C_TEMPLATE::p("inc.foot_web","","0");?>