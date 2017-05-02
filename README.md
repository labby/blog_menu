### Blog Menu
============

Blog Menu ( coded by Erik Coenjaerts (Eki) ) is a snippet to display a blog-menu containing active groups and history per month of the [LEPTON CMS][1] news module.<br /><br />
Call it by using function: display_blog_menu($page_id,$date_option,$group_header,$history_header,$display_option). <br />
For more information, see the included README


#### Requirements

* [LEPTON CMS][1]

#### Installation

* download latest [blog_menu.zip][2] installation archive
* in CMS backend select the file from "Add-ons" -> "Modules" -> "Install module"

#### License

The snippet is licensed under GNU

#### Notice

Not tested if it runs with latest release of LEPTON news module (view.php)

[1]: http://lepton-cms.org "LEPTON CMS"
[2]: http://www.lepton-cms.com/lepador/modules/blog_menu.php





*****************************************************************************************
 USING THE SNIPPET FUNCTION:
*****************************************************************************************
Once the module is installed, it can be invoked either from the index.php file of your template or from any code module section.

From template index.php:
<?php display_blog_menu(8); ?>

From a code module:
display_blog_menu(8);

*****************************************************************************************
 ADDITIONAL PARAMETERS
*****************************************************************************************
For a more customised output, you can pass over serveral parameters to the function explained below.

display_blog_menu($page_id,$date_option,$group_header,$history_header)

Optional Parameters:
  page_id... 		the page_id of the news page you want to generate the Blog Menu from
  date_option... 	0:=count articles according the posted date (default); 1:= count articles according the published date
  group_header... 	header above the group menu (default: '<h1>Categories</h1>')
  history_header... 	header above the history menu (default: '<h1>History</h1>')
  display_option...     0:=show both history and categories (default); 1:=show only history; 2:=show only categories

Example for customised call:
<?php display_blog_menu(15,1,'<h2>categories</h2>','<h2>history</h2>',2);?>

*****************************************************************************************
 TROUBLE SHOOTING
*****************************************************************************************
 - pass over at least the first argument ($page_id)
 - mask text with "your text " or 'your text '
 - within your template index.php file use: <?php display_blog_menu(); ?>
 - within a code module use: display_blog_menu();
 - remind the ; at the end of the code line

