<?php
if(!class_exists('HybridConnect_Widget')) {
class HybridConnect_Widget extends WP_Widget {
    function HybridConnect_Widget() {
        $widget_ops = array('description' => __('Add opt in forms that you\'ve designed using the Hybrid Connect template builder to your web site in the form of a widget', 'Leaders'));
        parent::WP_Widget('HybridConnect_Widget', $name = 'Hybrid Connect', $widget_ops);
    }
    function widget($args, $instance) {
        $id = apply_filters('widget_title', $instance['connectorID']);
        if (strpos($id, ">")) {
            $temp_str = substr($id, strpos($id, ">") + 1, strlen($id));
            $temp_str = substr($temp_str, 0, strpos($temp_str, "<"));
            $id = (int) $temp_str;
        }
        global $wpdb;
        $my_connector = $wpdb->get_results("SELECT * FROM wp_connectors WHERE IntegrationID=" . $id);
        if (!isset($my_connector[0])) {
            echo "Hybrid Connect Error : Connector could not be found";
            return;
        }
        $my_connector = $my_connector[0];
        
        $tpl_type = $wpdb->get_row("SELECT * FROM hc_tpl_types WHERE idConnector=" . $id . " AND type=1");

        if ($tpl_type->testing == 1) {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id . " AND type=1 ORDER BY RAND() LIMIT 0,1");
        } else {
            $variation = $wpdb->get_row("SELECT * FROM hc_variations WHERE enabled=1 AND idConnector=" . $id . " AND type=1 AND control=1");
        }
        
        $rand_id = rand(1000, 10000);
        $style_text = $wpdb->get_results("SELECT * FROM hc_style_text where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_text = $style_text[0];
        $style_button = $wpdb->get_results("SELECT * FROM hc_style_button where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_button = $style_button[0];
        $style_connector = $wpdb->get_results("SELECT * FROM hc_style_connector where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_connector = $style_connector[0];
        $style_email = $wpdb->get_results("SELECT * FROM hc_style_email where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_email = $style_email[0];
        $style_image = $wpdb->get_results("SELECT * FROM hc_style_image where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_image = $style_image[0];
        $style_optin = $wpdb->get_results("SELECT * FROM hc_style_optin where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $style_optin = $style_optin[0];
        $connector_txt = $wpdb->get_results("SELECT * FROM hc_connector_text where id_connector=" . $id . " AND type=1 AND idVariation=" . $variation->id);
        $connector_txt = $connector_txt[0];
        $connector_txt->optin_description = stripslashes($connector_txt->optin_description);
        $connector_txt->optin_headline = stripslashes($connector_txt->optin_headline);
        $connector_txt->email_call = stripslashes($connector_txt->email_call);
        $connector_txt->fb_call = stripslashes($connector_txt->fb_call);
        $connector_txt->oneclick_call = stripslashes($connector_txt->oneclick_call);
        $connector_txt->email_btn = stripslashes($connector_txt->email_btn);
        $connector_txt->fb_btn = stripslashes($connector_txt->fb_btn);
        $connector_txt->oneclick_btn = stripslashes($connector_txt->oneclick_btn);
        //OLD CALL FOR SELECTING A SPECIFIC TEMPLATE
        if ($my_connector->template_widget == "1") {
            $template_path = $this->_get_hc_template('shortcode', -1);
        } else {
            $template_path = $this->_get_hc_template('shortcode', '');
        }
        include $template_path;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['connectorID'] = strip_tags($new_instance['connectorID']);
        return $instance;
    }
    //Renders the admin settings form (Appearance -> Widgets)
    function form($instance) {
        $connectorID = esc_attr($instance['connectorID']);
        global $wpdb;
        $myrows = $wpdb->get_results("SELECT IntegrationID, Name FROM wp_connectors where is_user_template=0");
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('connectorID'); ?>"><?php _e('Connector Name:'); ?></label>
            <select name="<?php echo $this->get_field_name('connectorID'); ?>" class="widefat" id="<?php echo $this->get_field_id('connectorID'); ?>">
                <?php
                foreach ($myrows as $myrow) {
                    if ($myrow->IntegrationID == $connectorID) {
                        echo '<option selected value="' . $myrow->IntegrationID . '">' . $myrow->Name . '</option>';
                    } else {
                        echo '<option value="' . $myrow->IntegrationID . '">' . $myrow->Name . '</option>';
                    }
                }
                ?>
            </select>
        </p>
        <?php
    }
    function _get_hc_template($tpl_type, $tpl) {
        if ($tpl == -1) {
            $path = 'templates/template_custom.php';
        } else {
            $path = 'templates/template.php';
        }
        return $path;
    }
}
}