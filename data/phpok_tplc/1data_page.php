<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head","","0");?>

<script type="text/javascript">
function getIdList(obj){
	var tar = jQuery('.gview_list_table tr:not(.gview_list_td_title)');
	if(jQuery(obj).attr('checked')==true){
		jQuery('input[type="checkbox"]', tar).attr('checked',true);
	}else{
		jQuery('input[type="checkbox"]', tar).attr('checked',false);
	}
}
function changeContent(obj){
	var id = jQuery(obj).attr('id');
	getContent(obj,id);
}

function getNext(str){
	var num = str.replace('#','');
	var len = jQuery('.gview_list_table tr:not(:first)').length;
	if(num > 1){
		num = num - 1;	
		var tar = jQuery('.gview_list_table tr:not(:first)').eq(len-num);
	}else{
		var tar = jQuery('.gview_list_table tr:not(:first)').eq(0);
	}
	var id = jQuery(tar).attr('id');
	getContent(tar,id);
}
function getPrev(str){
	var num = str.replace('#','');
	var len = jQuery('.gview_list_table tr:not(:first)').length;
	if(jQuery('.gview_list_table tr:not(:first)').eq(len-num).prev().hasClass('gview_list_td_title')){
		var tar = jQuery('.gview_list_table tr:not(:first)').eq(len-1);
	}else{
		var tar = jQuery('.gview_list_table tr:not(:first)').eq(len-num-1);
	}
	var id = jQuery(tar).attr('id');
	getContent(tar,id);
}
function getContent(obj,id){
	var num = jQuery('td', obj).length;
	for(var i=1;i<num;i++){
		var k = i - 1;
		var val = jQuery('td', obj).eq(i).html();
		jQuery('#element_'+k).html(val);
	}
	jQuery('input[name="data_id"]').val(id);
	jQuery('.gview_list_table tr:not(.gview_list_td_title)').css('background','url(templates/zh/default/images/ui-bg_highlight-soft_100_eeeeee_1x100.png) repeat-x scroll 50% top #FFE45C');
	jQuery(obj).css('background','url(templates/zh/default/images/ui-bg_highlight-soft_75_ffe45c_1x100.png) repeat-x scroll 50% top #FFE45C');
	jQuery.ajax({
		url:GM.RootScript + '/dataManage.php?act=getsubmiter&id='+id,
		type:'GET',
		dataType:'json',
		success:function(data){
			jQuery('#submit_time').html(data['created']);
			jQuery('#td_ip').html(data['ip']);
			jQuery('.comments').empty();
			if(data['num']>0){
				for(var i=0;i<data['clist'].length;i++){
					var ele = '<li style="margin:5px 0 0 5px;width:460px;border:1px dashed #000;float:left;padding:5px;">';
    				ele += '<span><b style="color:#00A7E1;font-size:12px;">'+data['clist'][i]['FormDataComment']['name']+'</b>&nbsp;&nbsp;';
    				ele += '<b style="color:black;font-size:12px;">'+data['clist'][i]['FormDataComment']['created']+'</b></span>';
    				ele += '<p style="font-size:12px;">'+data['clist'][i]['FormDataComment']['content']+'</p>';
    				ele += '</li>';
    				jQuery('.comments').append(ele);
				}
			}
			jQuery('.comhdr').html(data['num']+'条评论');
			jQuery('#row_id').html('#'+jQuery(obj).attr('trkey'));
		}
	});
}

function doDelete(type) {
	if(type == 'all'){
		var tar = jQuery('.gview_list_table tr:not(.gview_list_td_title)');
		if(jQuery('input[type="checkbox"][checked]', tar).length > 0){
			jQuery('#delUP').submit();
		}else{
			alert('请选择要删除的数据');
			return false;
		}
	}else{
		var id = jQuery('input[name="data_id"]').val();
		if(confirm('是否删除此数据？')==true){
			if(id > 0){
				jQuery.ajax({
					url:GM.RootScript+'/dataManage.php?act=deleteOne&id='+id,
					type:'GET',
					success:function(data){
						window.location.href = GM.RootScript + '/dataManage.php?fid=<?php echo $fid;?>';
					}			
				});
			}else{
				return false;
			}
		}
	}
}
function editData() {
	var id = jQuery('input[name="data_id"]').val();
	if(id > 0){
		jQuery.ajax({
			url:GM.RootScript+'/dataManage.php?act=getFormContent&fid=<?php echo $fid;?>',
			type:'GET',
			success:function(data){
				jQuery('.TB_content').empty().html(data);
				var tar = jQuery('#'+id);
				var len = jQuery('td:not(:first)',tar).length;
				for(var i=0;i<len;i++){
					if(jQuery('#emf-li-'+i).attr('typename')=='select'){
						jQuery('select[name="element_'+i+'"]').val(jQuery('td:not(:first)',tar).eq(i).html());
					}else if(jQuery('#emf-li-'+i).attr('typename')=='textarea'){
						jQuery('textarea[name="element_'+i+'"]').val(jQuery('td:not(:first)',tar).eq(i).html());
					}else if(jQuery('#emf-li-'+i).attr('typename')=='checkbox'||jQuery('#emf-li-'+i).attr('typename')=='radio'){
						for(var j=0;j<jQuery('#emf-li-'+i+' input').length;j++){
							var substring = jQuery('#emf-li-'+i+' input').eq(j).val();
							var s = jQuery('td:not(:first)',tar).eq(i).html().indexOf(substring);
							if(s >= 0){
								jQuery('#emf-li-'+i+' input').eq(j).attr('checked',true);
							}else{
								jQuery('#emf-li-'+i+' input').eq(j).attr('checked',false);
							}
						}
					}else{
						jQuery('input[name="element_'+i+'"]').val(jQuery('td:not(:first)',tar).eq(i).html());
					}
				}
				jQuery('#submitUP').attr('action',GM.RootScript+'/dataManage.php?act=modify&id='+id);
				showBg();
			}
		});
	}else{
		alert('请选择一条数据');
		return false;
	}
}
function addData(){
	jQuery.ajax({
		url:GM.RootScript+'/dataManage.php?act=getFormContent&fid=<?php echo $fid;?>',
		type:'GET',
		success:function(data){
			jQuery('.TB_content').empty().html(data);
			jQuery('#submitUP').attr('action',GM.RootScript+'/dataManage.php?act=add');
			showBg();
		}
	});
}
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
function printData() {
	var id = jQuery('input[name="data_id"]').val();
	if(id > 0){
		window.open(GM.RootScript+'/dataManage.php?act=dataPrint&id='+id);
	}else{
		alert('请选择一条数据');
		return false;
	}
}
function emailData() {
	var id = jQuery('input[name="data_id"]').val();
	if(id > 0){
		var ele = '<div align="center"><form name="form1" action="'+GM.RootScript+'/dataManage.php?act=dataEmail&fid=<?php echo $fid;?>" method="POST">';
		ele += '<b>您的邮箱</b><input type="text" name="email" /><input type="hidden" name="id" value="'+id+'"/>　<input type="submit" value="发送"/>';
		ele += '</form></div>';
		jQuery('.TB_content').append(ele);
		showBg();
	}else{
		alert('请选择一条数据');
		return false;
	}
}
function setcolumns(){
	jQuery.ajax({
		url:GM.RootScript+'/dataManage.php?act=setcolumns&fid=<?php echo $fid;?>',
		type:'GET',
		dataType:'json',
		success:function(data){
		    var str = a ='';
		    jQuery('.gview_list_td_title .tdShow').each(function(k){
			    str += a + (jQuery(this).index() - 1);
			    a = ',';
		    });
		    var ele = '<div style="float:left;width:610px;margin-left:20px;">请选择所要显示的字段名</div>';
			ele += '<ul style="float:left;border:1px solid #000;width:610px;height:280px;margin-left:20px;margin-top:10px;" id="columns">';
			for(var i=0;i<data.length;i++){
				
				ele += '<li style="float:left;width:200px;">';
				if(str.indexOf(i) >= 0){
					ele += '<input type="checkbox" value="'+i+'" checked>'+data[i]['field_name'];
				}else{
					ele += '<input type="checkbox" value="'+i+'">'+data[i]['field_name'];
				}
				ele += '</li>';
			}
			ele += '</ul>';
			ele += '<div style="float:left;margin:10px 10px 0px 480px;">';
			ele += '<a id="dData" class="state-default" href="javascript:void(0)" onclick="showcolumns();">Ok　<span class="icon"></span></a>　';
			ele += '<a id="eData" class="state-default" href="javascript:void(0)" onclick="javascript:closeBg();">Cancel<span class="icon"></span</a>'
			ele += '</div>';
			jQuery('.TB_content').empty().append(ele);
			showBg();
		}
	});
}
function showcolumns(){
	var len = jQuery('.gview_list_table tr').length;
	var ary = new Array();
	jQuery('#columns input[checked==""]').each(function(i){
		if(i<3){
			var index = jQuery(this).val();
			ary[i] = index;
		}
	});
	for(var j=0;j<len;j++){
		var tar = jQuery('.gview_list_table tr').eq(j);
		jQuery('td:not(:first)', tar).removeClass().addClass('tdHidden');
		for(var k=0;k<ary.length;k++){
			jQuery('#line_'+j+'_td_'+ary[k], tar).removeClass().addClass('tdShow');
		}
	}
	closeBg();
}
</script>

<style type="text/css">
#product_page span{
    color: #8CC63F;
    display: block;
    float: left;
    font-family: Arial;
    font-size: 17px;
    margin: 2px 3px;
    text-decoration: none;
	cursor:pointer;
}
.next {
    background-image: url("templates/zh/default/images/navi.gif");
    background-position: right bottom;
    background-repeat: no-repeat;
    height: 18px;
    width: 9px;
}
.prev {
    background-image: url("templates/zh/default/images/navi.gif");
    background-position: left bottom;
    height: 18px;
    width: 9px;
}
#fullbg{
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
	width:700px;
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
.tdHidden {display:none;}
.tdShow {display:table-cell;}
.state-default {
    background: url("templates/zh/default/images/ui-bg_glass_100_f6f6f6_1x400.png") repeat-x scroll 50% 50% #F6F6F6;
    border: 1px solid #CCCCCC;
    color: #1C94C4;
    font-weight: bold;
    outline: medium none;
    cursor: pointer;
    display: inline-block;
    margin: 0 4px 0 0;
    padding-left:20px;
    padding-right:5px;
    position: relative;
    text-align: center;
    text-decoration: none !important;
    border-radius: 4px 4px 4px 4px;
    font-size:11px;
}
.state-default .icon {
	background-position: -96px -112px;
    background-image: url("templates/zh/default/images/ui-icons_ef8c08_256x240.png");
    left: 0.2em;
    margin-left: 0;
    margin-top: -8px;
    position: absolute;
    right: auto;
    top: 50%;
    height: 16px;
    width: 16px;
    background-repeat: no-repeat;
    display: block;
    overflow: hidden;
    text-indent: -99999px;
}
</style>

  <div class="mainbody pt20">
    <div class="result">
      <div class="resultin">
        <div class="resultdeep">
          <div class="leftcon">
            <div class="boxhdr" style="position: relative;z-index:10;">
              <h2> <img src="templates/zh/default/images/result-icon.gif" /> <span>数据管理</span> </h2>
              <div class="page"> 
              	<span id="product_page"> <?php echo $pagelist;?> </span> 
              </div>
              <img src='templates/zh/default/images/plus-icon.gif' id='plus_icon' style="position: absolute;top:41px;right:-1px;z-index:1000;" onclick='setcolumns();' />
             </div>
            <form name="form1" id="delUP" action="dataManage.php?act=del" method="post" style="margin:0px; padding:0px;" >
            <div id="gbox_list1" class="ui-jqgrid ui-widget ui-widget-content ui-corner-all" style="width: 465px;">
              <div id="gview_list1" class="ui-jqgrid-view" style="width: 465px;">
              	<table border="0" cellspacing="0" cellpadding="0" class="gview_list_table" style="width:465px;">
                  <tr class="gview_list_td_title">
                    <td width="50"><input name="" type="checkbox" value="" onclick="getIdList(jQuery(this));"/>
                      # </td>
                   
                        <?php $_i=0;$fieldlist=(is_array($fieldlist))?$fieldlist:array();foreach($fieldlist AS  $key=>$value){$_i++; ?>
                    		<?php if($key < 3){?>
								<td id="line_0_td_<?php echo $key;?>" class="tdShow"><?php echo $value[field_name];?></td>
                    		<?php }else{ ?>
                    			<td id="line_0_td_<?php echo $key;?>" class="tdHidden"><?php echo $value[field_name];?></td>
                    		<?php } ?>
						<?php } ?>
                  </tr>
   
                <?php $count = count($data);;?>
                <?php $_i=0;$data=(is_array($data))?$data:array();foreach($data AS  $key=>$value){$_i++; ?>
               		<?php if($key==0){?>
                    <tr onclick="changeContent(jQuery(this));" id="<?php echo $value[id];?>" trkey="<?php echo $count;?>" style="background:url('templates/zh/default/images/ui-bg_highlight-soft_75_ffe45c_1x100.png') repeat-x scroll 50% top #FFE45C;">
                	<?php }else{ ?>
                    <tr onclick="changeContent(jQuery(this));" id="<?php echo $value[id];?>" trkey="<?php echo $count;?>" style="background:url('templates/zh/default/images/ui-bg_highlight-soft_100_eeeeee_1x100.png') repeat-x scroll 50% top #FFE45C;">
                	<?php } ?>
                        <td><input name="idlist[]" type="checkbox" value="<?php echo $value[id];?>" /> <?php echo $count--;;?></td>
                        <?php  $ary = unserialize($value['form_data']);$k = 0;;?>
                        <?php $_i=0;$ary=(is_array($ary))?$ary:array();foreach($ary AS  $v){$_i++; ?>
                        <?php if(gettype($v)=='array'){?><?php $v = implode(',',$v);;?><?php } ?>
                        <?php if($k<3){?>
                        <td id="line_<?php echo $key+1;?>_td_<?php echo $k;?>" class="tdShow"><?php echo $v;?></td>
                        <?php }else{ ?>
                        <td id="line_<?php echo $key+1;?>_td_<?php echo $k;?>" class="tdHidden"><?php echo $v;?></td>
                        <?php } ?>
                        <?php $k++;;?>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </table>
              </div>
            </div>
            <div class="btncon">
            	<input type="hidden" name="fid" value="<?php echo $fid;?>" />
                <a href="javascript:void(0);" onclick="doDelete('all');"><img src="templates/zh/default/images/deletebtn.gif" /></a>
                <a href="javascript:void(0);" ><img src="templates/zh/default/images/exportbtn.gif" /></a>
            	<div class="clear"></div>
            </div>
            </form>
          </div>
          <div class="rightcon">
        	<div class="topbtn">
            	<a href="javascript:void(0);" onclick='addData();'><img src="templates/zh/default/images/btn-new.gif" /></a>
                <a href="javascript:void(0);" onclick='editData();'><img src="templates/zh/default/images/btn-edit.gif" /></a>
                <a href="javascript:void(0);" onclick='emailData();'><img src="templates/zh/default/images/btn-email.gif" /></a>
                <a href="javascript:void(0);" onclick='printData();'><img src="templates/zh/default/images/btn-print.gif" /></a>
                <a href="javascript:void(0);" onclick="doDelete('one');"><img src="templates/zh/default/images/btn-delete.gif" /></a>
            </div>
            <div class="bar">
                <a class="btnprev" href="javascript:void(0);" onclick="getPrev(jQuery('#row_id').html());">Prev</a>
                <h2 class="msg2">
                    <span id="row_id">#<?php echo count($data);;?></span>
                    <?php echo $formMsg[form_title];?>
                </h2>
                <a class="btnnext" href="javascript:void(0);" onclick="getNext(jQuery('#row_id').html());">Next</a>
            </div>
            <?php if(count($data)>0){?>
            <div id="submitted_data" class="submitted_data_a" style="padding-top:5px;padding-bottom:10px;">
            	<?php  $ary = $data?unserialize($data[0]['form_data']):'';;?>
            	<table width="100%" align="center">
                	<?php $_i=0;$fieldlist=(is_array($fieldlist))?$fieldlist:array();foreach($fieldlist AS  $key=>$value){$_i++; ?>
       				<tr>
						<td align="left" style="height:30px;width:233px;padding-left:30px"><b><?php echo $value[field_name];?></b></td>
						<td>&nbsp;</td>
						<td id="element_<?php echo $key;?>" align="left"><?php echo (isset($ary['element_'.$key])?(gettype($ary['element_'.$key])=='array'?implode(',',$ary['element_'.$key]):$ary['element_'.$key]):'');?></td>
					</tr>
					<?php } ?>
                    
                </table>
                <br>
            </div>
            <div class="infobar" style="border-radius: 10px 10px 10px 10px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td width="3%" align="left"></td>
                        <td width="55%" align="left">
                            <span style="color:gray">创建时间: </span>
                            <strong>
                                <font style="font-weight:bold;" id="submit_time"><?php  echo $data?$data[0]['created']:'';;?></font>
                            </strong>
                        </td>
                        <td width="2%">
                        	<span style="color:gray">IP:</span>
                        </td>
                        <td width="" id="td_ip"><?php  echo $data?$data[0]['ip']:'';?></td>
                    </tr>
                </table>
            </div>
            <span class="comhdr"><?php echo $cnum;?>条评论</span>
            <ul class="comments">
                <?php if(!empty($clist)){?>
            			foreach($clist AS $key=>$value){
                        <?php $_i=0;$clist=(is_array($clist))?$clist:array();foreach($clist AS  $key=>$value){$_i++; ?>
            				<li style="margin:5px 0 0 5px;width:460px;border:1px dashed #000;float:left;padding:5px;">
                                <span><b style="color:#00A7E1;font-size:12px;"><?php echo $value['name'];?></b>&nbsp;&nbsp;
                                <b style="color:black;font-size:12px;"><?php echo $value['created'];?></b></span>
                                <p style="font-size:12px;"><?php echo $value['content'];?></p>
            				</li>
            			<?php } ?>
            	<?php } ?>
            </ul>
            <div class="commarea">
                <form name="formComment" id="commentUP" action="dataManage.php?act=commentSubmit&fid=<?php echo $fid;?>" style="margin:0px;padding:0px;" method="post" >
                <div class="commareain">
                    <div class="commareadeep">
                        <p>
                            <label>评论内容</label>
                            <textarea id="comment_text" rows="7" cols="30" style="resize:none" name="comment_text"></textarea>
                        </p>
                        <p>
                            <label>您的姓名</label>
                            <input id="comment_name" type="text" name="comment_name" />
                            <input type="hidden" name="data_id" value="<?php echo $data?$data[0]['id']:0;;?>" />
                        </p>
                    <input type="image" class="btnsubmit" src="templates/zh/default/images/submitbtn.gif" />
                    </div>
                </div>
                </form>
            </div>
            <?php } ?>
        </div>
        </div>
      </div>
    </div>
  </div>

<p>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</p>
<div id="footer">
	<div id="footer-nav">
        <a href="http://www.emailmeform.com/about-us.html">About</a>
        |
        <a href="http://www.emailmeform.com/builder/templates">Templates</a>
        |
        <a href="http://www.emailmeform.com/v-terms.html">Terms</a>
        |
        <a href="http://www.emailmeform.com/v-privacy.html">Privacy</a>
        |
        <a href="http://www.emailmeform.com/builder/onlineform/sendfeedback_logged">Contact</a>
    </div>
    <p>Copyright &copy; 2006-2011 EmailMeForm. All rights reserved. EMF-02-07-4708 iad6fwa03p</p>
</div>
</div>
</div>

<!-- JS遮罩层 -->
<div id="fullbg"></div>
<!-- end JS遮罩层 -->
<!-- 对话框 -->
<div id="dialog">
	<div id="TB_title" style="border-top-left-radius: 10px; border-top-right-radius: 10px;height:27px;">
		<div id="TB_closeAjaxWindow">
			<a id="TB_closeWindowButton" href="javascript:void(0);" onclick="closeBg();"></a>
		</div>
	</div>
	<div id="TB_ajaxContent" style="width: 640px; height:350px;px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;margin-left:10px;">
		<div class="TB_content">
			
		</div>
	</div>	
		
</div>
<!-- JS遮罩层上方的对话框 -->

</body>
</html>