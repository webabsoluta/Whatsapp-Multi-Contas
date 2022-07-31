<?php

/**
 * @author Bruno Souza
 * @package WmcEnqueueStyles
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

/**
 * WmcEnqueueStyles
**/
class WmcEnqueueStyles{


	/**
	 * WmcEnqueueStyles:__construct()
	**/
	function __construct()
	{
	
		// front-end
		add_action("wp_enqueue_scripts", array($this, "wmcLoadStyles"));
	
	}
	
	
	/**
	 * WmcEnqueueStyles:wmcLoadStyles
	 * ref: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	**/
	function wmcLoadStyles()
	{
		wp_enqueue_style("wmc_default", WMC_URL . "assets/css/default.css", array(),"1.1.0","all" );
	}
	
	
}
