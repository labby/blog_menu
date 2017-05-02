<?php
/*
 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 -----------------------------------------------------------------------------------------
  Code snippet BlogMenu for Website Baker v2.6.x
  Licencsed under GNU, written by Erik Coenjaerts (Eki)
 -----------------------------------------------------------------------------------------
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
			$output = "<ul>".$output."</ul>";
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
			$output = "<ul>".$output."</ul>";
	        echo $output;
		}

	}
}
?>