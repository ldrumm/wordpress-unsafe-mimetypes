<?php
/*
Plugin Name: wordpress unsafe mimetypes
Plugin URI: http://redmine.lukedrummond.net/projects/wp-unsafe-mimetypes
Description: Allows users to add file types to the whitelist of allowed media formats.  This  is especially useful if you wish to distribute binaries, or specialist media formats (i.e. not just mp3, jpg and pdf)
Version: 0.0.1
Author: Luke Drummond
Author URI: https://lukedrummond.net
License: zlib
*/
?>


<?php
/*Add the settings options to the wordpress admin menu*/

#function unsafe_mime_list_types()
#{
#	
#echo 'here are the settings yeah';
#}

#function unsafe_mime_commit_types()
#{
#echo 'here are the settings yeah';
#}


#function unsafe_mime_register_types()
#{
#echo 'here are the settings yeah';
#}



function my_plugin_menu()
{
	add_options_page('Configure custom mime types', 'mimetypes', 'manage_options', 'mimetypes-settings', 'unsafe-mime-settings');
}

function unsafe_mime_settings_page()
{
	echo 'Here are the settings yeah';
	register_setting('unsafe-mime-group', 'custom-mime-setting');
	?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Settings</h2>	
		<form method="post" action="options.php">
	
	<?php
		settings_fields('unsafe-mime-group');
		do_settings_sections('unsafe-mime-settings');
		submit_button(); 
	?>
	    </form>
	</div>
	<?php

}

if(is_admin()){
	add_action( 'admin_menu', 'my_plugin_menu' );
}

?>
