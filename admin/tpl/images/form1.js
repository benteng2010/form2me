//定义命名空间
Gootop = {};

//获取1级，2级域名
var enableFload = true;
var rootUrl = document.location.href.substring(0,document.location.href.indexOf(window.document.location.pathname)); 
if(enableFload){
	var pathArr = document.location.pathname.split('/');
	Gootop.RootScript = rootUrl+'/'+pathArr[1]; 
}else{
	Gootop.RootScript = rootUrl;
}

Gootop.pop =function(posTar,msg,type,fixTop,fixLeft){
  	posTar.focus();
  	var position = posTar.offset();
	var pop = '<div id=\'pop_tip\' class="formError UsernameformError"  style="top:'+Number(position.top-fixTop)+'px;left:'+Number(position.left-fixLeft)+'px;display:none; opacity: 0.87;">'
	+'<div class="formErrorContent">'+msg+'<br/></div>'
	+'<div class="formErrorArrow">'
	+'<div class="line10"></div>'
	+'<div class="line9"></div>'
	+'<div class="line8"></div>'
	+'<div class="line7"></div>'
	+'<div class="line6"></div>'
	+'<div class="line5"></div>'
	+'<div class="line4"></div>'
	+'<div class="line3"></div>'
	+'<div class="line2"></div>'
	+'<div class="line1"></div>'
	+'</div></div>';
  	jQuery('body').append(pop);
  	jQuery('#pop_tip').fadeIn(300);
  	posTar.blur(function(){
  		jQuery('#pop_tip').remove();
  	});
};

var widgets = {
	text:{
			name:'text',
			caption:'Single Line Text',
			designing_js:function(properties){
							var ele = '<li id="'+properties['len']+'">';
						    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
						    ele += '<div class="form_field">';
						    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
						    ele += '<div class="form_right_ic">';
						    ele += '<div class="form_span_y">';
						    ele += '<input id="element_'+properties['len']+'" name="element_'+properties['len']+'" class="text " type="text" size="30" readonly="readonly">';
						   	ele += '</div>';
						   	ele += '</div>';
						    ele += '<div class="form_clear"></div>';
						    ele += '</div>';
						    ele += '</a>';
						    ele += '</li>';
						    return ele;
					},
			default_js:function(){
						return {'id':'','type':'text','title':'Single Line Text','instructions':'','is_required':'','field_size':'30','range_min':'0','range_max':'0','default_value':''};
					},
			setting_js:function(properties){
						properties = properties==null ? {} : properties;
						get_properties_html(properties);
					}
		 },
	radio:{
				name:'radio',
				caption:'Multiple Choice',
				designing_js:function(properties){
								var ele = '<li id="'+properties['len']+'">';
							    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
							    ele += '<div class="form_field">';
							    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
							    ele += '<div class="form_right_ic">';
							    ele += '<div class="form_span_y"><ul>';
							    ele += '<li style="float:left;width:200px;"><input type="radio" name="element_'+properties['len']+'" value="第一选项" onclick="javascript:return false;"><span>第一选项</span></li>';
							    ele += '<li style="float:left;width:200px;"><input type="radio" name="element_'+properties['len']+'" value="第二选项" onclick="javascript:return false;"><span>第二选项</span></li>';
							    ele += '<li style="float:left;width:200px;"><input type="radio" name="element_'+properties['len']+'" value="第三选项" onclick="javascript:return false;"><span>第三选项</span></li>';
							   	ele += '</ul></div>';
							   	ele += '</div>';
							    ele += '<div class="form_clear"></div>';
							    ele += '</div>';
							    ele += '</a>';
							    ele += '</li>';
							    return ele;
						},
				default_js:function(){
							return {'id':'','type':'radio','title':'Multiple Choice','instructions':'','is_required':'','choice':'第一选项,第二选项,第三选项'};
						},
				setting_js:function(properties){
							properties = properties==null ? {} : properties;
							get_properties_html(properties);
						}
			 },
	select:{
					name:'select',
					caption:'Dropdown',
					designing_js:function(properties){
									var ele = '<li id="'+properties['len']+'">';
								    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
								    ele += '<div class="form_field">';
								    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
								    ele += '<div class="form_right_ic">';
								    ele += '<div class="form_span_y">';
								    ele += '<select name="element_'+properties['len']+'" onchange="javascript:return false;">';
								    ele += '<option value="第 一选项" selected>第一选项</option>';
								    ele += '<option value="第二选项">第二选项</option>';
								    ele += '<option value="第三选项">第三选项</option>';				
								   	ele += '</select></div>';
								   	ele += '</div>';
								    ele += '<div class="form_clear"></div>';
								    ele += '</div>';
								    ele += '</a>';
								    ele += '</li>';
								    return ele;
							},
					default_js:function(){
								return {'id':'','type':'select','title':'Dropdown','instructions':'','is_required':'','choice':'第一选项,第二选项,第三选项'};
							},
					setting_js:function(properties){
								properties = properties==null ? {} : properties;
								get_properties_html(properties);
							}
				 },
	checkbox:{
					name:'checkbox',
					caption:'Chekcbox',
					designing_js:function(properties){
									var ele = '<li id="'+properties['len']+'">';
								    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
								    ele += '<div class="form_field">';
								    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
								    ele += '<div class="form_right_ic">';
								    ele += '<div class="form_span_y"><ul>';
								    ele += '<li style="float:left;width:200px;"><input type="checkbox" name="element_'+properties['len']+'[]" value="第一选项" onclick="javascript:return false;"><span>第一选项</span></li>';
								    ele += '<li style="float:left;width:200px;"><input type="checkbox" name="element_'+properties['len']+'[]" value="第二选项" onclick="javascript:return false;"><span>第二选项</span></li>';
								    ele += '<li style="float:left;width:200px;"><input type="checkbox" name="element_'+properties['len']+'[]" value="第三选项" onclick="javascript:return false;"><span>第三选项</span></li>';
								   	ele += '</ul></div>';
								   	ele += '</div>';
								    ele += '<div class="form_clear"></div>';
								    ele += '</div>';
								    ele += '</a>';
								    ele += '</li>';
								    return ele;
							},
					default_js:function(){
								return {'id':'','type':'checkbox','title':'Checkbox','instructions':'','is_required':'','choice':'第一选项,第二选项,第三选项'};
							},
					setting_js:function(properties){
								properties = properties==null ? {} : properties;
								get_properties_html(properties);
							}
				 },
    textarea:{
				name:'textarea',
				caption : 'Paragraph Text',
				designing_js:function(properties){
								var ele = '<li id="'+properties['len']+'">';
							    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
							    ele += '<div class="form_field">';
							    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
							    ele += '<div class="form_right_ic">';
							    ele += '<div class="form_span_y">';
							    ele += '<textarea id="element_'+properties['len']+'" name="element_'+properties['len']+'" cols="45" rows="10" readonly="readonly" style="width:263px;height:157px;"></textarea>';
							   	ele += '</div>';
							   	ele += '</div>';
							    ele += '<div class="form_clear"></div>';
							    ele += '</div>';
							    ele += '</a>';
							    ele += '</li>';
							    return ele;
						},
				default_js:function(){
							return {'id':'','type':'textarea','title':'Paragraph Text','instructions':'','is_required':'','cols':'45','rows':'10','range_min':'0','range_max':'0','default_value':''};
						},
				setting_js:function(properties){
							properties = properties==null ? {} : properties;
							get_properties_html(properties);
						}
			},
	name:{
			name:'text',
			caption:'username',
			designing_js:function(properties){
							var ele = '<li id="'+properties['len']+'">';
						    ele += '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''+properties['len']+'\');">';
						    ele += '<div class="form_field">';
						    ele += '<label class="form_label"><span class="form_label_title">'+properties['title']+'</span></label>';
						    ele += '<div class="form_right_ic">';
						    ele += '<div class="form_span_y">';
						    ele += '<input id="element_'+properties['len']+'" name="element_'+properties['len']+'" class="text " type="text" value="" size="30" readonly="readonly">';
						   	ele += '</div>';
						   	ele += '</div>';
						    ele += '<div class="form_clear"></div>';
						    ele += '</div>';
						    ele += '</a>';
						    ele += '</li>';
						    return ele;
					},
			default_js:function(){
						return {'id':'','type':'text','title':'Name','instructions':'','is_required':'','field_size':'30'};
					},
			setting_js:function(properties){
						properties = properties==null ? {} : properties;
						get_properties_html(properties);
					}
		 }	
};

var themes = {
	backgrounds:{
					title:'背景',
					index:'wallpaper,header,forms,field,highlight,instruction',
					value:'壁纸,头部,表单,字段,加亮,说明',
					color:true,
					font:false,
					style:false,
					size:false,
					borderstyle:false,
					thickness:false
				},
	texts: {
				title:'排版',
				index:'title,description,field_title,field_text,instructions',
				value:'标题,描述,字段标题,字段文本,说明',
				color:true,
				font:true,
				style:true,
				size:true,
				borderstyle:false,
				thickness:false
		   },
	borders:{
			   title:'边框',
			   index:'forms',
			   value:'表单',
			   color:true,
			   font:false,
			   style:false,
			   size:false,
			   borderstyle:true,
			   thickness:true
		   	}
};

var wallpaper = header = form = field = highlight = instruction = {color:''};
var title = description = fieldtitle = fieldtext = fieldinstruction = {font:'',style:'',size:'',color:''};
var border = {thickness:'',color:'',style:''};

function get_properties_html(properties){
	 var ele = '<ul class="form_settings_ul" id="ul_'+properties['len']+'" style="display:none;">'
	 +'<li>'
	 +'<label class="form_settings_label">'
	 +'Field Label'
	 +'</label>'
	 +'<textarea name="form['+properties['len']+'][field_label]" class="form_text" style="width:100%;height:70px;color:#333;" onkeyup="setValue(jQuery(this),\'field_label\',\''+properties['len']+'\');">'+properties['title']+'</textarea>'
	 +'</li>'
	 +'<li class="form_settings_li_left">'
	 +'<fieldset>'
	 +'<legend class="form_settings_group">Options</legend>'
	 +'<div class="form_fieldset_div">'
	 +'<input class="form_checkbox" type="checkbox" value="1" name="form['+properties['len']+'][is_required]" '+properties['is_required']+' onchange="setRequire(jQuery(this),\''+properties['len']+'\');">'
	 +'<label class="form_emf-choice">'
	 +'Required'
	 +'</label>'
	 +'</div>'
	 +'</fieldset>'
	 +'</li>'
	 +'<li class="form_settings_li_right">'
	 +'<fieldset>'
	 +'<legend class="form_settings_group">Show Field to</legend>'
	 +'<div class="form_fieldset_div">'
	 +'<input class="form_checkbox" type="radio" value="1" name="form['+properties['len']+'][show_field]" checked>'
	 +'<label class="form_emf-choice">'
	 +'Everyone'
	 +'</label>'
	 +'<br>'
	 +'<input class="form_checkbox" type="radio" value="2" name="form['+properties['len']+'][show_field]">'
	 +'<label class="form_emf-choice">'
	 +'Admin Only'
	 +'</label>'
	 +'</div>'
	 +'</fieldset>'
	 +'</li>';
	 if(typeof(properties['field_size']) != 'undefined'){
		 ele += '<li style="float:left;">'
     	 +'<label class="form_settings_label">'
     	 +'Field Size'
     	 +'</label>'
     	 +'<input name="form['+properties['len']+'][field_size]" class="form_text" type="text" id="field_size" value="30" style="width:300px;" onchange="setValue(jQuery(this),\'field_size\',\''+properties['len']+'\');" />'
     	 +'</li>';
	 }
	 if(typeof(properties['cols'])!='undefined' && typeof(properties['rows'])!='undefined'){
		 ele += '<li style="float:left;">'
		 +'<fieldset>'
         +'<legend class="form_settings_group">Field Size</legend>'
         +'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
         +'<div style="float:left;"><label class="form_emf-choice">'
         +'Cols'
         +'</label>'
         +'<br>'
         +'<input name="form['+properties['len']+'][field_cols]" type="text" value="45" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''+properties['len']+'\');" />'
         +'</div>'
         +'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
         +'Rows'
         +'</label>'
         +'<br/>'
         +'<input type="text" name="form['+properties['len']+'][field_rows]" value="10" style="width:79px;" onchange="setValue(jQuery(this),\'range_max\',\''+properties['len']+'\');" />'
         +'</div>'
         +'</div>'
         +'</fieldset>'
         +'</li>';
	 }
	 if(typeof(properties['range_min']) != 'undefined' && typeof(properties['range_max']) != 'undefined'){
		 ele += '<li style="float:left;>'
         +'<fieldset>'
         +'<legend class="form_settings_group">Range</legend>'
         +'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
         +'<div style="float:left;"><label class="form_emf-choice">'
         +'Range Min'
         +'</label>'
         +'<br>'
         +'<input name="form['+properties['len']+'][range_min]" type="text" value="0" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''+properties['len']+'\');" />'
         +'</div>'
         +'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
         +'Range Max'
         +'</label>'
         +'<br/>'
         +'<input type="text" name="form['+properties['len']+'][range_max]" value="0" style="width:79px;" onchange="setValue(jQuery(this),\'range_max\',\''+properties['len']+'\');" />'
         +'</div>'
         +'</div>'
         +'</fieldset>'
         +'</li>';
	 }
	 if(typeof(properties['default_value']) != 'undefined'){
		 ele += '<li style="float:left;">'
     	 +'<label class="form_settings_label">'
     	 +'Default Value'
     	 +'</label>'
     	 +'<input class="form_text" type="text" name="form['+properties['len']+'][default_value]" id="dafault_name" style="width:300px;" onkeyup="setValue(jQuery(this),\'default_value\',\''+properties['len']+'\');" />'
     	 +'</li>';
	 }
	 if(typeof(properties['choice']) != 'undefined' && properties['type']=="radio"){
		 var ary = new Array();
		 ary = properties['choice'].split(',');
		
		 ele += '<li style="float:left;">'
		 +'<fieldset>'
         +'<legend class="form_settings_group">选项</legend>'
         +'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
         +'<div style="float:left;">'
         +'<ul>'
		 for(var i=0;i<ary.length;i++){
			ele += '<li style="flot:left;"><input type="radio" name="form['+properties['len']+'][multiple_choice_checked]" value="'+ary[i]+'" onclick="set_default_choice(jQuery(this),\'radio\',\''+properties['len']+'\');"/>'
			+'<input name="form['+properties['len']+'][radio][]" type="text" value="'+ary[i]+'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'multiple_choice\',\''+properties['len']+'\');" />'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\'radio\','+properties['len']+');"/>'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+properties['len']+');"/></li>';
		 }
         ele += '</ul></div>'
         +'</div>'
         +'</fieldset>'
         +'</li>';
	 }
	 if(typeof(properties['choice'])!='undefined' && properties['type']=="checkbox"){
		 var ary = new Array();
		 ary = properties['choice'].split(',');
		
		 ele += '<li style="float:left;">'
		 +'<fieldset>'
         +'<legend class="form_settings_group">选项</legend>'
         +'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
         +'<div style="float:left;">'
         +'<ul>'
		 for(var i=0;i<ary.length;i++){
			ele += '<li style="flot:left;"><input type="checkbox" name="form['+properties['len']+'][checkbox_choice_checked]['+i+']" value="'+ary[i]+'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''+properties['len']+'\');"/>'
			+'<input name="form['+properties['len']+'][checkbox][]" type="text" value="'+ary[i]+'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'checkbox_choice\',\''+properties['len']+'\');" />'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\'checkbox\','+properties['len']+');"/>'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+properties['len']+');"/></li>';
		 }
         ele += '</ul></div>'
         +'</div>'
         +'</fieldset>'
         +'</li>';
	 }
	 if(typeof(properties['choice']) != 'undefined' && properties['type']=="select"){
		 var ary = new Array();
		 ary = properties['choice'].split(',');
		
		 ele += '<li style="float:left;">'
		 +'<fieldset>'
         +'<legend class="form_settings_group">选项</legend>'
         +'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
         +'<div style="float:left;">'
         +'<ul>'
		 for(var i=0;i<ary.length;i++){
			ele += '<li style="flot:left;"><input type="radio" name="form['+properties['len']+'][dropdown_choice_selected]" value="'+ary[i]+'" onclick="set_default_choice(jQuery(this),\'select\',\''+properties['len']+'\');"/>'
			+'<input name="form['+properties['len']+'][select][]" type="text" value="'+ary[i]+'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'dropdown_choice\',\''+properties['len']+'\');" />'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\'select\','+properties['len']+');"/>'
			+'&nbsp;<img src="'+Gootop.RootScript+'/templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+properties['len']+');"/></li>';
		 }
         ele += '</ul></div>'
         +'</div>'
         +'</fieldset>'
         +'</li>';
	 }
	 ele += '<li style="float:left;">'
	 +'<label class="form_settings_label">'
	 +'Instructions for User' 
	 +'</label>'
	 +'<textarea name="form['+properties['len']+'][instructions]" class="form_text" style="width:300px;height:70px;color:#333;"></textarea>'
	 +'<input type="hidden" name="form['+properties['len']+'][field_type]" value="'+properties['type']+'" />'
	 +'<input type="hidden" name="form['+properties['len']+'][field_list]" value="'+properties['len']+'" />'
	 +'</li>'
	 +'<table id="form_emf-elements-operator-table" style="table-layout: fixed;">'
     +'<tr>'
     +'<td style="width:92px">'
     +'<img src="'+Gootop.RootScript+'/templates/zh/default/images/duplicate.png" style="cursor: pointer;">'
     +'</td>'
     +'<td style="width:92px">'
     +'<img src="'+Gootop.RootScript+'/templates/zh/default/images/delete.png" style="cursor: pointer;">'
     +'</td>'
     +'<td style="width:92px">'
     +'<img src="'+Gootop.RootScript+'/templates/zh/default/images/add.png" style="cursor: pointer;" onclick="javascript:jQuery(\'#check1\').trigger(\'click\');"/>'
     +'</td>'
     +'</tr>'
     +'</table>'
	 +'</ul>';
	 jQuery('#table2').append(ele);
	 
	 jQuery('#field_count').val(jQuery('#table2 > ul').length);
}

function setRequire(obj,id){
	if(jQuery(obj).attr('checked')){
		if(jQuery('#'+id+' .form_label').find('span[class="req"]').length == 0){
			jQuery('#'+id+' .form_label').append('<span class="req"> * </span>');
		}
	}else{
		if(jQuery('#'+id+' .form_label').find('span[class="req"]').length > 0){
			jQuery('#'+id+' .form_label .req').remove();
		}
	}
}

function setValue(obj,name,id){
	var val = jQuery(obj).val();
	if(name=='field_label'){
		jQuery('#'+id+' .form_label').find('span[class="form_label_title"]').html(val);
	}else if(name=='field_size'){
		jQuery('#element_'+id).attr('size',val);
	}else if(name=='default_value'){
		jQuery('#element_'+id).val(val);
	}else if(name=='form_title'){
		jQuery('#formtitle').html(val);
	}else if(name=='multiple_choice'){
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var tarObj = jQuery('#'+id+' ul');
		jQuery('li', tarObj).eq(index).find('input[type="radio"]').val(val);
		jQuery('li', tarObj).eq(index).find('input[type="radio"]').next('span').html(val);
		jQuery(obj).prev('input[type="radio"]').val(val);
	}else if(name=='checkbox_choice'){
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var tarObj = jQuery('#'+id+' ul');
		jQuery('li', tarObj).eq(index).find('input[type="checkbox"]').val(val);
		jQuery('li', tarObj).eq(index).find('input[type="checkbox"]').next('span').html(val);
		jQuery(obj).prev('input[type="checkbox"]').val(val);
	}else if(name=='dropdown_choice'){
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var tarObj = jQuery('#'+id+' select');
		jQuery('option', tarObj).eq(index).val(val).html(val);
		jQuery(obj).prev('input[type="radio"]').val(val);
	}
}

function getSetOptions(obj,id){
	jQuery('#notice_content').hide();
	jQuery('#sortable > li').removeClass();
	jQuery(obj).parent('li').addClass('current_edit');
	jQuery('#table2 > ul').hide();jQuery('#ul_'+id).show();
	jQuery('#check2').trigger('click');
}

function changeProperty(){
	var pt = jQuery('#property > .selected').attr('id');
	var ty = jQuery('#typography > .selected').attr('id');
	if(pt == 'backgrounds'){
		var color = jQuery('.color_input').val();
		//alert(color);
		if(ty == 'wallpaper'){
			jQuery('.form_emf_container_outer').css('background-color',color);
			wallpaper.color = color;
			var strObj = Serialize(wallpaper);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_wallpaper"]').val(strObj);
			//jQuery('input[name=="wallpaper"]').val(color);
		}else if(ty == 'header'){
			jQuery('.form_emf_container_a').css('background-color',color);
			header.color = color;
			var strObj = Serialize(header);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_header"]').val(strObj);
		}else if(ty == 'forms'){
			jQuery('.form_emf_container').css('background-color',color);
			form.color = color;
			var strObj = Serialize(form);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_form"]').val(strObj);
		}else if(ty == 'field'){
			jQuery('.form_emf_container_b > ul').find('input:not(:last)').css('background-color',color);
			jQuery('.form_emf_container_b > ul').find('textarea').css('background-color',color);
			field.color = color;
			var strObj = Serialize(field);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_field"]').val(strObj);
		}else if(ty == 'highlight'){
			jQuery('.form_emf_container_b .highlight-field').css('background-color',color);
			highlight.color = color;
			var strObj = Serialize(highlight);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_highlight"]').val(strObj);
		}else if(ty == 'instruction'){
			jQuery('.form_emf_li_field .emf_block').css('background-color',color);
			jQuery('.emf-div-instruction').css('background-color',color);
			instruction.color = color;
			var strObj = Serialize(instruction);
			strObj = strObj.replace('\\','');
			jQuery('input[name="bg_instruction"]').val(strObj);
		}
	}else if(pt == 'texts'){
		var font = jQuery('#theme_font > select').val();
		var style = jQuery('#theme_style > select').val();
		if(style=="normal"){
			var weight = 'normal';
		}else if(style=='bold'){
			var weight = 'bold';
		}else if(style=='italic'){
			var weight = 'normal';
		}
			
		var size = jQuery('#theme_size > select').val();
		var color = jQuery('input[name="color_input"]').val();
		if(ty == 'title'){
			jQuery('.form_emf_bold').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			title.color = color;
			title.weight = weight;
			title.size = size;
			title.style = style;
			title.font = font;
			var strObj = Serialize(title);
			//strObj = strObj.replace('\\','');
			jQuery('input[name="text_title"]').val(strObj);
		}else if(ty == 'description'){
			jQuery('.emf-form-description').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			description.color = color;
			description.weight = weight;
			description.size = size;
			description.style = style;
			description.font = font;
			var strObj = Serialize(description);
			strObj = strObj.replace('\\','');
			jQuery('input[name="text_description"]').val(strObj);
		}else if(ty == 'field_title'){
			jQuery('.form_emf_label_desc').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			fieldtitle.color = color;
			fieldtitle.weight = weight;
			fieldtitle.size = size;
			fieldtitle.style = style;
			fieldtitle.font = font;
			var strObj = Serialize(fieldtitle);
			strObj = strObj.replace('\\','');
			jQuery('input[name="text_fieldtitle"]').val(strObj);
		}else if(ty == 'field_text'){
			jQuery('.form_emf_container_b > ul').find('input:not(:last)').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			jQuery('.form_emf_container_b > ul').find('textarea').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			fieldtext.color = color;
			fieldtext.weight = weight;
			fieldtext.size = size;
			fieldtext.style = style;
			fieldtext.font = font;
			var strObj = Serialize(fieldtext);
			strObj = strObj.replace('\\','');
			jQuery('input[name="text_fieldtext"]').val(strObj);
		}else if(ty == 'instructions'){
			jQuery('.form_emf_li_field .emf_block').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			jQuery('.emf-div-instruction').css({'font-family':font,'font-style':style,'font-weight':weight,'font-size':size+'px','color':color});
			fieldinstruction.color = color;
			fieldinstruction.weight = weight;
			fieldinstruction.size = size;
			fieldinstruction.style = style;
			fieldinstruction.font = font;
			var strObj = Serialize(fieldinstruction);
			strObj = strObj.replace('\\','');
			jQuery('input[name="text_instruction"]').val(strObj);
		}
	}else if(pt == 'borders'){
		var thickness = jQuery('#theme_thickness > select').val();
		var color = jQuery('input[name="color_input"]').val();
		var style = jQuery('#theme_borderstyle > select').val();
		jQuery('.form_emf_container').css({'border-color':color,'border-style':style,'border-width':thickness+'px'});
		border.color = color;
		border.style = style;
		border.thickness = thickness;
		var strObj = Serialize(border);
		strObj = strObj.replace('\\','');
		jQuery('input[name="border_form"]').val(strObj);
	}
}

function Serialize(obj){  
    switch(obj.constructor){  
        case Object:  
            var str = "{";  
            for(var o in obj){  
                str += '"' + o + '":' + Serialize(obj[o]) +",";  
            }  
            if(str.substr(str.length-1) == ",")  
                str = str.substr(0,str.length -1);  
            return str + "}";  
            break;  
        case Array:              
            var str = "[";  
            for(var o in obj){  
                str += Serialize(obj[o]) +",";  
            }  
            if(str.substr(str.length-1) == ",")  
                str = str.substr(0,str.length -1);  
            return str + "]";  
            break;  
        case Boolean:  
            return '"' + obj.toString() + '"';  
            break;  
        case Date:  
            return '"' + obj.toString() + '"';  
            break;  
        case Function:  
            break;  
        case Number:  
            return '"' + obj.toString() + '"';  
            break;   
        case String:  
            return '"' + obj.toString() + '"';  
            break;      
    }  
}  

function getThemeId(id){
	if(id==0){
		window.location.href = Gootop.RootScript + '/themeManage.php?act=edit&id=new';
	}else{
		window.location.href = Gootop.RootScript + '/themeManage.php?act=edit&id=' + id;
	}
}

function rgbToHex(rgbarray,array){  
    if (rgbarray.length < 3) return false;  
    if (rgbarray.length == 4 && rgbarray[3] == 0 && !array) return 'transparent';  
    var hex = [];  
    for (var i = 0; i < 3; i++){  
    	var bit = (rgbarray[i] - 0).toString(16);  
      	hex.push((bit.length == 1) ? '0' + bit : bit);  
    }  
    return array ? hex : '#' + hex.join('');  
} 

function evalProperty() {
	var val = jQuery('input[name="bg_wallpaper"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container_outer').css('background-color',jsonstr['color']);
	}
				
	var val = jQuery('input[name="bg_header"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container_a').css('background-color',jsonstr['color']);
	}
	var val = jQuery('input[name="bg_form"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container').css('background-color',jsonstr['color']);
	}
	
	var val = jQuery('input[name="bg_field"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container_b > ul').find('input:not(:last)').css('background-color',jsonstr['color']);
		jQuery('.form_emf_container_b > ul').find('textarea').css('background-color',jsonstr['color']);
	}
	
	var val = jQuery('input[name="bg_highlight"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container_b .highlight-field').css('background-color',jsonstr['color']);
	}
	
	var val = jQuery('input[name="bg_instruction"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_li_field .emf_block').css('background-color',jsonstr['color']);
		jQuery('.emf-div-instruction').css('background-color',jsonstr['color']);
	}
							
	var val = jQuery('input[name="text_title"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_bold').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
	}
	
	var val = jQuery('input[name="text_description"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.emf-form-description').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
	}
	
	var val = jQuery('input[name="text_fieldtitle"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_label_desc').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
	}
	
	var val = jQuery('input[name="text_fieldtext"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container_b > ul').find('input:not(:last)').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
		jQuery('.form_emf_container_b > ul').find('textarea').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
	}
	
	var val = jQuery('input[name="text_instruction"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_li_field .emf_block').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
		jQuery('.emf-div-instruction').css({'font-family':jsonstr['font'],'font-style':jsonstr['style'],'font-weight':jsonstr['weight'],'font-size':jsonstr['size']+'px','color':jsonstr['color']});
	}
	
	var val = jQuery('input[name="border_form"]').val();
	if(val != 'null'){
		var jsonstr = eval("(" + val + ")");
		jQuery('.form_emf_container').css({'border-color':jsonstr['color'],'border-style':jsonstr['style'],'border-width':jsonstr['thickness']+'px'});
	}
}


function insert_choice(obj,type,id){
	if(type=='radio'){
		var ele = '<li style="float:left;"><input type="radio" name="form['+id+'][multiple_choice_checked]" value="" onclick="set_default_choice(jQuery(this),\''+type+'\',\''+id+'\');"/>'
		+'<input name="form['+id+'][radio][]" type="text" value="" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'multiple_choice\',\''+id+'\');" />'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),'+type+','+id+');"/>'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+id+');"/></li>';
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var el = '<li style="float:left;width:200px;"><input type="radio" name="elment_'+id+'" value="" onclick="javascript:return false;"><span></span></li>';
		jQuery(obj).parent('li').after(ele);
		var tarObj = jQuery('#sortable > #'+id).find('ul');
		jQuery('li', tarObj).eq(index).after(el);
	}else if(type=='checkbox'){
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var len = jQuery('li', tar).length;
		var ele = '<li style="float:left;"><input type="checkbox" name="form['+id+'][checkbox_choice_checked]['+len+']" value="" onclick="set_default_choice(jQuery(this),\''+type+'\',\''+id+'\');"/>'
		+'<input name="form['+id+'][checkbox][]" type="text" value="" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'checkbox_choice\',\''+id+'\');" />'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),'+type+','+id+');"/>'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images//form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+id+');"/></li>';
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var el = '<li style="float:left;width:200px;"><input type="checkbox" name="elment_'+id+'[]" value="" onclick="javascript:return false;"><span></span></li>';
		jQuery(obj).parent('li').after(ele);
		var tarObj = jQuery('#sortable > #'+id).find('ul');
		jQuery('li', tarObj).eq(index).after(el);
	}else if(type=="select"){
		var ele = '<li style="float:left;"><input type="radio" name="form['+id+'][dropdown_choice_selected]" value="" onclick="set_default_choice(jQuery(this),\''+type+'\',\''+id+'\');"/>'
		+'<input name="form['+id+'][select][]" type="text" value="" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'dropdown_choice\',\''+id+'\');" />'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),'+type+','+id+');"/>'
		+'&nbsp;<img src="'+Gootop.RootScript+'/admin/tpl/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'+id+');"/></li>';
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var el = '<option value=""></option>';
		jQuery(obj).parent('li').after(ele);
		var tarObj = jQuery('#sortable > #'+id).find('select');
		jQuery('option', tarObj).eq(index).after(el);
	}
}

function delete_choice(obj,id){
	var tar = jQuery(obj).parent('li').parent('ul');
	var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
	var tarObj = jQuery('#sortable > #'+id).find('ul');
	jQuery('li', tarObj).eq(index).remove();
	jQuery(obj).parent('li').remove();
}

function set_default_choice(obj,type,id){
	if(type=='radio' || type=='checkbox'){
		var tar = jQuery(obj).parent('li').parent('ul');
		var index = jQuery('li', tar).index(jQuery(obj).parent('li'));
		var tarObj = jQuery('#sortable > #'+id).find('ul');
		if(jQuery(obj).attr('checked')==true){
			jQuery('li', tarObj).eq(index).find('input').attr('checked',true);
		}else{
			jQuery('li', tarObj).eq(index).find('input').attr('checked',false);
		}
	}else if(type=="select"){
		jQuery('#sortable > #'+id).find('select').val(jQuery(obj).val());
	}	
}

