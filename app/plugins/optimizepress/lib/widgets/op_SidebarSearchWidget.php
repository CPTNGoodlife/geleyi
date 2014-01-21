<?php
/* SIDEBAR SEARCH WIDGET */
class OP_SidebarSearchWidget extends WP_Widget {
    //Constructor
    function OP_SidebarSearchWidget(){
	parent::WP_Widget(false, 'OptimizePress: Sidebar Search', array('description' => __('Displays a search box')));
    }
    
    //Options form for admin section
    function form($instance){
        
    }

    //Widget options get processed and saved here
    function update($new_instance, $old_instance){
        return $new_instance;
    }
    
    //Content of widget gets output here
    function widget($args, $instance){
	?>
	<div class="sidebar-section search">
	    <form class="cf searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div>
		    <label class="assistive-text" for="s"><?php _e('Search for:', OP_T_SN) ?></label>
		    <div class="search-text-input"><input type="text" value="<?php the_search_query() ?>" name="s" id="s" /></div>
		    <input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search',OP_T_SN) ?>" />
		</div>
	    </form>
	</div>
	<?php
    }
}

//Register widgets
register_widget('OP_SidebarSearchWidget');
?>