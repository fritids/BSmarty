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

    <header><!-- header -->
        <nav class="top-bar"><!-- navigation -->
          <ul>
            <!-- Title Area -->
            <li class="name has-dropdown">
              <h1><a href="<?php echo Router::url('admin'); ?>" title="Dashboard">BSmarty</a></h1>
              <ul class="dropdown">
                  <li><a href="<?php echo Router::url('admin'); ?>" title="Return to the dashboard">Dashboard</a></li>
                  <li><a href="<?php echo Router::url(''); ?>" title="View the site">Return to the frontend</a></li>
                </ul>
            </li>
            <li class="toggle-topbar"><a href="#"></a></li>
          </ul>

          <section>
            <!-- Left Nav Section -->
            <ul class="left">
              <li class="divider"></li>
              <li class="has-dropdown">
                <a href="<?php echo Router::url('admin/posts/index'); ?>" title="Manage articles">Articles</a>
                 <ul class="dropdown">
                  <li><a href="<?php echo Router::url('admin/posts/index'); ?>" title="View all articles">View all</a></li>
                  <li><a href="<?php echo Router::url('admin/posts/edit'); ?>" title="Add new article">Add new</a></li>
                  <li><a href="<?php echo Router::url('admin/categories/index/posts'); ?>" title="Manage categories">Categories</a></li>
                </ul>
              </li>
              <li class="divider"></li>
              <li class="has-dropdown">
                <a href="<?php echo Router::url('admin/pages/index'); ?>">Pages</a>
                <ul class="dropdown">
                  <li><a href="<?php echo Router::url('admin/pages/index'); ?>" title="View all pages">View all</a></li>
                  <li><a href="<?php echo Router::url('admin/pages/edit'); ?>" title="Add new page">Add new</a></li>
                  <li><a href="<?php echo Router::url('admin/categories/index/pages'); ?>" title="Manage categories">Categories</a></li>
                </ul>
              </li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/menu/index'); ?>" title="Menu">Menu</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/medias/index'); ?>" title="Explorer">Explorer</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/downloads/index'); ?>" title="Downloads">Downloads</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/online_orders/index'); ?>" title="Online orders">Online orders</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/configs/index'); ?>" title="Options">Options</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo Router::url('admin/users/index'); ?>" title="Users">Users</a></li>
              <li class="divider"></li>
            </ul><!-- end of Left Nav Section -->

            <!-- Right Nav Section -->
            <ul class="right">
              <li class="divider show-for-medium-and-up"></li>
              <li class="has-dropdown">
                <a href="#">Informations</a>
                <ul class="dropdown">
                  <li><label><i class="foundicon-website"></i> Front</label></li>
                  <li><a href="<?php echo Router::url(''); ?>" title="View website">View website</a></li>
                  <li class="divider"></li>
                  <li><label>Personal</label></li>
                  <li><a href="<?php echo Router::url('admin/users/edit/'.$_SESSION['User']->id); ?>" title="Edit my profile">Edit my profile</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo Router::url('users/logout'); ?>" title="Logout">Logout</a></li>
                </ul>
              </li>
            </ul>
            <!-- end of Right Nav Section -->       
          </section>
        </nav><!-- end of navigation -->
    </header><!-- end of header -->