<?php

/**
 * This is the footer.php
 * This page includes all website bottom content like javascript libraries,
 * code tracking and more...
 * This page close the body and HTML tag
 * Inculed by default.php
 *
 * @package BSmarty
 * @version 1.1
 */

?>

    <!-- JAVASCRIPTS FILES HERE -->

    <!-- Included JS Files (Compressed) -->
    <script src="<?php echo Router::webroot('js/jquery.js'); ?>"></script>
    <script src="<?php echo Router::webroot('js/foundation.min.js'); ?>"></script>
    <script src="<?php echo Router::webroot('js/app.js'); ?>"></script>

    <script src="<?php echo Router::webroot('js/payments.js'); ?>"></script>
    
    <!-- Initialize JS Plugins -->
    <script type="text/javascript" src="<?php echo Router::webroot('js/table.sorter.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo Router::webroot('js/jquery-ui-1.9.2.min.js'); ?>"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $(".featured").orbit({
              directionalNav: true,
              bullets: false,
              timer: true
            });
            $('.tablesort').tablesorter();

            $('.datepicker').datepicker(); // Datepicker jQuery UI

            // Downloads CGU accepts
            $('.download').on('click', function(e) {
                var id = $(this).data('download-id');
                if(!$('#cgucheck-'+id).attr('checked')){
                  e.preventDefault();
                  $('#alert-cgu').reveal();
                }
            });

        });
    </script>

  </body>
</html>