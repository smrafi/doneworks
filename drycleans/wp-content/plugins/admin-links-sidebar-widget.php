<?php
/*
Plugin Name: Admin Links Widget
Plugin URI: http://kdmurray.net/2010/09/22/admin-links-plugin-updated-to-1-4-0/
Description: Provide links to administrative functions from the sidebar.
Version: 1.4.0
Author: Keith Murray
Author URI: http://kdmurray.net/
*/

function widget_adminlinks_init() {
	function widget_adminlinks($args) {
		global $user_level;
		global $wp_version;
		
		if ($user_level == 10)
		{		
			extract($args);
			echo '<!--';
			$blog_url = get_settings('home');
			echo '-->';
			$options	        = get_option('widget_adminlinks');
		
			$title		        = empty($options['title'])	? __('Admin Links')	: $options['title'];
			$path		        = empty($options['path'])	? __('Admin Links')	: $options['path'];

			
			$show_dashboard	        = $options['show_dashboard']		? '1'			: '0';
			$show_editthispost      = $options['show_editthispost']         ? '1'                   : '0';
			$show_editthispage      = $options['show_editthispage']         ? '1'                   : '0';
			$show_newpost	        = $options['show_newpost']		? '1'			: '0';
			$show_manplugins	= $options['show_manplugins']		? '1'			: '0';
			$show_mancomments	= $options['show_mancomments']		? '1'			: '0';
			$show_manthemes 	= $options['show_manthemes']		? '1'			: '0';
			$show_manwidgets	= $options['show_manwidgets']		? '1'			: '0';

					
	 		echo $before_widget;
			echo $before_title . $title . $after_title;
			echo '<ul>';
			if ($show_dashboard) {
					    echo '<li><a href="'.$blog_url.'/wp-admin/">Dashboard</a>';
					    }
			if (is_single() && $show_editthispost) {
			  echo '<li><a href="'.$blog_url.'/wp-admin/post.php?action=edit&post=';
			  the_id();
			  echo '">Edit This Post</a>';
					    }
			if (is_page() && $show_editthispage) {
			if ($wp_version < '3.0')
			{
			  echo '<li><a href="'.$blog_url.'/wp-admin/page.php?action=edit&post=';
			}
			else
			{
			  echo '<li><a href="'.$blog_url.'/wp-admin/post.php?action=edit&post=';
			}
			  the_id();
			  echo '">Edit This Page</a>';
					    }
			if ($show_newpost) { 
					    echo '<li><a href="'.$blog_url.'/wp-admin/post-new.php">New Post</a>';
					    }
			if ($show_manplugins) { 
					    echo '<li><a href="'.$blog_url.'/wp-admin/plugins.php">Manage Plugins</a>';
					    }
			if ($show_mancomments) { 
					    echo '<li><a href="'.$blog_url.'/wp-admin/edit-comments.php">Manage Comments</a>';
					    }
			if ($show_manthemes) { 
					    echo '<li><a href="'.$blog_url.'/wp-admin/themes.php">Manage Themes</a>';
					    }
			if ($show_manwidgets) { 
					    echo '<li><a href="'.$blog_url.'/wp-admin/widgets.php">Manage Widgets</a>';
					    }
			echo '</ul>';
			echo $after_widget;
		}
	}

	function widget_adminlinks_control() {
		$options = $newoptions = get_option('widget_adminlinks');
		if ( $_POST["admlink_submit"] ) {
			$newoptions['title']	= strip_tags(stripslashes($_POST["admlink_title"]));
			$newoptions['show_dashboard']		= isset($_POST['admlink_show_dashboard']);
			$newoptions['show_editthispost']	= isset($_POST['admlink_show_editthispost']);
			$newoptions['show_editthispage']	= isset($_POST['admlink_show_editthispage']);
			$newoptions['show_newpost']		= isset($_POST['admlink_show_newpost']);
			$newoptions['show_manplugins']		= isset($_POST['admlink_show_manplugins']);
			$newoptions['show_mancomments']		= isset($_POST['admlink_show_mancomments']);
			$newoptions['show_manthemes']		= isset($_POST['admlink_show_manthemes']);
			$newoptions['show_manwidgets']		= isset($_POST['admlink_show_manwidgets']);
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_adminlinks', $options);
		}
		$title			= htmlspecialchars($options['title'], ENT_QUOTES);
		$show_dashboard	  	= $options['show_dashboard']    ? 'checked="checked"' : '';
		$show_editthispost  	= $options['show_editthispost'] ? 'checked="checked"' : '';
		$show_editthispage  	= $options['show_editthispage'] ? 'checked="checked"' : '';
		$show_newpost	  	= $options['show_newpost']      ? 'checked="checked"' : '';
		$show_manplugins  	= $options['show_manplugins']   ? 'checked="checked"' : ''; 
		$show_mancomments 	= $options['show_mancomments']  ? 'checked="checked"' : ''; 
		$show_manthemes   	= $options['show_manthemes']    ? 'checked="checked"' : ''; 
		$show_manwidgets  	= $options['show_manwidgets']   ? 'checked="checked"' : ''; 
	?>
        <p>Title: <input style="width: 250px;" id="admlink_title" name="admlink_title" type="text" value="<?php echo $title; ?>" /></p>
        <p style="text-align:right;margin-right:40px;">
            Show Dashboard? 
            <input class="checkbox" type="checkbox" <?php echo $show_dashboard; ?> id="admlink_show_dashboard" name="admlink_show_dashboard" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Edit This Post? 
            <input class="checkbox" type="checkbox" <?php echo $show_editthispost; ?> id="admlink_show_editthispost" name="admlink_show_editthispost" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Edit This Page? 
            <input class="checkbox" type="checkbox" <?php echo $show_editthispage; ?> id="admlink_show_editthispage" name="admlink_show_editthispage" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Write a Post? 
            <input class="checkbox" type="checkbox" <?php echo $show_newpost; ?> id="admlink_show_newpost" name="admlink_show_newpost" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Manage Plugins? 
            <input class="checkbox" type="checkbox" <?php echo $show_manplugins; ?> id="admlink_show_manplugins" name="admlink_show_manplugins" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Manage Comments? 
            <input class="checkbox" type="checkbox" <?php echo $show_mancomments; ?>id="admlink_show_mancomments" name="admlink_show_mancomments" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Manage Themes? 
            <input class="checkbox" type="checkbox" <?php echo $show_manthemes; ?>id="admlink_show_manthemes" name="admlink_show_manthemes" /></p>
	<p style="text-align:right;margin-right:40px;">
            Show Manage Widgets? 
            <input class="checkbox" type="checkbox" <?php echo $show_manwidgets; ?>id="admlink_show_manwidgets" name="admlink_show_manwidgets" /></p>
	<input type="hidden" id="admlink_submit" name="admlink_submit" value="1" />
	<?php
	}

	if (function_exists('register_sidebar_widget')) {
		register_sidebar_widget('Admin Links', 'widget_adminlinks');
		register_widget_control('Admin Links', 'widget_adminlinks_control', 300, 300);
	}
}

// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'widget_adminlinks_init');

?>
