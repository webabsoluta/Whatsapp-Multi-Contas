<?php

/**
 * @author Bruno Souza
 * @package WhatsappMultiContas
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

/**
 * WhatsappMultiContas
**/
class WhatsappMultiContas{
	
	/**
	 * WhatsappMultiContas:__construct()
	**/
	function __construct()
	{
		$enqueueStyles = new WmcEnqueueStyles();  
		$metaBoxes = new WmcMetaBoxes();  
		$plugin_options = new WmcPluginOptions();  
		$plugin_options = new WmcShortCodes();  
		$rest_api  = new WmcRestApi();  
		
	}
	
	
}

