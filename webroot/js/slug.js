//
//	jQuery Slug Generation Plugin by Perry Trinier (perrytrinier@gmail.com) Modified by Benjamin Cabanes (contact@slapandthink.com)
//  Licensed under the GPL: http://www.gnu.org/copyleft/gpl.html

jQuery.fn.slug = function(options) {
	var settings = {
		slug: '.slug', // Class or Id (whatever) used for slug destination input and span. The span is created on $(document).ready() 
		hide: true	 // Boolean - By default the slug input field is hidden, set to false to show the input field and hide the span. 
	};

	if(options) {
		jQuery.extend(settings, options);
	}
	
	$this = jQuery(this);

	jQuery(document).ready( function() {
		if (settings.hide) {
			jQuery('input' + settings.slug).after("<span class="+settings.slug+"></span>");
			jQuery('input' + settings.slug).hide();
		}
	});
	
	makeSlug = function() {
			var patterns = {
				0:{'key':/\s/g, 'value':'-'},
				1:{'key':/[éèëê]/g, 'value':'e'},
				2:{'key':/[àâä]/g, 'value':'a'},
				3:{'key':/[ç]/g, 'value':'c'},
				4:{'key':/[îï]/g, 'value':'i'},
				5:{'key':/[ù]/g, 'value':'u'},
				6:{'key':/[ôóö]/g, 'value':'o'},
				7:{'key':/[\'\"]/g, 'value':'-'},
				8:{'key':/[^a-zA-Z0-9\-]/g, 'value':''},
			};

			var slugcontent_hyphens = $this.val();
			for(i=0; i<9; i++){
				slugcontent_hyphens = slugcontent_hyphens.replace(patterns[i]['key'], patterns[i]['value']);
			}
			var finishedslug = slugcontent_hyphens;
			jQuery('input' + settings.slug).val(finishedslug.toLowerCase());
			jQuery('span' + settings.slug).text(finishedslug.toLowerCase());
			
		}
		
	jQuery(this).keyup(makeSlug);
	return $this;
};