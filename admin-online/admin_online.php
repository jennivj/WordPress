<?php
/**
 * @package Admin Online
 * @version 1.0
 */
/*
Plugin Name: Admin Online
Plugin URI: http://www.techwyse.com
Description: Admin Online
Author: Techwyse
Version: 1.0
Author URI: http://www.techwyse.com
*/
ob_start();
global $curr_page, $hidAction, $option, $wpdb;

define("PLUGIN_PATH",ABSPATH.'wp-content/plugins/adminonline/');
define("PLUGIN_URL",get_option('siteurl').'/wp-content/plugins/adminonline/');
define("UPLOAD_PATH",ABSPATH.'wp-content/uploads/');
define("UPLOAD_URL",get_option('siteurl').'/wp-content/uploads/');

$wpdb->show_errors();
//include('widget.php');
$curr_page = $_REQUEST["page"];
$hidAction = $_POST["hidAction"];
$option = $_REQUEST["option"];

	include('MasterWidget.php');
	if(!is_admin()) {
		wp_enqueue_script('jquery_1_3_2',PLUGIN_URL.'inc/js/jquery-1.3.2.js');
		
	}

add_action('admin_menu', 'admin_add_pages');
function admin_add_pages(){
	add_menu_page('Site Menus','Site Menus','manage_options', 'site_menu', 'site_menu');
 	add_submenu_page(site_menu,'',' ','manage_options', 'site_menu', 'site_menu');

 	/*if (file_exists(PLUGIN_PATH.'faqcategory/menu_option.php')) 
	{
		add_submenu_page('site_menu','FAQ Category','FAQ Category','manage_options', 'faqcategory', 'faqcategory');
		if($_REQUEST['page']=="faqcategory")
			include(PLUGIN_PATH.'faqcategory/menu_option.php');
	}*/
	if (file_exists(PLUGIN_PATH.'faq/menu_option.php')) 
	{
		add_submenu_page('site_menu','FAQ','FAQ','manage_options', 'faq', 'faq');
		if($_REQUEST['page']=="faq")
			include(PLUGIN_PATH.'faq/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'reviews/menu_option.php')) 
	{
		add_submenu_page('site_menu','Reviews','Reviews','manage_options', 'reviews', 'reviews');
		if($_REQUEST['page']=="reviews")
			include(PLUGIN_PATH.'reviews/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'category/menu_option.php')) 
	{
		add_submenu_page('site_menu','Category','Category','manage_options', 'category', 'category');
		if($_REQUEST['page']=="category")
			include(PLUGIN_PATH.'category/menu_option.php');
	}
	



	
	if (file_exists(PLUGIN_PATH.'products/menu_option.php')) {
		add_submenu_page('site_menu','Products','Products','manage_options', 'products', 'products');
		if ($_REQUEST['page']=='products') 
			include(PLUGIN_PATH.'products/menu_option.php');
	}
	
		if (file_exists(PLUGIN_PATH.'career/menu_option.php')) 
	{
		add_submenu_page('site_menu','Career','Career','manage_options', 'career', 'career');
		if($_REQUEST['page']=="career")
			include(PLUGIN_PATH.'career/menu_option.php');
	}

	/*if (file_exists(PLUGIN_PATH.'brands/menu_option.php')) 
	{
		add_submenu_page('site_menu','Brands','Brands','manage_options', 'brands', 'brands');
		if($_REQUEST['page']=="brands")
			include(PLUGIN_PATH.'brands/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'product/menu_option.php')) 
	{
		add_submenu_page('site_menu','Product','Product','manage_options', 'product', 'product');
		if($_REQUEST['page']=="product")
			include(PLUGIN_PATH.'product/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'specialofferbanner/menu_option.php')) 
	{
		add_submenu_page('site_menu','Special Offer Banner','Special Offer Banner','manage_options', 'specialofferbanner', 'specialofferbanner');
		if($_REQUEST['page']=="specialofferbanner")
			include(PLUGIN_PATH.'specialofferbanner/menu_option.php');
	}
 	if (file_exists(PLUGIN_PATH.'gallerycategory/menu_option.php')) 
	{
		add_submenu_page('site_menu','Gallery Category','Gallery Category','manage_options', 'gallerycategory', 'gallerycategory');
		if($_REQUEST['page']=="gallerycategory")
			include(PLUGIN_PATH.'gallerycategory/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'gallery/menu_option.php')) {
		add_submenu_page('site_menu','Gallery','Gallery','manage_options', 'gallery', 'gallery');
		if ($_REQUEST['page']=='gallery') 
			include(PLUGIN_PATH.'gallery/menu_option.php');
	}
	if (file_exists(PLUGIN_PATH.'categorybrands/menu_option.php')) {
		add_submenu_page('site_menu','Category/Brands','Category/Brands','manage_options', 'categorybrands', 'categorybrands');
		if ($_REQUEST['page']=='categorybrands') 
			include(PLUGIN_PATH.'categorybrands/menu_option.php');
	}*/
}
function site_menu(){
	
	echo "<center style='color:#00000; padding-top:120px; font-size:30px;'><b>Welcome to the Site Menu Section</b></center>";
}
?> 