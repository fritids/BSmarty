<?php

/**
 * This is the main.php
 * This page displays all the main content website, typically all views.
 * Inculed by default.php
 *
 * @package BSmarty
 * @version 1.1
 */

?>

    <div role="main"><!-- main -->
      <div class="row">
        <div class="twelve columns">
          <?php
            /**
             * Display flash lessage if exists
             */
            echo $this->Flash->display();
          ?>

          <?php
            /**
             * Display the content
             */
            echo $content_for_layout;
          ?>
        </div>
      </div>
    </div><!-- end of main -->