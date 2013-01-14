<?php

/**
 * This is the top.php
 * This page displays the website header like the Chrome Frame (for old web browser)
 * and the banner, top menu etc...
 * The body tag is open.
 * Inculed by default.php
 *
 * @package BSmarty
 * @version 1.1
 */

// <body>
?>

    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
         chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 9]><p class="chromeframe">Your browser is too <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <header>
      <div class="row">
        <div class="twelve columns">
          <nav class="top-bar"><!-- navigation -->
            <ul>
              <!-- Title Area -->
              <li class="name"><h1><a href="<?php echo Router::url(''); ?>" title="Accueil">BSmarty</a></h1></li>
              <li class="toggle-topbar"><a href="#"></a></li>
            </ul>

            <section>
              <!-- Left Nav Section -->
              <ul class="left">
                <li class="divider"></li>
                  <?php
                    /**
                     * Display the menu
                     */
                    $pagesMenu = $this->request('Pages', 'getMenu');
                    foreach($pagesMenu as $p):
                  ?>
                    <li><a href="<?php echo Router::url("pages/view/id:{$p->id}/slug:{$p->slug}"); ?>" title="<?php echo $p->name; ?>"><?php echo $p->name; ?></a></li>
                  <?php endforeach; ?>

                  <li><a href="<?php echo Router::url('downloads/index'); ?>" title="Downloads">Downloads</a></li>
                  <?php if(!isset($_SESSION['User'])): ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo Router::url('users/login'); ?>" title="Downloads">Login</a></li>
                  <?php else: ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo Router::url('users/logout'); ?>" title="Logout">Logout</a></li>
                  <?php endif; ?>
              </ul><!-- end of Left Nav Section -->

              <?php if(isset($_SESSION['User']) AND $_SESSION['User']->role == 'admin'): ?>
                <!-- Right Nav Section -->
                <ul class="right">
                  <li class="divider show-for-medium-and-up"></li>
                  <li class="has-dropdown">
                    <a href="#">Informations</a>
                    <ul class="dropdown">
                      <li><label><i class="foundicon-settings"></i> Admin Panel</label></li>
                      <li><a href="<?php echo Router::url('admin/dashboard'); ?>" title="Dashboard">Dashboard</a></li>
                      <li class="divider"></li>
                      <li><label>Personal</label></li>
                      <li><a href="<?php echo Router::url('admin/users/edit/'.$_SESSION['User']->id); ?>" title="Edit my profile">Edit my profile</a></li>
                      <li class="divider"></li>
                      <li><a href="<?php echo Router::url('users/logout'); ?>" title="Logout">Logout</a></li>
                    </ul>
                  </li>
                </ul>
                <!-- end of Right Nav Section -->
              <?php
                endif;
              ?>             
            </section>
          </nav><!-- end of navigation -->
        </div>
      </div>
    </header>