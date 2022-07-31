<?php

/**
 * Plugin Name: Whatsapp Multi-Contas
 * Plugin URI: https://github.com/webabsoluta
 * Description: Disponibiliza link de Whatsapp para todo o site ou um número específico para página específica. Shortcode:[wmc_whatsapp_multicontas]
 * Version: 1.1.0
 * Author: Bruno Souza
 * Author URI: https://webabsoluta.com.br
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: whatsapp-multi-contas
 * Domain Path: /l10n
**/


// If this file is called directly, abort.
if (!defined("WPINC")){
	die;
}


/**
 * Silent is golden
**/
define("WMC_EXEC",true);


/**
 * Debug
**/
define("WMC_DEBUG",false);


/**
 * Plugin File
**/
define("WMC_FILE",__FILE__);


/**
 * Plugin Path
**/
define("WMC_PATH",dirname(__FILE__));


/**
 * Plugin Base URL
**/
define("WMC_URL",plugins_url("/",__FILE__));


/**
 * The plugin class.
**/
require WMC_PATH . "/incl/setup.php";

/** Metabox and Custom Fields **/
require WMC_PATH . "/incl/meta-boxes.php";

/** Styles **/
require WMC_PATH . "/incl/enqueue-styles.php";
/** plugin options **/
require WMC_PATH . "/incl/plugin-options.php";
/** short-codes **/
require WMC_PATH . "/incl/short-codes.php";

/** REST-API **/
require WMC_PATH . "/incl/rest-api.php";


/**
 * Begins execution of the plugin.
**/
function run_whatsapp_multi_contas()
{
	$plugin = new WhatsappMultiContas();  
}

run_whatsapp_multi_contas();
