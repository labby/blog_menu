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

if(!function_exists("display_blog_menu")) require_once dirname(__DIR__)."/include.php";

class blog_menu
{
	
	public $page_id	= 0;
	public $date_option = 0;
	public $group_header = '<h1>Categories</h1>';
	public $history_header = '<h1>History</h1>';
	public $display_option = 0;
	
	/**
	 *	The reference to *Singleton* instance of this class
	 *
	 *	@var	object
	 *	@access	private
	 *
	 */
	private static $instance;
	
	/**
	 *	Return the »internal« instance of this class
	 *
	 */
	static public function getInstance()
	{
		if (null === static::$instance) {
			static::$instance = new static();
		}
		return static::$instance;
	}
	
	public function get_blog_menu( int $page_id = -1 )
	{
		if( -1 === $page_id) $page_id = $this->page_id;
		
		ob_start();
		
		display_blog_menu(
			$page_id,
			$this->date_option,
			$this->group_header,
			$this->history_header,
			$this->display_option
		);
		
		return ob_get_clean();
	}
}