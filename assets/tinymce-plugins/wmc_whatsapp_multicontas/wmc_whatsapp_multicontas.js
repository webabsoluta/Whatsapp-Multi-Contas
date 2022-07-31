(function(){
	tinymce.create("tinymce.plugins.wmc_whatsapp_multicontas", {
		init: function(editor, url) {
			editor.addButton("wmc_whatsapp_multicontas", {
				title: "Whatsapp Multi Contas",
				icon: "icon wmc_whatsapp_multicontas wmc-mce-icon dashicons-admin-links",
				onclick: function(){
					editor.windowManager.open({
						title: "Whatsapp Multi Contas",
						bodyType: "tabpanel",
						body: [
							{
								title: "General",
								type: "form",
								items:[
								
		
		
								
								]
							},
							{
								title: "About",
								type: "form",
								items:[
									{type: "panel",html:"<h4 style='font-size:24px;font-weight:600;'>Whatsapp Multi Contas v.1.1.0</h4><br/><p style='font-size:12px;'>Created by <a style='font-size:12px;cursor:pointer;font-weight:600;' href='https://webabsoluta.com.br'>Bruno Souza</a></p><p style='font-size:12px;cursor:pointer;font-weight:600;'>Powered by <a style='cursor:pointer;font-weight:600;' href='https://codecanyon.net/item/iwp-devtoolz/13581496'>iWP-DevToolz</a></p>"},
								]
							}
						],
						onsubmit: function(e){
							var shortcode = "";
							shortcode += "[wmc_whatsapp_multicontas ";
							shortcode += "]";
							shortcode += "[/wmc_whatsapp_multicontas]";
							editor.insertContent(shortcode);
						}
					});
				}
			});
		},
		createControl: function(n, cm) {
			return null;
		},
		getInfo: function() {
			return {
				longname: "wmc - Whatsapp Multi Contas",
				author: "Bruno Souza",
				authorurl: "https://webabsoluta.com.br",
				infourl: "https://github.com/webabsoluta",
				version: "1.1.0"
			};
		}
	});
	tinymce.PluginManager.add("wmc_whatsapp_multicontas", tinymce.plugins.wmc_whatsapp_multicontas);
})();
