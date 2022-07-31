<?php

/**
 * @author Bruno Souza
 * @package WmcMetaBoxes
 * @license GNU General Public License v2 or later
**/


defined("WMC_EXEC") or die("Silent is golden");

/**
 * WmcMetaBoxes
**/
class WmcMetaBoxes{


	/**
	 * WmcMetaBoxes:__construct()
	**/
	function __construct()
	{
		// whatsapp-page
		add_action("add_meta_boxes",array($this,"wmcWhatsappPageMetabox"));
		add_action("save_post",array($this,"wmcWhatsappPageSavePost"));
		add_action("admin_footer",array($this,"wmcWhatsappPageAdminFooter"));
		add_action("admin_enqueue_scripts",array($this,"wmcWhatsappPageAdminEnqueueScripts"));
		
	}
	
	
	
	// TODO: ================== WHATSAPP-PAGE ==================
	
	/**
	 * Adds whatsapp-page meta-box container
	 * WmcMetaBoxes:wmcWhatsappPageMetabox($hook)
	 * ref: https://developer.wordpress.org/reference/functions/add_meta_box/
	**/
	function wmcWhatsappPageMetabox($hook){
		$allowed_hook = array("page"); //limit meta box to certain page
		if(in_array($hook, $allowed_hook))
		{
			add_meta_box("wmc-whatsapp-page",__("Whatsapp da Página", "whatsapp-multi-contas"),array($this,"wmcWhatsappPageCallback"),$hook,"side","default");
		}
	}
	
	
	/**
	 * Render whatsapp-page meta-box content
	 * WmcMetaBoxes:wmcWhatsappPageCallback($post)
	 * @param WP_Post $post The post object
	**/
	function wmcWhatsappPageCallback($post){
		wp_nonce_field("wmc_whatsapp_page", "wmc_whatsapp_page_nonce");
		
		?>
		<table class="form-table">
		<?php
		// page-whatsapp-num
		$current_data = get_post_meta($post->ID, "_wmc_page_whatsapp_num", true);
		if($current_data == ""){
			$current_data = "";
		}
		?>
		<tr>
			<th scope="row">
				<label for="wmc-page-whatsapp-num"><?php _e("Número Whatsapp da Página", "whatsapp-multi-contas"); ?></label>
			</th>
			<td>
			<input class="regular-text wmc-form-control" type="tel" id="wmc-page-whatsapp-num" name="wmc-page-whatsapp-num" value="<?php echo esc_attr($current_data); ?>" placeholder="5522912345678" />
			<p class="description"><?php _e("Informe o Número do Whatsapp desta página. Sem "+"", "whatsapp-multi-contas"); ?></p>
			</td>
		</tr>
		<?php
		?>
		</table>
		<?php
		
	
	}
	
	
	/**
	 * WmcMetaBoxes:wmcWhatsappPageSavePost($post_id)
	 * @param int $post_id The ID of the post being saved
	**/
	function wmcWhatsappPageSavePost($post_id){
		
		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST["wmc_whatsapp_page_nonce"] ) ? $_POST["wmc_whatsapp_page_nonce"] : "";
		$nonce_action = "wmc_whatsapp_page";
		
		// Check if nonce is valid
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return ;
		}
		
		// Check if nonce is valid
		if (!current_user_can("edit_post", $post_id)){
			return ;
		}
		
		// page-whatsapp-num
		$data = sanitize_text_field($_POST["wmc-page-whatsapp-num"]);
		update_post_meta($post_id, "_wmc_page_whatsapp_num", $data);
	
	
	}
	
	
	/**
	 * WmcMetaBoxes:wmcWhatsappPageAdminFooter()
	**/
	function wmcWhatsappPageAdminFooter(){
		$screen = get_current_screen();
		$allowed_hook = array("page"); //limit meta box to certain page
		if(in_array($screen->id, $allowed_hook))
		{
		// page-whatsapp-num
	
		}
	}
	
	
	/**
	 * WmcMetaBoxes:wmcWhatsappPageAdminEnqueueScripts($hook)
	**/
	function wmcWhatsappPageAdminEnqueueScripts($hook){
		$screen = get_current_screen();
		$allowed_hook = array("page"); //limit meta box to certain page
		if(in_array($screen->id, $allowed_hook))
		{
		
		// page-whatsapp-num
		
		?>
		<style type="text/css">
			#postbox-container-1 #wmc-whatsapp-page th,
			#postbox-container-1 #wmc-whatsapp-page td
			{
				display: block;
				padding: 0px;
			}
			#postbox-container-1 #wmc-whatsapp-page .wmc-form-control,
			#postbox-container-1 #wmc-whatsapp-page input
			{
				width: 100% !important;
			}
		</style>
		<?php
		
		}
	}
	
	
	
	
}
