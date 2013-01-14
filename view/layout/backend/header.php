<?php

/**
 * This is the header.php
 * This page will set the doctype, metas, links and other
 * tags in the head HTML part.
 * Inculed by default.php
 *
 * @package BSmarty
 * @version 1.1
 */


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Administration'; ?></title>
    <meta name="description" content="BSmarty : Open Source CMS">
    <meta name="author" content="BSmarty : Open Source CMS | Benjamin Cabanes | http://slapandthink.com | @slapandthink">

    <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/foundation.css">
    <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/app.css">
    <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/fonts/general_foundicons.css">
    <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/admin_style.css">

    <!--[if lt IE 8]>
      <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/fonts/general_foundicons_ie7.css">
    <![endif]-->

    <link rel="stylesheet" href="<?php echo Router::url(''); ?>css/jquery-ui-1.9.2.css">

    <script src="<?php echo Router::webroot('js/modernizr.foundation.js'); ?>"></script>

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>