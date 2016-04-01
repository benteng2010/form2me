<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head","","0");?>

<style type="text/css">
#emf-page {
    width: 100%;
}
#emf-inner-content {
    background: url("templates/zh/default/images/content-box-bg.png") repeat-y scroll left top white;
    margin-right: 10px;
}

.tabbj2 {
    background: url("templates/zh/default/images/form-element-tab-bg.png") no-repeat scroll left top transparent;
    display: block;
    height: 58px;
    width: 72px;
} 

</style>
<div id="emf-page">
<div id="emf-content">
<div id="emf-inner-content">
<table width="0" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="form_left_con">
        <div class="form_left">
            <div class="form_left_con">
            	<ul class="form_left_menu">
                     <li><a href="#" class="tabbj2" id="check1"><img src="templates/zh/default/images/form-add-field.png"/></a></li>
                     <li><a href="#" class="tabbj1" id="check2"><img src="templates/zh/default/images/form-field-settings.png"/></a></li>
                     <li><a href="#" class="tabbj1" id="check3"><img src="templates/zh/default/images/form-form-settings.png"/></a></li>
                 </ul>
                <div class="form_clear"></div>
                <div class="form_left_con20" id="table1">
                    <h3>Basic</h3>
                    <?php $_i=0;$blist=(is_array($blist))?$blist:array();foreach($blist AS  $key=>$value){$_i++; ?>
			   			<?php if($key%3==0){?>
			   				<ul class="form_basic_left">
                        <?php } ?>
			   			<li><a href="#" onclick="add_canvas_widget('<?php echo str_replace(' ','_',strtolower($value['field_type']));;?>');return false;" id="form_widget_<?php echo $value[id];?>"><?php echo $value[field_name];?></a></li>
                        <?php if($key%3==2 || $key==(count($baselist)-1)){?>
			   			</ul>
			   			<?php } ?>
			   		<?php } ?>
                    <div class="form_clear"></div>
                </div>
                <form name="form1" id="addUP" action="formManage.php?act=addOK" method="post" >
                <div class="form_left_con2" id="table2" style="display:none;">
                	<span id="notice_content">Please select a field

Click on a field in the form preview on the right to change its properties.</span>
				
                </div>
                <input type="hidden" name="field_count" id="field_count" value="0"/>
                <div class="form_left_con2" id="table3" style="display:none;">
                	<ul class="form_settings_ul">
                	 	<li>
                        	<label class="form_settings_label">
                                 表单标题  
                            </label>
                            <input type="text" name="form_title" id="form_title" value="Form Title" style="width:300px;" onkeyup="setValue(jQuery(this),'form_title',0);" />
                            <br/>
                            <input type="checkbox" name="show_title" value="1"/>是否显示标题
                        </li>
                    	<li>
                        	<label class="form_settings_label">
                               	 描述
                            </label>
                            <textarea name="description" class="form_text" style="width:100%;height:70px;color:#333;font-size:12px;" onkeyup="setValue(jQuery(this),'description',0);">请在此填写表单描述</textarea>                        </li>
                        <li>
                            <fieldset>
                                <legend class="form_settings_group">表单确认选项</legend>
                                <div class="form_fieldset_div_2">
                                	<input type="radio" name="sure_options" value="1" onclick="showNotice(1);" checked />信息提示&nbsp;<input type="radio" name="sure_options" value="2" onclick="showNotice(2);" />页面重定向
                                    <br/>
                                    <span id="notice">请填写提示信息</span>
                                    <input type="text" name="sure_content" id="sure_content" style="width:280px;" />
                                </div>
                            </fieldset>
                        </li>
                        <li>
                        	<label class="form_settings_label">
                                 标签位置 
                            </label>
                            <select name="label_position" style="width:110px;">
                            	<option value="left" selected>靠左</option>
                                <option value="top" >靠上</option>
                                <option value="right" >靠右</option>
                            </select>
                        </li>
                        <li>
                        	<label class="form_settings_label">
                                 表单宽度  
                            </label>
                            <input type="text" name="width" class="form_text" style="width:100%;" />
                        </li>
                        <li>
                        	<label class="form_settings_label">
                                 按钮名称
                            </label>
                            <input type="text" name="button_name" class="form_text" style="width:100%;" />
                        </li>
                        <li>
                            <fieldset>
                                <legend class="form_settings_group">按钮位置</legend>
                                <div class="form_fieldset_div_2">
                                	<input type="radio" name="button_align" value="left" checked />左边&nbsp;<input type="radio" name="button_align" value="center" />中间&nbsp;<input type="radio" name="button_align" value="right" />右边
                                </div>
                            </fieldset>
                        </li>
                        <li>
                            <fieldset>
                                <legend class="form_settings_group">是否开放</legend>
                                <div class="form_fieldset_div_2">
                                    <input type="radio" name="enable" value="1" checked />开放&nbsp;&nbsp;<input type="radio" name="enable" value="0"/>关闭
                                </div>
                            </fieldset>
                        </li>
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </td>
    <td valign="top">
        <div class="form_right">
            <div class="form_right_con">
                <div class="form_right_title"><span style="padding-top:30px;"><img alt="Action Tip" src="templates/zh/default/images/action-tip.png">Adding New Form </span></div>
                <div class="form_right_con2">
                <div style="padding:20px;">
                    <div class="form_right_con2_title">
                        <a href="javascript:void(0);" onclick="javascript:jQuery('#check3').trigger('click');">
                            <h2 id="formtitle">Form Title</h2>
                            <p>This is your form description. Click here to edit.</p>
                        </a>
                    </div>
                    <ul class="form_right_con2_con" id="sortable">
                        
                    </ul>
                    <ul class="form_right_con2_con">
                        <li>
                            <div class="form_right_con2_title_li">
                                <a href="#"><img src="templates/zh/default/images/cc.png" /></a>
                            </div>
                        </li>
                    </ul>
                    </div>
                    <div class="form_div_button" style="bottom:0px;">
                	<a href="javascript:void(0);" onclick="javascript:jQuery('#addUP').submit();"><img src="templates/zh/default/images/savebutton.png" /></a>
                </div>
                </div>
            </div>
        </div>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<script type="text/javascript">
function scrollDoor(){
}
scrollDoor.prototype = {
	sd : function(menus,divs,openClass,closeClass){
		var _this = this;
		if(menus.length != divs.length)
		{
			alert("菜单层数量和内容层数量不一样!");
			return false;
		}			
		for(var i = 0 ; i < menus.length ; i++)
		{	
			_this.$(menus[i]).value = i;				
			_this.$(menus[i]).onclick = function()
			{
				if(this.id != 'check2'){
					jQuery('#notice_content').show();
					jQuery('#table2 > ul').hide();
				}
				for(var j = 0 ; j < menus.length ; j++)
				{		
					_this.$(menus[j]).className = closeClass;
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = openClass;	
				_this.$(divs[this.value]).style.display = "block";				
			}
			_this.$(menus[0]).className = openClass;	
			_this.$(divs[0]).style.display = "block";	
			
		}
		},
	$ : function(oid){
		if(typeof(oid) == "string")
		return document.getElementById(oid);
		return oid;
	}
}

jQuery(function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["check1","check2","check3"],["table1","table2","table3"],"tabbj2","tabbj1");
	if(jQuery('#sortable > li').length > 0){
		jQuery('#sortable > li').each(function(e){
			var top = jQuery(this).offset().top;
			jQuery('a div',this).last().css('top',top+'px');
			
		});
	}
	jQuery( "#sortable" ).sortable({update:function(event,ui){
			var len = jQuery('#sortable > li').length;
			for(var i=0;i<len;i++){
				var id = jQuery('#sortable > li').eq(i).attr('id');
				var k = i + 1;
				jQuery('#ul_'+id+' input').last().val(k);
			}
			jQuery('#sortable > li').each(function(e){
				var top = jQuery(this).offset().top;
				jQuery('a div',this).last().css('top',top+'px');
			
			});
		}
	});
	jQuery( "#sortable" ).disableSelection();
	jQuery('#field_count').val(jQuery('#sortable > li').length);
});

function checkinfo(){
	return true;
}

function add_canvas_widget(type,properties){
	var len = jQuery('#sortable > li').length + 1;
	if(properties==null){
		var default_js = widgets[type]['default_js'];
		properties = default_js();
		properties['len'] = len;
	}
	var designing_js = widgets[type]['designing_js'];
	var ele = designing_js(properties);
	jQuery('#sortable').append(ele);
	var tar = jQuery('#sortable > li').last();
	var top = jQuery(tar).offset().top;
	var ele_div = '<div style="z-index:1000;position:absolute;top:'+(top)+'px;left:930px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="templates/zh/default/images/form-element-delete.png" /></div>';
	jQuery('a',tar).append(ele_div);
	var setting_js = widgets[type]['setting_js'];
	setting_js(properties);
}

//阻止js冒泡事件
function stopBubble(e) {  
    if (e && e.stopPropagation) {//非IE  
        e.stopPropagation();  
    }  
    else {//IE  
        window.event.cancelBubble = true;  
    }  
}  

function del_li(event,obj){
	var id = jQuery(obj).parent('a').parent('li').attr('id');
	jQuery(obj).parent('a').parent('li').remove();
	jQuery('#sortable > li').each(function(e){
		var top = jQuery(this).offset().top;
		jQuery('a div',this).last().css('top',top+'px');
		
	});
	jQuery('#ul_'+id).remove();
	var len = jQuery('#sortable > li').length;
	for(var i=0;i<len;i++){
		var id = jQuery('#sortable > li').eq(i).attr('id');
		var k = i + 1;
		jQuery('#ul_'+id+' input').last().val(k);
	}
	jQuery('#field_count').val(jQuery('#table2 > ul').length);
	jQuery('#table2 > ul').hide();
	jQuery('#notice_content').show();
	jQuery('#check2').trigger('click');
	stopBubble(event);
	return false;
}
function showNotice(value){
	if(value==1){
		jQuery('#notice').html('请填写提示信息');
		jQuery('#sure_content').val('');
	}else{
		jQuery('#notice').html('请填写跳转链接');
		jQuery('#sure_content').val('http://');
	}
}
</script>

<?php QG_C_TEMPLATE::p("inc.foot","","0");?>