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

// function to display a Blog Menu on every page via (invoke function from template or code page)

if (!function_exists('display_blog_menu')) {
	
	function display_blog_menu( int $page_id=0, $date_option = 0, $group_header = '<h1>Categories</h1>' , $history_header = '<h1>History</h1>', $display_option = 0) {
		
		if( 0 === $page_id) return "";
		
		$oBlockMenu = block_menu::getInstance();
		
		echo $oBlockMenu->get_blog_menu( $page_id, $date_option, $group_header, $history_header, $display_option);
	}
}
?>