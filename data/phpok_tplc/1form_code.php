<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("inc.head","","0");?>

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
					_this.$(menus[j]).className = _this.$(menus[j]).className.replace(closeClass,'');
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = _this.$(menus[this.value]).className.replace(closeClass,'');	
				_this.$(menus[this.value]).className += openClass;	
				_this.$(divs[this.value]).style.display = "block";				
			}
			_this.$(menus[0]).className = _this.$(menus[0]).className.replace(closeClass,'');
			_this.$(menus[0]).className += openClass;	
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
	SDmodel.sd(["check1","check2"],["textarea_code_div1","textarea_code_div2"]," selected"," selected");
});
</script>

	<div id="mainbody">
    	<div id="maincon-wrap" style="padding:20px;margin-top:16px;width:auto;">
        	<div>
                <h2 style="color:#0083CA;font: bold 26px/23px "Trebuchet MS";">
                    代码:
                    <span id="form_name_html" style="padding-left:5px;color:#000;"><?php echo $formMsg[form_title];?></span>
                </h2>
                <br>
            </div>
            <div id="download_code_wrap_wrap">
            	<div id="download_code_wrap" style="background-color: rgb(140, 198, 63);">
                	<div id="download_code_left">
                    	<div id="download_code_left_ui">
                        	<ul>
                            	<li class="html_with selected" id="check1">
                                    <div class="icon"></div>
                                    <div class="text">
                                        HTML代码
                                        <br>
                                        含Javascript和CSS
                                    </div>
                                </li>
                                <li class="html_link" id="check2">
                                    <div class="icon"></div>
                                    <div class="text">HTML链接</div>
                                </li>
                            </ul>
                        </div>
                        <div id="download_code_left_btn">
                        	
                        </div>
                    </div>
                    <div id="download_code_right">
                    	<div id="download_code_right_textarea">
                            <div id="textarea_code_div1">
                                <textarea id="textarea_code" onclick="this.select();">
                                <?php echo htmlspecialchars($content)?>
                                </textarea>
                            </div>
                        	<div id="textarea_code_div2" style="display:none;">
                                <div id="html_link">
								<label class="html_link_desc">在电子邮件或者即时消息使用这个URL</label>
								<textarea id="html_link_form_url" onclick="this.focus();this.select();"><?php echo $urlContent;?></textarea>

								<label class="html_link_desc">在网页中使用这个HTML链接</label>
								<textarea id="html_link_form_link" onclick="this.focus();this.select();"><?php echo $htmlContent;?></textarea>

								</div>
                           </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<?php QG_C_TEMPLATE::p("inc.foot","","0");?>