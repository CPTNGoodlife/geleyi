<?php
    //Prepare defaults
    $header_layout = op_page_option('header_layout');
    $header_logo_setup = op_default_option('header_logo_setup');
    if (!empty($header_layout['logo'])) $header_logo_setup['logo'] = $header_layout['logo'];
    if (!empty($header_layout['bgimg'])) $header_logo_setup['bgimg'] = $header_layout['bgimg'];
    if (!empty($header_layout['repeatbgimg'])) $header_logo_setup['repeatbgimg'] = $header_layout['repeatbgimg'];
    if (!empty($header_layout['bgcolor'])) $header_logo_setup['bgcolor'] = $header_layout['bgcolor'];
?>

<div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar cf" id="op_page_layout_header">
    <label class="form-title"><?php _e('Header Style',OP_SN) ?></label>
	<p class="op-micro-copy"><?php printf(__('Use these options to customize styling of your page header.  Ensure you also create and assign menus to your blog Menus within the %1$sWordpress Menus admin panel%2$s if you want to use navigation menus on your blog.', OP_SN),'<a href="nav-menus.php">','</a>') ?></p>
	<?php
	if($layouts = op_page_config('header_layout','menu-positions')):
		$cur_layout = op_get_current_item($layouts,op_default_page_option('header_layout','menu-position'));
		$previews = array();
		$alongside_nav = false;
		foreach($layouts as $name => $layout){
			$field_id = 'op_sections_layout_header_menu-position_'.$name;
			$selected = ($cur_layout == $name);
			$li_class = $input_attr = '';
			if($selected){
				$alongside_nav = ($name == 'alongside');
				$li_class = ' img-radio-selected';
				$input_attr = ' checked="checked"';
			}
			$preview = $layout['preview'];
			$preview['li_class'] = $li_class;
			$preview['input'] = '<input type="radio" name="op[header_layout][menu_position]" id="'.$field_id.'" value="'.$name.'"'.$input_attr.' />';
			$preview['preview_content'] = __($layout['title'],OP_SN);
			$previews[] = $preview;
		}
		echo $this->load_tpl('generic/img_radio_selector',array('previews'=>$previews, 'classextra'=>'menu-position op-thumbnails op-thumbnails--fullwidth '));
    endif; ?>
    <?php if($error = $this->error('op_sections_header')): ?>
    <span class="error"><?php echo $error ?></span>
    <?php endif; ?>
    <label for="op_header_layout_logo" class="form-title"><?php _e('Upload a logo (optional)',OP_SN) ?></label>
    <p class="op-micro-copy"><?php _e('Upload a logo image to show on your page. We recommend you size your logo to '.OP_HEADER_LOGO_WIDTH.'px by '.OP_HEADER_LOGO_HEIGHT.'px',OP_SN) ?></p>
    <?php op_upload_field('op[header_layout][logo]',$header_logo_setup['logo']) ?>
    <div class="clear"></div>


   <!-- <div class="op-hr"><hr /></div> -->

    <label for="op_header_layout_bgimg" class="form-title"><?php _e('Upload a Banner Image',OP_SN) ?></label>
    <p class="op-micro-copy"><?php printf(__('Upload a header image up to %spx in width with any graphics on it',OP_SN),op_page_config('header_width')) ?></p>
    <?php op_upload_field('op[header_layout][bgimg]',$header_logo_setup['bgimg']) ?>


    <label for="op_header_layout_repeatbgimg" class="form-title"><?php _e('Upload Repeating Header Background Image',OP_SN) ?></label>
    <p class="op-micro-copy"><?php _e('This would normally be a gradient.  Upload a repeating header background image which will be tiled horizontally on your header.  We recommend you use a gradient of your choice which is 1px by 250px or the same height as the banner image above if you have uploaded one',OP_SN) ?></p>
    <?php op_upload_field('op[header_layout][repeatbgimg]',$header_logo_setup['repeatbgimg']) ?>
    <label><strong><?php _e('or choose a header background colour',OP_SN); ?></strong></label>
	<?php op_color_picker('op[header_layout][bgcolor]',$header_logo_setup['bgcolor'],'op_header_bgcolor');	?><div class="clear"></div>


	<div class="op-bsw-grey-panel section-nav_bar_above">
		<div class="op-bsw-grey-panel-header cf">
			<h3><a href="#"><?php _e('Navigation Bar Above Header',OP_SN) ?></a></h3>
			<?php $help_vid = op_help_vid(array('page','header_layout','nav_bar_above'),true); ?>
			<div class="op-bsw-panel-controls<?php echo $help_vid==''?'':' op-bsw-panel-controls-help' ?> cf">
				<div class="show-hide-panel"><a href="#"></a></div>
                <?php
                $enabled = op_page_on_off_switch('header_layout','nav_bar_above');
				echo $help_vid;
				?>
			</div>
		</div>
        <div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar">
            <label for="op_header_above_nav" class="form-title"><?php _e('Select Menu for Navigation Bar',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('Select a menu to assign to this navigation bar. You can create new menus by going to Appearance > Menus in the Wordpress control panel',OP_SN) ?></p>
            <select id="op_header_above_nav" name="op[header_layout][nav_bar_above][nav]"><option value=""><?php _e('None',OP_SN) ?></option>
            <?php
			$cur = op_page_option('header_layout','nav_bar_above','nav');
			foreach($nav_menus as $nav){
				echo '<option value="'.$nav->term_id.'"'.($cur == $nav->term_id ? ' selected="selected"':'').'>'.$nav->name.'</option>';
			}
			?>
            </select>


            <label for="op_header_layout_nav_bar_above_logo" class="form-title"><?php _e('Upload Small Navigation Bar Logo (optional)',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('If you want to show a small logo in your navigation bar, upload it here. Ensure the logo is in transparent PNG format and no larger than xxx',OP_SN) ?></p>
		    <?php op_upload_field('op[header_layout][nav_bar_above][logo]',op_default_page_option('header_layout','nav_bar_above','logo')) ?>

	    <label for="op_header_layout_nav_bar_above_font" class="form-title"><?php _e('Select Navigation Bar Font (optional)',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('If you would like to change the font for this navigation menu, you may change these settings below.',OP_SN) ?></p>
			<?php
			$font_family = (isset($header_layout['nav_bar_above']['font_family']) ? $header_layout['nav_bar_above']['font_family'] : op_default_option($header_layout['nav_bar_above'], 'font_family'));
			$font_weight = (isset($header_layout['nav_bar_above']['font_weight']) ? $header_layout['nav_bar_above']['font_weight'] : op_default_option($header_layout['nav_bar_above'], 'font_weight'));
			$font_size = (isset($header_layout['nav_bar_above']['font_size']) ? $header_layout['nav_bar_above']['font_size'] : op_default_option($header_layout['nav_bar_above'], 'font_size'));
			$font_shadow = (isset($header_layout['nav_bar_above']['font_shadow']) ? $header_layout['nav_bar_above']['font_shadow'] : op_default_option($header_layout['nav_bar_above'], 'font_shadow'));
			op_font_selector('op[header_layout][nav_bar_above]', array('family' => $font_family, 'style' => $font_weight, 'size' => $font_size, 'shadow' => $font_shadow), '<div class="op-micro-copy-font-selector">', '</div>', false);
			?>
			<div class="clear"></div><br/>
        </div>
    </div>

	<div class="op-bsw-grey-panel section-nav_bar_below">
		<div class="op-bsw-grey-panel-header cf">
			<h3><a href="#"><?php _e('Navigation Bar Below Header',OP_SN) ?></a></h3>
			<?php $help_vid = op_help_vid(array('page','header_layout','nav_bar_above'),true); ?>
			<div class="op-bsw-panel-controls<?php echo $help_vid==''?'':' op-bsw-panel-controls-help' ?> cf">
				<div class="show-hide-panel"><a href="#"></a></div>
                <?php
                $enabled = op_page_on_off_switch('header_layout','nav_bar_below');
				echo $help_vid;
				?>
			</div>
		</div>
        <div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar">
            <label for="op_header_below_nav" class="form-title"><?php _e('Select Menu for Navigation Bar',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('Select a menu to assign to this navigation bar. You can create new menus by going to Appearance > Menus in the Wordpress control panel',OP_SN) ?></p>
            <select id="op_header_below_nav" name="op[header_layout][nav_bar_below][nav]"><option value=""><?php _e('None',OP_SN) ?></option>
            <?php
			$cur = op_page_option('header_layout','nav_bar_below','nav');
			foreach($nav_menus as $nav){
				echo '<option value="'.$nav->term_id.'"'.($cur == $nav->term_id ? ' selected="selected"':'').'>'.$nav->name.'</option>';
			}
			?>
            </select>



            <label for="op_header_layout_nav_bar_below_logo" class="form-title"><?php _e('Upload Small Navigation Bar Logo (optional)',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('If you want to show a small logo in your navigation bar, upload it here. Ensure the logo is in transparent PNG format and no larger than xxx',OP_SN) ?></p>
		    <?php op_upload_field('op[header_layout][nav_bar_below][logo]',op_default_page_option('header_layout','nav_bar_below','logo')) ?>

	    <label for="op_header_layout_nav_bar_below_font" class="form-title"><?php _e('Select Navigation Bar Font (optional)',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('If you would like to change the font for this navigation menu, you may change these settings below.',OP_SN) ?></p>
			<?php
			$font_family = (isset($header_layout['nav_bar_below']['font_family']) ? $header_layout['nav_bar_below']['font_family'] : op_default_option($header_layout['nav_bar_below'], 'font_family'));
			$font_weight = (isset($header_layout['nav_bar_below']['font_weight']) ? $header_layout['nav_bar_below']['font_weight'] : op_default_option($header_layout['nav_bar_below'], 'font_weight'));
			$font_size = (isset($header_layout['nav_bar_below']['font_size']) ? $header_layout['nav_bar_below']['font_size'] : op_default_option($header_layout['nav_bar_below'], 'font_size'));
			$font_shadow = (isset($header_layout['nav_bar_below']['font_shadow']) ? $header_layout['nav_bar_below']['font_shadow'] : op_default_option($header_layout['nav_bar_below'], 'font_shadow'));
			op_font_selector('op[header_layout][nav_bar_below]', array('family' => $font_family, 'style' => $font_weight, 'size' => $font_size, 'shadow' => $font_shadow), '<div class="op-micro-copy-font-selector">', '</div>', false);
			?>
			<div class="clear"></div><br/>
        </div>
    </div>

	<div class="op-bsw-grey-panel section-nav_bar_alongside" id="op_page_layout_header_nav_bar_alongside">
		<div class="op-bsw-grey-panel-header cf">
			<h3><a href="#"><?php _e('Navigation Bar Alongside Logo',OP_SN) ?></a></h3>
			<?php $help_vid = op_help_vid(array('page','header_layout','nav_bar_above'),true); ?>
			<div class="op-bsw-panel-controls<?php echo $help_vid==''?'':' op-bsw-panel-controls-help' ?> cf">
				<div class="show-hide-panel"><a href="#"></a></div>
                <?php
                $enabled = op_page_on_off_switch('header_layout','nav_bar_alongside');
				echo $help_vid;
				?>
			</div>
		</div>
        <div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar">
            <label for="op_header_alongside_nav" class="form-title"><?php _e('Select Menu for Navigation Bar',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('Select a menu to assign to this navigation bar. You can create new menus by going to Appearance > Menus in the Wordpress control panel',OP_SN) ?></p>
            <select id="op_header_alongside_nav" name="op[header_layout][nav_bar_alongside][nav]"><option value=""><?php _e('None',OP_SN) ?></option>
            <?php
			$cur = op_page_option('header_layout','nav_bar_alongside','nav');
			foreach($nav_menus as $nav){
				echo '<option value="'.$nav->term_id.'"'.($cur == $nav->term_id ? ' selected="selected"':'').'>'.$nav->name.'</option>';
			}
			?>
            </select>

	    <label for="op_header_layout_nav_bar_alongside_font" class="form-title"><?php _e('Select Navigation Bar Font (optional)',OP_SN) ?></label>
            <p class="op-micro-copy"><?php _e('If you would like to change the font for this navigation menu, you may change these settings below.',OP_SN) ?></p>
			<div class="op-micro-copy-font-selector">
				<?php
				$font_family = (isset($header_layout['nav_bar_alongside']['font_family']) ? $header_layout['nav_bar_alongside']['font_family'] : op_default_option($header_layout['nav_bar_alongside'], 'font_family'));
				$font_weight = (isset($header_layout['nav_bar_alongside']['font_weight']) ? $header_layout['nav_bar_alongside']['font_weight'] : op_default_option($header_layout['nav_bar_alongside'], 'font_weight'));
				$font_size = (isset($header_layout['nav_bar_alongside']['font_size']) ? $header_layout['nav_bar_alongside']['font_size'] : op_default_option($header_layout['nav_bar_alongside'], 'font_size'));
				$font_shadow = (isset($header_layout['nav_bar_alongside']['font_shadow']) ? $header_layout['nav_bar_alongside']['font_shadow'] : op_default_option($header_layout['nav_bar_alongside'], 'font_shadow'));
				op_font_selector('op[header_layout][nav_bar_alongside]', array('family' => $font_family, 'style' => $font_weight, 'size' => $font_size, 'shadow' => $font_shadow), '<div class="op-micro-copy-font-selector">', '</div>', false);
				?>
			</div>
			<div class="clear"></div><br/>
        </div>
    </div>

</div>