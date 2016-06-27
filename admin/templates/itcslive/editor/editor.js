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
					plugins : "autolink,lists,image,charmap,print,preview,anchor,pagebreak,code,save,textcolor,importcss,searchreplace,insertdatetime,link,fullscreen,table,emoticons,media,hr,directionality,paste,visualchars,visualblocks,nonbreaking,template,print,wordcount,advlist,autosave,contextmenu",

					// Toolbar
					toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect | formatselect fontselect fontsizeselect",
					toolbar2: "searchreplace | bullist numlist | outdent indent | undo redo | link unlink anchor image | code | forecolor,backcolor | fullscreen",
					toolbar3: "table | subscript superscript | charmap emoticons media hr ltr rtl",
					toolbar4: "inserttime cut copy paste | visualchars visualblocks nonbreaking blockquote template | print preview",
					removed_menuitems: "newdocument",

					// URL
					relative_urls : true,
					remove_script_host : false,
					document_base_url : "http://www.itcslive.in/",
					rel_list : [
						{title: 'Alternate', value: 'alternate'},
						{title: 'Author', value: 'author'},
						{title: 'Bookmark', value: 'bookmark'},
						{title: 'Help', value: 'help'},
						{title: 'License', value: 'license'},
						{title: 'Lightbox', value: 'lightbox'},
						{title: 'Next', value: 'next'},
						{title: 'No Follow', value: 'nofollow'},
						{title: 'No Referrer', value: 'noreferrer'},
						{title: 'Prefetch', value: 'prefetch'},
						{title: 'Prev', value: 'prev'},
						{title: 'Search', value: 'search'},
						{title: 'Tag', value: 'tag'}

					],

					//Templates
		/*			templates: [
					{title: 'Layout', description: 'HTMLLayout', url:'http://www.webdesol.com/currrespnew1/english/media/editors/tinymce/templates/layout1.html'},
					{title: 'Simple snippet', description: 'Simple HTML snippet', url:'http://www.webdesol.com/currrespnew1/english/media/editors/tinymce/templates/snippet1.html'}
				],*/
					//content_css : "http://www.webdesol.com/currrespnew1/english/templates/system/css/editor.css",
					importcss_append: true,
					// Advanced Options
					resize: "both",
					image_advtab: true,
					height : "450",
					width : "750",

				});
	});