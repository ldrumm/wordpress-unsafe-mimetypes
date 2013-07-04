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

function unsafe_mime_list_types()
{
	
return  'here are the types yeah';
}

function unsafe_mime_commit_types()
{
add_option('unsafe_mime_settings', 'none');
}


function custom_upload_mimes()
{
	
 
function custom_upload_mimes ($existing_mimes=array() ) {
 
    // change the word forbiddenfiletype below to an extension you wish to allow
     $existing_mimes[get_option('unsafe_mime_settings')] = 'application/octet-stream';
    
    // call the modified list of extensions
    return $existing_mimes;
}
	
echo 'here are the settings yeah';
}



function my_plugin_menu()
{
	add_options_page('Configure custom mime types', 'Allowed mimetypes', 'manage_options', 'mimetypes-settings', 'unsafe_mime_settings_page');
}

function unsafe_mime_settings_page()
{
		print_r($_POST);
	?>
	
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Configure Custom Mimetypes</h2>	
		<form method="post" action="options.php">
	
	<?php
		settings_fields('unsafe-mime-group');
		do_settings_sections('test-setting-admin');
		submit_button(); 
	?>
	    </form>
	</div>
	<?php

}
function print_section_info()
{
	print_r($_POST);
	echo 'Configure which mimetypes you want to be able to upload below...';
	echo 'The current list of custom mimetypes is as follows<br/><br/><em>'.unsafe_mime_list_types().'</em>';

}

function create_mime_list_box()
{
	?><input type="text" id="mime_list" name="mime_list" value="<?=get_option('unsafe_mime_settings');?>" /><?php
    

}

function register_mysettings()
{
	register_setting('unsafe-mime-group', 'custom-mime-setting');
	add_settings_section(
	    'setting_section_id',
	    'Setting',
	    'print_section_info',
	    'test-setting-admin'
	);	
	add_settings_field(
	    'mime_list', 
	    'List of file extensions (no dot, comma separated)', 
	    'create_mime_list_box', 
	    'test-setting-admin',
	    'setting_section_id'			
	);
}

if(is_admin()){
	
	add_action( 'admin_menu', 'my_plugin_menu' );
	add_action( 'admin_init', 'register_mysettings' );
	add_filter('upload_mimes', 'custom_upload_mimes');
}
	
?>
