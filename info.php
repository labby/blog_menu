<?php

/**
 *  @module         Blog Menu
 *  @version        see info.php of this module
 *  @author         Erik Coenjaerts
 *  @copyright      2006-2017 Erik Coenjaerts
 *  @license        GNU General Public License
 *  @license terms  see info.php of this module
 *  @platform       see info.php of this module
 * 
 */
 
// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH')) {	
	include(LEPTON_PATH.'/framework/class.secure.php'); 
} else {
	$oneback = "../";
	$root = $oneback;
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= $oneback;
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) { 
		include($root.'/framework/class.secure.php'); 
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}
// end include class.secure.php

$module_directory	= 'blog_menu';
$module_name		= 'Blog Menu';
$module_function	= 'snippet';
$module_version		= '0.22';
$module_platform	= '1.x';
$module_author		= 'Erik Coenjaerts';
$module_license		= 'GNU General Public License';
$module_description	= 'Snippet to display a blog-menu containing active groups and history per month of the news module. Call it by using function: display_blog_menu($page_id,$date_option,$group_header,$history_header,$display_option). For more information, see the included howto.txt';
$module_home		= 'http://cms-lab.com/';
$module_guid		= '07ffa8db-4dc2-42d5-841d-e6d83a869de7';
?>