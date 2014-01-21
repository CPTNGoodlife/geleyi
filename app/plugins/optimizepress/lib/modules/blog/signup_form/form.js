;(function($){
	var op_optin = function($t){
		var self = this;
		self.$t = $t;
		self.tmp_obj = $('<div />');
		self.selects = $t.find('.field_select').change(function(){ check_select(this) });
		self.hdn_div = $t.find('.hidden-div');
		self.prefix = $t.find('.field_prefix').val();
		self.idprefix = $t.find('.field_idprefix').val();
		self.input_elems = {},
		self.lists = {};
		self.els = {
			email_select: $t.find('.email_select'),
			email_selected: $t.find('.email_box_selected').val(),
			name_select: $t.find('.name_select'),
			name_selected: $t.find('.name_box_selected').val(),
			action: $t.find('.form_action'),
			method: $t.find('.method_select'),
			extra_fields: $t.find('.extra_fields .op-multirow-container'),
			email_extra_fields: $t.find('.email_data_extra_fields .op-multirow-container')
		};
		self.els.email_extra_fields.data('multirow_counter',self.els.email_extra_fields.find('.op-multirow').length);
		self.els.extra_fields.data('multirow_counter',self.els.extra_fields.find('.op-multirow').length);

		function doIntegrationType(integrationType) {
			var $select = self.$t.find('.provider_list_select');
			$select.empty().after('<img class="op-bsw-waiting" src="images/wpspin_light.gif" alt="loading" style="position:relative;display:block;top:4px">');
			$.post(OptimizePress.ajaxurl,
				{
					'action': OptimizePress.SN+'-email-provider-details',
					'provider': integrationType
				},
				function(response){
					self.lists = response.lists;
					switch (integrationType) {
						case 'infusionsoft':
						case 'aweber':
						case 'mailchimp':
						case 'icontact':
						case 'getresponse':
						case 'campaignmonitor':
							var options = [];
							$.each(response.lists, function (id, list) {
								options.push($('<option/>', {value: id, text: list.name}));
							});
							$select.empty().append(options);
							break;
					}
					/*
					 * Removing loading graphics
					 */
					$select.next().remove();

					/*
					 * Selecting previously selected value (if editing)
					 */
					if (typeof $select.attr('data-default') != 'undefined') {
						$select.val($select.attr('data-default'));
					}

					$select.trigger('change');
				},
				'json'
			);
		}

		self.$t.find('.integration_type_select').change(function(e) {
			var show, hide, integrationType = $(this).val();
			switch (integrationType) {
				case 'email':
					show = 'p.email_data_field,div.email_data_field,p.new_window';
					hide = 'p.form_html_field,div.form_html_field,p.provider_list,p.thank_you_page,p.action_page,div.provider_list_note';
					break;
				case 'custom':
				case 'oneshoppingcart':
					hide = 'p.email_data_field,div.email_data_field,p.provider_list,p.thank_you_page,p.action_page,div.provider_list_note';
					show = 'p.form_html_field,div.form_html_field,p.new_window';
					break;
				case 'infusionsoft':
					hide = 'p.email_data_field,p.form_html_field,div.form_html_field,div.email_data_field,p.new_window,p.thank_you_page';
					show = 'p.provider_list,div.extra_fields,p.action_page,div.provider_list_note';
					doIntegrationType(integrationType);
					break;
				case 'aweber':
				case 'getresponse':
				case 'mailchimp':
				case 'icontact':
				case 'campaignmonitor':
				case 'officeautopilot':
					hide = 'p.email_data_field,p.form_html_field,div.form_html_field,div.email_data_field,p.new_window,p.action_page';
					show = 'p.provider_list,p.thank_you_page,div.extra_fields,div.provider_list_note';
					doIntegrationType(integrationType);
					break;
			}
			self.$t.find(hide).hide();
			self.$t.find(show).show();
			$.fancybox.update();
		}).trigger('change');

		self.$t.find('.gotowebinar_enabled_select').change(function(e) {
			var $gotowebinar = self.$t.find('.gotowebinar_list_field');
			if ($(this).val() == 'Y') {
				$gotowebinar.show();
			} else {
				$gotowebinar.hide();
			}
		}).trigger('change');

		self.$t.find('.provider_list_select').change(function() {
			var list = $(this).val();
			self.input_elems = {};
			if (typeof self.lists[list] != 'undefined') {
				self.input_elems = self.lists[list].fields;	
			}
			/*
			 * Infusionsoft action page attribute 
			 */
			if (typeof self.lists[list] != 'undefined' 
			&& typeof self.lists[list].action != 'undefined') {
				self.$t.find('.action_page input').val(self.lists[list].action);
			}
			/*
			 * Infusionsoft hidden form params
			 */
			if (typeof self.lists[list] != 'undefined' 
			&& typeof self.lists[list].hidden != 'undefined') {
				$.each(self.lists[list].hidden, function (i, item) {
					self.hdn_div.empty();
					self.hdn_div.append($('<input type="hidden" name="'+self.prefix+'[fields][field_name][]" />').val(i));
					self.hdn_div.append($('<input type="hidden" name="'+self.prefix+'[fields][field_vals][]" />').val(item));
				});
			}
			var options = [];
			$.each(self.input_elems, function(id, value) {
				options.push($('<option/>', {value: id, text: value}));
			});
			var $name = self.$t.find('.name_select');
			$name.empty().append(options);

			multirow_dropdown();
			/*
			 * Selecting previously selected value (if editing)
			 */
			// if (typeof $name.attr('data-default') != 'undefined') {
			// 	$name.val($name.attr('data-default'));
			// }
		});
		
		self.$t.find('.form_html').change(function(){
			var tmp = self.tmp_obj;
			self.input_elems = {};
			tmp.html($(this).val().replace(/<!--.*-->/g, "").replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,''));
			var form = tmp.find('form[action]');
			
			self.els.method.val('');
			self.els.action.val('');
			self.selects.find('option').remove();
			self.hdn_div.html('');
			
			if(form.length > 0){
				$('input[name]:not(:button,:submit)',form).each(function(){
					var name = $(this).attr('name'),
						name_selected = name == self.els.name_selected ? ' selected="selected"' : '', 
						email_selected = name == self.els.email_selected ? ' selected="selected"' : '';
					self.els.name_select.append('<option value="'+name+'"'+name_selected+'>'+name+'</option>');
					self.els.email_select.append('<option value="'+name+'"'+email_selected+'>'+name+'</option>');
					self.input_elems[name] = name;
				});
				if(typeof self.input_elems.name != 'undefined'){
					self.els.name_select.val('name');
				}
				if(typeof self.input_elems.email != 'undefined'){
					self.els.email_select.val('email');
				}
				$(':input',self.tmp_obj).each(function(){
					var name = $(this).attr('name');
					if(typeof name != 'undefined'){
						self.hdn_div.append($('<input type="hidden" name="'+self.prefix+'[fields][field_name][]" />').val(name));
						self.hdn_div.append($('<input type="hidden" name="'+self.prefix+'[fields][field_vals][]" />').val($(this).val()));
					}
				});
				self.els.action.val(form.attr('action'));
				self.els.method.val((form.attr('method') || 'post').toLowerCase());
				check_select(self.els.name_select);
				multirow_dropdown();
			}
		}).keyup(function(){$(this).trigger('change')}).trigger('change');
		
		self.$t.find('.disable_name').change(function(){
			self.$t.find('.name_input').parent().toggle(!($(this).is(':checked')));
		}).trigger('change');
		
		self.els.extra_fields.delegate('select','change',function(){
			var v = $(this).val(),
				func = 'hide',
				focusel = false,
			el = $(this).parent().next();
			if(v == 'op_add_new_field' || v == ''){
				func = 'show';
				focusel = true;
			}
			el[func]();
			if(focusel){
				el.find(':input').focus();
			}
		}).add(self.els.email_extra_fields).delegate('a[href$="#remove"]','click',function(e){
			e.preventDefault();
			$(this).closest('.op-multirow').remove();
		});
		
		self.els.extra_fields.find('.op-multirow').each(function(){
			var selected = $(this).find('input[name="selected_value"]');
			if(selected.length > 0){
				$(this).find('select').val(selected.val()).trigger('change');
			}
		});
		
		self.els.extra_fields.next().click(function(e){
			e.preventDefault();
			var c = self.els.extra_fields.data('multirow_counter');
			c++;
			self.els.extra_fields.data('multirow_counter',c);
			var id = self.idprefix+'extra_field_'+c+'_';
			self.els.extra_fields.append('<div class="op-multirow cf"><div><label for="'+id+'field_name">'+op_mod_signup_form.lang.field_name+'</label><select name="'+self.prefix+'[extra_fields][field_name][]" id="'+id+'field_name"><option value="op_add_new_field">'+op_mod_signup_form.lang.add_new_field+'</option><option value="">-----------------</option></select></div><div><input type="text" name="'+self.prefix+'[extra_fields][title][]" id="'+id+'title" /></div><div><label for="'+id+'text">'+op_mod_signup_form.lang.text+'</label><input type="text" name="'+self.prefix+'[extra_fields][text][]" id="'+id+'text" /></div><div class="op-multirow-controls"><a href="#remove"><img alt="'+op_mod_signup_form.lang.remove+'" src="'+OptimizePress.imgurl+'remove-row.png" /></a></div></div>').find('div.op-multirow:last select').trigger('change');
			multirow_dropdown();
		});

		self.els.email_extra_fields.next().click(function(e){
			e.preventDefault();
			var c = self.els.email_extra_fields.data('multirow_counter');
			c++;
			self.els.email_extra_fields.data('multirow_counter',c);
			var id = self.idprefix+'email_extra_field_'+c;
			self.els.email_extra_fields.append('<div class="op-multirow cf"><label for="'+id+'">'+op_mod_signup_form.lang.text+'</label><input type="text" name="'+self.prefix+'[email_extra_fields][]" id="'+id+'" /><div class="op-multirow-controls"><a href="#remove"><img alt="'+op_mod_signup_form.lang.remove+'" src="'+OptimizePress.imgurl+'remove-row.png" /></a></div></div>').find('div.op-multirow:last input').focus();
		});
		
		function check_select(elem){
			var elem = $(elem),
				elem2 = self.$t.find(elem.hasClass('name_select') ? '.email_select' : '.name_select'),
				val1 = elem.val(),
				val2 = elem2.val();
			if(val1 == val2){
				elem2.find('option[value!="'+val1+'"]:eq(0)').attr('selected',true);
			}
		};
		
		function multirow_dropdown(){
			var new_values = '<option value="op_add_new_field">'+op_mod_signup_form.lang.add_new_field+'</option><option value="">-----------------</option>';
			$.each(self.input_elems,function(i,v){
				new_values += '<option value="'+i+'">'+v+'</option>';
			});
			self.els.extra_fields.find('select').each(function(i){
				var current = $(this).find(':selected').attr('value');
				$(this).html(new_values).val(current).trigger('change');
			});
		};
	};
	var tmp_obj;
	$(document).ready(function(){
		$('.op-signup_form-form_html').each(function(){
			new op_optin($(this));
		});
		$('.module-signup_form .color_scheme_selector').change(function(){
			var $t = $(this),
				parent = $(this).closest('.tab-color_scheme'),
				section_name = parent.find('.section_name').val();
			if(typeof op_mod_signup_form.styles[section_name] !== 'undefined'){
				set_preview(parent.find('.preview'),op_mod_signup_form.styles[section_name][$t.val()].preview);
			}
		}).trigger('change');
	});
	function set_preview(elem,img){
		var tmp_img = new Image();
		tmp_img.src = img;
		if(tmp_img.complete){
			elem.css('background-image','url("'+img+'")');
		} else {
			elem.css('background-image',"url('images/wpspin_light.gif')");
			$(tmp_img).load(function(){
				elem.css('background-image','url("'+img+'")');
			});
		}
	};
})(jQuery);