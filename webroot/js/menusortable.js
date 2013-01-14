jQuery(document).ready(function() {

        //menu edition
        $(".menu-sortable").sortable( {
        	axis: "x,y",

        	update: function(event, ui){
        		var newOrder = $(this).sortable('toArray').toString();
                        $('input[name="menu_order"]').val(newOrder);
        	}
        });
        //$( "#sortable" ).disableSelection();
        $(".menu-sortable-reset").on('click', function(){
        	$(".menu-sortable").sortable( "cancel" );
        });

});