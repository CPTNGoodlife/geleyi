<?php
/* SIDEBAR OPTIN WIDGET */
class OP_SidebarOptinWidget extends WP_Widget {
    //Constructor
    function OP_SidebarOptinWidget(){
	parent::WP_Widget(false, 'OptimizePress: Sidebar Opt-in', array('classname' => 'widget-optin-title', 'description' => sprintf(__('Displays an optin box in the sidebar. Can be enabled and customized from the <a href="%s">Blog Settings > Modules > Sidebar Opt-in</a> section.'), admin_url('admin.php?page=optimizepress-theme-settings#modules'))));
    }
    
    //Options form for admin section
    function form($instance){
    ?>
	<p>To use this widget you must enable the Sidebar Opt-in Module from the <a href="<?php echo admin_url('admin.php?page=optimizepress-theme-settings#modules'); ?>">Blog Settings > Modules</a> section of OptimizePress</p>
	<?php
    }

    //Widget options get processed and saved here
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    
    //Content of widget gets output here
    function widget($args, $instance){
	op_mod('signup_form')->display(array('sidebar_optin'),false,array('before_form'=>'<div class="sidebar-section sidebar-form">','after_form'=>'</div>'));
    }
}

//Register widgets
register_widget('OP_SidebarOptinWidget');
?>