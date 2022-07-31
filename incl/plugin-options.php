<?php

/**
 * @author Bruno Souza
 * @package WmcMetaBoxes
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

/**
 * WmcPluginOptions
**/
class WmcPluginOptions{

	/**
	 * WmcPluginOptions:wmc_whatsapp_filiais_setting()
	**/
	private $wmc_whatsapp_filiais_setting = array();



	/**
	 * WmcPluginOptions:__construct()
	**/
	function __construct()
	{
		if(is_admin()){
			// whatsapp-filiais
			$this->wmc_whatsapp_filiais_setting = get_option("wmc_whatsapp_filiais_setting");
			add_action("admin_menu",array($this,"wmcAddWhatsappFiliaisPageOption"));
			add_action("admin_init",array($this,"wmcAddWhatsappFiliaisPageInit"));
			add_action("admin_footer",array($this,"wmcWhatsappFiliaisAdminFooter"));
			add_action("admin_enqueue_scripts",array($this,"wmcWhatsappFiliaisAdminEnqueueScripts"));
			
		}
	}




	// TODO: WHATSAPP-FILIAIS--------------------------------------------------------------------------


	/**
	 * WmcPluginOptions:wmcAddWhatsappFiliaisPageOption()
	 * @ref: https://developer.wordpress.org/reference/functions/add_menu_page/
	**/
	function wmcAddWhatsappFiliaisPageOption()
	{
		add_menu_page(
			__("Whatsapp Muticontas","whatsapp-multi-contas"), //$page_title
			__("Whatsapp Muticontas","whatsapp-multi-contas"), //$menu_title
			"manage_options", //$capability
			"wmc_whatsapp_filiais",//$menu_slug
			array($this,"wmcWhatsappFiliaisPageContent")//$function
		);
	}


	/**
	 * WmcPluginOptions:wmcWhatsappFiliaisPageContent()
	**/
	function wmcWhatsappFiliaisPageContent()
	{
		$this->wmc_whatsapp_filiais_setting = get_option("wmc_whatsapp_filiais_setting");
		?>
		<div class="wrap">
			<h1><?php _e("Whatsapp Muticontas","whatsapp-multi-contas") ?></h1>
			<div class="wmc-box">
				<div class="inside">
					<form method="post" action="options.php">
						<?php settings_fields("wmc_whatsapp_filiais_group"); ?>
						<?php do_settings_sections("wmc-whatsapp-filiais"); ?>
						<?php submit_button(); ?>
					</form>
				</div>
			</div>
		</div>
		<?php
	}


	/**
	 * WmcPluginOptions:wmcAddWhatsappFiliaisPageInit()
	**/
	function wmcAddWhatsappFiliaisPageInit()
	{
		
		
		register_setting(
			"wmc_whatsapp_filiais_group",// group
			"wmc_whatsapp_filiais_setting", //setting name
			array($this,"wmcAddWhatsappFiliaisSanitize") //sanitize_callback
		);
		
		
		add_settings_section(
			"wmc_whatsapp_filiais_section", //id
			__("Configuração:","whatsapp-multi-contas"), //title
			array($this,"wmcAddWhatsappFiliaisInfo"), //callback
			"wmc-whatsapp-filiais" //page
		);
		
		// primary-whatsapp
		add_settings_field(
			"wmc_primary_whatsapp", //id
			__("Whatsapp Principal","whatsapp-multi-contas"), //title
			array($this,"wmcPrimaryWhatsappCallback"), //callback
			"wmc-whatsapp-filiais", //page
			"wmc_whatsapp_filiais_section" //section
		);
		
		// texto-whatsapp
		add_settings_field(
			"wmc_texto_whatsapp", //id
			__("Texto da Mensagem","whatsapp-multi-contas"), //title
			array($this,"wmcTextoWhatsappCallback"), //callback
			"wmc-whatsapp-filiais", //page
			"wmc_whatsapp_filiais_section" //section
		);
	}


	/**
	 * WmcPluginOptions:wmcAddWhatsappFiliaisSanitize()
	**/
	function wmcAddWhatsappFiliaisSanitize($input)
	{
		$new_input = array();
		
		
		// primary-whatsapp
		if(isset($input["wmc_primary_whatsapp"]))
			$new_input["wmc_primary_whatsapp"] = sanitize_text_field($input["wmc_primary_whatsapp"]);
		
		
		
		// texto-whatsapp
		if(isset($input["wmc_texto_whatsapp"]))
			$new_input["wmc_texto_whatsapp"] = sanitize_text_field($input["wmc_texto_whatsapp"]);
		
		return $new_input;
	}


	/**
	 * WmcPluginOptions:wmcAddWhatsappFiliaisInfo()
	**/
	function wmcAddWhatsappFiliaisInfo()
	{
		_e("Informe o número que será exibido em todas as páginas que não possuem seu próprio número específico.","whatsapp-multi-contas");
	}
	
	
	/**
	 * WmcPluginOptions:wmcPrimaryWhatsappCallback()
	**/
	function wmcPrimaryWhatsappCallback(){
	
		if(isset($this->wmc_whatsapp_filiais_setting["wmc_primary_whatsapp"])){
			$value = esc_attr($this->wmc_whatsapp_filiais_setting["wmc_primary_whatsapp"]);
		}else{
			$value = "";
		}
		?>
		<input class="regular-text" id="wmc-primary-whatsapp" type="tel" name="wmc_whatsapp_filiais_setting[wmc_primary_whatsapp]" placeholder="5522912345678" value="<?php echo $value; ?>" />
		<p class="description"><?php _e("Número principal a ser exibido quando o campo Whatsapp da Página estiver vazio","whatsapp-multi-contas") ?></p>
		<?php
	}
	
	
	/**
	 * WmcPluginOptions:wmcTextoWhatsappCallback()
	**/
	function wmcTextoWhatsappCallback(){
	
		if(isset($this->wmc_whatsapp_filiais_setting["wmc_texto_whatsapp"])){
			$value = esc_attr($this->wmc_whatsapp_filiais_setting["wmc_texto_whatsapp"]);
		}else{
			$value = "";
		}
		?>
		<input class="regular-text" id="wmc-texto-whatsapp" type="text" name="wmc_whatsapp_filiais_setting[wmc_texto_whatsapp]" placeholder="Escreva o texto" value="<?php echo $value; ?>" />
		<p class="description"><?php _e("Escreva o texto padrão que aparecerá na mensagem enviada pelo visitante.","whatsapp-multi-contas") ?></p>
		<?php
	}
	
	
	
	
	/**
	 * WmcPluginOptions:wmcWhatsappFiliaisAdminFooter($hook)
	**/
	function wmcWhatsappFiliaisAdminFooter()
	{
		$screen = get_current_screen();
		if($screen->id == "settings_page_wmc_whatsapp_filiais")
		{
			//primary-whatsapp
			
			//texto-whatsapp
			
		}
	}
	
	
	/**
	 * WmcPluginOptions:wmcWhatsappFiliaisAdminEnqueueScripts($hook)
	**/
	function wmcWhatsappFiliaisAdminEnqueueScripts($hook)
	{
		$screen = get_current_screen();
		if($screen->id == "settings_page_wmc_whatsapp_filiais")
		{
			//primary-whatsapp
			
			//texto-whatsapp
			
		}
	}
	
	
}
