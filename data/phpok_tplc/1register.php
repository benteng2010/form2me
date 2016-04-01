<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head_web","","0");?>
<div class="register_title">
  <div class="reg_bt"> <img src="templates/zh/default/images/zzc2.jpg" /> </div>
</div>
<div id="content" style="border:0px;">
  <div class="contents">
    <div class="contents_left">
      <div class="maincon">
        <div class="txt">
          <h2 class="subtitle2">给我发电子邮件表格注册</h2>
        </div>
        <div class="formArea">
          <form id="sign_up_form" class="sign_up_form" action="register.php?act=regok" method="post" onSubmit="return checkServer();">
            <p class="p_right">
              <label>用户名:</label>
              <input type="text" id="username" class="sign-aax" name="username" />
            </p>
            <p class="p_right">
              <label>密码:</label>
              <input type="password" id="password" class="sign-aax" name="password" />
            </p>
            <p class="p_right">
              <label>确认密码:</label>
              <input type="password" id="retypePassword" class="sign-aax" name="retypePassword" />
            </p>
            <p class="p_right">
              <label>您的电子邮件:</label>
              <input type="text" id="ContactEmail" class="sign-aax" name="ContactEmail" />
            </p>
            <p class="p_right">
              <label>确认电子邮件:</label>
              <input type="text" id="ConfirmContactEmail" class="sign-aax" name="ConfirmContactEmail" onpaste="return false;" />
            </p>
            <p class="alttype">
              <input type="checkbox" id="termsofservice" name="termsofservice" class="chk" />
              <label>我同意From2.Me  <a href="#" target="_blank">服务条款</a></label>
              <input type="image" src="templates/zh/default/images/mfzcs.png" style="float:right;margin-right:30px;" class="signup"  />
              <div class="clear"></div>
            </p>
            <div class="txt">
              <p> 如果你已经签署了，但还没有收到您的确认电子邮件。请点击这里重新发送确认电子邮件。 </p>
            </div>
          </form>
        </div>
        <h3 class="subtitle22">短隐私政策:</h3>
        <ol class="defaultlist">
          <li>1、我们保留所有您的个人信息秘密。我们绝对讨厌垃圾邮件，所以我们没有垃圾邮件。</li>
          <li>2、我们不卖，租金也不是由我们的服务处理垃圾邮件的任何电子邮件地址，如需更详细的
   			版本，请参阅：<a href="#">隐私政策</a></li>
        </ol>
      </div>
    </div>
    <div class="contents_right">
      <div class="contents_weibo" style="top:-7px;"> <a href="#" class="xlwb">新浪微博</a> <a href="#" class="tewb">腾讯微博</a> </div>
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
            <p class="login_wjmm"> <span>
              <input class="loginbtn" type="image" src="templates/zh/default/images/login_an.jpg"  />
              </span> <a href="login.php?act=forget">忘记密码</a> </p>
          </form>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="w1">
      <div class="w2">
        <p class="w3"> <span><a href="#" class="w1_06"></a></span> 没有网站亦可使用： </p>
        <p class="w4"> 有时候，您只是希望发送一个邮件给客户进行订购表、调查表、邀请函等，这时，使用我们的Form2.me吧，您不需要建立网页，直接拷贝我们提供的代码到邮件中即可使用。 </p>
      </div>
      <div class="w5"> <img src="templates/zh/default/images/w1_03.jpg" /> </div>
    </div>
  </div>
</div>
<?php QG_C_TEMPLATE::p("inc.foot_web","","0");?>
<script type="text/javascript">
function checkServer() {
	if(jQuery('#username').val() == ''){
		GM.pop(jQuery('#username'),"请输入用户名.",false,37,-430);
	}
	if(jQuery('#password').val() == ''){
		GM.pop(jQuery('#password'),"请输入密码.",false,37,-430);
	}
	if(jQuery('#retypePassword').val() == ''){
		GM.pop(jQuery('#retypePassword'),"请确认密码.",false,37,-430);
	}
	if(jQuery('#retypePassword').val() != jQuery('#password').val()){
		GM.pop(jQuery('#retypePassword'),"两次密码输入不一致.",false,37,-430);
	}
	if(jQuery('#ContactEmail').val() == ''){
		GM.pop(jQuery('#ContactEmail'),"请输入邮箱地址.",false,37,-430);
	}
	if(jQuery('#ConfirmContactEmail').val() == ''){
		GM.pop(jQuery('#ConfirmContactEmail'),"请确认密码.",false,37,-430);
	}
	if(jQuery('#ContactEmail').val() != jQuery('#ConfirmContactEmail').val()){
		GM.pop(jQuery('#ConfirmContactEmail'),"两次密码输入不一致.",false,37,-430);
	}
	if(jQuery('#termsofservice').attr('checked')){
		return true;
	}else{
		return false;
	}
}

</script>