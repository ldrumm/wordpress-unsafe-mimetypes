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
require_once('unsafe_mimetypes_mimelist.php');
if(!function_exists('wp_get_current_user')) {
	include(ABSPATH . "wp-includes/pluggable.php");
}

function custom_upload_mimes_filter()
{
		$priv = get_option('unsafe_mime_settings_priv');
		$mimes_list = get_mimes_list();
		if( (($priv ==='all') && current_user_can('upload_files')) || (($priv ==='admin') && current_user_can('manage_options')) ){
			$mimes = explode(' ', get_option('unsafe_mime_settings_list'));
			if(isset($mimes)){
				foreach($mimes as $mime){
					$existing_mimes[$mime] = (array_key_exists($mime, $mimes_list)===true) ? $mimes_list[$mime] :'application/octet-stream';
				}
				return $existing_mimes;
			}
			return NULL;
		}
		else return NULL;
}

function unsafe_mime_admin_menu()
{
	add_options_page(
		'Configure custom mime types', 
		'Allowed mimetypes', 
		'manage_options', 
		'mimetypes-settings', 
		'unsafe_mime_settings_page');
}

function unsafe_mime_settings_page()
{
	if(!current_user_can('manage_options')){
		die(__("setting option not allowed"));
	}
	if(isset($_POST['mime_list'])){
			update_option('unsafe_mime_settings_list', strtolower($_POST['mime_list']));
	}
	if(isset($_POST['mime_priv'])){
		update_option('unsafe_mime_settings_priv', $_POST['mime_priv']);
	}
	?>
	
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Configure Custom Mimetypes</h2><form method="post" action="options-general.php?page=mimetypes-settings">
		<?php
		settings_fields('unsafe-mime-group');
		do_settings_sections('unsafe-mime-setopt');
		submit_button(); 
		?></form></div><?php
}

function unsafe_mime_section_info()
{
	echo 'Configure which mimetypes you want to be able to upload below...';
	echo 'The current list of custom mimetypes is as follows:<br/><br/><em>' . get_option('unsafe_mime_settings_list'). '</em>';
}

function create_mime_list_box()
{
	?><input type="text" id="mime_list" name="mime_list" value="<?=get_option('unsafe_mime_settings_list');?>" /><?php
}

function create_mime_priv_dropdown()
{
	$opt = get_option('unsafe_mime_settings_priv');
	$a_friendly = ($opt === 'admin')? 'Admins Only':'All uploaders';
	$a_val = $opt;
	$b_friendly = ($opt === 'admin')? 'All uploaders':'Admins Only';
	$b_val = ($opt === 'admin')? 'all':'admin';
	?>
	
	<select name="mime_priv">
		<option selected value="<?=$a_val?>"><?=$a_friendly?></option>
		<option value="<?=$b_val?>"><?=$b_friendly?></option>
	</select>
	<?php
}

function register_mime_settings()
{
	register_setting('unsafe-mime-group', 'custom-mime-setting');
	add_settings_section(
	    'setting_section_id',
	    'Setting',
	    'unsafe_mime_section_info',
	    'unsafe-mime-setopt'
	);
	add_settings_field(
	    'mime_list', 
	    'List of file extensions (no dot, space separated)', 
	    'create_mime_list_box', 
	    'unsafe-mime-setopt',
	    'setting_section_id'
	);
	add_settings_field(
	    'mime_priv', 
	    'User level required to upload unsafe mimetypes', 
	    'create_mime_priv_dropdown', 
	    'unsafe-mime-setopt',
	    'setting_section_id'
	);
}

if(is_admin()){
	if (current_user_can('manage_options') ){
		add_action('admin_menu', 'unsafe_mime_admin_menu' );
		add_action('admin_init', 'register_mime_settings');
	}
	add_filter('upload_mimes', 'custom_upload_mimes_filter');
}
?>
