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
	function display_blog_menu($page_id,$date_option = 0,$group_header = '<h1>Categories</h1>' ,$history_header = '<h1>History</h1>',$display_option = 0) {
		
		// register outside object
		global $database;

		//get link to the page
		$query = "SELECT link FROM " .TABLE_PREFIX ."pages WHERE page_id=$page_id;";
		$result = $database->query($query);
		if($result->numRows() > 0){
			$link = $result->fetchRow();
            $page_link = $link['link'];
		}
		
		// convert all numeric inputs to integer variables
		$page_id = (int) $page_id;

		if($display_option==0 or $display_option==2){ //show categories

			// query to obtain categories for the selected page
	  		$query = "SELECT * FROM " .TABLE_PREFIX ."mod_news_groups WHERE page_id=$page_id AND active=true;";

			// make database query and obtain active groups and amount of posts per group
			$result = $database->query($query);
			if($result->numRows() > 0){
				if ($group_header != "") {
					echo $group_header;
				}
				$output = "";
				while($group = $result->fetchRow()){
	                $id = $group['group_id'];
					$query_detail = "SELECT * FROM " .TABLE_PREFIX ."mod_news_posts WHERE page_id=$page_id AND active=true AND group_id=$id;";
					$detail_result = $database->query($query_detail);
					$num = $detail_result->numRows();
					$output .=	"<li><a href=\"" .WB_URL.PAGES_DIRECTORY .$page_link .PAGE_EXTENSION ."?g=".$group['group_id']."\">" .$group['title'] ."</a> (".$num.")</li>\n";
	      		}
			}
			$output = "<ul class='blog_menu'>".$output."</ul>";
	        echo $output;
		}
		if($display_option==0 or $display_option==1){ //show history

	        //determine sorting method
	        switch($date_option){
	            case 0:
	                $date = "posted_when";
	                break;
	            case 1:
	                $date = "published_when";
	                break;
	        }

	        $output ="";
	        //query to obtain history per month for the selected page
	        $query = "SELECT MONTHNAME(FROM_UNIXTIME(".$date.")) as mo,MONTH(FROM_UNIXTIME(".$date.")) as m,FROM_UNIXTIME(".$date.",'%Y') as y,COUNT(*) as total FROM " .TABLE_PREFIX ."mod_news_posts WHERE page_id=$page_id AND active=true GROUP BY y,m ORDER BY y DESC,m DESC;";
	        $result = $database->query($query);
			if($result->numRows() > 0){
				if ($history_header != "") {
					echo $history_header;
				}
				while($history = $result->fetchRow()){
	                $output .= "<li><a href=\"" .WB_URL.PAGES_DIRECTORY .$page_link .PAGE_EXTENSION ."?y=".$history['y']."&m=".$history['m']."&method=".$date_option."\">" .$history['mo']." ".$history['y']."</a> (".$history['total'].")</li>\n";
	            	}
	        	}
			$output = "<ul class='blog_menu'>".$output."</ul>";
	        echo $output;
		}

	}
}
?>