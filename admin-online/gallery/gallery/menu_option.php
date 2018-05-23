<?php

function gallery(){
	global $curr_page, $hidAction,$hidAction1,$option, $wpdb;
	
	define('TBL','tbl_gallery');
	$entity = 'Gallery';
	$page_name = 'gallery';
	$folder_name = 'gallery';
	$primary_key = 'gallery_id';
	
	
	//create table if not exists
	$table_name = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE 'tbl_gallery'",' ' ) );
	if ($table_name==''){
		$sql = "
				CREATE TABLE IF NOT EXISTS `tbl_gallery` (
				`gallery_id` INT( 11 ) NOT NULL AUTO_INCREMENT,
				`category_id` INT( 11 ) NOT NULL,
				`imagetitle` VARCHAR( 250 ) NOT NULL ,
				`imagealt` VARCHAR( 250 ) NOT NULL ,
				`image` VARCHAR( 255 ) NOT NULL ,
				`description` VARCHAR( 255 ) NOT NULL ,
				`ordering` INT( 11 ) NOT NULL ,
				`status` ENUM( 'Y', 'N' ) NOT NULL ,
				PRIMARY KEY (`gallery_id`)
				) 
			";
		$wpdb->query($sql);
	}
	
	if ( ! is_dir(UPLOAD_PATH) ) {
		@mkdir(UPLOAD_PATH,0777);
	}
	
	if ( ! is_dir(UPLOAD_PATH.$folder_name) ) {
		@mkdir(UPLOAD_PATH.$folder_name,0777);
		@mkdir(UPLOAD_PATH.$folder_name.'/thumbs',0777);
	}
	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_REQUEST = stripslashes_deep($_REQUEST);
	
	
	
	if ($hidAction!='')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-crud.php');
	elseif ($_REQUEST['hidAction1']=='editgal')
	include(PLUGIN_PATH.$folder_name.'/'.$page_name.'-edit-crud.php');
			
	elseif ($option=='add')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
	elseif ($option=='edit')
		include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_edit.php');	
	else
		include(PLUGIN_PATH.$folder_name.'/manage_'.$page_name.'.php');
}

	add_action('admin_print_scripts', 'gallery_call_scripts');
	add_action('admin_print_styles', 'gallery_call_css');
	
	function gallery_call_scripts() {
		/*wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');*/
		wp_enqueue_script('jquery_tablednd',PLUGIN_URL.'inc/js/jquery.tablednd_0_5.js');
		/*wp_enqueue_script('jquery_lightbox',PLUGIN_URL.'inc/js/lightbox/js/jquery.lightbox-0.5.js');*/
		
	}
	
	function gallery_call_css() {
		wp_enqueue_style('css_lightbox',PLUGIN_URL.'inc/js/lightbox/css/jquery.lightbox-0.5.css');
	}
?>