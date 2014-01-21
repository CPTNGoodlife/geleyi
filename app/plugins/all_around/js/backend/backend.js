function all_around_get_ajax_array(response) {
	var arr=new Array();
	var i, is;
	for (var key in response) {
		if (key.substring(0,4)=='data') {
			is=key.substring(4);
			i=parseInt(is, 10);
			arr[i]=response[key];
		}
	}
	return arr;
}

var all_around_send_ajax;
var all_around_ajax_load_form;
var all_around_fields_changed = new Array();
var all_around_loader_image;
var all_around_loader_image2;
var all_around_loader_image3;
var all_around_font_type='';
var all_around_google_font_list_loaded=0;
var all_around_font_pointer_input='';
all_around_font_pointer_button='';

var all_around_font_default_settings={
	'type': 'google',
	'font': 'default',
	'variant': 'regular',
	'subset': 'latin',
	'size': 'default',
	'size_unit': 'px',
	'color': 'default',
	'italic': 0,
	'bold': 0,
	'underline': 0,
	'default_bold': 0
};


(function($){

	$(document).ready(function(){

		all_around_loader_image='<img style="width: 208px; float: none;" id="all_around_loader" src="'+all_around_plugin_url+'images/loadingAnimation.gif" />';
		all_around_loader_image2='<img id="all_around_loader" src="'+all_around_plugin_url+'images/loadingAnimation.gif" style="width: 208px; margin-top:27px; margin-left: 130px" title="">';
		all_around_loader_image3='<img id="all_around_loader" src="'+all_around_plugin_url+'images/loadingAnimation.gif" style="width: 208px; display: block; margin-bottom: 15px; margin-left: 15px;" title="">';

		all_around_send_ajax = function(action, pdata, callback, datatype) {
			if (typeof datatype=='undefined') datatype='json';
			//if (datatype!='text') datatype+=' text';
			var sdata=all_around_ajax_action_param+'='+action+'&'+pdata;
			//alert(sdata);
			$.ajax({
				type: 'POST',
				dataType: datatype,
				url: all_around_ajax_receiver, 
				data: sdata,
				success: function(response) {
					callback(response, datatype, 1);
				},
				error: function(request, status){
					//alert(request.responseText);
					console.log('Ajax error: '+request.responseText);
					callback(request.responseText, 'text', 0);
				}
			});
		}
		
		all_around_ajax_load_form = function(target, custom_form, sub_item_id) {
			var item_id=$('#element_id').val();
			var data='item_id='+item_id+'&custom_form='+custom_form+'&sub_item_id='+sub_item_id;
			var sub_item_id_i = parseInt(sub_item_id, 10);
			var check=1;
			if (typeof all_around_fields_changed[sub_item_id_i] == 'undefined') check=0;
			else {
				if (all_around_fields_changed[sub_item_id_i] == 0) check=0;
			}
			if (check==1) {
				var r=confirm("This operation will reset content fields. Continue?");
				if (r==false) return;
			}
			$(target).prepend(all_around_loader_image3);
			all_around_send_ajax('all_around_get_custom_form', data, function(response) {
				if (response.status==1) {
					all_around_fields_changed[sub_item_id_i] = 0;
					$(target).html(response.data);
					var types=custom_form.substring(12);
					var type=parseInt(types, 10)
					//console.log('type='+type+', i='+sub_item_id_i);
					all_around_update_content(type, sub_item_id_i);
					all_around_init_color_picker();
				}
			});	
		}
		
		function all_around_parse_font_variant (variant) {
			var ret={
				italic: 0,
				bold: 0,
				underline: 0
			};
			//console.log('all_around_parse_font_variant '+variant);
			if (typeof variant == 'undefined') return ret;
			if (variant=='regular' || variant=='') return ret;
			
			var len=variant.length;
			if (typeof len != 'undefined') {
				//console.log('len='+len);
				if (len-6>=0) if (variant.substr(len-6)=='italic') ret.italic=1;
			}
			var n=0;
			var ni=0;
			if (len>2) {
				n=variant.substr(0, 3);
				ni=parseInt(n);
				if (ni > 0) ret.bold=ni;
			}
			ni=parseInt(variant);
			if (ni > 0) ret.bold=ni;
			return ret;
		}

		function all_around_convert_json_to_css(obj) {
			var buffer='';
			if (typeof obj.font!='undefined') {
				if (obj.font!=all_around_font_default_settings.font) {
					if (buffer!='') buffer+=' ';
					buffer+='font-family: \''+obj.font+'\' !important;';
				}
			}
			if (typeof obj.size!='undefined') {
				if (obj.size!=all_around_font_default_settings.size) {
					if (buffer!='') buffer+=' ';
					buffer+='font-size: '+obj.size+obj.size_unit+'; line-height: '+obj.size+obj.size_unit+' !important;';
				}
			}
			if (typeof obj.color!='undefined') {
				if (obj.color!=all_around_font_default_settings.color) {
					if (buffer!='') buffer+=' ';
					buffer+='color: '+obj.color+' !important;';
				}
			}
			var additional_style={
				italic: 0,
				bold: 0,
				underline: 0
			};
			if (typeof obj.type=='undefined') obj.type=all_around_font_default_settings.type;
			if (obj.type=='google' && typeof obj.variant != 'undefined') {
				if (obj.variant!=all_around_font_default_settings.variant) {
					additional_style=all_around_parse_font_variant (obj.variant);
					if (typeof obj.underline!='undefined') additional_style.underline=obj.underline;
				}
			}
			if (obj.type=='system') {
				if (typeof obj.italic!='undefined') additional_style.italic=obj.italic;
				if (typeof obj.bold!='undefined') additional_style.bold=obj.bold;
				if (typeof obj.underline!='undefined') additional_style.underline=obj.underline;
			}
			if (additional_style.italic!=0) {
				if (buffer!='') buffer+=' ';
				buffer+='font-style: italic !important;'
			}
			if (additional_style.underline!=0) {
				if (buffer!='') buffer+=' ';
				buffer+='text-decoration: underline !important;'
			}
			if (additional_style.bold!=0) {
				if (additional_style.bold==1) additional_style.bold='bold';
				if (typeof obj.default_bold!='undefined' && obj.default_bold==additional_style.bold) {
				} else {
					if (buffer!='') buffer+=' ';
					buffer+='font-weight: '+additional_style.bold+' !important;'
				}
			} else { // if bold=0
				if (typeof obj.default_bold!='undefined' && obj.default_bold && obj.default_bold!='0') {
					//console.log('default_bold='+obj.default_bold);
					if (buffer!='') buffer+=' ';
					buffer+='font-weight: normal !important;'
				}
			}
			return buffer;
		}
		
		function all_around_make_css_from_field(item, additional_style) {
			if (typeof additional_style=='undefined') additional_style='';
			var json_buffer='';
			var json_object={};
		
			json_buffer=$(item).val();
			//console.log('item='+item);
			json_object = $.parseJSON(json_buffer);
			var buffer = all_around_convert_json_to_css(json_object);
			if (buffer!='') additional_style+=' ';
			buffer=additional_style+buffer;
			if (buffer!='') buffer=' style="'+buffer+'"';
			return buffer;
		}
		
		function all_around_update_content(type, i) {
			if (type==4) return;
			var title=$('#item_'+i+'_title').val();
			//console.log('type = '+type); console.log('title = "'+title+'"'); console.log('i = "'+i+'"');
			var buffer='';

			var title_font = all_around_make_css_from_field('#item_'+i+'_title_font');
			//console.log(title_font);

			if (type==0) {
				var first_field_font = all_around_make_css_from_field('#item_'+i+'_f1_first_field_font');
				var first_field_value_font = all_around_make_css_from_field('#item_'+i+'_f1_first_field_value_font');
				var second_field_font = all_around_make_css_from_field('#item_'+i+'_f1_second_field_font');
				var second_field_value_font = all_around_make_css_from_field('#item_'+i+'_f1_second_field_value_font');
				var third_field_font = all_around_make_css_from_field('#item_'+i+'_f1_third_field_font');
				var third_field_value_font = all_around_make_css_from_field('#item_'+i+'_f1_third_field_value_font');
				var fourth_field_font = all_around_make_css_from_field('#item_'+i+'_f1_fourth_field_font');
				var fourth_field_value_font = all_around_make_css_from_field('#item_'+i+'_f1_fourth_field_value_font');
				var about_font = all_around_make_css_from_field('#item_'+i+'_f1_about_font');
				var first_field=$('#item_'+i+'_f1_first_field').val();
				var first_field_value=$('#item_'+i+'_f1_first_field_value').val();
				var second_field=$('#item_'+i+'_f1_second_field').val();
				var second_field_value=$('#item_'+i+'_f1_second_field_value').val();
				var third_field=$('#item_'+i+'_f1_third_field').val();
				var third_field_value=$('#item_'+i+'_f1_third_field_value').val();
				var fourth_field=$('#item_'+i+'_f1_fourth_field').val();
				var fourth_field_value=$('#item_'+i+'_f1_fourth_field_value').val();
				var about=$('#item_'+i+'_f1_about').val();
				var facebook_link=$('#item_'+i+'_f1_facebook_link').val();
				var twitter_link=$('#item_'+i+'_f1_twitter_link').val();
				var pinterest_link=$('#item_'+i+'_f1_pinterest_link').val();
				var youtube_link=$('#item_'+i+'_f1_youtube_link').val();

				if (title!='') buffer+='<h3'+title_font+'>'+title+'</h3><br /><br />\n';
				if (first_field!='' && first_field_value!='') buffer+='<span class="bold"'+first_field_font+'>'+first_field+' </span><span'+first_field_value_font+'>'+first_field_value+'</span><br />\n';
				if (second_field!='' && second_field_value!='') buffer+='<span class="bold"'+second_field_font+'>'+second_field+' </span><span'+second_field_value_font+'>'+second_field_value+'</span><br />\n';
				if (third_field!='' && third_field_value!='') buffer+='<span class="bold"'+third_field_font+'>'+third_field+' </span><span'+third_field_value_font+'>'+third_field_value+'</span><br />\n';
				if (fourth_field!='' && fourth_field_value!='') buffer+='<span class="bold"'+fourth_field_font+'>'+fourth_field+' </span><span'+fourth_field_value_font+'>'+fourth_field_value+'</span><br />\n';
				if (about!='') buffer+='<br /><span'+about_font+'>'+about+'</span><br />\n';
				if (facebook_link!='' || twitter_link!='' || pinterest_link!='' || youtube_link!='') buffer+='<br /><br />\n';
				if (facebook_link!='') buffer+='<a href="'+facebook_link+'" class="button_socials button_hover_effect fb" data-hovercolor="#496dba" data-hoveroutcolor="#3b5a9a"></a>\n';
				if (twitter_link!='') buffer+='<a href="'+twitter_link+'" class="button_socials button_hover_effect tw" data-hovercolor="#4bb8e7" data-hoveroutcolor="#23aae1"></a>\n';
				if (pinterest_link!='') buffer+='<a href="'+pinterest_link+'" class="button_socials button_hover_effect pin" data-hovercolor="#de343d" data-hoveroutcolor="#cc2129"></a>\n';
				if (youtube_link!='') buffer+='<a href="'+youtube_link+'" class="button_socials button_hover_effect yt" data-hoveroutcolor="#bb000e" data-hovercolor="#fd0013"></a>';
			}
			if (type==1) {
				var first_field_font = all_around_make_css_from_field('#item_'+i+'_f2_first_field_font');
				var first_field_value_font = all_around_make_css_from_field('#item_'+i+'_f2_first_field_value_font');
				var second_field_font = all_around_make_css_from_field('#item_'+i+'_f2_second_field_font');
				var second_field_value_font = all_around_make_css_from_field('#item_'+i+'_f2_second_field_value_font');
				var about_font = all_around_make_css_from_field('#item_'+i+'_f2_about_font');
				var about=$('#item_'+i+'_f2_about').val();
				var first_field=$('#item_'+i+'_f2_first_field').val();
				var first_field_value=$('#item_'+i+'_f2_first_field_value').val();
				var second_field=$('#item_'+i+'_f2_second_field').val();
				var second_field_value=$('#item_'+i+'_f2_second_field_value').val();
				var button_text=$('#item_'+i+'_f2_button_text').val();
				var button_link=$('#item_'+i+'_f2_button_link').val();
				var button_color=$('#item_'+i+'_f2_button_color').val();
				var button_color_css='background-color: '+button_color+';';
				var button_hover_color=$('#item_'+i+'_f2_button_hover_color').val();
				var button_font = all_around_make_css_from_field('#item_'+i+'_f2_button_font', button_color_css);

				if (title!='') buffer+='<h3'+title_font+'>'+title+'</h3><br /><br />\n';
				if (about!='') buffer+='<span'+about_font+'>'+about+'</span><br /><br /><br />\n';
				if (first_field!='' && first_field_value!='') buffer+='<span class="bold"'+first_field_font+'>'+first_field+' </span><span'+first_field_value_font+'>'+first_field_value+'</span><br />\n';
				if (second_field!='' && second_field_value!='') buffer+='<span class="bold"'+second_field_font+'>'+second_field+' </span><span'+second_field_value_font+'>'+second_field_value+'</span><br />\n';
				if (button_text!='' && button_link!='') buffer+='<br /><br /><a href="'+button_link+'" class="button_regular button_hover_effect" data-hovercolor="'+button_hover_color+'" data-hoveroutcolor="'+button_color+'"'+button_font+'>'+button_text+'</a>';
			}
			if (type==2) {
				var first_title_font = all_around_make_css_from_field('#item_'+i+'_f3_first_title_font');
				var first_about_font = all_around_make_css_from_field('#item_'+i+'_f3_first_about_font');
				var second_title_font = all_around_make_css_from_field('#item_'+i+'_f3_second_title_font');
				var second_about_font = all_around_make_css_from_field('#item_'+i+'_f3_second_about_font');
				var third_title_font = all_around_make_css_from_field('#item_'+i+'_f3_third_title_font');
				var third_about_font = all_around_make_css_from_field('#item_'+i+'_f3_third_about_font');
				var fourth_title_font = all_around_make_css_from_field('#item_'+i+'_f3_fourth_title_font');
				var fourth_about_font = all_around_make_css_from_field('#item_'+i+'_f3_fourth_about_font');
				var first_show=$('#item_'+i+'_f3_first_show').val();
				var first_image=$('#item_'+i+'_f3_first_image').val();
				var first_title=$('#item_'+i+'_f3_first_title').val();
				var first_about=$('#item_'+i+'_f3_first_about').val();
				var second_show=$('#item_'+i+'_f3_second_show').val();
				var second_image=$('#item_'+i+'_f3_second_image').val();
				var second_title=$('#item_'+i+'_f3_second_title').val();
				var second_about=$('#item_'+i+'_f3_second_about').val();
				var third_show=$('#item_'+i+'_f3_third_show').val();
				var third_image=$('#item_'+i+'_f3_third_image').val();
				var third_title=$('#item_'+i+'_f3_third_title').val();
				var third_about=$('#item_'+i+'_f3_third_about').val();
				var fourth_show=$('#item_'+i+'_f3_fourth_show').val();
				var fourth_image=$('#item_'+i+'_f3_fourth_image').val();
				var fourth_title=$('#item_'+i+'_f3_fourth_title').val();
				var fourth_about=$('#item_'+i+'_f3_fourth_about').val();

				if (title!='') buffer+='<h3'+title_font+'>'+title+'</h3><br /><br />\n<div class="separator"></div><br /><br />\n';
				if (first_show==1) {
					buffer+='<div class="col-1-4_block">\n';
					if (first_image!='') buffer+='	<div class="content_img_wrap"><img src="'+first_image+'" alt="" style="width: 182px;" /><a href="'+first_image+'" class="hover_link" rel="prettyPhoto"><img src="'+all_around_plugin_url+'images/more.png" alt="More" /></a></div><br />\n';
					if (first_title!='') buffer+='	<h4'+first_title_font+'>'+first_title+'</h4><br />\n';
					if (first_about!='') buffer+='	<span'+first_about_font+'>'+first_about+'</span>\n';
					buffer+='</div>\n';
				}
				if (second_show==1) {
					buffer+='<div class="col-1-4_block">\n';
					if (second_image!='') buffer+='	<div class="content_img_wrap"><img src="'+second_image+'" alt="" style="width: 182px;" /><a href="'+second_image+'" class="hover_link" rel="prettyPhoto"><img src="'+all_around_plugin_url+'images/more.png" alt="More" /></a></div><br />\n';
					if (second_title!='') buffer+='	<h4'+second_title_font+'>'+second_title+'</h4><br />\n';
					if (second_about!='') buffer+='	<span'+second_about_font+'>'+second_about+'</span>\n';
					buffer+='</div>\n';
				}
				if (third_show==1) {
					buffer+='<div class="col-1-4_block">\n';
					if (third_image!='') buffer+='	<div class="content_img_wrap"><img src="'+third_image+'" alt="" style="width: 182px;" /><a href="'+third_image+'" class="hover_link" rel="prettyPhoto"><img src="'+all_around_plugin_url+'images/more.png" alt="More" /></a></div><br />\n';
					if (third_title!='') buffer+='	<h4'+third_title_font+'>'+third_title+'</h4><br />\n';
					if (third_about!='') buffer+='	<span'+third_about_font+'>'+third_about+'</span>\n';
					buffer+='</div>\n';
				}
				if (fourth_show==1) {
					console.log('fourth_show='+fourth_show);
					buffer+='<div class="col-1-4_block">\n';
					if (fourth_image!='') buffer+='	<div class="content_img_wrap"><img src="'+fourth_image+'" alt="" style="width: 182px;" /><a href="'+fourth_image+'" class="hover_link" rel="prettyPhoto"><img src="'+all_around_plugin_url+'images/more.png" alt="More" /></a></div><br />\n';
					if (fourth_title!='') buffer+='	<h4'+fourth_title_font+'>'+fourth_title+'</h4><br />\n';
					if (fourth_about!='') buffer+='	<span'+fourth_about_font+'>'+fourth_about+'</span>\n';
					buffer+='</div>';
				}
			}
			if (type==3) {
				var first_title_font = all_around_make_css_from_field('#item_'+i+'_f4_first_title_font');
				var first_about_font = all_around_make_css_from_field('#item_'+i+'_f4_first_about_font');
				var second_title_font = all_around_make_css_from_field('#item_'+i+'_f4_second_title_font');
				var second_about_font = all_around_make_css_from_field('#item_'+i+'_f4_second_about_font');
				var third_title_font = all_around_make_css_from_field('#item_'+i+'_f4_third_title_font');
				var third_about_font = all_around_make_css_from_field('#item_'+i+'_f4_third_about_font');
				var first_show=$('#item_'+i+'_f4_first_show').val();
				var first_title=$('#item_'+i+'_f4_first_title').val();
				var first_image=$('#item_'+i+'_f4_first_image').val();
				var first_about=$('#item_'+i+'_f4_first_about').val();
				var first_button_text=$('#item_'+i+'_f4_first_button_text').val();
				var first_button_link=$('#item_'+i+'_f4_first_button_link').val();
				var second_show=$('#item_'+i+'_f4_second_show').val();
				var second_title=$('#item_'+i+'_f4_second_title').val();
				var second_image=$('#item_'+i+'_f4_second_image').val();
				var second_about=$('#item_'+i+'_f4_second_about').val();
				var second_button_text=$('#item_'+i+'_f4_second_button_text').val();
				var second_button_link=$('#item_'+i+'_f4_second_button_link').val();
				var third_show=$('#item_'+i+'_f4_third_show').val();
				var third_title=$('#item_'+i+'_f4_third_title').val();
				var third_image=$('#item_'+i+'_f4_third_image').val();
				var third_about=$('#item_'+i+'_f4_third_about').val();
				var third_button_text=$('#item_'+i+'_f4_third_button_text').val();
				var third_button_link=$('#item_'+i+'_f4_third_button_link').val();

				var first_button_color=$('#item_'+i+'_f4_first_button_color').val();
				var first_button_color_css='background-color: '+first_button_color+';';
				var first_button_hover_color=$('#item_'+i+'_f4_first_button_hover_color').val();
				var second_button_color=$('#item_'+i+'_f4_second_button_color').val();
				var second_button_color_css='background-color: '+second_button_color+';';
				var second_button_hover_color=$('#item_'+i+'_f4_second_button_hover_color').val();
				var third_button_color=$('#item_'+i+'_f4_third_button_color').val();
				var third_button_color_css='background-color: '+third_button_color+';';
				var third_button_hover_color=$('#item_'+i+'_f4_third_button_hover_color').val();

				var first_button_font = all_around_make_css_from_field('#item_'+i+'_f4_first_button_font', first_button_color_css);
				var second_button_font = all_around_make_css_from_field('#item_'+i+'_f4_second_button_font', second_button_color_css);
				var third_button_font = all_around_make_css_from_field('#item_'+i+'_f4_third_button_font', third_button_color_css);

				if (title!='') buffer+='<h3'+title_font+'>'+title+'</h3><br /><br />\n<div class="separator"></div><br /><br />\n';
				if (first_show==1) {
					buffer+='<div class="col-1-3_block">\n';
					if (first_title!='') buffer+='	<h4'+first_title_font+'>'+first_title+'</h4><br />\n';
					if (first_image!='') buffer+='	<img src="'+first_image+'" alt="" style="width: 230px;" /><br />\n';
					if (first_about!='') buffer+='	<br /><span'+first_about_font+'>'+first_about+'</span><br />\n';
					if (first_button_text!='' && first_button_link!='') buffer+='	<br /><br /><a href="'+first_button_link+'" class="button_regular button_hover_effect" data-hovercolor="'+first_button_hover_color+'" data-hoveroutcolor="'+first_button_color+'"'+first_button_font+'>'+first_button_text+'</a>\n';
					buffer+='</div>\n';
				}
				if (second_show==1) {
					buffer+='<div class="col-1-3_block">\n';
					if (second_title!='') buffer+='	<h4'+second_title_font+'>'+second_title+'</h4><br />\n';
					if (second_image!='') buffer+='	<img src="'+second_image+'" alt="" style="width: 230px;" /><br />\n';
					if (second_about!='') buffer+='	<br /><span'+second_about_font+'>'+second_about+'</span><br />\n';
					if (second_button_text!='' && second_button_link!='') buffer+='	<br /><br /><a href="'+second_button_link+'" class="button_regular button_hover_effect" data-hovercolor="'+second_button_hover_color+'" data-hoveroutcolor="'+second_button_color+'"'+second_button_font+'>'+second_button_text+'</a>\n';
					buffer+='</div>\n';
				}
				if (third_show==1) {
					buffer+='<div class="col-1-3_block">\n';
					if (third_title!='') buffer+='	<h4'+third_title_font+'>'+third_title+'</h4><br />\n';
					if (third_image!='') buffer+='	<img src="'+third_image+'" alt="" style="width: 230px;" /><br />\n';
					if (third_about!='') buffer+='	<br /><span'+third_about_font+'>'+third_about+'</span><br />\n';
					if (third_button_text!='' && third_button_link!='') buffer+='	<br /><br /><a href="'+third_button_link+'" class="button_regular button_hover_effect" data-hovercolor="'+third_button_hover_color+'" data-hoveroutcolor="'+third_button_color+'"'+third_button_font+'>'+third_button_text+'</a>\n';
					buffer+='</div>\n';
				}
			}
			
			$('#item_'+i+'_content').val(buffer);
		
		}

		all_around_control_changed_callback_for_all = function(name, value) {
			//console.log('Changed: '+name+' = '+value);
			if (name=='settings_param_hv_switch') {
				if (value==0) $('#settings_param_wrapper_text_max_height_span').html('Slider height:');
				if (value==1) $('#settings_param_wrapper_text_max_height_span').html('Slider width:');
			}
			if (name.indexOf('_f1_')>-1 || name.indexOf('_f2_')>-1 || name.indexOf('_f3_')>-1 || name.indexOf('_f4_')>-1 || name.indexOf('_title')>-1 || name.indexOf('_font')>-1) {
				var p=name.indexOf('_',5);
				var is=name.substring(5, p);
				var i=parseInt(is,10);
				all_around_fields_changed[i]=1;
				var type=$('#item_'+i+'_content_type').val();
				all_around_update_content(type, i);
			}
		}
		
		if (all_around_should_check_for_update==1) {
			all_around_send_ajax('all_around_get_responder_answer', 'action2=check_for_update&var1='+all_around_version, function(response) {
				if (response.status==1) {
					var r=response.data;
					if (r.substring(0,3)=='New') {
						//console.log(response.data);
						$notification=$('#all_around_update_notification');
						$notification.html(response.data);
						$notification.fadeIn('slow');
					}
				}
			});
		}

		if (all_around_update_google_fonts==1) {
			all_around_send_ajax('all_around_download_google_fonts', '', function(response) {
				//alert(response);
			});
		}
		
		$('.all_around_font_button').live('click', function(){
			var val_pointer=$(this).attr('data-value');
			all_around_font_pointer_input=val_pointer;
			all_around_font_pointer_button=$(this).attr('id');
			var val=$('#'+val_pointer).attr('value');
			var arr=$.parseJSON(val);
			//alert(arr.font);
			all_around_popup_fonts (arr);
		});
		
		//all_around_popup_fonts();
		function all_around_popup_fonts (new_settings) {
			var settings={}; //=all_around_font_default_settings;
			$.extend(settings, all_around_font_default_settings);
			//settings.type='test'; alert (all_around_font_default_settings.type); return;
			if (typeof new_settings != 'undefined') {
				$.extend(settings, new_settings);
			}
			all_around_font_type=settings.type;

			all_around_create_popup('Set font', '', 500, 'px', 340, 0, 1, 150);
			
			if (settings.type=='google') {
				all_around_send_ajax('all_around_get_font_listboxes', 'with_font_list=1&type='+settings.type+'&font='+settings.font+'&variant='+settings.variant+'&subset='+settings.subset, function(response, type, status) {
					all_around_google_font_list_loaded=1;
					settings.font_list=response.font_list;
					settings.variant_list=response.variant_list;
					settings.subset_list=response.subset_list;
					all_around_set_fonts_popup (settings);
				});
			} else {
				all_around_set_fonts_popup (settings);
			}

		}
		
		function all_around_generate_listbox (name, arr, default_value) {
			buffer='<select id="'+name+'" name="'+name+'">';
			for (var key in arr) {
				var val=arr[key];
				if (key==default_value) selected='selected="selected" ';
				else selected='';
				buffer+='<option '+selected+'value="'+key+'">'+val+'</option>';
			}
			buffer+='</select>';
			return buffer;
		}
		function all_around_generate_options (arr, default_value) {
			buffer='';
			for (var key in arr) {
				var val=arr[key];
				if (key==default_value) selected='selected="selected" ';
				else selected='';
				buffer+='<option '+selected+'value="'+key+'">'+val+'</option>';
			}
			return buffer;
		}

		
		function all_around_set_fonts_popup (settings) {
			var checked_google='';
			var checked_system='';
			var div_google_visible='display: none;';
			var div_system_visible='display: none;';
			if (settings.type=='google') {checked_google=' checked="checked"'; div_google_visible='';}
			if (settings.type=='system') {checked_system=' checked="checked"'; div_system_visible='';}
			settings.bold_checked='';
			settings.italic_checked='';
			settings.underline_checked='';
			if (settings.bold==1) settings.bold_checked='checked="checked"';
			if (settings.italic==1) settings.italic_checked='checked="checked"';
			if (settings.underline==1) settings.underline_checked='checked="checked"';
			//if (settings.color=='default') settings.color='#000000';

			var arr=new Array();
			arr['px']='px';
			arr['em']='em';
			arr['%']='%';
			arr['mm']='mm';
			arr['cm']='cm';
			arr['in']='in';
			arr['pt']='pt';
			arr['ex']='ex';
			arr['pc']='pc';
			settings.size_units_listbox=all_around_generate_options (arr, settings.size_unit);
			
			var arr2=new Array();
			var key, val;
			for (var i=0; i<=100; i++) {
				key=i;
				val=i;
				if (i==0) {key='default'; val='Default';}
				arr2[key]=val;
			}
			settings.sizes_listbox=all_around_generate_options (arr2, settings.size);

			if (typeof settings.font_list == 'undefined') settings.font_list='Loading...';
			if (typeof settings.variant_list == 'undefined') settings.variant_list='Loading...';
			if (typeof settings.subset_list == 'undefined') settings.subset_list='Loading...';

			buffer='<div style="margin-top: 10px; margin-left: auto; margin-right: auto; width: 400px;">';
				buffer+='<label for="all_around_google_font"><input type="radio" name="all_around_font_type" value="google"'+checked_google+' id="all_around_google_font"> Google fonts</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for="all_around_system_font"><input type="radio" name="all_around_font_type" value="system"'+checked_system+' id="all_around_system_font"> System fonts</label><br /><br /><br />';
				buffer+='<div style="text-align: left; width: 350px; margin-left: auto; margin-right: auto; padding-left: 56px;">';
					buffer+='<div id="google_fonts_div" style="'+div_google_visible+'">';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Font:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_font_name_list">'+settings.font_list+'</div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Variant:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_font_variant_list">'+settings.variant_list+'</div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Subset:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_font_subset_list">'+settings.subset_list+'</div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Size:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_size"><select id="all_around_font_size" name="all_around_font_size" style="width: 80px;">'+settings.sizes_listbox+'</select><select name="all_around_font_size_unit" id="all_around_font_size_unit">'+settings.size_units_listbox+'</select></div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Color:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_color"><div class="fbuilder_color_wrapper"><input type="text" name="all_around_font_color" id="all_around_font_color" value="'+settings.color+'" class="fbuilder_color fbuilder_input" style="padding: 3px;"><div class="fbuilder_color_display fbuilder_color_display_default"></div><div class="fbuilder_colorpicker" style="position: absolute; z-index: 1000;"></div></div> </div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Underline:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_underline"><input type="checkbox" name="all_around_font_underline" id="all_around_font_underline" value="1"'+settings.underline_checked+'></div></div>';
					buffer+='</div>';
					buffer+='<div id="system_fonts_div" style="'+div_system_visible+'">';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span style="vertical-align: top; margin-top: 3px;" class="all_around_popup">Font:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_font_name"><input type="text" id="all_around_font_name2" name="all_around_font_name2" value="'+settings.font+'" style="width: 200px;">';
						buffer+='<br /><small>Examples: <a class="all_around_font_change" data-value="default">Default</a>, <a class="all_around_font_change" data-value="Tahoma, Arial, Helvetica, sans-serif">Tahoma</a>, <a class="all_around_font_change" data-value="Arial, Helvetica, sans-serif">Arial</a>,<br /><a class="all_around_font_change" data-value="Helvetica, Arial, sans-serif">Helvetica</a>, <a class="all_around_font_change" data-value="sans-serif, Helvetica, Arial">sans-serif</a>, <a class="all_around_font_change" data-value="Verdana, Helvetica, Arial, sans-serif">Verdana</a></small>';
						buffer+='</div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Size:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_size2"><select name="all_around_font_size2" id="all_around_font_size2" style="width: 146px;">'+settings.sizes_listbox+'</select><select name="all_around_font_size_unit2" id="all_around_font_size_unit2">'+settings.size_units_listbox+'</select></div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Color:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_color2"><div class="fbuilder_color_wrapper"><input type="text" name="all_around_font_color2" id="all_around_font_color2" value="'+settings.color+'" class="fbuilder_color fbuilder_input" style="padding: 3px; width: 200px;"><div class="fbuilder_color_display fbuilder_color_display_default"></div><div class="fbuilder_colorpicker" style="position: absolute; z-index: 1000;"></div></div> </div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Bold:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_bold2"><input type="checkbox" name="all_around_font_bold2" id="all_around_font_bold2" value="1"'+settings.bold_checked+'></div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Italic:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_italic2"><input type="checkbox" name="all_around_font_italic2" id="all_around_font_italic2" value="1"'+settings.italic_checked+'></div></div>';
						buffer+='<div style="display: block; margin-bottom: 5px;"><span class="all_around_popup">Underline:</span><div style="display: inline-block; padding: 0; margin: 0;" id="all_around_div_underline2"><input type="checkbox" name="all_around_font_underline2" id="all_around_font_underline2" value="1"'+settings.underline_checked+'></div></div>';
					buffer+='</div>';
				buffer+='</div>';
				buffer+='<br /><input type="hidden" name="all_around_font_default_bold" id="all_around_font_default_bold" value="'+settings.default_bold+'"><a class="fbuilder_gradient fbuilder_button fbuilder_toggle_clear left" id="all_around_font_set_button" style="float: none; padding: 5px; display: inline-block; width: 50px;">Set</a></div>';
			buffer+='</div>';
			all_around_set_popup_content(buffer);
			all_around_make_font_form_handlers();
			$("input[name='all_around_font_type']").change(function(){
				var val = $(this).val();
				if (all_around_font_type=='google') {
					if (val=='system') {
						$('#google_fonts_div').fadeOut(400, function(){
							$('#system_fonts_div').fadeIn();
							all_around_font_type='system';
						});
					}
				} else {
					if (val=='google') {
						$('#system_fonts_div').fadeOut(400, function(){
							$('#google_fonts_div').fadeIn();
							if (all_around_google_font_list_loaded==0) {
								all_around_send_ajax('all_around_get_font_listboxes', 'with_font_list=1&type=google&font=default', function(response, type, status) {
									all_around_google_font_list_loaded=1;
									// response.font_list, response.variant_list, response.subset_list
									$('#all_around_div_font_name_list').html(response.font_list);
									$('#all_around_div_font_variant_list').html(response.variant_list);
									$('#all_around_div_font_subset_list').html(response.subset_list);
									all_around_make_font_form_handlers();
								});
							}
							all_around_font_type='google';
						});
					}
				}
			});
			$(".all_around_font_change").click(function(){
				var val = $(this).attr('data-value');
				$('#all_around_font_name2').attr('value', val);
			});
			$("#all_around_font_set_button").click(function(){
				//alert('ok');
				var ret={};
				ret.type=all_around_font_type;
				if (all_around_font_type=='system') {
					ret.font=$('#all_around_font_name2').val();
					ret.size=$('#all_around_font_size2').val();
					ret.size_unit=$('#all_around_font_size_unit2').val();
					ret.color=$('#all_around_font_color2').val();
					if ($('#all_around_font_bold2').is(':checked')) ret.bold=1;
					else ret.bold=0;
					if ($('#all_around_font_italic2').is(':checked')) ret.italic=1;
					else ret.italic=0;
					if ($('#all_around_font_underline2').is(':checked')) ret.underline=1;
					else ret.underline=0;
				}
				if (all_around_font_type=='google') {
					ret.font=$('#all_around_font_name').val();
					ret.variant=$('#all_around_font_variant').val();
					ret.subset=$('#all_around_font_subset').val();
					ret.size=$('#all_around_font_size').val();
					ret.size_unit=$('#all_around_font_size_unit').val();
					ret.color=$('#all_around_font_color').val();
					if ($('#all_around_font_underline').is(':checked')) ret.underline=1;
					else ret.underline=0;
				}
				ret.default_bold=$('#all_around_font_default_bold').val();
				var rets=JSON.stringify(ret);
				$('#'+all_around_font_pointer_input).attr('value', rets);
				var rets2=all_around_convert_font_data_to_label(ret);
				$('#'+all_around_font_pointer_button).html(rets2);
				all_around_control_changed(all_around_font_pointer_input, ret);
				all_around_google_font_list_loaded=0;
				all_around_remove_popup();
			});
		}
		function all_around_convert_font_data_to_label(arr) {
			if (typeof arr.font == 'undefined') arr.font='Default';
			if (arr.font == 'default') arr.font='Default';
			if (arr.font.indexOf(",")>-1) arr.font=arr.font.substring(0, arr.font.indexOf(","));
			var s = arr.font+" font";
			if (typeof arr.size!='undefined' && typeof arr.size_unit!='undefined')
				if (arr.size!='default') s+=", "+arr.size+arr.size_unit;
			s+='...';
			return s;
		}
		function all_around_make_font_form_handlers() {
			all_around_init_color_picker();
			$('#all_around_font_name').change(function(){
				var font = $(this).val();
				var variant = $('#all_around_font_variant').val();
				var subset = $('#all_around_font_subset').val();
				var sent='with_font_list=0&type='+all_around_font_type+'&font='+font+'&variant='+variant+'&subset='+subset;
				all_around_send_ajax('all_around_get_font_listboxes', sent, function(response, type, status) {
					$('#all_around_div_font_variant_list').html(response.variant_list);
					$('#all_around_div_font_subset_list').html(response.subset_list);
				});
			});
		}
		
		//all_around_popup_fonts();

		$('#all_around_save_button').on('click', function(e) {
			e.preventDefault();
			$('#all_around_save_loader').show();
			var postForm = $('#form1').serialize();
			postForm=postForm.replace(/\&/g, '[odvoji]');
			//$('#save-loader').show();
			//alert(postForm);
			var data='all_around_data=' + postForm;
			all_around_send_ajax(all_around_ajax_save_handler, data, function(response, type, status){
				//alert("Saved\nstatus="+status+"\ntype="+type+"\ndata="+response.data);
				$('#all_around_save_loader').hide();
				$('#all_around_save_status').fadeIn('slow', function(){
					$(this).fadeOut('slow');
				});
				var id='';
				if (typeof response.id!='undefined') id=response.id;
				if (response.status==2) {
					window.location=all_around_admin_url+'&action=edit&id='+response.id;
					return;
				}
				//$('#usquare_id').val(response);
				//$('#save-loader').hide();
				//saved_alert ();
			});
		});

		$('#all_around_add_new_item').on('click', function(e) {
			e.preventDefault();
			var count=$('li.all_around_primary_sortable').length;
			all_around_send_ajax('all_around_add_subitem', 'count='+count, function(response) {
				//alert("New item\nstatus="+response.status+"\ndata="+response.data);
				if (response.status==1) {
					$('#all_around_sortable').append('<li class="ui-state-default all_around_primary_sortable">'+response.data+'</li>');
					all_around_update_content(0, count);
					//all_around_init_color_picker();
				}
			});
		});
		function all_around_add_new_item_from_post(id) {
			var count=$('li.all_around_primary_sortable').length;
			all_around_send_ajax('all_around_add_subitem', 'count='+count+'&from_post='+id, function(response) {
				//alert("New item\nstatus="+response.status+"\ndata="+response.data);
				if (response.status==1) {
					$('#all_around_sortable').append('<li class="ui-state-default all_around_primary_sortable">'+response.data+'</li>');
					//all_around_init_color_picker();
				}
			});
		}
		function all_around_add_new_item_from_category(id) {
			var count=$('li.all_around_primary_sortable').length;
			all_around_send_ajax('all_around_add_subitem_from_category', 'count='+count+'&category='+id, function(response) {
				//alert("New item\nstatus="+response.status+"\ndata="+response.data);
				if (response.status==1) {
					var arr=all_around_get_ajax_array(response);
					for (i=0; i<arr.length; i++) {
						//console.log(i + ' = ' + arr[i]);
						$('#all_around_sortable').append('<li class="ui-state-default all_around_primary_sortable">'+arr[i]+'</li>');
					}
					//all_around_init_color_picker();
				}
				all_around_remove_popup();
			});
		}
		//all_around_add_new_item_from_category(1);
		
		$('.all_around_delete').on('click', function(e) {
			e.preventDefault();
			var url=$(this).attr('href');
			//alert(url);
			var r=confirm("Are you sure you want delete this slider?");
			if (r==true) {
				window.location=url;
			}
		});
		
		
		$('#all_around_preview_button').click(function(e){
			e.preventDefault();
			all_around_create_popup('Preview', '', 98, '%', 600);
			var postForm = $('#form1').serialize();
			postForm=postForm.replace(/\&/g, '[odvoji]');
			var data='all_around_data=' + postForm;
			all_around_send_ajax(all_around_ajax_preview_handler, data, function(response) {
				//alert(response.data);
				$('#all_around_loader').remove();
				$('#all_around_popup_holder').html(response.data);
			});
		});

		$('#all_around_add_new_from_post').click(function(e){
			var buffer='<label for="all_around_search_input">Search posts:</label><input id="all_around_search_input" style="width:260px;" name="all_around_search_input">';
			buffer+='<ul id="all_around_search_ul" style=""></ul>';

			all_around_create_popup('Insert from post', buffer, 450, 'px', 250, 0);
			
			$('#all_around_search_input').focus();
			$('#all_around_search_input').keyup(function(e){
				var qinput = $(this).val();
				console.log('qinput='+qinput);
				$('#all_around_search_ul').html('<li style="text-align: center;">'+all_around_loader_image+'</li>');

				all_around_send_ajax('all_around_post_search', 'query='+qinput, function(response, dataType, success) {
					//alert(response.data);
					//console.log('dataType='+dataType+', success='+success);
					if (dataType=='text' || success==0) return;
					$('#all_around_search_ul').html(response.data);
					$('.all_around_search_li_a').click(function(e) {
						e.preventDefault();
						var id=$(this).attr('data-id');
						all_around_add_new_item_from_post(id);
						all_around_remove_popup();
					});
				});
			});
		});

		$('#all_around_add_new_from_category').click(function(e){
			all_around_create_popup('Insert from category', '', 450, 'px', 100, 0, 0, 27, 130);
			all_around_send_ajax('all_around_get_categories_listbox', '', function(response) {
				var buffer='<div style="position: relative; margin-left: 40px; margin-top: 20px;"><label for="all_around_search_input">Choose category: </label>'+response.data;
				buffer+=' <a class="fbuilder_gradient fbuilder_button fbuilder_toggle_clear left" id="all_around_category_button" style="float: none; padding: 5px; display: inline-block; width: 50px;">Add</a></div>';
				all_around_set_popup_content(buffer);
				$('#all_around_category_button').click(function(e){
					var val=$('#all_around_category_select').val();
					//alert(val);
					all_around_set_popup_content(all_around_loader_image2);
					all_around_add_new_item_from_category(val);
				});
			});
		});
		
		$('.all_around_delete_subitem').live('click',function(e){
			console.log('link click');
			e.preventDefault();
			e.stopPropagation();
			var r=confirm("Are you sure you want delete this item?");
			if (r==true) {
				$(this).parents('.all_around_primary_sortable').remove();
			}
		});


	});

})(jQuery);