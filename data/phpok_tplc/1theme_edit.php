<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head","","0");?>
<script type="text/javascript" src="templates/zh/default/images/default.js"></script>
<style type="text/css">
.matrix_picker li.color_select {
	border:2px solid #00FF00;
}
#fullbg {
	background-color: Gray;
	display:none;
	z-index:3;
	position:absolute;
	left:0px;
	top:0px;
	filter:Alpha(Opacity=30);
	/* IE */
	-moz-opacity:0.4;
	/* Moz + FF */
	opacity: 0.4;
}
#dialog {
	background: none repeat scroll 0 0 #FFFFFF;
	border: 8px solid #00A7E1;
	color: #000000;
	display: none;
	left: 50%;
	position: absolute;
	text-align: left;
	top: 50%;
	z-index: 2000;
	width:430px;
	border-radius: 10px 10px 10px 10px;
}
#TB_closeAjaxWindow {
	float: right;
	margin-bottom: 1px;
	padding: 7px 10px 5px 0;
	text-align: right;
}
#TB_window a:link {
	color: #666666;
}
#TB_closeWindowButton, #TB_closeWindowButton2 {
	background: url("templates/zh/default/images/dialog-box-close.png") no-repeat scroll left top transparent;
	display: block;
	height: 54px;
	position: absolute;
	right: -25px;
	top: -25px;
	width: 54px;
}
#TB_ajaxContent {
	clear: both;
	line-height: 1.4em;
	overflow: auto;
	padding: 2px 15px 15px;
	text-align: left;
}
.TB_content_caption h2 {
	color: #0083CA;
	font-size: 15px;
	font-weight: bold;
}
#theme_name, #theme_name_rename {
	border-color: #7C7C7C #C3C3C3 #DDDDDD;
	border-radius: 10px 10px 10px 10px;
	border-style: solid;
	border-width: 1px;
	color: #333333;
	font-size: 150%;
	margin: 10px 0;
	padding: 0 5px;
	text-align: left;
	text-transform: capitalize;
	width: 97%;
}
.TB_content_button img.second {
	padding-right: 0;
}
.TB_content_button img {
	cursor: pointer;
	padding-right: 30px;
}
.TB_content_button img {
	cursor: pointer;
	padding-right: 30px;
}
#TB_window a:link {
	color: #666666;
}
a {
	text-decoration: underline;
}
#emf-form-theme-manager-wrap {
	padding-top: 10px;
	position: relative;
	width: 968px;
}
</style>

<div id="emf-form-theme-manager-wrap">
  <div class="form_edit">
    <div class="form_edit_theme_manager">
      <div class="form_edit_left_a" style="padding-top:50px;">
        <form name="form1" id="editUP" action="themeManage.php?act=editOK" method="post" >
          <div class="theme_lists" style="width:150px;">
            <label class="desc">主题</label>
            <br>
            <div id="operate"> 
              <?php if($id==0){?>
              <input type="text" name="subject" id="subject" style="width:150px;"/>
              <?php }else{ ?>
              <select name="subject" id="subject" style="width:150px;" onchange="getThemeId(jQuery(this).val());">
                <option value="0">新建主题</option>
                <?php $_i=0;$options=(is_array($options))?$options:array();foreach($options AS  $key=>$value){$_i++; ?>
                <option value="<?php echo $key;?>" <?php if($key==$id){?>selected<?php } ?>><?php echo $value;?></option>
                <?php } ?>
              </select>
              <?php } ?> 
            </div>
            
            <?php if($id==0){?>
            <input type="hidden" name="bg_wallpaper" value='{"color":"transparent"}'/>
            <input type="hidden" name="bg_header" value='{"color":"transparent"}'/>
            <input type="hidden" name="bg_form" value='{"color":"transparent"}'/>
            <input type="hidden" name="bg_field" value='{"color":"transparent"}'/>
            <input type="hidden" name="bg_highlight" value='{"color":"transparent"}'/>
            <input type="hidden" name="bg_instruction" value='{"color":"transparent"}'/>
            <input type="hidden" name="text_title" value='{"font":"Default","style":"bold","size":"12","color":"#000","weight":"bold"}'/>
            <input type="hidden" name="text_description" value='{"font":"Default","style":"bold","size":"12","color":"#000","weight":"bold"}'/>
            <input type="hidden" name="text_fieldtitle" value='{"font":"Default","style":"bold","size":"12","color":"#000","weight":"bold"}'/>
            <input type="hidden" name="text_fieldtext" value='{"font":"Default","style":"bold","size":"12","color":"#000","weight":"bold"}'/>
            <input type="hidden" name="text_instruction" value='{"font":"Default","style":"bold","size":"12","color":"#000","weight":"bold"}'/>
            <input type="hidden" name="border_form" value='{"thickness":"0","style":"solid","color":"transparent"}'/>
            
            <?php }else{ ?>
            <input type="hidden" name="bg_wallpaper" value='<?php echo $themeMsg[backgrounds][wallpaper1];?>'/>
            <input type="hidden" name="bg_header" value='<?php echo $themeMsg[backgrounds][header1];?>'/>
            <input type="hidden" name="bg_form" value='<?php echo $themeMsg[backgrounds][form1];?>'/>
            <input type="hidden" name="bg_field" value='<?php echo $themeMsg[backgrounds][field1];?>'/>
            <input type="hidden" name="bg_highlight" value='<?php echo $themeMsg[backgrounds][highlight1];?>'/>
            <input type="hidden" name="bg_instruction" value='<?php echo $themeMsg[backgrounds][instruction1];?>'/>
            <input type="hidden" name="text_title" value='<?php echo $themeMsg[text][title1];?>'/>
            <input type="hidden" name="text_description" value='<?php echo $themeMsg[text][description1];?>'/>
            <input type="hidden" name="text_fieldtitle" value='<?php echo $themeMsg[text][field_title1];?>'/>
            <input type="hidden" name="text_fieldtext" value='<?php echo $themeMsg[text][field_text1];?>'/>
            <input type="hidden" name="text_instruction" value='<?php echo $themeMsg[text][instruction1];?>'/>
            <input type="hidden" name="border_form" value='<?php echo $themeMsg[borders][form1];?>'/>
            <?php } ?>
            <input type="hidden" name="theme_id" value="<?php echo $id;?>" />
          </div>
          <div class="save_button">
            <div class="save_theme_button">
              <div onclick="javascript:jQuery('#editUP').submit();">保存主题</div>
            </div>
            <?php if($id>0){?>
            <div class="theme_button">
              <div class="button_wraper"> <span class="icon_rename"></span>
                <div class="button_name" style="cursor:pointer;" onclick="showBg();">重命名</div>
              </div>
              <div class="button_wraper"> <span class="icon_delete"></span>
                <div class="button_name" onclick="delTheme(jQuery('#subject').val());">删除</div>
              </div>
            </div>
            <?php } ?> 
          </div>
        </form>
      </div>
      <div class="form_bxk"> <img src="templates/zh/default/images/theme_mid_image.png" /> </div>
      <div>
      <div class="menu_level1">
        <div class="form_edit_sleft">
          <div class="desc_shit">属性</div>
          <ul class="properties" id="property" style="height:126px;">
            <li id="backgrounds">背景</li>
            <li id="texts">文本</li>
            <li id="borders">边框</li>
          </ul>
        </div>
        <div class="form_edit_sleft" style="display:none;">
          <div class="desc_shit"></div>
          <ul class="properties" id="typography" style="border:0px;">
          </ul>
        </div>
      </div>
      </div>
      <div class="menu_level3" style="display: none;">
        <div style="display: block;float:left;margin-right:10px;" id="theme_thickness" class="themeDiv">
          <div class="desc1">粗细:</div>
          <select class="select" size="7" onchange="changeProperty(jQuery(this).val());">
            
                        	<?php $sizeAry = array('0'=>'None','1'=>'Hairline','3'=>'Thin','5'=>'Medium','10'=>'Thick');;?>
                        		  <?php $k = 0;;?>
                        		  <?php $_i=0;$sizeAry=(is_array($sizeAry))?$sizeAry:array();foreach($sizeAry AS  $key=>$value){$_i++; ?>
            <option value="<?php echo $key;?>" <?php if($k==0){?>selected<?php } ?>><?php echo $value;?></option>
            
                        		  <?php $k++;;?>
                        		  <?php } ?>
          </select>
        </div>
        <div style="display: block;float:left;margin-right:10px;" id="theme_borderstyle" class="themeDiv">
          <div class="desc1">样式:</div>
          <select class="select" size="7" onchange="changeProperty(jQuery(this).val());">
            
                        	<?php $sizeAry = array('solid'=>'Solid','dotted'=>'Dotted','dashed'=>'Dashed','double'=>'Double');;?>
                        		  <?php $k = 0;;?>
                        		  <?php $_i=0;$sizeAry=(is_array($sizeAry))?$sizeAry:array();foreach($sizeAry AS  $key=>$value){$_i++; ?>
            <option value="<?php echo $key;?>" <?php if($k==0){?>selected<?php } ?>><?php echo $value;?></option>
            
                        		  <?php $k++;;?>
                        		  <?php } ?>
          </select>
        </div>
        <div style="display: block;float:left;margin-right:10px;" id="theme_font" class="themeDiv">
          <div class="desc1">字体:</div>
          <select class="select" size="7" onchange="changeProperty(jQuery(this).val());">
            
                        	<?php $sizeAry = array('Arial'=>'Arial','Courier New'=>'Courier','Default'=>'Default','Georgia'=>'Georgia','Trebuchet MS'=>'Trebuchet','Times New Roman'=>'Times','Verdana'=>'Verdana');;?>
                        		  <?php $k = 0;;?>
                        		  <?php $_i=0;$sizeAry=(is_array($sizeAry))?$sizeAry:array();foreach($sizeAry AS  $key=>$value){$_i++; ?>
            <option value="<?php echo $key;?>" <?php if($k==0){?>selected<?php } ?>><?php echo $value;?></option>
            
                        		  <?php $k++;;?>
                        		  <?php } ?>
          </select>
        </div>
        <div style="display: block;float:left;margin-right:10px;" id="theme_style" class="themeDiv">
          <div class="desc1">样式:</div>
          <select class="select" size="7" onchange="changeProperty(jQuery(this).val());">
            
                        	<?php $sizeAry = array('normal'=>'Normal','bold'=>'Bold','italic'=>'Italic');;?>
                        		  <?php $k = 0;;?>
                        		  <?php $_i=0;$sizeAry=(is_array($sizeAry))?$sizeAry:array();foreach($sizeAry AS  $key=>$value){$_i++; ?>
            <option value="<?php echo $key;?>" <?php if($k==0){?>selected<?php } ?>><?php echo $value;?></option>
            
                        		  <?php $k++;;?>
                        		  <?php } ?>
          </select>
        </div>
        <div style="display: block;float:left;margin-right:10px;" id="theme_size" class="themeDiv">
          <div class="desc1">字号:</div>
          <select class="select" size="7" onchange="changeProperty(jQuery(this).val());">
            
                        	<?php $sizeAry = array(10=>8,11=>9,12=>10,13=>11,14=>12,18=>14,20=>16,23=>18,31=>24);;?>
                        		  <?php $k = 0;;?>
                        		  <?php $_i=0;$sizeAry=(is_array($sizeAry))?$sizeAry:array();foreach($sizeAry AS  $key=>$value){$_i++; ?>
            <option value="<?php echo $key;?>" <?php if($k==0){?>selected<?php } ?>><?php echo $value;?></option>
            
                        		  <?php $k++;;?>
                        		  <?php } ?>
          </select>
        </div>
        <div style="display: block;float:left;margin-right:10px;" id="theme_color" class="themeDiv">
          <div class="desc1">颜色:</div>
          <ul class="matrix_picker">
            <li style="background-color: none;"><span></span></li>
            <?php $_i=0;$list=(is_array($list))?$list:array();foreach($list AS  $key=>$value){$_i++; ?>
            <li style="background-color:<?php echo $value[code];?>"></li>
            <?php } ?>
          </ul>
        </div>
        <div class="color_preview_wrap pattern_ext_menu" style="display: block;">
          <div class="color_preview" style="background-color:#00cc00;"></div>
          <input class="color_input" type="text" name="color_input" size="7" maxlength="7" value="#00cc00"/>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="form_emf_container_outer" >
      <div class="form_emf_container" style="border: 1px solid #999;">
        <div class="form_emf_container_a"> <a style="height: 40px;">EmailMeForm</a> </div>
        <div class="form_emf_container_b">
          <div class="form_emf_head_widget">
            <div class="form_emf_bold">Form Title</div>
            <div class="emf-form-description">This is your form description. Click here to edit.</div>
          </div>
          <ul>
            <li class="form_emf_li_field highlight-field">
              <label class="form_emf_label_desc">Name</label>
              <div class="emf-div-field"> <span>
                <input class="emf_input_w60" type="text" value="" name="">
                <label class="emf_block">First</label>
                </span> <span>
                <input class="emf_input_w100" type="text" value="" name="" style="width:100px;">
                <label class="emf_block">Last</label>
                </span> </div>
              <div class="emf-clear"></div>
            </li>
            <li class="form_emf_li_field" style="text-align:left">
              <label class="form_emf_label_desc"> Email <span>*</span> </label>
              <div class="emf-div-field">
                <input type="text" name="element_1" value="" size="30">
              </div>
              <div class="emf-clear"></div>
            </li>
            <li class="form_emf_li_field" style="text-align:left;width:100% !important;">
              <div class="emf-div-field-section">
                <div class="emf-section-separator" style=""></div>
                <h3>Section Name</h3>
                <div class="emf-section-text" style="">A description of the section goes here.</div>
              </div>
              <div class="emf-clear"></div>
            </li>
            <li class="form_emf_li_field" style="text-align:left;width:100% !important;">
              <label class="form_emf_label_desc" style="">Message</label>
              <div class="emf-div-field">
                <textarea cols="63" rows="5" >Hello World! This is your Field Text. </textarea>
                <p class="emf-div-instruction">Instructions for users are down here.</p>
              </div>
              <div class="emf-clear"></div>
            </li>
            <li class="emf-li-post-button">
              <input type="submit" value="Submit">
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- JS遮罩层 -->
<div id="fullbg"></div>
<!-- end JS遮罩层 --> 
<!-- 对话框 -->
<div id="dialog">
  <div id="TB_title" style="border-top-left-radius: 10px; border-top-right-radius: 10px;height:27px;">
    <div id="TB_closeAjaxWindow"> <a id="TB_closeWindowButton" href="javascript:void(0);" onclick="closeBg();"></a> </div>
  </div>
  <div id="TB_ajaxContent" style="width: 400px; height: 135px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
    <div class="TB_content">
      <form name="form2" id="themeUP" action="themeManage.php?act=rename" method="post" >
        <div class="TB_content_caption">
          <h2>请编辑主题名</h2>
          <input id="theme_name_rename" type="text" name="theme_name_rename"/>
          <input id="themeId" type="hidden" name="themeId"/>
        </div>
        <div class="TB_content_button" style="margin: 35px auto 0pt; text-align: center;"> <a class="upgrade" style="display:inline;" onclick="jQuery('#themeUP').submit();" href="javascript:void(0);"> <img src="templates/zh/default/images/dialog-box-button-save.png" /> </a> <img src="templates/zh/default/images/dialog-box-button-close.png" class="second" onclick="closeBg();" /> </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#property > li').bind('click',function(){
		jQuery('.menu_level3').hide();
		jQuery('.themeDiv').hide();
		jQuery(this).addClass('selected').siblings().removeClass();
		var property = jQuery(this).attr('id');
		var propertys = themes[property];
		
		var tar = jQuery('.form_edit_sleft').eq(1);
		jQuery('.desc_shit',tar).html(propertys['title']);
		var indexAry = propertys['index'].split(',');
		var valAry = propertys['value'].split(',');
		jQuery('#typography').empty();
		for(var i=0;i<indexAry.length;i++){
			var ele = '<li id="'+indexAry[i]+'">'+valAry[i]+'</li>';
			jQuery('#typography').append(ele);
		}
		
		jQuery('#typography > li').bind('click',function(){				
			var pt = jQuery('#property > .selected').attr('id');
			var ty = jQuery(this).attr('id');
			if(pt == 'backgrounds'){
				if(ty == 'wallpaper'){
					var val = jQuery('input[name="bg_wallpaper"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'header'){
					var val = jQuery('input[name="bg_header"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'forms'){
					var val = jQuery('input[name="bg_form"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'field'){
					var val = jQuery('input[name="bg_field"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'highlight'){
					var val = jQuery('input[name="bg_highlight"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'instruction'){
					var val = jQuery('input[name="bg_instruction"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}
				jQuery('.color_preview').css('background-color',jsonstr['color']);
				jQuery('.color_input').val(jsonstr['color']);
				
			}else if(pt == 'texts'){
				
				if(ty == 'title'){
					var val = jQuery('input[name="text_title"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'description'){
					var val = jQuery('input[name="text_description"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'field_title'){
					var val = jQuery('input[name="text_fieldtitle"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'field_text'){
					var val = jQuery('input[name="text_fieldtext"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}else if(ty == 'instructions'){
					var val = jQuery('input[name="text_instruction"]').val();
					if(val != 'null'){
						var jsonstr = eval("(" + val + ")");
					}
				}
				if(val != 'null'){
					jQuery('#theme_font > select').val(jsonstr['font']);
					jQuery('#theme_style > select').val(jsonstr['style']);
					jQuery('#theme_size > select').val(jsonstr['size']);
					jQuery('.color_preview').css('background-color',jsonstr['color']);
					jQuery('.color_input').val(jsonstr['color']);
				}
				
			}else if(pt == 'borders'){
				var val = jQuery('input[name="border_form"]').val();
				if(val != 'null'){
					var jsonstr = eval("(" + val + ")");
					jQuery('#theme_thickness > select').val(jsonstr['thickness']);
					jQuery('input[name="color_input"]').val(jsonstr['color']);
					jQuery('#theme_borderstyle > select').val(jsonstr['style']);
				}
			}

			jQuery(this).addClass('selected').siblings().removeClass();
			if(!propertys['size']){
				jQuery('#theme_size').hide();
			}else{
				jQuery('#theme_size').show();
			}
			if(!propertys['style']){
				jQuery('#theme_style').hide();
			}else{
				jQuery('#theme_style').show();
			}
			if(!propertys['thickness']){
				jQuery('#theme_thickness').hide();
			}else{
				jQuery('#theme_thickness').show();
			}
			if(!propertys['font']){
				jQuery('#theme_font').hide();
			}else{
				jQuery('#theme_font').show();
			}
			if(!propertys['borderstyle']){
				jQuery('#theme_borderstyle').hide();
			}else{
				jQuery('#theme_borderstyle').show();
			}
			jQuery('#theme_color').show();
			jQuery('.color_preview_wrap').show();
			jQuery('.menu_level3').show();
		});
		jQuery(tar).show();
		jQuery('.matrix_picker > li').bind('click',function(){
			if(qgIE == 'FF'){
				var actualColor = jQuery(this).css('background-color').match(/\d{1,3}/g);
				actualColor = (actualColor) ? rgbToHex(actualColor) : "transparent";  
			}else{
				var actualColor = jQuery(this).css('background-color');
				if(!actualColor){
					actualColor = "transparent";
				}
			}
			jQuery('.color_preview').css('background-color',actualColor);
			jQuery('.color_input').val(actualColor);
			jQuery('.matrix_picker > li').removeClass();
			jQuery(this).addClass('color_select');
			changeProperty();
		});
	});
	evalProperty();
});

//显示灰色JS遮罩层
function showBg(){
	jQuery('#themeId').val(jQuery('#subject').val());
	jQuery('#theme_name_rename').val(jQuery('#subject option[selected==""]').html());
	
	objWH = getObjWh('dialog');
	var tbT=objWH.split("|")[0]+"px";
	var tbL=objWH.split("|")[1]+"px";
	jQuery("#dialog").css({top:tbT,left:tbL,display:"block"});

	var bH=jQuery(document).height();
	var bW=jQuery(document).width();
	jQuery("#fullbg").css({width:bW,height:bH,display:"block"});
	
	//jQuery(window).scroll(function(){resetBg()});
	jQuery(window).resize(function(){resetBg()});
}

function getObjWh(obj){
	var st=document.documentElement.scrollTop;//滚动条距顶部的距离
	var sl=document.documentElement.scrollLeft;//滚动条距左边的距离
	var ch=document.documentElement.clientHeight;//屏幕的高度
	var cw=document.documentElement.clientWidth;//屏幕的宽度
	var objH=jQuery("#"+obj).height();//浮动对象的高度
	var objW=jQuery("#"+obj).width();//浮动对象的宽度
	var objT=Number(st)+(Number(ch)-Number(objH))/2-50;
	if(objT<0){objT = 5};
	var objL=Number(sl)+(Number(cw)-Number(objW))/2;
	return objT+"|"+objL;
}

function resetBg(){
	var fullbg=jQuery("#fullbg").css("display");
	if(fullbg=="block"){
		var bH2=jQuery(document).height();
		var bW2=jQuery(document).width();
		jQuery("#fullbg").css({width:bW2,height:bH2});
		var objV=getObjWh("dialog");
		var tbT=objV.split("|")[0]+"px";
		var tbL=objV.split("|")[1]+"px";
		jQuery("#dialog").css({top:tbT,left:tbL});
	}
}

//关闭灰色JS遮罩层和操作窗口
function closeBg(){
	jQuery("#fullbg").css("display","none");
	jQuery("#dialog").css("display","none");
}
function delTheme(id){
	window.location = GM.RootScript+'/themeManage.php?act=del&id='+id;
}
</script>
<div style="clear:both"></div>
<?php QG_C_TEMPLATE::p("inc.foot","","0");?>