///////// Editor Section //////////////////////
$(document).ready(function() {
			tinyMCE.init({
					// General
					directionality: "ltr",
					language : "en",
					mode : "specific_textareas",
					autosave_restore_when_empty: false,
					skin : "lightgray",
					theme : "modern",
					schema: "html5",
					selector: "#editor",

					// Cleanup/Output
					inline_styles : true,
					gecko_spellcheck : true,
					entity_encoding : "raw",
					extended_valid_elements : "hr[id|title|alt|class|width|size|noshade]",
					force_br_newlines : false, force_p_newlines : true, forced_root_block : 'p',
					toolbar_items_size: "small",
					invalid_elements : "script,applet,iframe",

					// Plugins
					//plugins : "autolink,lists,image,charmap,print,preview,anchor,pagebreak,code,save,textcolor,importcss,searchreplace,insertdatetime,link,fullscreen,table,emoticons,media,hr,directionality,paste,visualchars,visualblocks,nonbreaking,template,print,wordcount,advlist,autosave,contextmenu",
                    plugins : '',

					// URL
					relative_urls : true,
					remove_script_host : false,
					document_base_url : "http://www.itcslive.in/",
					resize: "height",
					image_advtab: true,
					height : "200",
					width : "100%",

				});
	});