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


/**
 * Explorer loader
 */
jQuery.fn.bs_explorer = function(options) {

	var settings = {
		contentArea: '.content', // Class or Id (whatever) used for displaying the loaded content 
		contentForm: 'form', // Class or ID (whatever) of the upload form
		progress: 'progress',
		url: '' // The url to the script handling the file
	};

	if(options) {
		jQuery.extend(settings, options);
	}

	$this = jQuery(this);

	// Starting
	loading();

	/**
	 * Let's begin by loading the content
	 */
	function loading(){
		$this.find(settings.contentArea).load(settings.url, function(){
			// Here, we can lunch the upload script part
	    	
	    	/* Make some validation here */
	    	$this.find(':file').change(function(){
			    var file = this.files[0];
			    name = file.name;
			    size = file.size;
			    type = file.type;
			    
			    // Some validation here
			    alert("Filename: "+file.name);
			    alert("Size: "+file.size+" bytes");
			    alert("Filetype: "+file.type);
	    	});

	    	// Call the uploading script part
	    	uploading();

	    }).hide().fadeIn('slow');
	} 


	function uploading(){
		/**
    	 * Then the uploas script
    	 */
    	$this.find(settings.contentForm).bind('submit', function(){	//disable the form
    		var form = $(this);
    		var formData = new FormData($(this)[0]);
    		// AJAX call
            $.ajax({
                url: settings.url,  //server script to process data
                type: 'POST',
                xhr: function() {  // custom xhr
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // check if upload property exists
                        myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                beforeSend: function(){
                  form.find('progress').fadeIn(500); //Display the progress bar
                },
                success: function(){
                  $("#explorerModal").find('.content').html('');
                  form.find('progress').fadeOut(500); //Hide the progress bar
                  
                  // Reload the content
                  loading();

                },
                error: function(){
                  console.log('error');
                },
                // Form data
                data: formData,
                //Options to tell JQuery not to process data or worry about content-type
                cache: false,
                contentType: false,
                processData: false
            });
	
			return false;

    	});
	}

	/**
	 * Process handling function
	 */
    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $(settings.progress).attr({value:e.loaded,max:e.total});
        }
    }



    return $this;
};