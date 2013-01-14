/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {

	tinymce.create('tinymce.plugins.ShortcodesPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addButton('BS-layouts', {
				title : 'Layouts Shortcode',
				image : url+'/images/layout-shortcodes.png', 
				onclick : function() {
					ed.windowManager.open({
						file : url + '/pages/shortcodes_popup.php?section=layouts',
						width : 540,
						height : 350,
                              title: 'Layouts Selection',
						inline : 1	
					});
				}
			});

			ed.addButton('BS-readmore', {
				title : 'Read more shortcode',
				image : url+'/images/readmore-shortcodes.png', 
				onclick : function() {
					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '<!--more-->');
				}
			});

			/*ed.addButton('BS-Sstyling', {
				title : 'Quick Styling',
				image : url+'/images/styling-shortcodes.png', 
				onclick : function() {
					ed.windowManager.open({
						file : url + '/pages/rt_shortcodes_popup.php?section=styling',
						width : 640,
						height : 350,
                              title: 'Quick Styling',
						inline : 1
					});
				}
			});*/

			// ed.addButton('BS-Sbuttons', {
			// 	title : 'Buttons Shortcode',
			// 	image : url+'/images/button-shortcodes.png', 				
			// 	onclick : function() {
			// 		ed.windowManager.open({
			// 			file : url + '/pages/shortcodes_popup.php?section=buttons',
			// 			width : 570,
			// 			height : 500,
   //                            title: 'Buttons',
			// 			inline : 1
			// 		});
			// 	}
			// });

			/*ed.addButton('BS-Scontactform', {
				title : 'RT-Theme Contact Form Shortcode ',
				image : url+'/images/mail-open.png',
				onclick : function() {
					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[contact_form title=\"Form Title\" email=\"youremail@yoursite.com\" text=\"Form description\"] ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');
					
						jQuery(".helpshortcode").remove();
						jQuery("#poststuff").prepend('<div class="helpshortcode alert-box secondary"></div>');

						jQuery(".helpshortcode").hide(function() {
							jQuery(".helpshortcode").html('<div class="updated"><div class="rt-message">X</div>'
											+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
											+ '	<hr class="rt-message-hr" /> Please Note: You can also use this shortcode with a text widget in sidebars.'
											+ '	<h4>Parameters of this shortcode</h4> '
											+ '	<p>	'
											+ '<b>title:</b> Form title<br />	'
											+ '<b>email:</b> Write an email which you want to send the form<br />	'
											+ '<b>text:</b> The text before the form<br />	'											
											+ '	</p></div>');						
						});
						jQuery(".helpshortcode").fadeIn('slow');
				
				}
				
			});*/

			ed.addButton('BS-Sslider', {
				title : 'Slider Shortcode',
				image : url+'/images/slider-shortcodes.png',
				onclick : function() {
					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[slider]<br />[slide image_width=\"650\" image_height=\"300\" link=\"your_link\" alt_text="check it out" title="your_title"] full url of your image [/slide] <br />[slide image_width=\"650\" image_height=\"300\" link="your_link\" alt_text="check it out" title="your_title" auto_resize="true"] full url of your image [/slide] <br />[/slider] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');

							jQuery("#help").hide();
							jQuery(".helpshortcode").remove();
							jQuery("#help").html('<div class="helpshortcode alert-box secondary">'
									+ '<h5><i class="foundicon-idea"></i>How to use: <i>Slider Shortcode</i></h5>'
									+ '<p>ou can enter unlimited [slide ]..[/slide] line to add new items to your gallery.<p>'
									+ '	<p>'
									+ '<b>image_width:</b> Image width<br />'
									+ '<b>image_height:</b> Image height<br />	'
									+ '<b>link:</b> Write the link for the slide or leave blank.<br />	'
									+ '<b>alt_text:</b> The text for the "alt" tag.<br />'
									+ '<b>title:</b> your title<br />'
									+ '</p>'
									+ '<code>[slider]<br />[slide image_width="650" image_height="300" link="your_link" alt_text="check it out" title="your_title"] full url of your image [/slide] <br />[slide image_width=\"650\" image_height=\"300\" link="your_link\" alt_text="check it out" title="your_title" auto_resize="true"] full url of your image [/slide] <br />[/slider]</code>'
									+ '<a href="#" class="close">&times;</a></div>');
							jQuery("#help").slideDown("slow");

				}
			});

			/*ed.addButton('BS-Sgallery', {
				title : 'Photo Gallery Shortcode',
				image : url+'/images/photo-gallery-shortcodes.png',
				onclick : function() {
					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '			[photo_gallery] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[/photo_gallery] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');

						jQuery(".helpshortcode").remove();
						jQuery("#poststuff").prepend('<div class="helpshortcode alert-box secondary"></div>');

						jQuery(".helpshortcode").hide(function() {
							jQuery(".helpshortcode").html('<div class="updated"><div class="rt-message">X</div>'
									+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
									+ '	<hr class="rt-message-hr" /> You can enter unlimited [image ]..[/image] line to add new items to your gallery.'
									+ '	<h4>Parameters of this shortcode</h4> '
									+ '	<p>	'
									+ '<b>thumb_width:</b> thumbnail width<br />	'
									+ '<b>thumb_height:</b> thumbnail height<br />	'
									+ '<b>lightbox:</b> opens the big image in a lightbox<br />	'
									+ '<b>custom_link:</b> you can define another link different then the big version of the thumbnail.<br />	'
									+ '<b>caption:</b> caption text for the item.<br />	'
									+ '<b>title:</b> title text.<br />	'
									+ '	</p></div>');						
						});
						jQuery(".helpshortcode").fadeIn('slow'); 
				}
			});*/

			/*ed.addButton('BS-Slightbox', {
				title : 'Auto Thumbnail and Lightbox Shortcode',
				image : url+'/images/thumbnail-shortcodes.png',
				onclick : function() {
					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '			[auto_thumb width="150" height="150" link="" lightbox="true" align="left" title="" alt="" iframe="false" frame="true" crop="true"] full url of your image [/auto_thumb] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');

						jQuery(".helpshortcode").remove();
						jQuery("#poststuff").prepend('<div class="helpshortcode alert-box secondary"></div>');

						jQuery(".helpshortcode").hide(function() {
							jQuery(".helpshortcode").html('<div class="updated"><div class="rt-message">X</div>'
									+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
									+ '	<hr class="rt-message-hr" /> '
									+ '	<h4>Parameters of this shortcode</h4> '
									+ '	<p>	'
									+ '<b>link:</b> you can enter custom url. If you leave blank it will be linked to the bigger version of the image. <br />	'
									+ '<b>width:</b> thumbnail width<br />	'
									+ '<b>height:</b> thumbnail height<br />	'
									+ '<b>lightbox:</b> (true/false) default is true, enter no to disable lightbox feature<br />	'
									+ '<b>title:</b> link title text.<br />	'
									+ '<b>align:</b> (left/right/center) default is left, image alignment<br />	'
									+ '<b>alt:</b> alt tag for image<br />	'
									+ '<b>iframe:</b> (true/false) default is false. Use this paramater if you want to open a page or an external url in a lightbox.<br />	'
									+ '<b>frame:</b> (true/false) default is true.  Use this paramater if you want to add a frame to the thubmnail.<br />	'
									+ '<b>crop:</b> (true/false) default is true. Crops images with the width and height values that you defined.<br />	'
									+ '	</p></div>');						
						});
						jQuery(".helpshortcode").fadeIn('slow');
						 
				}
			});*/
 
 
			/*ed.addButton('BS-Ssliderscroll', {
					title : 'Scroll Slider Shortcode',
					image : url+'/images/scroll_slider.png',
					onclick : function() {
						window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '			[scroll_slider]<br />[scroll_image] full url of your image [/scroll_image] <br />[scroll_image] full url of your image [/scroll_image] <br />[scroll_image] full url of your image [/scroll_image] <br />[/scroll_slider] <br /> <br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".helpshortcode").remove();
							jQuery("#poststuff").prepend('<div class="helpshortcode alert-box secondary"></div>');
	
							jQuery(".helpshortcode").hide(function() {
								jQuery(".helpshortcode").html('<div class="updated"><div class="rt-message">X</div>'
										+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> ' 
										+ '	<hr class="rt-message-hr" /> '
										+ '	<p>Paste image urls in the [scroll_image][/scroll_image] breckets which has been uploaded by the media uploader before. i.e., your images must be local for the site. '
										+ '	</p></div>');											
							});
							jQuery(".helpshortcode").fadeIn('slow');
							 
					}
				});*/
 
			// ed.addButton('BS-Stabs', {
			// 		title : 'Tabs Shortcode',
			// 		image : url+'/images/tab-shortcodes.png',
			// 		onclick : function() {
			// 			window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '			[tabs align="horizontal" tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"]<br />[tab id="tab1"]Tab 1 Content [/tab]<br />[tab id="tab2"]Tab 2 Content[/tab]<br />[tab id="tab3"]Tab 3 Content [/tab]<br />[/tabs]<br /> <br /> ');
			// 			window.tinyMCE.activeEditor.execCommand('mceRepaint');
							
			// 				jQuery("#help").hide();
			// 				jQuery(".helpshortcode").remove();
			// 				jQuery("#help").html('<div class="helpshortcode alert-box secondary">'
			// 						+ '<h5><i class="foundicon-idea"></i>How to use: <i>Tabs Shortcode</i></h5>'
			// 						+ '<p>Put tab contents into the [tab][/tab] breckets. For the tab titles use the first bracket parameters like  [tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"] . There is no tab limit, you can add tabs till the fit your page.<p>'
			// 						+ '<p><b>tab :</b> horizontal or vertical</p>'
			// 						+ '<a href="#" class="close">&times;</a></div>');
			// 				jQuery("#help").slideDown("slow");
							 
			// 		}
			// 	});

			// ed.addButton('BS-Stable', {
			// 		title : 'Table Shortcode',
			// 		image : url+'/images/table-shortcodes.png',
			// 		onclick : function() {
			// 			window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '			[table col1="Title 1" col2="Title 2" col3="Title 3"]<br />[line][col]Content line 1 col 1 [/col]<br />[col]Content line 1 col 2 [/col]<br />[col]Content line 1 col 3 [/col][/line]<br />[line][col]Content line 2 col 1 [/col]<br />[col]Content line 2 col 2 [/col]<br />[col]Content line 2 col 3 [/col][/line]<br/>[line][col]Content line 3 col 1 [/col]<br />[col]Content line 3 col 2 [/col]<br />[col]Content line 3 col 3 [/col][/line][/table]<br /> <br /> ');
			// 			window.tinyMCE.activeEditor.execCommand('mceRepaint');
							
			// 				jQuery("#help").hide();
			// 				jQuery(".helpshortcode").remove();
			// 				jQuery("#help").html('<div class="helpshortcode alert-box secondary">'
			// 						+ '<h5><i class="foundicon-idea"></i>How to use: <i>Table Shortcode</i></h5>'
			// 						+ '<p>To start the table use [table][/table] breckets. To make a line [line][/line]. Then, put your content into [col][/col] breckets. There is no table limit, line limit and col limit, but your table must be right structured.<p>'
			// 						+ '<a href="#" class="close">&times;</a></div>');
			// 				jQuery("#help").slideDown("slow");
							 
			// 		}
			// 	});


			ed.addButton('BS-Saccordion', {
					title : 'Accordion Shortcode',
					image : url+'/images/accordion-shortcodes.png',
					onclick : function() {
						window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[accordion]<br />[pane title="Accordion Pane 1" active] content [/pane] <br />[pane title="Accordion Pane 2"] content [/pane] <br />[pane title="Accordion Pane 3"] content [/pane] <br />[/accordion]<br /><br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
							jQuery("#help").hide();
							jQuery(".helpshortcode").remove();
							jQuery("#help").html('<div class="helpshortcode alert-box secondary">'
									+ '<h5><i class="foundicon-idea"></i> How to use: <i>Accordion Shortcode</i></h5>'
									+ '<p>Put contents into the [pane title="Pane Title"][/pane] breckets.<br /> You can use the "active" attribute on one pane to display it first, and use "class" attribute to add custom class.<br />Example:<p>'
									+ '<code>[accordion]<br />[pane title="My title" active]My content[/pane]<br />[pane title="My second title" active]My second content[/pane]<br />[/accordion]</code>'
									+ '<a href="#" class="close">&times;</a></div>');
							jQuery("#help").slideDown("slow");
					}
				});

			ed.addButton('BS-Stooltip', {
					title : 'Tool Tip Shortcode',
					image : url+'/images/tool_tip.png',
					onclick : function() {
						window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[tooltip text="Tooltip Text" width="100" position="top"]content[/tooltip]<br /><br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery("#help").hide();
							jQuery(".helpshortcode").remove();
							jQuery("#help").html('<div class="helpshortcode alert-box secondary">'
									+ '<h5><i class="foundicon-idea"></i>How to use: <i>Tips Shortcode</i></h5>'
									+ '<p>Put contents into the [tooltip][/tooltip] breckets.<p>'
									+ '	<p>'
									+ '<b>text:</b> the text you want to show in the tooltip<br />'
									+ '<b>width:</b> width in pixel, 100 by default<br />'
									+ '<b>position:</b> choose between top, bottom, left, right<br />'
									+ 'Example:</p>'
									+ '<code>[tooltip text="Tooltip Text" width="100" position="top"]content[/tooltip]</code>'
									+ '<a href="#" class="close">&times;</a></div>');
							jQuery("#help").slideDown("slow");
							 
					}
				});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Shortcodes plugin',
				author : 'Benjamin Cabanes',
				authorurl : 'http://slapandthink.com',
				infourl : 'http://www.tinymce.com/wiki.php',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('shortcodes', tinymce.plugins.ShortcodesPlugin);
})();