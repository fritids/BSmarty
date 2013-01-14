/**
 * BSmarty Javascript Loader
 * This is the file with only loaders and actions display scipts
 */

jQuery(document).ready(function() {

  /**
   * Slug interactions
   */
  $("#input-name").slug({hide:false,slug:'#input-slug'});

  /**
   * Table Sorter
   */
  $('.tablesort').tablesorter();

  /**
   * Date picker
   */
  $('.datepicker').datepicker(); // Datepicker jQuery UI

  /**
   * Explorer Script
   */
  $("#explorerLink").click(function() {
    var url = $(this).data('modal-url');
      $("#explorerModal").bs_explorer({
        contentArea: '.content',
        contentForm: 'form',
        progress: 'progress',
        url: url
      }).reveal();
  });













  $('.path').click(function(){
    alert($(this).html());
    //$(this).focus().select();
  })

});