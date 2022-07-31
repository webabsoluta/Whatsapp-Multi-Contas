<?php

/**
 * @author Bruno Souza
 * @package WmcShortCodes
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

/**
 * WmcShortCodes
**/
class WmcShortCodes{


	/**
	 * WmcShortCodes:__construct()
	**/
	function __construct()
	{
		// wmc_whatsapp_multicontas
		add_action("init",array($this,"wmcWhatsappMulticontas"));
		add_action("init",array($this,"wmcWhatsappMulticontasTinymce"));
		
	}
	
	
	// TODO: LAYOUT FOR `WHATSAPP-MULTICONTAS`
	/**
	 * WmcShortCodes:wmcWhatsappMulticontas()
	**/
	function wmcWhatsappMulticontas(){
		add_shortcode("wmc_whatsapp_multicontas", array($this, "wmcWhatsappMulticontasShortcode"));
	}
	
	
	/**
	 * WmcShortCodes:wmcWhatsappMulticontasShortcode($atts, $content, $tag)
	**/
	function wmcWhatsappMulticontasShortcode($atts, $content, $tag){
			// shortcode option/attributes
		$atts = shortcode_atts(
			array(
			), $atts, $tag);
		
		
		// CUSTOM-CODE
			// Carregar Num da Página
			$whatsapp_page = get_post_meta(get_the_ID(), "_wmc_page_whatsapp_num", true);
			// Carrega Options do Plugin
			$options = get_option("wmc_whatsapp_filiais_setting");
			if($whatsapp_page == ''){
				$content = 'https://api.whatsapp.com/send?phone='.$options["wmc_primary_whatsapp"].'&text='.$options["wmc_texto_whatsapp"];
			}else{
				$content = 'https://api.whatsapp.com/send?phone='.$whatsapp_page.'&text='.$options["wmc_texto_whatsapp"];
			}		
		
		
		return $content;
	}
	
	
	/**
	 * WmcShortCodes:wmcWhatsappMulticontasTinymce()
	**/
	function wmcWhatsappMulticontasTinymce(){
		add_filter("mce_external_plugins", array($this, "wmcWhatsappMulticontasTinymcePlugin"));
		add_action("admin_enqueue_scripts",array($this,"wmcWhatsappMulticontasTinymceStyle"));
		add_filter("mce_buttons", array($this, "wmcWhatsappMulticontasAddTinymceButton"));
	}
	
	
	/**
	 * WmcShortCodes:wmcWhatsappMulticontasTinymcePlugin($plugin_array)
	**/
	function wmcWhatsappMulticontasTinymcePlugin($plugin_array){
		$plugin_array["wmc_whatsapp_multicontas"] = WMC_URL . "/assets/tinymce-plugins/wmc_whatsapp_multicontas/wmc_whatsapp_multicontas.js";
		return $plugin_array;
	}
	
	
	/**
	 * WmcShortCodes:wmcWhatsappMulticontasTinymceStyle($hooks)
	**/
	function wmcWhatsappMulticontasTinymceStyle($buttons){
		wp_register_style("wmc_whatsapp_multicontas_style", WMC_URL . "/assets/tinymce-plugins/wmc_whatsapp_multicontas/wmc_whatsapp_multicontas.css",array(),"1.1.0" );
		wp_enqueue_style("wmc_whatsapp_multicontas_style");
	}
	
	
	/**
	 * WmcShortCodes:wmcWhatsappMulticontasAddTinymceButton($buttons)
	**/
	function wmcWhatsappMulticontasAddTinymceButton($buttons){
		array_push($buttons, "wmc_whatsapp_multicontas"); 
		return $buttons;
	}
	
	
}
