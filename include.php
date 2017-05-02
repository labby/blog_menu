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
		if( 0 === $page_id) return false;
		
		$database = LEPTON_database::getInstance();
		
		//	get link to the page
		$page_link = $database->get_one( "SELECT `link` FROM `" .TABLE_PREFIX ."pages` WHERE `page_id`=".$page_id );

		if($display_option==0 or $display_option==2){ //show categories

			// make database query and obtain active groups and amount of posts per group
			$result = array();
			$database->execute_query( 
				"SELECT * FROM `" .TABLE_PREFIX ."mod_news_groups` WHERE `page_id`=".$page_id." AND `active`=true;",
				true,
				$result,
				true
			);
			$output = "";
			if( count($result) > 0) {
				if ($group_header != "") {
					echo $group_header;
				}
				
	            foreach( $result as $group ) { 
	                $id = $group['group_id'];
										
					$num = $database->get_one( "SELECT COUNT(`post_id`) FROM `".TABLE_PREFIX ."mod_news_posts` WHERE `page_id`=".$page_id." AND `active`=true AND `group_id`=".$id);
						
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
	        $result = array();
	        $database->execute_query( $query, true, $result, true);

			if( count($result) > 0) {
				if ($history_header != "") {
					echo $history_header;
				}
				
				foreach($result as $history) {
	                $output .= "<li><a href=\"" .WB_URL.PAGES_DIRECTORY .$page_link .PAGE_EXTENSION ."?y=".$history['y']."&m=".$history['m']."&method=".$date_option."\">" .$history['mo']." ".$history['y']."</a> (".$history['total'].")</li>\n";
	            }
	        }

			$output = "<ul class='blog_menu'>".$output."</ul>";
	        echo $output;
		}

	}
}
?>