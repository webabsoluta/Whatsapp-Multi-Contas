<?php

/**
 * @author Bruno Souza
 * @package WmcRestApi
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

class WmcRestApi{


	/**
	 * WmcRestApi:__construct()
	**/
	function __construct()
	{
		// posts
		add_action("rest_api_init", array($this, "postRestApi"));
		add_action("rest_api_init", array($this, "pageRestApi"));
		// taxonomies
		add_action("rest_api_init", array($this, "categoryRestApi"));
		add_action("rest_api_init", array($this, "postTagRestApi"));
	}
	/**
	 * WmcRestApi:postRestApi()
	 * ref: https://developer.wordpress.org/reference/functions/register_rest_field/
	**/
	function postRestApi(){
	}
	
	/**
	 * WmcRestApi:pageRestApi()
	 * ref: https://developer.wordpress.org/reference/functions/register_rest_field/
	**/
	function pageRestApi(){
		register_rest_field("page", "wmc_page_whatsapp_num", array(
				"get_callback"	=> array($this,"pagePageWhatsappNum"),
				"schema"		=> null,
			)
		);
	}
	
	/**
	 * WmcRestApi:pagePageWhatsappNum()
	**/
	function pagePageWhatsappNum($object){
		$id = $object["id"];
		$data = get_post_meta($id,"_wmc_page_whatsapp_num",true);
		return $data;
	}
	
	/**
	 * WmcRestApi:categoryRestApi()
	 * ref: https://developer.wordpress.org/reference/functions/register_rest_field/
	**/
	function categoryRestApi(){
	}
	
	/**
	 * WmcRestApi:postTagRestApi()
	 * ref: https://developer.wordpress.org/reference/functions/register_rest_field/
	**/
	function postTagRestApi(){
	}
	
	
	
}
