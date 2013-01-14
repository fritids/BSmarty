<div role="main layout"><!-- main -->
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