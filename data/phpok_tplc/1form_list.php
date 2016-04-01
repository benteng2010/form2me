<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head","","0");?>

<script type="text/javascript">
function doAction(obj) {
	jQuery('#form_main .form_list_1').removeClass().addClass('form_list_2');
	jQuery('#form_main .form_list_left').removeClass().addClass('form_list_left_2');
	jQuery('#form_main .form_list_right').removeClass().addClass('form_list_right_2');
	jQuery('#form_main .form_list_title_icon').removeClass().addClass('form_list_title_icon_2');
	jQuery('#form_main .form_list_bd').hide();
	jQuery('.form_list_2',obj).removeClass().addClass('form_list_1');
	jQuery('.form_list_left_2',obj).removeClass().addClass('form_list_left');
	jQuery('.form_list_right_2',obj).removeClass().addClass('form_list_right');
	jQuery('.form_list_title_icon_2',obj).removeClass().addClass('form_list_title_icon');
	jQuery('.form_list_bd',obj).show();
}

function getTheme(obj,fid) {
	var themeId = jQuery(obj).val();
	jQuery.ajax({
		url: 'formManage.php?act=changetheme&fid=' + fid + '&themeId=' + themeId,
		type: 'GET',
		success: function(data){
			var tar = jQuery(obj).parent('.form_title_theme');
			if(themeId == 0){
				jQuery('span',tar).removeClass();
			}else{
				jQuery('span',tar).removeClass().addClass('actived');
			}
		}
	});
}
function showUsage(obj){
	jQuery('.maincon-mail-list-table').hide();
	jQuery(obj).parent('li').parent('ul').parent('div').next('.maincon-mail-list-table').show();
}
</script>

<style type="text/css">
.maincon-mail-list-table {
    background: url("templates/zh/default/images/table-bd-bg.gif") repeat-y scroll left top transparent;
    height: 155px;
    margin: 0 auto 10px;
    width: 853px;
}
.maincon-mail-list-table-hd {
    background: url("templates/zh/default/images/table-hd-bg.gif") no-repeat scroll left top transparent;
    height: 155px;
}
.maincon-mail-list-table-ft {
    background: url("templates/zh/default/images/table-ft-bg.gif") no-repeat scroll left bottom transparent;
    height: 155px;
}
.canvas {
    float: left;
    padding-left: 5px;
}
.canvas div {
    font-weight: bold;
}
div#pages_wrap {
    height: 22px;
    position: relative;
}
div#sort-by {
    font-weight: bold;
    left: 30px;
    position: absolute;
    top: 20px;
}
div#sort-by a#form_name {
    padding: 4px 15px 4px 4px;
	color:#000;
}
div#sort-by a#date_created {
    padding: 4px 16px 4px 4px;
	color:#000;
}
div#sort-by a#date_created.actived {
    background-color: #2266BB;
    color: #FFFFFF;
}
div#sort-by a#form_name.actived {
    background-color: #2266BB;
    color: #FFFFFF;
}
div#sort-by a {
    border: 1px solid #2266BB;
    border-radius: 4px 4px 4px 4px;
    font-weight: normal;
    margin-right: 4px;
	text-decoration: none;
}
</style>
    
<div id="form_main">
	<div id="maincon-wrap">
    	<h3>&nbsp;</h3>
		<h4>&nbsp;</h4>
        
        <a href="formManage.php?act=addForm">
        <img alt="add form" src="templates/zh/default/images/add-form.gif">
        </a>
        <div style="clear:both;"></div>
        <div id="maincon">
        <div id="maincon-hd">
        <div id="maincon-ft">
        <div id="pages_wrap">
        	<div id="sort-by">
            	<span>排序 </span>
                <a id="date_created" <?php if(!$order||$order=='created'){?>class="actived"<?php } ?> href="formManage.php?order=created">按创建时间</a>
                <a id="form_name" <?php if($order=='form_name'){?>class="actived"<?php } ?> href="formManage.php?order=form_name">按表单名称</a>
			</div>
            <div style="clear:both"></div>
        </div>
        <div id="maincon-mamager">
        <?php $_i=0;$formlist=(is_array($formlist))?$formlist:array();foreach($formlist AS  $key=>$value){$_i++; ?>
        <?php if($key==0){?>
        <div class="form_list" onmouseover="doAction(jQuery(this));">
            <div class="form_list_1">
                <div class="form_list_left">
                    <div class="form_list_right">
                        <div class="form_list_title_icon">
                            <span><?php echo $value[form_title];?></span>
                            <span style="display:block;font-size:11px;font-weight:normal;"><?php echo $value[created];?></span>
                            <div class="form_title_theme">
                                <span <?php if($value[form_style_id]>0){?>class="actived"<?php } ?>style="display:block"></span>
                                <select name="" style="width:120px;" onchange="getTheme(jQuery(this),'<?php echo $value[id];?>');">
                                    <option value="0" <?php if($value[form_style_id]==0){?>selected<?php } ?>>None</option>
                                    <?php $_i=0;$options=(is_array($options))?$options:array();foreach($options AS  $k=>$v){$_i++; ?>
                                        <option value="<?php echo $v[id];?>" <?php if($v[id] == $value[form_style_id]){?>selected<?php } ?>><?php echo $v[subject];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form_title_ssl">
                                <a href="#">
                                    <span class="form_no_ssl"></span>
                                    <b>SSL</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_list_bd">
                <div class="form_list_bd1">
                    <ul>
                        <li>
                            <a href="dataManage.php?fid=<?php echo $value[id];?>" class="form_data_sprite" ><span></span> <b>数据</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=modify&id=<?php echo $value[id];?>" class="form_edit_sprite" ><span></span> <b>编辑</b></a>
                        </li>
                        <li>
                            <a href="form.php?id=<?php echo base64_encode($value[id]);;?>" class="form_ciew_sprite" target="_blank"><span></span> <b>预览</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=notifications&fid=<?php echo $value[id];?>" class="form_ciew_notifications" target="_blank"><span></span> <b>通知</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=codes&id=<?php echo $value[id];?>" class="form_code_sprite" ><span></span> <b>代码</b></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="form_usage_sprite" onclick="showUsage(jQuery(this));"><span></span> <b>统计</b></a>
                        </li>
                    </ul>
                    <ul style="float:right">
                        <li>
                            <a href="formManage.php?act=del&id=<?php echo $value[id];?>" class="form_delete_sprite" ><span></span> <b>删除</b></a>
                        </li>
                    </ul>
                </div>
                
                 <div class="maincon-mail-list-table" style="display:none;">
                 	<div class="maincon-mail-list-table-hd">
                    	<div class="maincon-mail-list-table-ft">
                        	<div class="canvas">
                            	<div id="statistics-1241741" class="canvas-target" style="width:792px;height:150px;">
                    				<object width="790" height="147" id="MSLine" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
                                    <param value="templates/zh/default/images/GTVistor.swf" name="movie">
                                    <param value="&amp;dataURL=formManage.php?act=Visdata&id=<?php echo $value[id];?>" name="FlashVars">
                                    <param value="high" name="quality">
                                    <param value="transparent" name="wmode">
                                	<embed width="790" height="147" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="MSLine" wmode="transparent" quality="high" flashvars="&amp;dataURL=formManage.php?act=Visdata&id=<?php echo $value[id];?>" src="templates/zh/default/images/GTVistor.swf"></object>
                				</div>
                            </div>
                        </div>
                    </div>
                 </div>
                 
            </div>
            <div style="clear:both"></div>
        </div>
        <?php }else{ ?>
        <div class="form_list" onmouseover="doAction(jQuery(this));">
            <div class="form_list_2">
                <div class="form_list_left_2">
                    <div class="form_list_right_2">
                        <div class="form_list_title_icon_2">
                            <span><?php echo $value[form_title];?></span>
                            <span style="display:block;font-size:11px;font-weight:normal;"><?php echo $value[created];?></span>
                            <div class="form_title_theme">
                                <span class="<?php if($value[form_style_id]!=0){?>actived<?php } ?>" style="display:block"></span>
                                <select name="" style="width:120px;" onchange="getTheme(jQuery(this),'<?php echo $value[id];?>');">
                                    <option value="0" <?php if($value[form_style_id]==0){?>selected<?php } ?>>None</option>
                                   <?php $_i=0;$options=(is_array($options))?$options:array();foreach($options AS  $k=>$v){$_i++; ?>
                                        <option value="<?php echo $v[id];?>" <?php if($v[id] == $value[form_style_id]){?>selected<?php } ?>><?php echo $v[subject];?></option>
                                   <?php } ?>
                                </select>
                            </div>
                            <div class="form_title_ssl">
                                <a href="#">
                                    <span class="form_no_ssl"></span>
                                    <b>SSL</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_list_bd" style="display:none;">
                <div class="form_list_bd1">
                    <ul>
                        <li>
                            <a href="dataManage.php?fid=<?php echo $value[id];?>" class="form_data_sprite" ><span></span> <b>数据</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=modify&id=<?php echo $value[id];?>" class="form_edit_sprite" ><span></span> <b>编辑</b></a>
                        </li>
                        <li>
                            <a href="form.php?id=<?php echo base64_encode($value[id]);;?>" class="form_ciew_sprite" target="_blank"><span></span> <b>预览</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=notifications&fid=<?php echo $value[id];?>" class="form_ciew_notifications" target="_blank"><span></span> <b>通知</b></a>
                        </li>
                        <li>
                            <a href="formManage.php?act=codes&id=<?php echo $value[id];?>" class="form_code_sprite" ><span></span> <b>代码</b></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="form_usage_sprite" onclick="showUsage(jQuery(this));"><span></span> <b>统计</b></a>
                        </li>
                    </ul>
                    <ul style="float:right">
                        <li>
                            <a href="formManage.php?act=del&id=<?php echo $value[id];?>" class="form_delete_sprite" ><span></span> <b>删除</b></a>
                        </li>
                    </ul>
                </div>
                
                <div class="maincon-mail-list-table" style="display:none;">
                 	<div class="maincon-mail-list-table-hd">
                    	<div class="maincon-mail-list-table-ft">
                        	<div class="canvas">
                            	<div id="statistics-1241741" class="canvas-target" style="width:792px;height:150px;">
                    				<object width="790" height="147" id="MSLine" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
                                    <param value="templates/zh/default/images/GTVistor.swf" name="movie">
                                    <param value="&amp;dataURL=formManage.php?act=Visdata&id=<?php echo $value[id];?>" name="FlashVars">
                                    <param value="high" name="quality">
                                    <param value="transparent" name="wmode">
                                	<embed width="790" height="147" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="MSLine" wmode="transparent" quality="high" flashvars="&amp;dataURL=formManage.php?act=Visdata&id=<?php echo $value[id];?>" src="templates/zh/default/images/GTVistor.swf"></object>
                				</div>
                            </div>
                        </div>
                    </div>
                 </div>
                
            </div>
            <div style="clear:both"></div>
        </div>
        <?php } ?>
        <?php } ?>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>

<?php QG_C_TEMPLATE::p("inc.foot","","0");?>