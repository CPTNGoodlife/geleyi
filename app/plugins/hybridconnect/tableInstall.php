<?php

function delete_tables() {
//    global $wpdb;
//    $wpdb->query("DROP TABLE IF EXISTS hc_templates");
//    $wpdb->query("DROP TABLE IF EXISTS wp_connectors");
//    $wpdb->query("DROP TABLE IF EXISTS wp_hc_subscribers");
//    $wpdb->query("DROP TABLE IF EXISTS wp_hyCong2w");
//    $wpdb->query("DROP TABLE IF EXISTS wp_mailingList");
//    $wpdb->query("DROP TABLE IF EXISTS hc_connector_text");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_button");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_connector");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_image");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_optin");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_text");
//    $wpdb->query("DROP TABLE IF EXISTS hc_style_email");
//    $wpdb->query("DROP TABLE IF EXISTS hc_lightbox_options");
}

function install_tables() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $it_tables = array();
    $num = 0;
    $it_tables[$num]['table_name'] = 'hc_templates';
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_templates` (
  `idConnector` int(11) NOT NULL,
  `sc_background` varchar(500) default NULL,
  `sc_width` varchar(500) default NULL,
  `sc_strokeColor` varchar(500) default NULL,
  `sc_strokeSize` varchar(500) default NULL,
  `sc_tpl_image` varchar(500) default NULL,
  `sc_tpl_title` varchar(500) default NULL,
  `sc_tpl_description` varchar(500) default NULL,
  `sc_tpl_button` varchar(500) default NULL,
  `sc_tpl_footer_text` varchar(500) default 'Your information will never be shared with any third party',
  `sc_tpl_footer_enable` tinyint(1) default '1',
  `sc_tpl_width` varchar(255) default NULL,
  `sc_borderWidth` varchar(32) default '0',
  `sc_borderColor` varchar(255) default '#FFFFFF',
  `wg_background` varchar(500) default NULL,
  `wg_width` varchar(500) default NULL,
  `wg_strokeColor` varchar(500) default NULL,
  `wg_strokeSize` varchar(500) default NULL,
  `wg_tpl_title` varchar(500) default NULL,
  `wg_tpl_description` varchar(500) default NULL,
  `wg_tpl_image` varchar(500) default NULL,
  `wg_tpl_button` varchar(500) default NULL,
  `wg_tpl_footer_text` varchar(500) default 'Your information will never be shared with any third party',
  `wg_tpl_footer_enable` tinyint(1) default '1',
  `wg_tpl_width` varchar(255) NOT NULL,
  `wg_borderWidth` varchar(32) default '0',
  `wg_borderColor` varchar(255) default '#FFFFFF',
  `custom_html` text,
  `custom_html2` text,
  `custom_shortcode` tinyint(4) DEFAULT '0',
  `custom_widget` tinyint(4) DEFAULT '0',
  PRIMARY KEY  (`idConnector`),
  UNIQUE KEY `idConnector` (`idConnector`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $num++;
    $it_tables[$num]['table_name'] = "wp_connectors";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `wp_connectors` (
  `IntegrationID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `TyPage` varchar(255) default NULL,
  `MailingList` varchar(255) default NULL,
  `GotoWebinar` varchar(255) default NULL,
  `Wordpress` varchar(255) default NULL,
  `FacebookCTA` varchar(255) default NULL,
  `FormCTA` varchar(255) default NULL,
  `oneClickCTA` varchar(255) default NULL,
  `template_shortcode` varchar(10) NOT NULL default '0',
  `template_widget` varchar(10) NOT NULL default '0',
  `shortcode_background` varchar(255) default '#FFFFFF',
  `shortcode_strokeColor` varchar(255) default '#000000',
  `shortcode_strokeSize` varchar(255) default '12',
  `shortcode_width` varchar(255) default '200',
  `widget_background` varchar(50) default '#FFFFFF',
  `widget_strokeColor` varchar(50) default '#000000',
  `widget_strokeSize` varchar(50) default '12',
  `widget_width` varchar(50) default '200',
  `allow_registration` tinyint(1) default '0',
  `registration_role` varchar(255) default NULL,
  `custom_code` text,
  `apiConnection` INT(1) NOT NULL DEFAULT '0',
  `emailOnly` INT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`IntegrationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
    $num++;
    $it_tables[$num]['table_name'] = "wp_hc_subscribers";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `wp_hc_subscribers` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(255) default NULL,
  `post` int(11) default NULL,
  `referer` varchar(255) default null,
  `trackingcode` varchar(255) default null,
  `referingdomain` varchar(255) default null,
  `commentsubscriber` int(1) null default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $num++;
    $it_tables[$num]['table_name'] = "wp_hyCong2w";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `wp_hyCong2w` (
  `id` int(11) NOT NULL auto_increment,
  `IntegrationID` int(11) NOT NULL,
  `webinarKey` varchar(255) default NULL,
  `subscribed` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `IntegrationID` (`IntegrationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
    $num++;
    $it_tables[$num]['table_name'] = "wp_mailingList";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `wp_mailingList` (
  `id` int(11) NOT NULL auto_increment,
  `IntegrationID` int(11) NOT NULL,
  `autoresponderType` varchar(255) default NULL,
  `settings` text,
  `subscribed` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `IntegrationID` (`IntegrationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;";
    $num++;
    $it_tables[$num]['table_name'] = "hc_connector_text";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_connector_text` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `optin_headline` text NOT NULL,
  `optin_description` text NOT NULL,
  `email_call` text NOT NULL,
  `fb_call` text NOT NULL,
  `oneclick_call` text NOT NULL,
  `email_btn` text NOT NULL,
  `fb_btn` text NOT NULL,
  `oneclick_btn` text NOT NULL,
  `privacy_policy_text` text NOT NULL,
  `type` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_connector_text` (`id`, `id_connector`, `optin_headline`, `optin_description`, `email_call`, `fb_call`, `oneclick_call`, `email_btn`, `fb_btn`, `oneclick_btn`, `privacy_policy_text`, `type`) VALUES
(1, 0, 'Want Some More Free Updates?', '<p>Enter benefits for why the user should sign up for your product/service.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect through Facebook!', 'Instant Access!', 'We hate spam just as much as you', 0);";
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_button";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_button` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `btn_bg_color` varchar(128) NOT NULL,
  `btn_font_color` varchar(128) NOT NULL,
  `txt_shadow_color` varchar(128) NOT NULL,
  `btn_border_color` varchar(128) NOT NULL,
  `btn_box_shadow` varchar(128) NOT NULL,
  `btn_font_family` varchar(128) NOT NULL,
  `btn_bg_light` varchar(128) default NULL,
  `btn_type` varchar(128) NOT NULL default 'Silver',
  `emailNewLine` int(1) not null default '0',
  `buttonNewLine` int(1) not null default '0',
  `button_font_size` varchar(32) not null default '15px',
  `button_lr_padding` varchar(32) not null default '15px',
  `button_tb_padding` varchar(32) not null default '6px',
  `fb_button_size` varchar(32) not null default 'large',
  `default_template` int(2) NOT NULL default '0',
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_button` (`id`, `id_connector`, `btn_bg_color`, `btn_font_color`, `txt_shadow_color`, `btn_border_color`, `btn_box_shadow`, `btn_font_family`, `btn_bg_light`, `btn_type`, `emailNewLine`, `buttonNewLine`, `button_font_size`, `button_lr_padding`, `button_tb_padding`, `fb_button_size`, `default_template`, `type`) VALUES
(1, 0, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0,'15px', '15px', '6px', 'large', 1, 0);";
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_connector";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_connector` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `opt_in_box_width` varchar(32) NOT NULL,
  `opt_in_box_height` varchar(32) NOT NULL,
  `call_action_height` varchar(32) NOT NULL,
  `tpl_bg_color` varchar(255) NOT NULL,
  `opt_in_bg_color` varchar(255) NOT NULL,
  `border_color` varchar(255) NOT NULL,
  `border_width` varchar(128) NOT NULL,
  `border_radius` varchar(128) NOT NULL,
  `set_heights` int(2) default '0',
  `eoh` varchar(128) default NULL,
  `ech` varchar(128) default NULL,
  `foh` varchar(128) default NULL,
  `fch` varchar(128) default NULL,
  `ooh` varchar(128) default NULL,
  `och` varchar(128) default NULL,
  `is_responsive` int(1) default '0',
  `min_width` varchar(32) default NULL,
  `max_width` varchar(32) default NULL,
  `template_gradient` INT( 1 ) DEFAULT '0',
  `template_bgcolor_1` varchar(128) NULL,
  `template_bgcolor_2` varchar(128) NULL,
  `template_picturebg` INT (1) default NULL,
  `template_picturebgurl` varchar(128) NULL,
  `template_transparent_bg` INT (1) default NULL,
  `template_transparent_optin_bg` INT (1) default NULL,
  `drop_shadow` INT (1) default '0',
  `h_shadow` varchar(32) default '5px',
  `v_shadow` varchar(32) default '5px',
  `blur_shadow` varchar(32) default '5px',
  `shadow_color` varchar(32) default '#cccccc',
  `border_style` varchar(32) default 'solid',
  `show_privacy_policy` INT(1) DEFAULT '0',
  `bold_privacy_policy` INT(1) DEFAULT '0',
  `center_privacy_policy` INT(1) DEFAULT '0',
  `privacy_policy_font` varchar(128) DEFAULT 'Arial',
  `privacy_policy_color` varchar(128) DEFAULT '#000000',
  `privacy_policy_size` varchar(32) DEFAULT '12px',
  `email_privacy_top_margin` varchar(32) DEFAULT '5px',
  `facebook_privacy_top_margin` varchar(32) DEFAULT '5px',
  `oneclick_privacy_top_margin` varchar(32) DEFAULT '5px',
  `is_template` INT(1) DEFAULT '0',
  `template_image` varchar(255) DEFAULT NULL,
  `user_template` INT(1) DEFAULT '0',
  `user_template_name` varchar(128) DEFAULT NULL,
  `external_top_margin` varchar(128) DEFAULT '10px',
  `external_bottom_margin` varchar(128) DEFAULT '10px',
  `bulletpointsize` varchar(128) default '32px',
  `bulletpointoffset` varchar(128) default '0px',
  `bulletpointoffsetx` varchar(128) default '0px',
  `default_template` int(11) default '0',
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_connector` (`id`, `id_connector`, `opt_in_box_width`, `opt_in_box_height`, `call_action_height`, `tpl_bg_color`, `opt_in_bg_color`, `border_color`, `border_width`, `border_radius`, `set_heights`, `eoh`, `ech`, `foh`, `fch`, `ooh`, `och`, `is_responsive`, `min_width`, `max_width`, `template_gradient`, `template_bgcolor_1`, `template_bgcolor_2`, `template_picturebg`, `template_picturebgurl`, `template_transparent_bg`, `template_transparent_optin_bg`, `drop_shadow`, `h_shadow`, `v_shadow`, `blur_shadow`, `shadow_color`, `border_style` , `show_privacy_policy`, `bold_privacy_policy`, `center_privacy_policy`, `privacy_policy_font`, `privacy_policy_color` , `privacy_policy_size`, `email_privacy_top_margin`, `facebook_privacy_top_margin` , `oneclick_privacy_top_margin` , `is_template`, `template_image`, `user_template`, `user_template_name`, `external_top_margin`, `external_bottom_margin`, `bulletpointsize`, `bulletpointoffset`, `bulletpointoffsetx`, `default_template`, `type`) VALUES
(1, 0, '600px', '220px', '90px', '#BB0000', '#cb4d4d', '#000000', '2px', '2px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '400', '800', 0, '#ffffff', '#ffffcc', 0, 0, 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, '', 0, '', '10px', '10px','32px', '0px', '0px', 0, 0);";
    $num++;
    $it_tables[$num]['table_name'] = "hc_lightbox_options";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_lightbox_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_connector` int(11) NOT NULL,
  `all_pages` tinyint(1) DEFAULT '0',
  `all_posts` int(1) DEFAULT '0',
  `excluded_pages` varchar(255) DEFAULT NULL,
  `excluded_posts` varchar(255) DEFAULT NULL,
  `single_page` tinyint(1) DEFAULT '0',
  `homepage` tinyint(1) DEFAULT '0',
  `all_posts_and_pages` tinyint(1) Default '0',
  `single_category` tinyint(1) Default '0',
  `included_pages` varchar(255) DEFAULT NULL,
  `included_posts` varchar(255) DEFAULT NULL,
  `on_time` varchar(255) DEFAULT '0',
  `on_click` varchar(255) DEFAULT '0',
  `activated` tinyint(1) default null,
  `lightbox_overlay_colour` varchar(32) default '#000000',
  `lightbox_overlay_opacity` varchar(32) default '0.8',
  `lightbox_fade_duration` int(4) default '600',
  `optin_activated` int(1) default '0',
  `optin_on_click` int(1) default '0',
  `optin_time_enable` int(1) default '0',
  `optin_on_time` varchar(255) default '0',
  `optin_scroll_enable` int(1) default '0',
  `optin_scroll_size` varchar(255) default '10%',
  `optin_slide_in_from` varchar(128) default 'top',
  `optin_slide_in_distance` varchar(32) default '0px',
  `optin_start_pos_attribute` varchar(32) default 'left',
  `optin_start_pos_value` varchar(32) default '20px',
  `optin_ani_duration` int(4) default '1000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_lightbox_options` (`id`, `id_connector`, `all_pages`, `all_posts`, `excluded_pages`, `excluded_posts`, `single_page`, `homepage`, `all_posts_and_pages`, `single_category`, `included_pages`, `included_posts`, `on_time`, `on_click`, `activated`, `lightbox_overlay_colour`, `lightbox_overlay_opacity`, `lightbox_fade_duration`, `optin_activated`, `optin_on_click`, `optin_time_enable`, `optin_on_time`, `optin_scroll_enable`, `optin_scroll_size`, `optin_slide_in_from`, `optin_slide_in_distance`, `optin_start_pos_attribute`, `optin_start_pos_value`, `optin_ani_duration` ) VALUES
(1, 0, 0, 0, '0', '0', 0, 0, '0','0', '0', '0', '0', '', 0, '#000000', '0.8','600', '0','0', '0', '0', '0', '10%','top','0px','left','20px','1000');";
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_email";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_email` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `input_border_color` varchar(128) NOT NULL,
  `input_bg_color` varchar(128) NOT NULL,
  `input_font_color` varchar(128) NOT NULL,
  `input_font_family` varchar(128) NOT NULL,
  `name_label_field` varchar(128) DEFAULT 'Name',
  `email_label_field` varchar(128) DEFAULT 'Email',
  `default_template` int(3) default NULL,
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_email` (`id`, `id_connector`, `input_border_color`, `input_bg_color`, `input_font_color`, `input_font_family`, `name_label_field`, `email_label_field` , `default_template`, `type`) VALUES
(1, 0, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email' ,1, 0);";
    $img1 = HYBRIDCONNECT_IAMGES_PATH . '/linkcontrol.png';
    $img2 = HYBRIDCONNECT_IAMGES_PATH . '/arrow-1-white-';
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_image";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_image` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `show_side_image` int(2) NOT NULL default '1',
  `image_url` varchar(255) NOT NULL,
  `vertical_position` varchar(128) NOT NULL,
  `image_left_margin` varchar(128) NOT NULL,
  `image_right_margin` varchar(128) NOT NULL,
  `show_arrow_graphics` int(2) NOT NULL default '1',
  `arrow_style` varchar(128) NOT NULL,
  `min_height` varchar(32) NOT NULL,
  `max_height` varchar(32) NOT NULL,
  `min_width` varchar(32) NOT NULL,
  `max_width` varchar(32) NOT NULL,
  `image_size` varchar(32) NOT NULL default '150px',
  `default_template` int(2) NOT NULL default '0',
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_image` (`id`, `id_connector`, `show_side_image`, `image_url`, `vertical_position`, `image_left_margin`, `image_right_margin`, `show_arrow_graphics`, `arrow_style`, `min_height`, `max_height`, `min_width`, `max_width`, `image_size`, `default_template`, `type`) VALUES
(1, 0, 1, '$img1', '-30px', '0px', '0px', 1, '$img2', '100', '200', '100', '200','150px', 1, 0);";
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_optin";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_optin` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `name_length` varchar(128) NOT NULL,
  `email_length` varchar(128) NOT NULL,
  `email_centered` int(1) NOT NULL default '1',
  `fb_centered` int(1) NOT NULL default '1',
  `oneclick_centered` int(1) NOT NULL default '1',
  `field_font_size` varchar(32) not null default '15px',
  `field_height` varchar(32) not null default '40px',
  `field_padding_top_bottom` varchar(32) not null default '3px',
  `field_padding_left_right` varchar(32) not null default '3px',
  `field_border_width` varchar(32) not null default '1px',
  `field_border_style` varchar(32) not null default 'solid',
  `field_border_radius` varchar(32) not null default '5px',
  `default_template` int(2) NOT NULL default '0',
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_optin` (`id`, `id_connector`, `name_length`, `email_length`, `email_centered`, `fb_centered`, `oneclick_centered`, `field_font_size`, `field_height`, `field_padding_top_bottom`, `field_padding_left_right`, `field_border_width`, `field_border_style`, `field_border_radius` ,`default_template`, `type`) VALUES
(1, 0, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0);";
    $num++;
    $it_tables[$num]['table_name'] = "hc_style_text";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_style_text` (
  `id` int(11) NOT NULL auto_increment,
  `id_connector` int(11) NOT NULL,
  `headline_font_color` varchar(128) NOT NULL,
  `headline_font_size` varchar(128) NOT NULL,
  `headline_font_family` varchar(128) NOT NULL,
  `border_font_color` varchar(128) NOT NULL,
  `border_font_size` varchar(128) NOT NULL,
  `border_font_family` varchar(128) NOT NULL,
  `call_action_font_color` varchar(128) NOT NULL,
  `call_action_font_family` varchar(128) NOT NULL,
  `call_action_font_size` varchar(128) NOT NULL,
  `headline_center` INT(1) NOT NULL default '0',
  `body_center` INT(1) NOT NULL default '0',
  `text_vertical_position` varchar(32) NOT NULL default '0px',
  `tick_style` VARCHAR(32) NULL DEFAULT  '1',
  `headline_shadow` int(1) not null default '0',
  `text_shadow` int(1) not null default '0',
  `cta_shadow` int(1) not null default '0',
  `text_h_Shadow` varchar(32) not null default '2px',
  `text_v_Shadow` varchar(32) not null default '2px',
  `text_blur_shadow` varchar(32) not null default '2px',
  `text_shadow_color` varchar(32) not null default '#cccccc',
  `headline_left_margin` varchar(32) not null default '5px',
  `headline_right_margin` varchar(32) not null default '5px',
  `text_left_margin` varchar(32) not null default '5px',
  `text_right_margin` varchar(32) not null default '5px',
  `bullet_left_margin` varchar(32) not null default '10px',
  `default_template` int(2) default '0',
  `type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_style_text` (`id`, `id_connector`, `headline_font_color`, `headline_font_size`, `headline_font_family`, `border_font_color`, `border_font_size`, `border_font_family`, `call_action_font_color`, `call_action_font_family`, `call_action_font_size`, `headline_center`, `body_center`, `text_vertical_position`, `tick_style`, `headline_shadow`, `text_shadow`, `cta_shadow`, `text_h_shadow`, `text_v_shadow`, `text_blur_shadow`, `text_shadow_color` , `headline_left_margin` , `headline_right_margin`, `text_left_margin`, `text_right_margin`, `bullet_left_margin`, `default_template`, `type`) VALUES
(1, 0, '#ffffff', '25px', 'berlin Sans FB', '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', '0', '0', '0px', '1', '0', '0', '0', '2px', '2px', '2px', '#cccccc','5px', '5px', '5px', '5px', '10px', 1, 0);";

// additional squeeze page settings table
    $num++;
    $it_tables[$num]['table_name'] = "hc_squeeze_options";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_squeeze_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_connector` int(11) NOT NULL,
  `squeeze_enabled` int(1) not null default '0',
  `single_page` varchar(128) DEFAULT '',
  `squeeze_bg_color` varchar(128) DEFAULT '#ffffff',
  `squeeze_gradient_checkbox` int(1) not null default '0',
  `squeeze_picture_checkbox` int(1) not null default '0',
  `squeeze_gradient_color1` varchar(128) not null default '#ffffff',
  `squeeze_gradient_color2` varchar(128) not null default '#cccccc',
  `squeeze_bgimage_url` varchar(128) not null default '0',
  `squeeze_tile` int(1) not null default '0',
  `repeat_x_axis` int(1) not null default '0',
  `repeat_y_axis` int(1) not null default '0',
  `centre_aligned` int(1) not null default '1',
  `vertically_aligned` int(1) not null default '0',
  `vertical_top_margin` varchar(32) not null default '20px',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";
    $it_tables[$num]['table_sql_default'] = "INSERT INTO `hc_squeeze_options` (`id`, `id_connector`, `squeeze_enabled`, `single_page`, `squeeze_bg_color`, `squeeze_gradient_checkbox`, `squeeze_picture_checkbox`, `squeeze_gradient_color1`, `squeeze_gradient_color2`, `squeeze_bgimage_url`, `squeeze_tile`, `repeat_x_axis`, `repeat_y_axis`, `centre_aligned`, `vertically_aligned`, `vertical_top_margin`) VALUES
(1, 0, 0, '', '#ffffff', '0', '0', '#ffffff','#cccccc','0','0','0','0','1','0','20px');";

$num++;
    $it_tables[$num]['table_name'] = "hc_activation_error_log";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_activation_error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(128) NOT NULL,
  `error_message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";

 $num++;
    $it_tables[$num]['table_name'] = "hc_conversion_tracking";
    $it_tables[$num]['table_sql'] = "CREATE TABLE IF NOT EXISTS `hc_conversion_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trackingcode` varchar(128) NOT NULL,
  `emailonly` int(1) not null default '1',
  `date` varchar(128) DEFAULT NULL,
  `value` float(10,2) DEFAULT NULL,
  `product` varchar(128) DEFAULT NULL,
  `customtrackcode` varchar(128) DEFAULT NULL,
  `ipaddress`  varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

    foreach ($it_tables as $it_table) {
        if (!$wpdb->get_var("SHOW TABLES LIKE '{$it_table['table_name']}'")) {
            $wpdb->query($it_table['table_sql']);
            if (isset($it_table['table_sql_default'])) {
                $wpdb->query($it_table['table_sql_default']);
            }
        }
    }

    $colExists = check_column_exists("hc_style_connector", "is_responsive");
    if (!$colExists) {
        $query1 = "ALTER TABLE  `hc_style_connector` ADD  `is_responsive` INT( 1 ) NULL DEFAULT  '0' AFTER  `och` ,
                    ADD  `min_width` VARCHAR( 32 ) NULL AFTER  `is_responsive` ,
                    ADD  `max_width` VARCHAR( 32 ) NULL AFTER  `min_width`";
        $wpdb->query($query1);
    }

    $colExists = check_column_exists("hc_style_image", "min_height");
    if (!$colExists) {
        $query2 = "ALTER TABLE  `hc_style_image` ADD  `min_height` VARCHAR( 32 ) NULL AFTER  `arrow_style` ,
                    ADD  `max_height` VARCHAR( 32 ) NULL AFTER  `min_height` ,
                    ADD  `min_width` VARCHAR( 32 ) NULL AFTER  `max_height` ,
                    ADD  `max_width` VARCHAR( 32 ) NULL AFTER  `min_width`";
        $wpdb->query($query2);
    }

    $colExists = check_column_exists("hc_style_text", "headline_bold");
    if (!$colExists) {
        $query3 = "ALTER TABLE  `hc_style_text` ADD  `headline_bold` INT( 1 ) NULL DEFAULT  '0' AFTER  `headline_font_family`";
        $wpdb->query($query3);
    }

    $colExists = check_column_exists("hc_lightbox_options", "cookie_enable");
    if (!$colExists) {
        $query4 = "ALTER TABLE  `hc_lightbox_options` ADD  `cookie_enable` INT( 1 ) NULL DEFAULT  '0',
                    ADD  `cookie_life` VARCHAR( 32 ) NULL ,
                    ADD  `scroll_enable` INT( 1 ) NULL DEFAULT  '0',
                    ADD  `scroll_size` VARCHAR( 32 ) NULL ,
                    ADD  `fadein_enable` INT( 1 ) NULL DEFAULT  '0'";
        $wpdb->query($query4);
    }

    $colExists = check_column_exists("hc_style_text", "tick_style");
    if (!$colExists) {
        $query5 = "ALTER TABLE  `hc_style_text`
                    ADD  `tick_style` VARCHAR( 32 ) NULL DEFAULT  '1' AFTER  `call_action_font_size`";
        $wpdb->query($query5);
    }

    $colExists = check_column_exists("hc_lightbox_options", "included_cats");
    if (!$colExists) {
        $query6 = "ALTER TABLE  `hc_lightbox_options`
                    ADD  `included_cats` VARCHAR( 255 ) NULL ,
                    ADD  `excluded_cats` VARCHAR( 255 ) NULL";
        $wpdb->query($query6);
    }

    $colExists = check_column_exists("hc_lightbox_options", "time_enable");
    if (!$colExists) {
        $query7 = "ALTER TABLE  `hc_lightbox_options` ADD  `time_enable` INT( 1 ) NULL DEFAULT  '0'";
        $wpdb->query($query7);
    }

    $colExists = check_column_exists("wp_connectors", "shortcode_background");
    if ($colExists) {
        $query8 = "ALTER TABLE `wp_connectors` DROP `shortcode_background` ,
                    DROP `shortcode_strokeColor` ,
                    DROP `shortcode_strokeSize` ,
                    DROP `shortcode_width` ,
                    DROP `widget_background` ,
                    DROP `widget_strokeColor` ,
                    DROP `widget_strokeSize` ,
                    DROP `widget_width` ;";
        $wpdb->query($query8);
    }

    $colExists = check_column_exists("wp_connectors", "template_lightbox");
    if (!$colExists) {
        $query9 = "ALTER TABLE `wp_connectors` ADD `template_lightbox` VARCHAR( 10 ) NULL DEFAULT '0',
                   ADD `custom_form` LONGTEXT NULL ,
                   ADD `custom_fbnot` LONGTEXT NULL ,
                   ADD `custom_fbyes` LONGTEXT NULL ";
        $wpdb->query($query9);
    }

    $colExists = check_column_exists("wp_connectors", "template_shortcode");
    if ($colExists) {
        $query10 = "ALTER TABLE `wp_connectors` CHANGE `template_shortcode` `template_shortcode` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0'";
        $wpdb->query($query10);
    }

    $colExists = check_column_exists("wp_connectors", "template_widget");
    if ($colExists) {
        $query11 = "ALTER TABLE `wp_connectors` CHANGE `template_widget` `template_widget` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0'";
        $wpdb->query($query11);
    }


    $colExists = check_column_exists("wp_connectors", "custom_width");
    if (!$colExists) {
        $query12 = "ALTER TABLE `wp_connectors` ADD `custom_width` VARCHAR( 32 ) NULL ";
        $wpdb->query($query12);
    }

    $hc_connectors_list = $wpdb->get_results("SELECT * FROM wp_connectors ORDER by IntegrationID ASC");
    foreach ($hc_connectors_list as $c) {
        $lo = $wpdb->get_results("SELECT * FROM `hc_lightbox_options` WHERE id_connector=" . $c->IntegrationID);
        if (!isset($lo[0])) {
            hctempMysqlCopyRow("hc_lightbox_options", "id", 1, $c->IntegrationID, null, true);
        }
    }

    // version 1.17 - rounded corners update
    $colExists = check_column_exists("hc_style_connector", "border_radius");
    if (!$colExists) {
        $query116 = "ALTER TABLE `hc_style_connector` ADD `border_radius` VARCHAR( 255 ) NULL DEFAULT  '0px' AFTER  `border_width`";
        $wpdb->query($query116);
    }

    // version 1.20 - gradient background update
    $colExists = check_column_exists("hc_style_connector", "template_gradient");
    if (!$colExists) {
        $query120 = "ALTER TABLE `hc_style_connector` ADD `template_gradient` INT( 1 ) NULL DEFAULT  '0' AFTER  `max_width` ,
                    ADD `template_bgcolor_1` varchar(128) NULL AFTER `template_gradient` ,
                    ADD `template_bgcolor_2` varchar(128) NULL AFTER `template_bgcolor_1`";
        $wpdb->query($query120);
    }

    // version 1.21 - picture background for connectors
    $colExists = check_column_exists("hc_style_connector", "template_picturebg");
    if (!$colExists) {
        $query121 = "ALTER TABLE `hc_style_connector` ADD `template_picturebg` INT( 1 ) NULL DEFAULT  '0' AFTER  `template_bgcolor_2` ,
                    ADD `template_picturebgurl` varchar(128) NULL AFTER `template_picturebg`";
        $wpdb->query($query121);
    }

    // version 1.22 - transparent background for connectors and opt in box
    $colExists = check_column_exists("hc_style_connector", "template_transparent_bg");
    if (!$colExists) {
        $query122 = "ALTER TABLE `hc_style_connector` ADD `template_transparent_bg` INT( 1 ) DEFAULT '0' AFTER  `template_picturebgurl` ,
                    ADD `template_transparent_optin_bg` INT( 1 ) DEFAULT '0' AFTER `template_transparent_bg`";
        $wpdb->query($query122);
    }

    // version 1.23 - center bodytext, center headline, vertical text position.
    $colExists = check_column_exists("hc_style_text", "headline_center");
    if (!$colExists) {
        $query123 = "ALTER TABLE `hc_style_text` ADD `headline_center` INT( 1 ) DEFAULT '0' AFTER  `call_action_font_size` ,
                    ADD `body_center` INT( 1 ) DEFAULT '0' AFTER `headline_center`,
                    ADD `text_vertical_position` varchar(32) NULL DEFAULT '0px' AFTER `body_center`";
        $wpdb->query($query123);
    }

    // version 1.24 - email field and submit button to be displayed on a new line
    $colExists = check_column_exists("hc_style_button", "emailNewLine");
    if (!$colExists) {
        $query124 = "Alter table `hc_style_button` ADD `emailNewLine` int(1) default '0' AFTER `btn_type` ,
                    ADD `buttonNewLine` int(1) default '0' after `emailNewLine`";
        $wpdb->query($query124);
    }

    // version 1.26 - add fields for button options
    $colExists = check_column_exists("hc_style_button", "button_font_size");
    if (!$colExists) {
        $query126 = "Alter table `hc_style_button` ADD `button_font_size` varchar(32) default '15px' after `buttonNewLine` ,
                    ADD `button_lr_padding` varchar(32) default '15px' after `button_font_size` ,
                    ADD `button_tb_padding` varchar(32) default '6px' after `button_lr_padding`";
        $wpdb->query($query126);
    }

    //version 1.27 - add box shadows to connectors
    $colExists = check_column_exists("hc_style_connector", "drop_shadow");
    if (!$colExists) {
        $query127 = "Alter table `hc_style_connector`
                    ADD `drop_shadow` INT (1) default '0' after `template_transparent_optin_bg` ,
                    ADD `h_shadow` varchar(32) default '5px' after `drop_shadow` ,
                    ADD `v_shadow` varchar(32) default '5px' after `h_shadow`,
                    ADD `blur_shadow` varchar(32) default '5px' after `v_shadow`,
                    ADD `shadow_color` varchar(32) default '#cccccc' after `blur_shadow`";
        $wpdb->query($query127);
    }

    //version 1.28 - add facebook button size options
    $colExists = check_column_exists("hc_style_button", "fb_button_size");
    if (!$colExists) {
        $query128 = "Alter table `hc_style_button`
                    ADD `fb_button_size` varchar (32) default 'large' after `button_tb_padding`";
        $wpdb->query($query128);
    }

    // version 1.29 - text shadow settings
    $colExists = check_column_exists("hc_style_text", "headline_shadow");
    if (!$colExists) {
        $query129 = "Alter table `hc_style_text` ADD `headline_shadow` int(1) not null default '0' after `tick_style`,
                    ADD `text_shadow` int(1) not null default '0' after `headline_shadow`,
                    ADD `cta_shadow` int(1) not null default '0' after `text_shadow`,
                    ADD `text_h_Shadow` varchar(32) not null default '2px' after `cta_shadow`,
                    ADD `text_v_Shadow` varchar(32) not null default '2px' after `text_h_shadow`,
                    ADD `text_blur_shadow` varchar(32) not null default '2px' after `text_v_shadow`,
                    ADD `text_shadow_color` varchar(32) not null default '#cccccc' after `text_blur_shadow`";
        $wpdb->query($query129);
    }

    // version 1.30 - headline and paragraph margin sliders
    $colExists = check_column_exists("hc_style_text", "headline_left_margin");
    if (!$colExists) {
        $query130 = "Alter table `hc_style_text`
                    ADD `headline_left_margin` varchar(32) not null default '5px' after `text_shadow_color`,
                    ADD `headline_right_margin` varchar(32) not null default '5px' after `headline_left_margin`,
                    ADD `text_left_margin` varchar(32) not null default '5px' after `headline_right_margin`,
                    ADD `text_right_margin` varchar(32) not null default '5px' after `text_left_margin`";
        $wpdb->query($query130);
    }

    // version 1.30 (part 2) add margin-left for bulleted lists
    $colExists = check_column_exists("hc_style_text", "bullet_left_margin");
    if (!$colExists) {
        $query1302 = "Alter table `hc_style_text`
                    ADD `bullet_left_margin` varchar(32) not null default '10px' after `text_right_margin`";
        $wpdb->query($query1302);
    }

    // version 1.30 (part 3) add border style settings
    $colExists = check_column_exists("hc_style_connector", "border_style");
    if (!$colExists) {
        $query1303 = "Alter table `hc_style_connector`
                    ADD `border_style` varchar(32) not null default 'solid' after `shadow_color`";
        $wpdb->query($query1303);
    }

    // version 1.30 (part 4) input field labels
    $colExists = check_column_exists("hc_style_email", "name_label_field");
    if (!$colExists) {
        $query1304 = "Alter table `hc_style_email` ADD `name_label_field` varchar(128) not null default 'Name' after `input_font_family`,
    ADD `email_label_field` varchar(128) not null default 'Email' after `name_label_field`";
        $wpdb->query($query1304);
    }

    // version 1.32 - privacy policy fields
    $colExists = check_column_exists("hc_style_connector", "show_privacy_policy");
    if (!$colExists) {
        $query132 = "Alter table `hc_style_connector` ADD `show_privacy_policy` INT(1) DEFAULT '0' after `border_style`,
                    ADD `bold_privacy_policy` INT(1) DEFAULT '0' after `show_privacy_policy`,
                    ADD `center_privacy_policy` INT(1) DEFAULT '0' after `bold_privacy_policy`,
                    ADD `privacy_policy_font` varchar(128) DEFAULT 'Arial' after `center_privacy_policy`,
                    ADD `privacy_policy_color` varchar(128) DEFAULT '#000000' after `privacy_policy_font`,
                    ADD `privacy_policy_size` varchar(32) DEFAULT '12px' after `privacy_policy_color`";
        $wpdb->query($query132);
    }

    // version 1.32 (part 2) - privacy policy text
    $colExists = check_column_exists("hc_connector_text", "privacy_policy_text");
    if (!$colExists) {
        $query1324 = "Alter table `hc_connector_text`
                    ADD `privacy_policy_text` varchar(255) NOT NULL DEFAULT 'We hate spam just as much as you' after `oneclick_btn`";
        $wpdb->query($query1324);
    }

    // version 1.33 - input field settings
    $colExists = check_column_exists("hc_style_optin", "field_font_size");
    if (!$colExists) {
        $query133 = "Alter table `hc_style_optin`
                  ADD `field_font_size` varchar(32) not null default '15px' AFTER `oneclick_centered`,
                  ADD `field_height` varchar(32) not null default '40px' AFTER `field_font_size`,
                  ADD `field_padding_top_bottom` varchar(32) not null default '3px' AFTER `field_height`,
                  ADD `field_padding_left_right` varchar(32) not null default '3px' AFTER `field_padding_top_bottom`,
                  ADD `field_border_width` varchar(32) not null default '1px' AFTER `field_padding_left_right`,
                  ADD `field_border_style` varchar(32) not null default 'solid' AFTER `field_border_width`,
                  ADD `field_border_radius` varchar(32) not null default '5px' AFTER `field_border_style`";
        $wpdb->query($query133);
    }

    // version 1.34 - margin top settings for privacy policy
    $colExists = check_column_exists("hc_style_connector", "email_privacy_top_margin");
    if (!$colExists) {
        $query134 = "Alter table `hc_style_connector`
                  ADD `email_privacy_top_margin` varchar(32) DEFAULT '5px' AFTER `privacy_policy_size`,
                  ADD `facebook_privacy_top_margin` varchar(32) DEFAULT '5px' AFTER `email_privacy_top_margin`,
                  ADD `oneclick_privacy_top_margin` varchar(32) DEFAULT '5px' AFTER `facebook_privacy_top_margin`";
        $wpdb->query($query134);
    }

    // version 1.35 - addition of template fields
    $colExists = check_column_exists("hc_style_connector", "is_template");
    if (!$colExists) {
        $query135 = "Alter table `hc_style_connector`
                  ADD `is_template` INT(1) DEFAULT '0' AFTER `oneclick_privacy_top_margin`,
                  ADD `template_image` varchar(255) DEFAULT '' AFTER `is_template`,
                  ADD `user_template` INT(1) DEFAULT '0' AFTER `template_image`,
                  ADD `user_template_name` varchar(128) DEFAULT '' AFTER `user_template`";
        $wpdb->query($query135);
    }

// version 1.39 - external top and bottom margins
    $colExists = check_column_exists("hc_style_connector", "external_top_margin");
    if (!$colExists) {
        $query139 = "Alter table `hc_style_connector`
                  ADD `external_top_margin` varchar(128) DEFAULT '10px' AFTER `user_template_name`,
                  ADD `external_bottom_margin` varchar(128) DEFAULT '10px' AFTER `external_top_margin`";
        $wpdb->query($query139);
    }

    // version 1.39 (part 2) - template filtering
    $colExists = check_column_exists("wp_connectors", "is_user_template");
    if (!$colExists) {
        $query1392 = "Alter table `wp_connectors`
                  ADD `is_user_template` tinyint(1) default '0' after `custom_width`";
        $wpdb->query($query1392);
    }

    // version 1.40 - specific image sizes
    $colExists = check_column_exists("hc_style_image", "image_size");
    if (!$colExists) {
        $query140 = "Alter table `hc_style_image` ADD `image_size` varchar(32) default '150px' after `max_width`";
        $wpdb->query($query140);
    }


    // version 1.40 data fix for invalid image and background images being saved to database
    $findProblemPictures = "select id_connector, template_picturebgurl, type from `hc_style_connector`;";
    $myPictures = $wpdb->get_results($findProblemPictures);
    foreach ($myPictures as $thisPicture) {
        if (substr($thisPicture->template_picturebgurl, -1) == "/") {
            $updateRow = "update `hc_style_connector` set template_picturebgurl = '' where id_connector = '" . $thisPicture->id_connector . "' and type = '" . $thisPicture->type . "';";
            $wpdb->query($updateRow);
        }
    }

    // same for side images if applicable
    $findProblemPictures = "select id_connector, image_url, type from `hc_style_image`;";
    $myPictures = $wpdb->get_results($findProblemPictures);
    foreach ($myPictures as $thisPicture) {
        if (substr($thisPicture->image_url, -1) == "/") {
            $updateRow = "update `hc_style_image` set image_url = '' where id_connector = '" . $thisPicture->id_connector . "' and type = '" . $thisPicture->type . "';";
            $wpdb->query($updateRow);
        }
    }


    // version 1.43 - squeeze pages
    // find each unique id_connector in each table and make a duplicate for squeeze pages type=3
    $getCurrentConnectorIDs = "select distinct `IntegrationID` from `wp_connectors`";
    $connectorIDNumbers = $wpdb->get_results($getCurrentConnectorIDs);
    $tableArray = array('hc_style_button', 'hc_connector_text', 'hc_style_email', 'hc_style_connector', 'hc_style_image', 'hc_style_optin', 'hc_style_text');
    for ($i = 0; $i < 7; $i++) {
        foreach ($connectorIDNumbers as $connectorID) {
            $check = $wpdb->get_results("select * from `" . $tableArray[$i] . "` where `id_connector` = " . $connectorID->IntegrationID . " and type = 3;");
            if ($wpdb->num_rows == "0") {
                squeezePageCopyRow($tableArray[$i], "id_connector", $connectorID->IntegrationID, $connectorID->IntegrationID, null, 3);
            }
        }
        unset($connectorID);
    }

    // run through each unique connector ID and add row to squeeze_options table if not already exist
    foreach ($connectorIDNumbers as $connectorID) {
        $check = $wpdb->get_results("select * from `hc_squeeze_options` where `id_connector` = " . $connectorID->IntegrationID . ";");
        if ($wpdb->num_rows == "0") {
            $wpdb->query("INSERT INTO `hc_squeeze_options` (`id_connector`, `squeeze_enabled`, `single_page`) VALUES ($connectorID->IntegrationID, 0, '');");
        }
    }


    // update version 1.44 - additional squeeze page options - background images / gradients etc.
    $colExists = check_column_exists("hc_squeeze_options", "squeeze_bg_color");
    if (!$colExists) {
        $squeezeSettings = "Alter table `hc_squeeze_options`
                  ADD `squeeze_bg_color` varchar(128) DEFAULT '#ffffff' after `single_page`,
                  ADD `squeeze_gradient_checkbox` int(1) not null default '0' after `squeeze_bg_color`,
                  ADD `squeeze_picture_checkbox` int(1) not null default '0' after `squeeze_gradient_checkbox`,
                  ADD `squeeze_gradient_color1` varchar(128) not null default '#ffffff' after `squeeze_picture_checkbox`,
                  ADD `squeeze_gradient_color2` varchar(128) not null default '#cccccc' after `squeeze_gradient_color1`,
                  ADD `squeeze_bgimage_url` varchar(128) not null default '0' after `squeeze_gradient_color2`,
                  ADD `squeeze_tile` int(1) not null default '0' after `squeeze_bgimage_url`,
                  ADD `repeat_x_axis` int(1) not null default '0' after `squeeze_tile`,
                  ADD `repeat_y_axis` int(1) not null default '0' after `repeat_x_axis`;";
        $wpdb->query($squeezeSettings);
    }


    // update version 1.44 (part 2) - additional squeeze page settings - vertical alignment and position of squeeze pages
    $colExists = check_column_exists("hc_squeeze_options", "centre_aligned");
    if (!$colExists) {
        $squeezeSettings = "Alter table `hc_squeeze_options`
                  ADD `centre_aligned` int(1) not null default '1' after `repeat_y_axis`,
                  ADD `vertically_aligned` int(1) not null default '0' after `centre_aligned`,
                  ADD `vertical_top_margin` varchar(32) not null default '20px' after `vertically_aligned`;";
        $wpdb->query($squeezeSettings);
    }

    // update version 1.44 (part 3) - convert text table to UTF-8 for full character support
    // must convert to binary then to utf-8 for true conversion.  Convert text table first
    $characterSupport = "alter table `hc_connector_text` modify `optin_headline` blob,
  modify `optin_description` blob,
  modify `email_call` blob,
  modify `fb_call` blob,
  modify `oneclick_call` blob,
  modify `email_btn` blob,
  modify `fb_btn` blob,
  modify `oneclick_btn` blob,
  modify `privacy_policy_text` blob;";
    $wpdb->query($characterSupport);


    $characterSupport = "alter table `hc_connector_text` modify `optin_headline` text character set utf8,
  modify `optin_description` text character set utf8,
  modify `email_call` text character set utf8,
  modify `fb_call` text character set utf8,
  modify `oneclick_call` text character set utf8,
  modify `email_btn` text character set utf8,
  modify `fb_btn` text character set utf8,
  modify `oneclick_btn` text character set utf8,
  modify `privacy_policy_text` text character set utf8;";
    $wpdb->query($characterSupport);

    $characterSupport = "alter table `hc_connector_text` convert to character set utf8;";
    $wpdb->query($characterSupport);


    // do the same now for email input fields
    $characterSupport = "alter table `hc_style_email` modify `name_label_field` blob,
  modify `email_label_field` blob;";
    $wpdb->query($characterSupport);

    $characterSupport = "alter table `hc_style_email` modify `name_label_field` varchar(128) character set utf8,
  modify `email_label_field` varchar(128) character set utf8;";
    $wpdb->query($characterSupport);

    $characterSupport = "alter table `hc_style_email` convert to character set utf8;";
    $wpdb->query($characterSupport);


    // version 1.45 - improved lightbox options
    $colExists = check_column_exists("hc_lightbox_options", "all_posts_and_pages");
    if (!$colExists) {
        $lightboxOptions = "alter table `hc_lightbox_options`
                  add `all_posts_and_pages` tinyint(1) Default '0' after `homepage`,
                  add `single_category` tinyint(1) Default '0' after `all_posts_and_pages`";
        $wpdb->query($lightboxOptions);
    }


    // version 1.45 - activate lightbox checkbox
    $colExists = check_column_exists("hc_lightbox_options", "activated");
    if (!$colExists) {
        $lightboxOptions = "alter table `hc_lightbox_options` add `activated` tinyint(1) default '0' after `on_click`;";
        $wpdb->query($lightboxOptions);
    }

    // version 1.45 - further lightbox updates
    $colExists = check_column_exists("hc_lightbox_options", "lightbox_overlay_colour");
    if (!$colExists) {
        $lightboxOptions = "alter table `hc_lightbox_options` add `lightbox_overlay_colour` varchar(32) default '#000000' after `activated`,
                  add `lightbox_overlay_opacity` varchar(32) default '0.8' after `lightbox_overlay_colour`,
                  add `lightbox_fade_duration` int(4) default '600' after `lightbox_overlay_opacity`;";
        $wpdb->query($lightboxOptions);
    }

    // version 1.46 - optin bar updates
    $colExists = check_column_exists("hc_lightbox_options", "optin_activated");
    if (!$colExists) {
        $lightboxOptions = "alter table `hc_lightbox_options`
                  ADD `optin_activated` int(1) default '0' after `lightbox_fade_duration`,
                  ADD `optin_on_click` int(1) default '0' after `optin_activated`,
                  ADD `optin_time_enable` int(1) default '0' after `optin_on_click`,
                  ADD `optin_on_time` varchar(255) default '0' after `optin_time_enable`,
                  ADD `optin_scroll_enable` int(1) default '0' after `optin_on_time`,
                  ADD `optin_scroll_size` varchar(255) default '10%' after `optin_scroll_enable`,
                  ADD `optin_slide_in_from` varchar(128) default 'top' after `optin_scroll_size`,
                  ADD `optin_slide_in_distance` varchar(32) default '0px' after `optin_slide_in_from`,
                  ADD `optin_start_pos_attribute` varchar(32) default 'left' after `optin_slide_in_distance`,
                  ADD `optin_start_pos_value` varchar(32) default '20px' after `optin_start_pos_attribute`,
                  ADD `optin_ani_duration` int(4) default '1000' after `optin_start_pos_value`;";
        $wpdb->query($lightboxOptions);
    }

    $lightboxOptions = "update `hc_lightbox_options` set `fadein_enable` = '1';";
    $wpdb->query($lightboxOptions);

    // version 1.49 custom code submit
    $colExists = check_column_exists("wp_connectors", "custom_code");
    if (!$colExists) {
        $custom_code = "alter table `wp_connectors`
                  ADD `custom_code` text default null after is_user_template;";
        $wpdb->query($custom_code);
    }

    // emd of version updates - now insert the templates
    // rebuild templates
    $deleteTables1 = "drop table `hc_style_button_templates`";
    $wpdb->query($deleteTables1);
    $deleteTables2 = "drop table `hc_style_email_templates`";
    $wpdb->query($deleteTables2);
    $deleteTables3 = "drop table `hc_style_image_templates`";
    $wpdb->query($deleteTables3);
    $deleteTables4 = "drop table `hc_style_optin_templates`";
    $wpdb->query($deleteTables4);
    $deleteTables5 = "drop table `hc_style_text_templates`";
    $wpdb->query($deleteTables5);
    $deleteTables6 = "drop table `hc_connector_text_templates`";
    $wpdb->query($deleteTables6);
    $deleteTables7 = "drop table `hc_style_connector_templates`";
    $wpdb->query($deleteTables7);


    // Template installation
    $templateTables1 = "CREATE TABLE IF NOT EXISTS `hc_style_button_templates` SELECT * FROM hc_style_button WHERE 1=0;";
    $wpdb->query($templateTables1);

    $templateTables3 = "CREATE TABLE IF NOT EXISTS `hc_style_email_templates` SELECT * FROM hc_style_email WHERE 1=0;";
    $wpdb->query($templateTables3);

    $templateTables4 = "CREATE TABLE IF NOT EXISTS `hc_style_image_templates` SELECT * FROM hc_style_image WHERE 1=0;";
    $wpdb->query($templateTables4);

    $templateTables5 = "CREATE TABLE IF NOT EXISTS `hc_style_optin_templates` SELECT * FROM hc_style_optin WHERE 1=0;";
    $wpdb->query($templateTables5);

    $templateTables6 = "CREATE TABLE IF NOT EXISTS `hc_style_text_templates` SELECT * FROM hc_style_text WHERE 1=0;";
    $wpdb->query($templateTables6);

    $templateTables7 = "CREATE TABLE IF NOT EXISTS `hc_connector_text_templates` SELECT * FROM hc_connector_text WHERE 1=0;";
    $wpdb->query($templateTables7);

    $templateTables2 = "CREATE TABLE IF NOT EXISTS `hc_style_connector_templates` SELECT * FROM hc_style_connector WHERE 1=0;";
    $wpdb->query($templateTables2);


    $hc_themeUpdate1 = "INSERT INTO `hc_connector_text_templates` (`id`, `id_connector`, `optin_headline`, `optin_description`, `email_call`, `fb_call`, `oneclick_call`, `email_btn`, `fb_btn`, `oneclick_btn`, `privacy_policy_text`, `type`) VALUES
	(1, 0, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(2, 5, 'Learn Our Best Traffic Methods!', '<p>Sign up below to receive your <strong>free traffic training guide</strong>. Plus, join over 12,000 subscribers who receive <strong>weekly exclusive updates</strong>!</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below to Sign Up', 'Sign Me Up!', 'Easy Facebook Signup!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(3, 5, 'Want Some More Free Updates?', '<p>Description of your opt in goes here. You can add multiple lines to your opt in box if you prefer. Make sure you list the benefits of why people should sign up to your list.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below to Sign Up', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(4, 6, 'Want Some More Free Updates?', '<p>Description of your opt in goes here. You can add multiple lines to your opt in box if you prefer. Make sure you list the benefits of why people should sign up to your list.</p>', 'Text', 'Click the Button Below to Sign Up', 'Click the Button Below to Sign Up', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(5, 6, 'Want Some More Free Updates?', '<p>Description of your opt in goes here. You can add multiple lines to your opt in box if you prefer. Make sure you list the benefits of why people should sign up to your list.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below to Sign Up', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(6, 7, '', '', 'Sign Up With Your Name and Email Address:', 'Click the Button Below to Sign Up:', 'Click the Button Below to Sign Up:', 'Sign Me Up!', 'Sign Up Via Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(7, 7, 'Sign Up and Download Your Cool Freebie!', '<p>Enter benefits for why the user should sign up for your product/service.</p>\n<ul>\n<li><strong>Good reason to sign up.</strong></li>\n<li>Awesome benefit of the freebie.</li>\n<li><strong>Another great benefit here!</strong></li>\n</ul>\n<p>Sign up now, as long as this offer lasts!</p>', '', '', '', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(8, 8, 'Free Video: Unpandalize Your Site!', '<p>Simple, <strong>4-minute video</strong> shows you the exact steps that we applied to a subscriber''s site, to get it ''unpandalized'' and back to <strong>better rankings than ever before!</strong></p>\n<ul>\n<li>Real case study, real results!</li>\n<li>Regain your rankings and traffic in record time!</li>\n<li>Completely free!</li>\n</ul>', 'Sign Up Below to See the Case Study!', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Instant Access', 'Sign Up With Facebook', 'Click Here for One Click Sign Up!', 'We hate spam. Your email will never be shared or sold.', 0),
  (9, 8, 'Want Some More Free Updates?', '<p>Description of your opt in goes here. You can add multiple lines to your opt in box if you prefer. <em>Make sure you list the benefits</em> of why people should sign up to your list.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below to Sign Up', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(10, 9, 'Sign Up for Exclusive Updates!', '<p>Enter benefits for why the user should sign up for your product/service.</p>\n<p>Keep it brief, but emphaisze the advantages your readers get for signing up.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(11, 9, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(12, 9, 'Get Your FREE Six-Pack Training Guide!', '<p>Sign up below to receive a FREE COPY of our <em>''3 Weeks to the Perfect Six-Pack''</em> PDF guide.</p>\n<p><span>Inside, you''ll learn:</span></p>\n<ul>\n<li><strong>The most effective ab exercises.</strong></li>\n<li>The top five mistakes you MUST avoid!</li>\n<li><strong>The easiest diet ''fix'' for a lean stomach.</strong></li>\n</ul>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Sign Up Now!', 'Click the Button Below', 'Yes, Sign Me Up!', 'Sign Up Through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam and will never misuse your email address!', 2),
	(13, 10, 'FIGHTGUIDE!', '<p>&nbsp;</p>\n<p>Sign up below to receive our free FIGHTGUIDE.</p>\n<p>Learn the insider training secrets that the world''s</p>\n<p>top MMA contestants use to get in</p>\n<p>superhuman shape!</p>', '', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(14, 10, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(15, 10, 'Want Some More Free Updates?', '<p>Enter benefits for why the user should sign up for your product/service.</p>\n<ul>\n<li>Awesome bullet point.</li>\n<li>And another one!</li>\n<li>Check out this benefit!</li>\n<li>Final bullet in this list.</li>\n</ul>', '', '', '', 'Sign Me Up!', 'Connect Through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you do!', 2),
	(16, 11, 'Sign Up to Get Free Exclusive Updates!', '<p>Enter benefits for why the user should sign up for your product/service - don''t talk features, but talk benefits! Try and keep your description text as short as possible.</p>', 'Enter your Name and Email Address Below', 'Connect With Facebook', 'Sign Up by Clicking the Button', 'Sign Me Up!', 'Click to Sign Up Via Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(17, 11, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(18, 11, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(19, 12, 'Join Our Aviation Newsletter Today!', '<p>Enter benefits for why the user should sign up for your freebie offer or newsletter.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect With Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(20, 12, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(21, 12, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(22, 13, 'Want Some More Free Updates?', '<p>Here''s why you should sign up today:</p>\n<ul>\n<li><strong>Reason number 1</strong></li>\n<li><strong>Another reason</strong></li>\n<li><strong>And a big benefit!</strong></li>\n</ul>', '', '', '', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(23, 13, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(24, 13, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(25, 14, '7 Powerful ''Mind Hacks'' Explained!', '<p>Enter benefits for why the user should sign up for your product/service. Some stuff here.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Sign Me Up via Facebook Connect!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(26, 14, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(27, 14, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(28, 15, '', '', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Sign Up With Facebook!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(29, 15, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(30, 15, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(31, 16, 'Want Some More Free Updates?', '<p>Enter benefits for why the user should sign up for your product/service.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
  (32, 16, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(33, 16, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(34, 17, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(35, 17, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(36, 17, 'Want Some More Free Updates?', '<p>Enter benefits for why the user should sign up for your product/service.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(37, 18, '31st October - HALLOWEEN NIGHT!', '<ul>\n<li>Entry before 10pm</li>\n<li>Free Champagne Cocktail on Arrival</li>\n</ul>', '', '', '', 'Add ME!', 'Put Me On the Guest List!', 'Add Me to the Guest List!', 'We hate spam just as much as you', 0),
	(38, 18, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(39, 18, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(40, 19, '', '', '', '', '', 'Sign Me Up!', 'Show Me!', 'Show Me!', 'We hate spam just as much as you', 0),
	(41, 19, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(42, 19, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(43, 20, 'Get Weekly Diet Tips and Motivators!', '<p>Having trouble sticking to a healthy, energizing diet?</p>\n<p>Sign up for our weekly newsletter with <strong>recipes</strong>, <strong>diet tips</strong> and everything you need to <strong>keep motivated!</strong></p>', 'Enter your Name and Email Address Below:', 'Click the Button Below to Sign Up:', 'Click the Button Below to Sign Up Instantly:', 'Sign Me Up!', 'Sign Up With Facebook Connect!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(44, 20, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(45, 20, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(46, 21, 'SIGN UP FOR FREE UPDATES', '<p>Enter benefits for why the user should sign up for your product/service.&nbsp;Try to mention three benefits for your subscribers, here. Keep it brief, but effective.</p>', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(47, 21, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(48, 21, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(49, 22, '', '', '', '', '', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(50, 22, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(51, 22, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(52, 23, 'Ultimate Cow Beauty Pageant', '<ul>\n<li>Cattle market</li>\n<li>Farmer''s lunch</li>\n<li>Meet and Greet</li>\n</ul>', '', '', '', 'Sign Me Up!', 'Sign Up With Facebook!', 'Instant Access!', 'We hate spam just as much as you', 0),
	(53, 23, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(54, 23, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(55, 24, 'Love Music?', '<p>All the tracks and mixes you love, sent straight to your inbox!</p>\n<p><strong>Sign up now!</strong></p>', '', '', '', 'Sign Me Up!', 'Sign Up!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 0),
	(56, 24, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(57, 24, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(58, 25, 'Join 19,000 Readers...', '<p>Sign up to our newsletter for weekly tips and for insider information!</p>', '', '', '', 'Sign Me Up!', 'Connect through Facebook!', 'One Click Sign Up', 'We hate spam just as much as you', 0),
	(59, 25, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(60, 25, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(61, 26, 'Join 19,000 Readers...', '<p>Sign up to our newsletter for weekly tips and for insider information!</p>', '', '', '', 'Sign Me Up!', 'Connect through Facebook!', 'One Click Sign Up', 'We hate spam just as much as you', 0),
	(62, 26, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(63, 26, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2),
	(64, 27, 'Join Our Newsletter', '<ul>\n<li>15% discount on future purchases</li>\n<li>Weekly Sunday update videos</li>\n<li>Free 28 day Training Course delivered to your inbox</li>\n</ul>\n<p>&nbsp;</p>', '', '', '', 'Sign Me Up!', 'Sign Up!', 'Sign Up!', 'We hate spam just as much as you', 0),
	(65, 27, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 1),
	(66, 27, 'Want Some More Free Updates?', 'Enter benefits for why the user should sign up for your product/service.', 'Enter your Name and Email Address Below', 'Click the Button Below to Sign Up', 'Click the Button Below', 'Sign Me Up!', 'Connect to the Webinar through Facebook!', 'Click Here for One Click Sign Up!', 'We hate spam just as much as you', 2);";

    $wpdb->query($hc_themeUpdate1);

    $hc_themeUpdate2 = "INSERT INTO `hc_style_button_templates` (`id`, `id_connector`, `btn_bg_color`, `btn_font_color`, `txt_shadow_color`, `btn_border_color`, `btn_box_shadow`, `btn_font_family`, `btn_bg_light`, `btn_type`, `emailNewLine`, `buttonNewLine`, `button_font_size`, `button_lr_padding`, `button_tb_padding`, `fb_button_size`, `default_template`, `type`) VALUES
	(1, 0, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(2, 5, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#207400', 'Green', 0, 0, '15px', '15px', '6px', 'xlarge', 1, 0),
	(3, 5, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Verdana', '#207400', '', 0, 0, '16px', '20px', '7px', 'large', 1, 1),
	(4, 6, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#207400', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(5, 6, '#FFB30F', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Arial', '#cd8f0c', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(6, 7, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#207400', 'Black', 0, 0, '17px', '22px', '7px', 'large', 1, 0),
	(7, 7, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Dosis', '#207400', '', 0, 0, '16px', '40px', '8px', 'large', 1, 1),
	(8, 8, '#FFB30F', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Dosis', '#cd8f0c', 'Orange', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(9, 8, '#FFB30F', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Arial', '#cd8f0c', '', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(10, 9, '#ededed', '#424242', '#ffffff', '#dcdcdc', '#ffffff', 'Dosis', '#bebebe', 'Silver', 0, 0, '15px', '28px', '6px', 'large', 1, 0),
	(11, 9, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(12, 9, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'PT Sans', '#207400', 'Green', 0, 0, '17px', '15px', '9px', 'xlarge', 1, 2),
	(13, 10, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#be1e1e', 'Silver', 1, 0, '24px', '132px', '6px', 'large', 1, 0),
	(14, 10, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(15, 10, '#FFB30F', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Verdana', '#cd8f0c', 'Orange', 0, 0, '15px', '40px', '8px', 'xlarge', 1, 2),
	(16, 11, '#595959', '#ffffff', '#000000', '#000000', '#FFFFFF', 'PT Sans Narrow', '#474747', 'Black', 0, 0, '18px', '22px', '6px', 'xlarge', 1, 0),
	(17, 11, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(18, 11, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(19, 12, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#be1e1e', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(20, 12, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(21, 12, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(22, 13, '#4FCDD6', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#3fa4ac', 'Blue', 0, 0, '20px', '38px', '18px', 'xlarge', 1, 0),
	(23, 13, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(24, 13, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(25, 14, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#be1e1e', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(26, 14, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(27, 14, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(28, 15, '#299100', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#207400', 'Green', 0, 1, '24px', '139px', '4px', 'xlarge', 1, 0),
	(29, 15, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(30, 15, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(31, 16, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#be1e1e', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(32, 16, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(33, 16, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(34, 17, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(35, 17, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(36, 17, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#be1e1e', 'Silver', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(37, 18, '#3c72cf', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Dosis', '#305ba6', 'Blue', 0, 0, '20px', '23px', '12px', 'xlarge', 1, 0),
	(38, 18, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(39, 18, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(40, 19, '#B1CC00', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Dosis', '#8ea400', 'Blue', 1, 0, '25px', '15px', '6px', 'xlarge', 1, 0),
	(41, 19, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(42, 19, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(43, 20, '#FF8000', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Dosis', '#cd6600', 'Orange', 0, 0, '16px', '21px', '8px', 'large', 1, 0),
	(44, 20, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(45, 20, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(46, 21, '#22AAE4', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#1b88b7', 'Blue', 0, 1, '16px', '101px', '9px', 'large', 1, 0),
	(47, 21, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(48, 21, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(49, 22, '#5CADE0', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Dosis', '#498bb4', 'Blue', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(50, 22, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(51, 22, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(52, 23, '#FFB957', '#FFFFFF', '#171515', '#113006', '#FFFFFF', 'Arial', '#cd9445', 'Silver', 0, 0, '23px', '104px', '7px', 'xlarge', 1, 0),
	(53, 23, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(54, 23, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(55, 24, '#ededed', '#171717', '#ffffff', '#dcdcdc', '#ffffff', 'Arial', '#bebebe', 'Silver', 0, 0, '15px', '26px', '6px', 'large', 1, 0),
	(56, 24, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(57, 24, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(58, 25, '#DE0000', '#FFFFFF', '#000000', '#940000', '#F06C6C', 'Dosis', '#b20000', 'Red', 0, 0, '27px', '129px', '5px', 'xlarge', 1, 0),
	(59, 25, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(60, 25, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(61, 26, '#D3DFCB', '#FFFFFF', '#000000', '#000000', '#fffffc', 'Dosis', '#a9b3a3', 'Orange', 0, 0, '27px', '123px', '5px', 'xlarge', 1, 0),
	(62, 26, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(63, 26, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(64, 27, '#FFC200', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Arial', '#cd9b00', 'Silver', 0, 0, '25px', '24px', '6px', 'xlarge', 1, 0),
	(65, 27, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(66, 27, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2); ";
    $wpdb->query($hc_themeUpdate2);

    $hc_themeUpdate3 = "INSERT INTO `hc_style_connector_templates` (`id`, `id_connector`, `opt_in_box_width`, `opt_in_box_height`, `call_action_height`, `tpl_bg_color`, `opt_in_bg_color`, `border_color`, `border_width`, `border_radius`, `set_heights`, `eoh`, `ech`, `foh`, `fch`, `ooh`, `och`, `is_responsive`, `min_width`, `max_width`, `template_gradient`, `template_bgcolor_1`, `template_bgcolor_2`, `template_picturebg`, `template_picturebgurl`, `template_transparent_bg`, `template_transparent_optin_bg`, `drop_shadow`, `h_shadow`, `v_shadow`, `blur_shadow`, `shadow_color`, `border_style`, `show_privacy_policy`, `bold_privacy_policy`, `center_privacy_policy`, `privacy_policy_font`, `privacy_policy_color`, `privacy_policy_size`, `email_privacy_top_margin`, `facebook_privacy_top_margin`, `oneclick_privacy_top_margin`, `is_template`, `template_image`, `user_template`, `user_template_name`, `default_template`, `type`) VALUES
	(2, 5, '521px', '237px', '98px', '#FFFFFF', '#F0F0F0', '#BFBFBF', '1px', '0px', 0, '237px', '98px', '237px', '98px', '237px', '98px', 0, '', '', 0, '#ffffff', '#ffffff', 0, '', 0, 0, 1, '2px', '2px', '21px', '#D6D6D6', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't5-0main.png', 0, '', 3, 0),
	(3, 5, '230px', '600px', '194px', '#bb0000', '#cb4d4d', '#ADADAD', '1px', '11px', 1, '626px', '194px', '600px', '165px', '581px', '173px', 0, '', '', 1, '#E6E6E6', '#ffffff', 0, '', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't5-1main.png', 0, '', 1, 1),
	(6, 7, '647px', '107px', '107px', '#FFFFFF', '#DBD4D4', '#000000', '0px', '12px', 1, '107px', '107px', '107px', '107px', '107px', '107px', 0, '', '', 1, '#FFFFFF', '#EDEDED', 0, '', 0, 1, 1, '2px', '2px', '17px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't7-0main.png', 0, '', 4, 0),
	(7, 7, '665px', '343px', '79px', '#E3E3E3', '#1E27A1', '#FFFFFF', '9px', '0px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 1, '#D9D9D9', '#DEDEDE', 0, '', 0, 0, 1, '1px', '1px', '30px', '#7D7D7D', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't7-1main.png', 0, '', 0, 1),
	(8, 8, '720px', '377px', '141px', '#CFF0FF', '#91C5DE', '#588EAD', '5px', '0px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#D6F2FF', '#96C9E0', 0, '', 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'outset', 1, 0, 1, 'Arial', '#3A6E8C', '12px', '8px', '8px', '8px', 0, 't8-0main.png', 0, '', 0, 0),
	(9, 8, '194px', '602px', '143px', '#FFD230', '#4D6BCB', '#AD5700', '2px', '15px', 1, '617px', '218px', '514px', '107px', '539px', '158px', 0, '', '', 0, '#ffffff', '#ffffff', 0, '', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'dotted', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't8-1main.png', 0, '', 2, 1),
	(10, 9, '609px', '303px', '122px', '#4A4A4A', '#FF8800', '#242424', '10px', '0px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#ffffff', '#ffffff', 0, '', 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't9-0main.png', 0, '', 0, 0),
	(12, 9, '731px', '393px', '159px', '#BB0000', '#cb4d4d', '#000000', '0px', '0px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't9-2back.png', 1, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 1, 0, 1, 'Arial', '#D1D1D1', '12px', '8px', '22px', '13px', 0, 't9-3main.png', 0, '', 0, 2),
	(13, 10, '477px', '519px', '258px', '#BB0000', '#cb4d4d', '#000000', '0px', '0px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't10-0bg.png', 1, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 1, 0, 1, 'Arial', '#D6D6D6', '12px', '18px', '17px', '15px', 0, 't10-0main.png', 0, '', 0, 0),
	(15, 10, '649px', '371px', '124px', '#292929', '#cb4d4d', '#EDEDED', '5px', '0px', 1, '354px', '124px', '354px', '120px', '354px', '116px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't10-3bg.jpg', 0, 1, 1, '1px', '1px', '20px', '#707070', 'solid', 1, 0, 0, 'Arial', '#CCCCCC', '12px', '19px', '21px', '15px', 0, 't10-3main.png', 0, '', 0, 2),
	(16, 11, '647px', '213px', '109px', '#F7F7F7', '#F0F0F0', '#820000', '4px', '16px', 0, '213px', '102px', '213px', '102px', '213px', '102px', 0, '', '', 1, '#BD0000', '#ED0000', 0, '', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't11-0main.png', 0, '', 5, 0),
	(19, 12, '600px', '220px', '108px', '#BB0000', '#cb4d4d', '#000000', '2px', '19px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't12-0bg.jpg', 1, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't12-0main.png', 0, '', 0, 0),
	(22, 13, '220px', '575px', '189px', '#000000', '#4D6BCB', '#000000', '3px', '0px', 1, '575px', '189px', '506px', '103px', '575px', '170px', 0, '', '', 1, '#000000', '#212121', 0, '', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't13-0main.png', 0, '', 2, 0),
	(25, 14, '568px', '287px', '145px', '#BB0000', '#cb4d4d', '#000000', '0px', '16px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 1, '#FFFFFF', '#F0F0F0', 0, '', 0, 1, 1, '0px', '0px', '29px', '#ADADAD', 'solid', 1, 0, 1, 'Arial', '#A8A8A8', '12px', '12px', '9px', '8px', 0, 't14-0main.png', 0, '', 0, 0),
	(37, 18, '600px', '231px', '138px', '#2B0C0C', '#E0CB9B', '#FF0000', '1px', '16px', 1, '231px', '95px', '231px', '79px', '231px', '90px', 0, '', '', 0, '#FF0000', '#EDEB80', 1, 't18back.png', 0, 1, 1, '0px', '0px', '23px', '#000000', 'dashed', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't18main.png', 0, '', 0, 0),
	(43, 20, '600px', '248px', '105px', '#90D777', '#259C2D', '#259C2D', '5px', '11px', 0, '220px', '90px', '220px', '90px', '220px', '90px', 0, '', '', 0, '#ffffff', '#ffffff', 0, '', 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't20-0main.png', 0, '', 0, 0),
	(46, 21, '629px', '276px', '155px', '#363D47', '#363D47', '#363D47', '2px', '0px', 1, '276px', '155px', '227px', '105px', '239px', '116px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't21-0-bg.png', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't21-0main.png', 0, '', 0, 0),
	(52, 23, '583px', '450px', '90px', '#CFE1FF', '#cb4d4d', '#000000', '1px', '5px', 1, '296px', '123px', '296px', '87px', '280px', '82px', 0, '', '', 0, '#ffffff', '#ffffff', 1, 't23back2.png', 1, 1, 0, '5px', '5px', '5px', '#cccccc', 'dashed', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't23main.png', 0, '', 0, 0),
	(55, 24, '194px', '513px', '165px', '#0051BB', '#C20000', '#EDEDED', '1px', '0px', 1, '513px', '165px', '428px', '72px', '441px', '88px', 0, '', '', 0, '#ffffff', '#ffffff', 0, '', 1, 0, 0, '5px', '5px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't24-0main.png', 0, '', 2, 0),
	(58, 25, '599px', '342px', '189px', '#017890', '#613525', '#98E024', '1px', '18px', 1, '313px', '191px', '223px', '108px', '252px', '125px', 0, '', '', 0, '#017890', '#FF8000', 0, '', 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'dashed', 1, 0, 1, 'Arial', '#FFFFFF', '12px', '12px', '9px', '10px', 0, 't25main.png', 0, '', 0, 0),
	(61, 26, '599px', '342px', '189px', '#DAC582', '#5D4157', '#AB8860', '1px', '18px', 1, '313px', '191px', '223px', '108px', '252px', '125px', 0, '', '', 0, '#017890', '#FF8000', 0, '', 0, 0, 1, '0px', '0px', '3px', '#000000', 'dashed', 1, 0, 1, 'Arial', '#FFFFFF', '12px', '12px', '9px', '10px', 0, 't26main.png', 0, '', 0, 0),
	(64, 27, '261px', '559px', '197px', '#bb0000', '#84002E', '#FFFFFF', '6px', '16px', 1, '589px', '198px', '465px', '83px', '486px', '95px', 0, '', '', 1, '#B80028', '#B80028', 0, '', 0, 0, 0, '5px', '5px', '5px', '#cccccc', 'double', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't27main.png', 0, '', 1, 0); ";
    $wpdb->query($hc_themeUpdate3);

    $hc_themeUpdate4 = "INSERT INTO `hc_style_email_templates` (`id`, `id_connector`, `input_border_color`, `input_bg_color`, `input_font_color`, `input_font_family`, `name_label_field`, `email_label_field`, `default_template`, `type`) VALUES
	(1, 0, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 0),
	(2, 5, '#6B6B6B', '#ffffff', '#A1A1A1', 'berlin Sans FB', 'Name', 'Email', 1, 0),
	(3, 5, '#8C8C8C', '#ffffff', '#000000', 'Verdana', 'Name', 'Email', 1, 1),
	(4, 6, '#920000', '#ffffff', '#000000', 'berlin Sans FB', 'Name', 'Email', 1, 0),
	(5, 6, '#920000', '#ffffff', '#000000', 'berlin Sans FB', 'Name', 'Email', 1, 1),
	(6, 7, '#919191', '#ffffff', '#000000', 'Arial', 'Name', 'Email', 1, 0),
	(7, 7, '#000000', '#ffffff', '#8F8F8F', 'Verdana', 'Name...', 'Email...', 1, 1),
	(8, 8, '#4C82A1', '#ffffff', '#C2C2C2', 'Verdana', 'First Name', 'Email', 1, 0),
	(9, 8, '#AD5700', '#ED5B00', '#FFFFFF', 'berlin Sans FB', 'Name', 'Email', 1, 1),
	(10, 9, '#1C1C1C', '#ffffff', '#858585', 'Droid Sans', 'Name', 'Email', 1, 0),
	(11, 9, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(12, 9, '#1F1F1F', '#ffffff', '#9E9E9E', 'Verdana', 'Name', 'Email', 1, 2),
	(13, 10, '#000000', '#ffffff', '#ADADAD', 'Arial', 'Enter Your Name', 'Enter Your Email', 1, 0),
	(14, 10, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(15, 10, '#212121', '#ffffff', '#000000', 'berlin Sans FB', 'Name', 'Email', 1, 2),
	(16, 11, '#820000', '#FAFAFA', '#000000', 'PT Sans Narrow', 'Name', 'Email', 1, 0),
	(17, 11, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(18, 11, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(19, 12, '#000F92', '#FFF9AB', '#707070', 'Dosis', 'Name', 'Email', 1, 0),
	(20, 12, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(21, 12, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(22, 13, '#66D6FF', '#000000', '#D6D6D6', 'Droid Sans', 'Name', 'Email', 1, 0),
	(23, 13, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(24, 13, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(25, 14, '#6E6E6E', '#C4C4C4', '#000000', 'Arial', 'Name', 'Email', 1, 0),
	(26, 14, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(27, 14, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(28, 15, '#171717', '#FFFFFF', '#9E9E9E', 'Arial', 'Name', 'Email', 1, 0),
	(29, 15, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(30, 15, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(31, 16, '#920000', '#ffffff', '#000000', 'berlin Sans FB', 'Name', 'Email', 1, 0),
	(32, 16, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(33, 16, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(34, 17, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 0),
	(35, 17, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(36, 17, '#920000', '#ffffff', '#000000', 'berlin Sans FB', 'Name', 'Email', 1, 2),
	(37, 18, '#000000', '#5C0000', '#FFFFFF', 'Homenaje', 'Name', 'Email', 1, 0),
	(38, 18, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(39, 18, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(40, 19, '#D1C454', '#FCFBC7', '#785400', 'Verdana', 'Name', 'Email', 1, 0),
	(41, 19, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(42, 19, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(43, 20, '#FFFFFF', '#90D777', '#8C8C8C', 'Verdana', 'Name...', 'Email...', 1, 0),
	(44, 20, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(45, 20, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(46, 21, '#000000', '#EBEBEB', '#5E5E5E', 'berlin Sans FB', 'Name', 'Email', 1, 0),
	(47, 21, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(48, 21, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(49, 22, '#83D4F2', '#F2F2F2', '#919191', 'Verdana', 'First Name...', 'Best Email...', 1, 0),
	(50, 22, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(51, 22, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(52, 23, '#920000', '#FFFCE8', '#000000', 'Arial', 'Name', 'Email', 1, 0),
	(53, 23, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(54, 23, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(55, 24, '#ADADAD', '#ffffff', '#000000', 'Dosis', 'Name', 'Email', 1, 0),
	(56, 24, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(57, 24, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(58, 25, '#920000', '#FCFBCA', '#000000', 'Dosis', 'Name', 'Email', 1, 0),
	(59, 25, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(60, 25, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(61, 26, '#920000', '#FCFBCA', '#000000', 'Dosis', 'Name', 'Email', 1, 0),
	(62, 26, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(63, 26, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(64, 27, '#F2F5ED', '#FFFFCC', '#B80028', 'Dosis', 'Name', 'Email', 1, 0),
	(65, 27, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(66, 27, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2); ";

    $wpdb->query($hc_themeUpdate4);

    $hc_themeUpdate5 = "INSERT INTO `hc_style_image_templates` (`id`, `id_connector`, `show_side_image`, `image_url`, `vertical_position`, `image_left_margin`, `image_right_margin`, `show_arrow_graphics`, `arrow_style`, `min_height`, `max_height`, `min_width`, `max_width`, `image_size`, `default_template`, `type`) VALUES
	(1, 0, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(2, 5, 1, 't5-0side.png', '-33px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '180px', 1, 0),
	(3, 5, 1, 't5-1side.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(4, 6, 1, 'hybrid-box-150.png', '-35px', '5px', '46px', 0, 'arrow-1-black-', '', '', '', '', '150px', 1, 0),
	(5, 6, 1, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(6, 7, 0, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-red-', '', '', '', '', '200px', 1, 0),
	(7, 7, 1, 't7-1side.png', '45px', '-5px', '34px', 0, 'arrow-1-white-', '', '', '', '', '161px', 1, 1),
	(8, 8, 1, 't8-0side.png', '-29px', '-7px', '6px', 1, 'arrow-1-blue-', '', '', '', '', '200px', 1, 0),
	(9, 8, 1, 't8-1side.png', '-43px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(10, 9, 1, 't9-0side.png', '-43px', '5px', '-31px', 1, 'arrow-1-black-', '', '', '', '', '200px', 1, 0),
	(11, 9, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(12, 9, 1, 't9-3side.png', '35px', '0px', '15px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(13, 10, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(14, 10, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(15, 10, 1, 't10-3side.png', '23px', '0px', '9px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(16, 11, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(17, 11, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(18, 11, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(19, 12, 1, 't12-0side.png', '-19px', '0px', '0px', 1, 'arrow-1-black-', '', '', '', '', '200px', 1, 0),
	(20, 12, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(21, 12, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(22, 13, 1, 't13-0side.png', '-31px', '-4px', '15px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(23, 13, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(24, 13, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(25, 14, 1, 't14-0side.png', '10px', '9px', '9px', 1, 'arrow-1-white-', '', '', '', '', '128px', 1, 0),
	(26, 14, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(27, 14, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(28, 15, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(29, 15, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(30, 15, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(31, 16, 1, 'gold-shield-200.png', '11px', '0px', '12px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(32, 16, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(33, 16, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(34, 17, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(35, 17, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(36, 17, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(37, 18, 1, 't18side1.png', '-79px', '-22px', '-8px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(38, 18, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(39, 18, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(40, 19, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(41, 19, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(42, 19, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(43, 20, 1, 't20-0side.png', '5px', '0px', '5px', 1, 'arrow-1-white-', '', '', '', '', '160px', 1, 0),
	(44, 20, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(45, 20, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(46, 21, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(47, 21, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(48, 21, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(49, 22, 0, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(50, 22, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(51, 22, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(52, 23, 0, 'linkcontrol.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(53, 23, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(54, 23, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(55, 24, 1, 't24-0side.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(56, 24, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(57, 24, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(58, 25, 1, 't25side.png', '-50px', '12px', '15px', 0, 'arrow-1-white-', '', '', '', '', '175px', 1, 0),
	(59, 25, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(60, 25, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(61, 26, 1, 't26side.png', '-50px', '12px', '15px', 1, 'arrow-1-yellow-', '', '', '', '', '175px', 1, 0),
	(62, 26, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(63, 26, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(64, 27, 1, 't27side.png', '-96px', '0px', '32px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(65, 27, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(66, 27, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(69, 28, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(70, 29, 0, 'music-love-headphones.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(71, 29, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(72, 29, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(73, 30, 0, 'music-love-headphones.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(74, 30, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(75, 30, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(76, 31, 0, 'music-love-headphones.png', '-30px', '0px', '0px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(77, 31, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(78, 31, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(79, 32, 1, 't32-0side.png', '22px', '5px', '30px', 0, 'arrow-1-white-', '', '', '', '', '102px', 1, 0),
	(80, 32, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(81, 32, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(82, 33, 0, 'linkcontrol.png', '-96px', '0px', '32px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(83, 33, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(84, 33, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(85, 34, 0, 'linkcontrol.png', '-96px', '0px', '32px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(86, 34, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(87, 34, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(88, 35, 1, 't32-0side.png', '22px', '5px', '30px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(89, 35, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(90, 35, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(91, 36, 0, 't32-0side.png', '22px', '5px', '30px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(92, 36, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(93, 36, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(94, 37, 1, 't37-0side.png', '17px', '79px', '97px', 0, 'arrow-1-white-', '', '', '', '', '64px', 1, 0),
	(95, 37, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(96, 37, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(97, 38, 0, 't38-0side.png', '17px', '79px', '97px', 0, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(98, 38, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(99, 38, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(100, 39, 1, 't39-0side.png', '22px', '0px', '69px', 0, 'arrow-1-white-', '', '', '', '', '64px', 1, 0),
	(101, 39, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(102, 39, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(103, 40, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 0),
	(104, 40, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(105, 40, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2),
	(106, 41, 1, 't9-0side.png', '-20px', '5px', '-31px', 1, 'arrow-1-black-', '', '', '', '', '200px', 1, 0),
	(107, 41, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 1),
	(108, 41, 1, 'linkcontrol.png', '-30px', '0px', '0px', 1, 'arrow-1-white-', '', '', '', '', '200px', 1, 2); ";

    $wpdb->query($hc_themeUpdate5);

    $hc_themeUpdate6 = "INSERT INTO `hc_style_optin_templates` (`id`, `id_connector`, `name_length`, `email_length`, `email_centered`, `fb_centered`, `oneclick_centered`, `field_font_size`, `field_height`, `field_padding_top_bottom`, `field_padding_left_right`, `field_border_width`, `field_border_style`, `field_border_radius`, `default_template`, `type`) VALUES
	(1, 0, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(2, 5, '140px', '140px', 1, 1, 1, '15px', '34px', '0px', '3px', '1px', 'solid', '0px', 1, 0),
	(3, 5, '173px', '173px', 1, 1, 1, '11px', '40px', '4px', '3px', '1px', 'solid', '5px', 1, 1),
	(4, 6, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(5, 6, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(6, 7, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(7, 7, '180px', '180px', 1, 1, 1, '16px', '40px', '0px', '3px', '1px', 'solid', '5px', 1, 1),
	(8, 8, '129px', '128px', 1, 1, 1, '15px', '40px', '3px', '3px', '2px', 'solid', '0px', 1, 0),
	(9, 8, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '2px', 'dotted', '6px', 1, 1),
	(10, 9, '140px', '140px', 1, 1, 1, '15px', '36px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(11, 9, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(12, 9, '187px', '187px', 1, 1, 1, '15px', '41px', '0px', '3px', '1px', 'solid', '5px', 1, 2),
	(13, 10, '300px', '300px', 1, 1, 1, '15px', '45px', '3px', '15px', '1px', 'solid', '8px', 1, 0),
	(14, 10, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(15, 10, '179px', '179px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '4px', 1, 2),
	(16, 11, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '8px', '1px', 'solid', '5px', 1, 0),
	(17, 11, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(18, 11, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(19, 12, '140px', '140px', 1, 1, 1, '18px', '40px', '3px', '3px', '2px', 'solid', '5px', 1, 0),
	(20, 12, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(21, 12, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(22, 13, '192px', '192px', 1, 1, 1, '17px', '40px', '3px', '3px', '2px', 'solid', '0px', 1, 0),
	(23, 13, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(24, 13, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(25, 14, '130px', '129px', 1, 1, 1, '15px', '36px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(26, 14, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(27, 14, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(28, 15, '203px', '203px', 1, 1, 1, '15px', '40px', '3px', '9px', '1px', 'solid', '7px', 1, 0),
	(29, 15, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(30, 15, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(31, 16, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(32, 16, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(33, 16, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(34, 17, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(35, 17, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(36, 17, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(37, 18, '197px', '203px', 1, 1, 1, '29px', '55px', '13px', '3px', '1px', 'solid', '5px', 1, 0),
	(38, 18, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(39, 18, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(40, 19, '229px', '227px', 1, 1, 1, '23px', '49px', '4px', '8px', '1px', 'solid', '5px', 1, 0),
	(41, 19, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(42, 19, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(43, 20, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '3px', 'solid', '5px', 1, 0),
	(44, 20, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(45, 20, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(46, 21, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '0px', 'solid', '0px', 1, 0),
	(47, 21, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(48, 21, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(49, 22, '140px', '140px', 1, 1, 1, '11px', '32px', '3px', '3px', '0px', 'solid', '0px', 1, 0),
	(50, 22, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(51, 22, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(52, 23, '162px', '163px', 0, 0, 0, '19px', '42px', '6px', '9px', '1px', 'solid', '5px', 1, 0),
	(53, 23, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(54, 23, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(55, 24, '140px', '140px', 1, 1, 1, '13px', '40px', '3px', '9px', '1px', 'dashed', '0px', 1, 0),
	(56, 24, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(57, 24, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(58, 25, '187px', '182px', 1, 1, 1, '24px', '46px', '2px', '6px', '1px', 'solid', '5px', 1, 0),
	(59, 25, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(60, 25, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(61, 26, '187px', '182px', 1, 1, 1, '24px', '46px', '2px', '6px', '1px', 'solid', '5px', 1, 0),
	(62, 26, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(63, 26, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(64, 27, '196px', '196px', 1, 1, 1, '22px', '48px', '3px', '6px', '1px', 'solid', '5px', 1, 0),
	(65, 27, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(66, 27, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2); ";

    $wpdb->query($hc_themeUpdate6);

    $hc_themeUpdate7 = "INSERT INTO `hc_style_text_templates` (`id`, `id_connector`, `headline_font_color`, `headline_font_size`, `headline_font_family`, `headline_bold`, `border_font_color`, `border_font_size`, `border_font_family`, `call_action_font_color`, `call_action_font_family`, `call_action_font_size`, `headline_center`, `body_center`, `text_vertical_position`, `tick_style`, `headline_shadow`, `text_shadow`, `cta_shadow`, `text_h_Shadow`, `text_v_Shadow`, `text_blur_shadow`, `text_shadow_color`, `headline_left_margin`, `headline_right_margin`, `text_left_margin`, `text_right_margin`, `bullet_left_margin`, `default_template`, `type`) VALUES
	(1, 0, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(2, 5, '#186621', '23px', 'Arial', 0, '#474747', '15px', 'Verdana', '#186621', 'Arial', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(3, 5, '#3A7533', '23px', 'Verdana', 1, '#3A7533', '16px', 'Verdana', '#781F1F', 'Verdana', '19px', 1, 0, '0px', '1', 0, 0, 0, '1px', '1px', '1px', '#8C8C8C', '0px', '5px', '14px', '12px', '10px', 1, 1),
	(4, 6, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(5, 6, '#ffffff', '22px', 'Droid Sans', 0, '#ffffff', '16px', 'berlin Sans FB', '#ffffff', 'Droid Sans', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(6, 7, '#ffffff', '25px', 'Verdana', 0, '#ffffff', '18px', 'berlin Sans FB', '#000000', 'Droid Serif', '20px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#F5F5F5', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(7, 7, '#08129C', '27px', 'Dosis', 1, '#171717', '17px', 'Verdana', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '4', 1, 1, 0, '1px', '1px', '2px', '#FFFFFF', '5px', '5px', '5px', '5px', '65px', 1, 1),
	(8, 8, '#050505', '31px', 'Lora', 0, '#262626', '17px', 'Verdana', '#000000', 'Lora', '18px', 0, 0, '0px', '2', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(9, 8, '#ffffff', '21px', 'Droid Sans', 1, '#ffffff', '17px', 'berlin Sans FB', '#ffffff', 'Droid Sans', '17px', 1, 0, '0px', '1', 1, 1, 1, '1px', '1px', '0px', '#4F4F4F', '5px', '5px', '11px', '18px', '10px', 1, 1),
	(10, 9, '#FF8800', '34px', 'Lobster', 0, '#ffffff', '18px', 'Open Sans', '#242424', 'Lobster', '21px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(11, 9, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(12, 9, '#ffffff', '25px', 'Arial', 1, '#ffffff', '17px', 'Verdana', '#ffffff', 'Verdana', '17px', 0, 0, '11px', '2', 1, 1, 1, '1px', '1px', '2px', '#363636', '29px', '5px', '30px', '214px', '44px', 1, 2),
	(13, 10, '#FF0000', '40px', 'Russo One', 0, '#ffffff', '19px', 'Arial', '#ffffff', 'berlin Sans FB', '18px', 1, 1, '40px', '1', 1, 1, 1, '2px', '2px', '2px', '#212121', '0px', '0px', '0px', '5px', '10px', 1, 0),
	(14, 10, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(15, 10, '#ffffff', '24px', 'Verdana', 1, '#ffffff', '16px', 'Verdana', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '2', 1, 1, 0, '2px', '2px', '2px', '#000000', '5px', '5px', '5px', '5px', '41px', 1, 2),
	(16, 11, '#FFFFFF', '32px', 'Lobster', 0, '#FFFFFF', '19px', 'PT Sans Narrow', '#FFFFFF', 'PT Sans Narrow', '22px', 1, 0, '0px', '1', 1, 1, 1, '2px', '2px', '2px', '#363636', '0px', '5px', '20px', '33px', '10px', 1, 0),
	(17, 11, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(18, 11, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(19, 12, '#FFFFFF', '26px', 'Dosis', 1, '#FFFFFF', '22px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 1, 1, 1, '0px', '0px', '6px', '#171717', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(20, 12, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(21, 12, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(22, 13, '#ffffff', '24px', 'Russo One', 0, '#ffffff', '17px', 'Open Sans', '#ffffff', 'Droid Sans', '19px', 1, 1, '0px', '5', 1, 0, 0, '2px', '2px', '2px', '#187980', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(23, 13, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(24, 13, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(25, 14, '#4A4A4A', '24px', 'Arial', 1, '#6E6E6E', '17px', 'Arial', '#4A4A4A', 'Verdana', '18px', 0, 0, '20px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '15px', '0px', '15px', '5px', '10px', 1, 0),
	(26, 14, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(27, 14, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(28, 15, '#ffffff', '25px', 'Arial', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'Arial', '18px', 0, 0, '0px', '1', 0, 0, 1, '2px', '2px', '2px', '#0D0D0D', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(29, 15, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(30, 15, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(31, 16, '#FF9D00', '37px', 'Yanone Kaffeesatz', 0, '#FFFC4F', '18px', 'Verdana', '#FFFC4F', 'Yanone Kaffeesatz', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(32, 16, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(33, 16, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(34, 17, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(35, 17, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(36, 17, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(37, 18, '#FFFFFF', '31px', 'Dosis', 0, '#FFFFFF', '21px', 'PT Sans Narrow', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '14', 1, 1, 0, '2px', '2px', '2px', '#000000', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(38, 18, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(39, 18, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(40, 19, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#007A21', 'Lora', '25px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(41, 19, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(42, 19, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(43, 20, '#ffffff', '24px', 'berlin Sans FB', 1, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 1, 1, 1, '2px', '2px', '5px', '#3B3B3B', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(44, 20, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(45, 20, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(46, 21, '#ffffff', '31px', 'Arial', 0, '#E8E8E8', '17px', 'Arial', '#FFFFFF', 'Arial', '18px', 0, 0, '16px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '27px', '5px', '20px', '5px', '10px', 1, 0),
	(47, 21, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(48, 21, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(49, 22, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(50, 22, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(51, 22, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(52, 23, '#8C0000', '27px', 'PT Sans', 0, '#302121', '20px', 'PT Sans', '#1C1818', 'PT Sans', '18px', 0, 0, '8px', '3', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '8px', '5px', '5px', '5px', '57px', 1, 0),
	(53, 23, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(54, 23, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(55, 24, '#C20000', '32px', 'Parisienne', 1, '#696969', '16px', 'Verdana', '#ffffff', 'Droid Sans', '18px', 1, 1, '186px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(56, 24, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(57, 24, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(58, 25, '#ffffff', '22px', 'Holtwood One SC', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '17px', '1', 1, 1, 0, '1px', '1px', '2px', '#000000', '24px', '5px', '24px', '5px', '10px', 1, 0),
	(59, 25, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(60, 25, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(61, 26, '#ffffff', '22px', 'Holtwood One SC', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '17px', '1', 1, 1, 0, '1px', '1px', '2px', '#000000', '24px', '5px', '24px', '5px', '10px', 1, 0),
	(62, 26, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(63, 26, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(64, 27, '#FFFFCC', '31px', 'Dosis', 0, '#ffffff', '20px', 'Dosis', '#ffffff', 'Dosis', '18px', 1, 0, '0px', '6', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '0px', '0px', '8px', '0px', '14px', 1, 0),
	(65, 27, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(66, 27, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2); ";

    $wpdb->query($hc_themeUpdate7);

    $hc_themeUpdate21 = "INSERT INTO `hc_connector_text_templates` (`id`, `id_connector`, `optin_headline`, `optin_description`, `email_call`, `fb_call`, `oneclick_call`, `email_btn`, `fb_btn`, `oneclick_btn`, `privacy_policy_text`, `type`) VALUES
	(70, 29, 'Sign Up for Our Newsletter', '<p>Join thousands of subscribers and receive all updates in your inbox, for free!</p>', '', '', '', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(73, 30, 'Subscribe for Free Updates!', '<p>Join thousands of subscribers and receive all updates in your inbox, for free!</p>', '', '', '', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(76, 31, 'Subscribe for Free Updates!', '<p>Join thousands of subscribers and receive all updates in your inbox, for free!</p>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(79, 32, 'Get Your Mobile-Ready Website!', '<p><strong>Is your website mobile-ready?</strong> Or are you losing out on thousands of visitors, by presenting a desktop-only design?</p>\n<p><strong>Sign up to get:</strong></p>\n<ul>\n<li><strong>Free mobile-ready website template</strong></li>\n<li><strong>Free consultation for your individual site</strong></li>\n</ul>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(82, 33, 'Conversion Training Course: Double your Conversion Rates', '<p>&nbsp;</p>\n<ul>\n<li>Learn the <strong>simple</strong> techniques that will double your conversion rates within the next half an hour</li>\n<li><strong>Real Life&nbsp;</strong><strong>case studies</strong> of how we tripled the profit margin of our clients</li>\n<li>24 of our&nbsp;hottest&nbsp;<strong>insider secrets&nbsp;</strong>for maximum profits</li>\n</ul>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>', 'Fill out the form Below to Start your FREE COURSE', '', '', 'Sign Me Up!', 'Sign Up!', 'Sign Up!', 'I will never spam you!', 0),
	(85, 34, 'Broome Manor Golf Course and Country Club', '<div>&nbsp;</div>\n<p>&nbsp;</p>', 'Members Enter your Name & Email Below to Keep Up-to-date with latest news, events and competitions!', 'Members Click the Button Below to Connect with us on Facebook and Keep Up-to-date with latest news, events and competitions!', 'Members Enter your Name & Email Below to Keep Up-to-date with latest news, events and competitions!', 'Sign Me Up!', 'Connect with Us on Facebook!', 'Connect with Us!', 'I will never spam you!', 0),
	(88, 35, 'Get Your Mobile-Ready Website!', '<p><strong>Is your website mobile-ready?</strong> Or are you losing out on thousands of visitors, by presenting a desktop-only design?</p>\n<p><strong>Sign up to get:</strong></p>\n<ul>\n<li><strong>Free mobile-ready website template</strong></li>\n<li><strong>Free consultation for your individual site</strong></li>\n</ul>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(91, 36, 'Rock Hard Thighs!', '<p><strong>Are you ready to finally get those rock hard thighs you''ve been after?</strong>&nbsp;Grab our revolutionary training r&eacute;gime for free!</p>\n<p><strong>Sign up to get:</strong></p>\n<ul>\n<li><strong>7 Day to rock hard thighs training program</strong></li>\n<li><strong>One Hour Video Exercise program</strong></li>\n</ul>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(94, 37, 'Free Blue Widget!', '<ul>\n<li>Get your own blue widget!</li>\n<li>Tutorial videos.</li>\n<li>Weekly newsletter updates included!</li>\n</ul>\n<p>&nbsp;</p>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(97, 38, 'SIGN UP TO OUR NEWSLETTER!', '<p>&nbsp;</p>\n<p>Sign up to receive all of our newsletter updates. Free, convenient, sent straight to your inbox. Some more text goes here.</p>', '', '', '', 'Sign Me Up!', 'Click Here to Sign Up!', 'Click Here to Sign Up!', 'We hate spam just as much as you', 0),
	(100, 39, 'Newsletter Updates!', '<p>Join thousands of subscribers and receive all updates in your inbox, for free!</p>', 'Enter Your Name and Email Address Below to Get Started!', 'Click the Button Below to Get Started Right Away!', 'Click the Button Below to Get Started Right Away!', 'Sign Me Up!', 'Sign Me Up!', 'Sign Me Up!', 'We hate spam just as much as you', 0);";
    $wpdb->query($hc_themeUpdate21);

    $hc_themeUpdate22 = "INSERT INTO `hc_style_button_templates` (`id`, `id_connector`, `btn_bg_color`, `btn_font_color`, `txt_shadow_color`, `btn_border_color`, `btn_box_shadow`, `btn_font_family`, `btn_bg_light`, `btn_type`, `emailNewLine`, `buttonNewLine`, `button_font_size`, `button_lr_padding`, `button_tb_padding`, `fb_button_size`, `default_template`, `type`) VALUES

	(70, 29, '#ededed', '#171717', '#ffffff', '#dcdcdc', '#ffffff', 'Arial', '#bebebe', 'Silver', 0, 0, '15px', '26px', '6px', 'large', 1, 0),
	(71, 29, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(72, 29, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(73, 30, '#FFEE00', '#000000', '#FFFFFF', '#000000', '#FFFFFF', 'Verdana', '#cdbf00', 'Yellow', 0, 0, '15px', '34px', '6px', 'large', 1, 0),
	(74, 30, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(75, 30, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(76, 31, '#DC2826', '#FFFFFF', '#212121', '#DC2826', '#BD9595', 'Verdana', '#b0201e', 'Silver', 0, 0, '15px', '113px', '9px', 'xlarge', 1, 0),
	(77, 31, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(78, 31, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(79, 32, '#74E04A', '#ffffff', '#000000', '#148729', '#FFFFFF', 'Verdana', '#5db43b', 'Green', 0, 0, '15px', '27px', '15px', 'xlarge', 1, 0),
	(80, 32, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(81, 32, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(82, 33, '#FFC200', '#B15D00', '#E3DADA', '#D17400', '#FFFFFF', 'Arial', '#cd9b00', 'Silver', 0, 0, '17px', '69px', '10px', 'xlarge', 1, 0),
	(83, 33, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(84, 33, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(85, 34, '#FFC200', '#B15D00', '#E3DADA', '#D17400', '#FFFFFF', 'Arial', '#cd9b00', 'Silver', 0, 0, '17px', '69px', '10px', 'xlarge', 1, 0),
	(86, 34, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(87, 34, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(88, 35, '#74E04A', '#ffffff', '#000000', '#148729', '#FFFFFF', 'Verdana', '#5db43b', 'Green', 0, 0, '15px', '27px', '15px', 'xlarge', 1, 0),
	(89, 35, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(90, 35, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(91, 36, '#53E01B', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Verdana', '#42b415', 'Green', 0, 0, '15px', '27px', '15px', 'xlarge', 1, 0),
	(92, 36, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(93, 36, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(94, 37, '#3c72cf', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Verdana', '#305ba6', 'Blue', 0, 0, '15px', '27px', '15px', 'large', 1, 0),
	(95, 37, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(96, 37, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(97, 38, '#3D3D3D', '#ffffff', '#000000', '#000000', '#FFFFFF', 'Dosis', '#313131', 'Black', 0, 0, '19px', '27px', '12px', 'large', 1, 0),
	(98, 38, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(99, 38, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(100, 39, '#FFAF2E', '#FFFFFF', '#212121', '#EB8328', '#DEDCBD', 'Verdana', '#cd8c24', 'Silver', 0, 0, '14px', '29px', '21px', 'large', 1, 0),
	(101, 39, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(102, 39, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(103, 40, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 0),
	(104, 40, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(105, 40, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2),
	(106, 41, '#ededed', '#424242', '#ffffff', '#dcdcdc', '#ffffff', 'Dosis', '#bebebe', 'Silver', 0, 0, '15px', '28px', '6px', 'large', 1, 0),
	(107, 41, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 1),
	(108, 41, '#ED2626', '#FFFFFF', '#171515', '#332C2C', '#F06C6C', 'Dosis', '#b20000', '1', 0, 0, '15px', '15px', '6px', 'large', 1, 2);";
    $wpdb->query($hc_themeUpdate22);

    $hc_themeUpdate23 = "INSERT INTO `hc_style_connector_templates` (`id`, `id_connector`, `opt_in_box_width`, `opt_in_box_height`, `call_action_height`, `tpl_bg_color`, `opt_in_bg_color`, `border_color`, `border_width`, `border_radius`, `set_heights`, `eoh`, `ech`, `foh`, `fch`, `ooh`, `och`, `is_responsive`, `min_width`, `max_width`, `template_gradient`, `template_bgcolor_1`, `template_bgcolor_2`, `template_picturebg`, `template_picturebgurl`, `template_transparent_bg`, `template_transparent_optin_bg`, `drop_shadow`, `h_shadow`, `v_shadow`, `blur_shadow`, `shadow_color`, `border_style`, `show_privacy_policy`, `bold_privacy_policy`, `center_privacy_policy`, `privacy_policy_font`, `privacy_policy_color`, `privacy_policy_size`, `email_privacy_top_margin`, `facebook_privacy_top_margin`, `oneclick_privacy_top_margin`, `is_template`, `template_image`, `user_template`, `user_template_name`, `default_template`, `type`) VALUES
  (67, 29, '266px', '326px', '165px', '#0051BB', '#C20000', '#EDEDED', '0px', '6px', 1, '326px', '165px', '239px', '72px', '256px', '84px', 0, '', '', 1, '#6482B6', '#3F5D91', 0, '', 0, 1, 1, '2px', '2px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't29-0main.png', 0, '', 2, 0),
	(68, 30, '310px', '326px', '165px', '#0051BB', '#C20000', '#EDEDED', '0px', '6px', 1, '289px', '125px', '239px', '72px', '256px', '84px', 0, '', '', 1, '#000000', '#454545', 0, '', 0, 1, 0, '2px', '2px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't30-0main.png', 0, '', 2, 0),
	(69, 31, '426px', '325px', '197px', '#DC2826', '#252222', '#EDEDED', '0px', '12px', 1, '325px', '197px', '292px', '161px', '300px', '161px', 0, '', '', 0, '#000000', '#454545', 0, '', 0, 0, 0, '2px', '2px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't31-0main.png', 0, '', 2, 0),
	(70, 32, '690px', '366px', '138px', '#DC2826', '#252222', '#FFFFFF', '4px', '12px', 0, '325px', '197px', '292px', '161px', '300px', '161px', 0, '', '', 1, '#3F7496', '#589DC9', 0, '', 0, 1, 1, '2px', '2px', '15px', '#919191', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't32-0main.png', 0, '', 2, 0),
	(71, 33, '322px', '559px', '197px', '#FFFFFF', '#84002E', '#FFFFFF', '0px', '0px', 1, '700px', '324px', '465px', '100px', '486px', '112px', 0, '', '', 0, '#B80028', '#B80028', 1, 't33back.png', 0, 1, 0, '5px', '5px', '5px', '#cccccc', 'double', 1, 0, 1, 'Arial', '#8C6262', '12px', '5px', '8px', '5px', 0, 't33main.png', 0, '', 1, 0),
	(72, 34, '585px', '559px', '197px', '#FFFFFF', '#84002E', '#120000', '1px', '19px', 1, '387px', '219px', '379px', '194px', '387px', '173px', 0, '', '', 0, '#B80028', '#B80028', 1, 't34back.jpg', 0, 1, 1, '5px', '5px', '5px', '#B3B3B3', 'outset', 0, 0, 0, 'Arial', '#8C6262', '12px', '5px', '8px', '5px', 0, 't34main.png', 0, '', 1, 0),
	(74, 36, '589px', '502px', '138px', '#0B1F36', '#252222', '#FFFFFF', '4px', '12px', 0, '325px', '197px', '292px', '161px', '300px', '161px', 0, '', '', 0, '#3F7496', '#589DC9', 1, 'T36back.png', 0, 0, 1, '2px', '2px', '19px', '#D1993E', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't36main.png', 0, '', 2, 0),
	(75, 37, '260px', '605px', '294px', '#FAFAFA', '#252222', '#FFFFFF', '3px', '0px', 1, '605px', '294px', '474px', '152px', '490px', '181px', 0, '', '', 0, '#3F7496', '#589DC9', 1, 't37-0bg.png', 0, 1, 1, '2px', '2px', '15px', '#919191', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't37-0main.png', 0, '', 2, 0),
	(76, 38, '560px', '439px', '108px', '#FFFFFF', '#252222', '#242424', '1px', '0px', 0, '605px', '294px', '474px', '152px', '490px', '181px', 0, '', '', 0, '#3F7496', '#589DC9', 1, 't38-0bg.png', 0, 1, 0, '2px', '2px', '15px', '#919191', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't38-0main.png', 0, '', 2, 0),
	(77, 39, '200px', '534px', '300px', '#FFAF2E', '#252222', '#EDEDED', '0px', '12px', 1, '589px', '300px', '427px', '144px', '465px', '177px', 0, '', '', 0, '#000000', '#454545', 0, '', 0, 0, 0, '2px', '2px', '5px', '#cccccc', 'solid', 0, 0, 0, 'Arial', '#000000', '12px', '5px', '5px', '5px', 0, 't39-0main.png', 0, '', 2, 0);";
    $wpdb->query($hc_themeUpdate23);

    $hc_themeUpdate24 = "INSERT INTO `hc_style_email_templates` (`id`, `id_connector`, `input_border_color`, `input_bg_color`, `input_font_color`, `input_font_family`, `name_label_field`, `email_label_field`, `default_template`, `type`) VALUES
	(70, 29, '#ADADAD', '#ffffff', '#A1A1A1', 'Verdana', 'enter your name', 'enter your email', 1, 0),
	(71, 29, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(72, 29, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(73, 30, '#000000', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(74, 30, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(75, 30, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(76, 31, '#000000', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(77, 31, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(78, 31, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(79, 32, '#949494', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(80, 32, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(81, 32, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(82, 33, '#CBD1C2', '#FFFFF2', '#7A7A7A', 'Dosis', 'Enter Name', 'Enter Email', 1, 0),
	(83, 33, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(84, 33, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(85, 34, '#CBD1C2', '#FFFFFF', '#7A7A7A', 'Dosis', 'Enter Name', 'Enter Email', 1, 0),
	(86, 34, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(87, 34, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(88, 35, '#949494', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(89, 35, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(90, 35, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(91, 36, '#949494', '#FDFFE5', '#000000', 'Verdana', 'your name...', 'your email...', 1, 0),
	(92, 36, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(93, 36, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(94, 37, '#949494', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(95, 37, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(96, 37, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(97, 38, '#949494', '#ED3313', '#FFFFFF', 'Dosis', 'your name...', 'your email...', 1, 0),
	(98, 38, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(99, 38, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(100, 39, '#000000', '#ffffff', '#A1A1A1', 'Verdana', 'your name...', 'your email...', 1, 0),
	(101, 39, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(102, 39, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(103, 40, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 0),
	(104, 40, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(105, 40, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2),
	(106, 41, '#1C1C1C', '#ffffff', '#858585', 'Droid Sans', 'Name', 'Email', 1, 0),
	(107, 41, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 1),
	(108, 41, '#920000', '#ffffff', '#000000', 'berlin sans FB', 'Name', 'Email', 1, 2);";
    $wpdb->query($hc_themeUpdate24);

    $hc_themeUpdate26 = "INSERT INTO `hc_style_optin_templates` (`id`, `id_connector`, `name_length`, `email_length`, `email_centered`, `fb_centered`, `oneclick_centered`, `field_font_size`, `field_height`, `field_padding_top_bottom`, `field_padding_left_right`, `field_border_width`, `field_border_style`, `field_border_radius`, `default_template`, `type`) VALUES
	(70, 29, '211px', '211px', 1, 1, 1, '13px', '40px', '3px', '9px', '1px', 'solid', '0px', 1, 0),
	(71, 29, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(72, 29, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(73, 30, '130px', '130px', 1, 1, 1, '13px', '40px', '3px', '9px', '1px', 'solid', '4px', 1, 0),
	(74, 30, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(75, 30, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(76, 31, '155px', '155px', 1, 1, 1, '13px', '40px', '3px', '9px', '1px', 'solid', '4px', 1, 0),
	(77, 31, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(78, 31, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(79, 32, '180px', '180px', 1, 1, 1, '13px', '52px', '3px', '9px', '1px', 'solid', '4px', 1, 0),
	(80, 32, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(81, 32, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(82, 33, '234px', '234px', 1, 1, 1, '19px', '41px', '3px', '6px', '1px', 'solid', '5px', 1, 0),
	(83, 33, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(84, 33, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(85, 34, '234px', '234px', 1, 1, 1, '19px', '41px', '3px', '6px', '1px', 'solid', '5px', 1, 0),
	(86, 34, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(87, 34, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(88, 35, '180px', '180px', 1, 1, 1, '13px', '52px', '3px', '9px', '1px', 'solid', '4px', 1, 0),
	(89, 35, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(90, 35, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(91, 36, '180px', '180px', 1, 1, 1, '17px', '52px', '3px', '9px', '1px', 'solid', '9px', 1, 0),
	(92, 36, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(93, 36, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(94, 37, '220px', '220px', 1, 1, 1, '17px', '52px', '3px', '9px', '1px', 'dashed', '4px', 1, 0),
	(95, 37, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(96, 37, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(97, 38, '170px', '170px', 1, 1, 1, '20px', '52px', '0px', '9px', '0px', 'dashed', '10px', 1, 0),
	(98, 38, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(99, 38, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(100, 39, '155px', '155px', 1, 1, 1, '13px', '40px', '3px', '9px', '1px', 'solid', '4px', 1, 0),
	(101, 39, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(102, 39, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(103, 40, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(104, 40, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(105, 40, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2),
	(106, 41, '140px', '140px', 1, 1, 1, '15px', '36px', '3px', '3px', '1px', 'solid', '5px', 1, 0),
	(107, 41, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 1),
	(108, 41, '140px', '140px', 1, 1, 1, '15px', '40px', '3px', '3px', '1px', 'solid', '5px', 1, 2); ";

    $wpdb->query($hc_themeUpdate26);

    $hc_themeUpdate27 = "INSERT INTO `hc_style_text_templates` (`id`, `id_connector`, `headline_font_color`, `headline_font_size`, `headline_font_family`, `headline_bold`, `border_font_color`, `border_font_size`, `border_font_family`, `call_action_font_color`, `call_action_font_family`, `call_action_font_size`, `headline_center`, `body_center`, `text_vertical_position`, `tick_style`, `headline_shadow`, `text_shadow`, `cta_shadow`, `text_h_Shadow`, `text_v_Shadow`, `text_blur_shadow`, `text_shadow_color`, `headline_left_margin`, `headline_right_margin`, `text_left_margin`, `text_right_margin`, `bullet_left_margin`, `default_template`, `type`) VALUES
	(70, 29, '#FFFFFF', '29px', 'Ubuntu', 1, '#FFFFFF', '16px', 'Verdana', '#ffffff', 'Verdana', '18px', 1, 1, '12px', '1', 1, 1, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(71, 29, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(72, 29, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(73, 30, '#FFEE00', '33px', 'Lobster', 1, '#FFFFFF', '16px', 'Verdana', '#ffffff', 'Verdana', '18px', 1, 1, '12px', '1', 0, 0, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(74, 30, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(75, 30, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(76, 31, '#252222', '29px', 'Arial', 1, '#252222', '16px', 'Verdana', '#ffffff', 'Verdana', '19px', 1, 1, '17px', '1', 0, 0, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(77, 31, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(78, 31, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(79, 32, '#FFFFFF', '29px', 'Arial', 1, '#FFFFFF', '16px', 'Verdana', '#ffffff', 'Verdana', '19px', 1, 0, '20px', '4', 1, 1, 1, '2px', '2px', '2px', '#223447', '5px', '5px', '24px', '5px', '85px', 1, 0),
	(80, 32, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(81, 32, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(82, 33, '#FFFFCC', '31px', 'Dosis', 0, '#542A00', '18px', 'Dosis', '#2A570B', 'Dosis', '24px', 1, 0, '15px', '12', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '0px', '0px', '83px', '17px', '11px', 1, 0),
	(83, 33, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(84, 33, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(85, 34, '#FFFFCC', '40px', 'Dosis', 0, '#FFFFFF', '24px', 'Dosis', '#FFFFFF', 'Dosis', '24px', 1, 0, '-26px', '12', 1, 1, 1, '2px', '2px', '2px', '#050000', '0px', '0px', '83px', '17px', '11px', 1, 0),
	(86, 34, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(87, 34, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(88, 35, '#FFFFFF', '29px', 'Arial', 1, '#FFFFFF', '16px', 'Verdana', '#ffffff', 'Verdana', '19px', 1, 0, '20px', '4', 1, 1, 1, '2px', '2px', '2px', '#223447', '5px', '5px', '24px', '5px', '85px', 1, 0),
	(89, 35, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(90, 35, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(91, 36, '#EB11A9', '31px', 'Dosis', 1, '#FFFFFF', '21px', 'Dosis', '#ffffff', 'Dosis', '25px', 1, 0, '12px', '3', 1, 1, 1, '2px', '2px', '2px', '#020F1C', '5px', '5px', '24px', '5px', '85px', 1, 0),
	(92, 36, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(93, 36, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(94, 37, '#13538A', '35px', 'PT Sans Narrow', 1, '#13538A', '19px', 'Verdana', '#13538A', 'Verdana', '19px', 1, 0, '20px', '7', 0, 0, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '24px', '5px', '23px', 1, 0),
	(95, 37, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(96, 37, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(97, 38, '#545454', '33px', 'Dosis', 0, '#545454', '21px', 'Dosis', '#13538A', 'Verdana', '19px', 1, 0, '154px', '7', 0, 0, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '24px', '5px', '23px', 1, 0),
	(98, 38, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(99, 38, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(100, 39, '#252222', '29px', 'Arial', 1, '#252222', '16px', 'Verdana', '#ffffff', 'Verdana', '17px', 1, 1, '17px', '1', 0, 0, 0, '2px', '2px', '2px', '#223447', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(101, 39, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(102, 39, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(103, 40, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(104, 40, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(105, 40, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2),
	(106, 41, '#FF8800', '34px', 'Lobster', 0, '#ffffff', '18px', 'Open Sans', '#242424', 'Lobster', '21px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 0),
	(107, 41, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 1),
	(108, 41, '#ffffff', '25px', 'berlin Sans FB', 0, '#ffffff', '18px', 'berlin Sans FB', '#ffffff', 'berlin Sans FB', '18px', 0, 0, '0px', '1', 0, 0, 0, '2px', '2px', '2px', '#cccccc', '5px', '5px', '5px', '5px', '10px', 1, 2);";
    $wpdb->query($hc_themeUpdate27);
    
    // external margins update
     $colExists = check_column_exists("hc_style_connector_templates", "external_top_margin");
    if (!$colExists) {
        $query139templates = "Alter table `hc_style_connector_templates`
                  ADD `external_top_margin` varchar(128) DEFAULT '10px' AFTER `user_template_name`,
                  ADD `external_bottom_margin` varchar(128) DEFAULT '10px' AFTER `external_top_margin`";
        $wpdb->query($query139templates);
    }
    
    //split test feature update
    $colExists = check_column_exists("hc_style_connector", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_connector` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_connector_text", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_connector_text` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_button", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_button` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_connector", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_connector` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_email", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_email` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_image", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_image` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_optin", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_optin` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }
    $colExists = check_column_exists("hc_style_text", "idVariation");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `hc_style_text` ADD `idVariation` INT( 11 ) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
    }

    $createQuery = "CREATE TABLE IF NOT EXISTS `hc_tpl_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConnector` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `testing` tinyint(1) DEFAULT '0',
  `dateTestStart` varchar(255) DEFAULT NULL,
  `dateTestEnd` varchar(255) DEFAULT NULL,
  `testEndManual` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($createQuery);

    $createQuery = "CREATE TABLE IF NOT EXISTS `hc_variations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConnector` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1',
  `name` varchar(500) DEFAULT NULL,
  `control` tinyint(1) DEFAULT '0',
  `totalImpressions` int(11) DEFAULT '0',
  `uniqueImpressions` int(11) DEFAULT '0',
  `conversions` int(11) DEFAULT '0',
  `conversionsRate` varchar(255) DEFAULT NULL,
  `percentageImproovement` varchar(255) DEFAULT NULL,
  `chanceTbo` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($createQuery);

    $createQuery = "CREATE TABLE IF NOT EXISTS `hc_variation_views` (
  `idVariation` int(11) NOT NULL,
  `ipUser` varchar(32) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $wpdb->query($createQuery);
    
    $createQuery = "CREATE TABLE IF NOT EXISTS `hc_tests_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startData` varchar(255) DEFAULT NULL,
  `stopData` varchar(255) DEFAULT NULL,
  `initialControl` int(11) DEFAULT NULL,
  `finalControl` int(11) DEFAULT NULL,
  `var1` int(11) DEFAULT NULL,
  `var2` int(11) DEFAULT NULL,
  `var3` int(11) DEFAULT NULL,
  `var4` int(11) DEFAULT NULL,
  `initialControlCurrent` int(11) DEFAULT NULL,
  `finalControlCurrent` int(11) DEFAULT NULL,
  `idConnector` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `testEndManual` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $wpdb->query($createQuery);

    $connectors = $wpdb->get_results("SELECT * FROM wp_connectors");

    foreach ($connectors as $connector) {
        $variations = $wpdb->get_results("SELECT * FROM hc_variations WHERE idConnector=" . $connector->IntegrationID);
        if (!isset($variations[0])) {
            for ($i = 0; $i < 4; $i++) {
                $wpdb->insert('hc_tpl_types', array('idConnector' => $connector->IntegrationID, 'type' => $i), array('%d', '%d'));
                $wpdb->insert('hc_variations', array('idConnector' => $connector->IntegrationID, 'type' => $i, 'name' => 'Default', 'control' => 1), array('%d', '%d', '%s', '%d'));
                $idVariation = $wpdb->insert_id;
                $wpdb->query("UPDATE hc_connector_text SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_button SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_connector SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_image SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_optin SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_text SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
                $wpdb->query("UPDATE hc_style_email SET idVariation=" . $idVariation . " WHERE id_connector=" . $connector->IntegrationID . " AND type=" . $i);
            }
        }
    }
    
    $colExists = check_column_exists("hc_variations", "formType");
    if (!$colExists) {
            $alterQuery = "ALTER TABLE  `hc_variations` ADD  `formType` VARCHAR( 255 ) NULL DEFAULT  'Hybrid'";

        $wpdb->query($alterQuery);
    }
    
     $colExists = check_column_exists("wp_connectors", "apiConnection");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_connectors` ADD `apiConnection` INT(1) NULL DEFAULT  '0'";
        $wpdb->query($alterQuery);
        // if this is running then must be an upgrade therefore must be running through API so for backwards compatability need to set APIConnection = 1
        $alterQuery = "update `wp_connectors` set `apiConnection` = 1";
        $wpdb->query($alterQuery);
    }
    
    $colExists = check_column_exists("wp_hc_subscribers", "referer");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_hc_subscribers` ADD `referer` varchar(255) default null after `post`";
        $wpdb->query($alterQuery);

    }
    
     $colExists = check_column_exists("wp_hc_subscribers", "trackingcode");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_hc_subscribers` ADD `trackingcode` varchar(255) default null after `referer`";
        $wpdb->query($alterQuery);

    }
    
    $colExists = check_column_exists("wp_hc_subscribers", "referingdomain");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_hc_subscribers` ADD `referingdomain` varchar(255) default null after `trackingcode`";
        $wpdb->query($alterQuery);

    }
    
     $colExists = check_column_exists("wp_connectors", "emailOnly");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_connectors` ADD `emailOnly` INT(1) NOT NULL DEFAULT '0' after `apiConnection`";
        $wpdb->query($alterQuery);
    }
    
      $colExists = check_column_exists("wp_hc_subscribers", "commentsubscriber");
    if (!$colExists) {
        $alterQuery = "ALTER TABLE  `wp_hc_subscribers` ADD `commentsubscriber` int(1) null default '0' after `referingdomain`";
        $wpdb->query($alterQuery);
    }
    
    // bullet point size update
    
    $colExists = check_column_exists("hc_style_connector", "bulletpointsize");
    if (!$colExists) {
       $alterQuery = "ALTER TABLE  `hc_style_connector` ADD `bulletpointsize` varchar(128) default '32px' after `external_bottom_margin`";
       $wpdb->query($alterQuery);
    }
    
     $colExists = check_column_exists("hc_style_connector", "bulletpointoffset");
    if (!$colExists) {
       $alterQuery = "ALTER TABLE  `hc_style_connector` ADD `bulletpointoffset` varchar(128) default '0px' after `bulletpointsize`";
       $wpdb->query($alterQuery);
    }
    
    $colExists = check_column_exists("hc_style_connector", "bulletpointoffsetx");
    if (!$colExists) {
       $alterQuery = "ALTER TABLE  `hc_style_connector` ADD `bulletpointoffsetx` varchar(128) default '0px' after `bulletpointoffset`";
       $wpdb->query($alterQuery);
    }
}

// end of table install


function squeezePageCopyRow($TableName, $IDFieldName, $IDToDuplicate, $new_id = null, $new_name = null, $template_type = null, $copyFromBase = null) {
    global $wpdb;
    if ($TableName && $IDFieldName && $IDToDuplicate > 0) {
        if (is_null($template_type) || $copyFromBase == "1") {
            $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
        } else {
            // override type to copy from 0 instead of 3
            $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate AND type = 0";
        }
        $result = $wpdb->get_results($sql);

        if ($result) {
            $sql = "INSERT INTO $TableName SET ";
            $row = get_object_vars($result[0]);
            $RowKeys = array_keys($row);
            $RowValues = array_values($row);
            $start = 1;
            if ($new_name) {
                $RowValues[1] = $new_name;
            }
            if ($TableName == 'hc_templates') {
                $start = 0;
                $RowValues[0] = $new_id;
            }
            if ($TableName == 'hc_connector_text' || $TableName == 'hc_style_button' || $TableName == 'hc_style_connector'
                    || $TableName == 'hc_style_email' || $TableName == 'hc_style_image' || $TableName == 'hc_style_optin' || $TableName == 'hc_style_text' || $TableName == 'hc_lightbox_options') {
                $start = 1;
                $RowValues[1] = $new_id;
            }
            if ($template_type) {
                $RowValues[1] = $new_id;
            }
            for ($i = $start; $i < count($RowKeys); $i++) {
                if ($i != $start) {
                    $sql .= ", ";
                }
                if ($template_type == 1 && $RowKeys[$i] == 'type') {
                    $RowValues[$i] = 1;
                }
                if ($template_type == 2 && $RowKeys[$i] == 'type') {
                    $RowValues[$i] = 2;
                }
                if ($template_type == 3 && $RowKeys[$i] == 'type') {
                    $RowValues[$i] = 3;
                }
                $sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
            }
            $result = $wpdb->get_results($sql);
            // echo $sql;
        }
    }
    // return $wpdb->insert_id;
}

function check_column_exists($db, $column) {
    $exists = false;
    if ($columns = mysql_query("show columns from $db")) {
        while ($c = mysql_fetch_assoc($columns)) {
            if ($c['Field'] == $column) {
                $exists = true;
                break;
            }
        }
    } else {
        echo (mysql_error());
    }
    return($exists);
}

function hctempMysqlCopyRow($TableName, $IDFieldName, $IDToDuplicate, $new_id = null, $new_name = null, $template_type = null) {
    global $wpdb;
    if ($TableName && $IDFieldName && $IDToDuplicate > 0) {
        $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
        $result = $wpdb->get_results($sql);
        if ($result) {
            $sql = "INSERT INTO $TableName SET ";
            $row = get_object_vars($result[0]);
            $RowKeys = array_keys($row);
            $RowValues = array_values($row);
            $start = 1;
            if ($new_name) {
                $RowValues[1] = $new_name;
            }
            if ($TableName == 'hc_templates') {
                $start = 0;
                $RowValues[0] = $new_id;
            }
            if ($TableName == 'hc_connector_text' || $TableName == 'hc_style_button' || $TableName == 'hc_style_connector'
                    || $TableName == 'hc_style_email' || $TableName == 'hc_style_image' || $TableName == 'hc_style_optin' || $TableName == 'hc_style_text' || $TableName == 'hc_lightbox_options') {
                $start = 1;
                $RowValues[1] = $new_id;
            }
            if ($template_type) {
                $RowValues[1] = $new_id;
            }
            for ($i = $start; $i < count($RowKeys); $i++) {
                if ($i != $start) {
                    $sql .= ", ";
                }
                if ($template_type == 1 && $RowKeys[$i] == 'type') {
                    $RowValues[$i] = 1;
                }
                if ($template_type == 2 && $RowKeys[$i] == 'type') {
                    $RowValues[$i] = 2;
                }
                $sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
            }
            $result = $wpdb->get_results($sql);
        }
    }
    return $wpdb->insert_id;
}

?>