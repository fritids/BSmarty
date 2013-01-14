<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>BSmarty - Installation</title>
    <meta name="description" content="BSmarty is a micro and flexible CMS - Open Source">
    <meta name="author" content="BSmarty : Open Source CMS | Benjamin Cabanes | http://slapandthink.com | @slapandthink">
    <meta name="keywords" content="benjamin cabanes, slapandthink, bsmarty, cms, open source"> 

    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/fonts/general_foundicons.css">   

    <!--[if lt IE 8]>
      <link rel="stylesheet" href="../css/fonts/general_foundicons_ie7.css">
    <![endif]-->

    <script src="../js/modernizr.foundation.js"></script>

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <header>
      <div class="row">
        <div class="twelve columns">
            <!-- Title Area -->
            <h1>BSmarty <small>Installation process</small></h1>
            <p>This process describe how to use the install script.</p>
            <p>The admin panel is available at <code>parent_folder/bs-admin</code>, you can change it in the config.php by setting a new prefix.</p>
            <p>The default admin login/password are: <code>admin/admin</code>, you can change them at any moment in the admin panel.</p>

            <div class="panel">
              <h2 class="subheader">Things to add</h2>
              <p>Admin dashboard: with some statistics on pages/posts/users/medias library (how much, etc...)</p>
              <p>Problem with the <code>BASE_URL</code> php constant on server.</p>
            </div>
        </div>
      </div>
    </header>

    <div role="main"><!-- main -->
      <div class="row">
        <div class="twelve columns">
          <section class="install step1"><!-- install step1 -->
            <header>
              <h1 class="subheader">STEP 1 <small>Upload files</small></h1> 
            </header>
            <div class="content">
              <p>
                You have to copy files on your server.<br />
                Note that you have to give some permission <code>0777</code> on some directories:
              </p>
              <ul>
                <li><code>webroot/medias</code> Use by the library manager</li>
                <li><code>webroot/downloads</code> If you want to use the download manager</li>
              </ul>
              <p>You have to desactivate the magic quote from your <code>php.ini</code>, you can add <code>php_flag magic_quotes_gpc Off</code> in your .htaccess</p>
            </div>
          </section><!-- end of install step1 -->
          <section class="install step2"><!-- install step2 -->
          	<header>
          		<h1 class="subheader">STEP 2 <small>Set the conf.php</small></h1>	
          	</header>
          	<div class="content">
          		<p>
          			First of all, you have to fill the conf.php with your database informations.<br />
          			The config.php is located in <code>config/conf.php</code>, then search the Conf's Class and fill with the host, the database name, the login and the password, like the example.<br />
          		</p>
          		<pre class="panel">
class Conf{
  static $debug = 1;

  static $databases = array(
    'default' => array(
	  'host'     => 'localhost',
	  'database' => 'myDatabaseName',
	  'login'    => 'myLogin',
	  'password' => 'myPassword'
	)
  );
}
          		</pre>
          	</div>
          </section><!-- end of install step2 -->
          <hr />
          <section class="install step3"><!-- install step3 -->
          	<header>
          		<h1 class="subheader">STEP 3 <small>Install the database</small></h1>	
          	</header>
          	<div class="content">
          		<p>
          			You have to initialize the database.<br />
          			This will create the structure database with few basic content.
          		</p>
	          	<a href="bs-install.php?set-database" class="button">Install the database</a>
          	</div>
          </section><!-- end of install step3 -->
          <hr />
          <section class="install step4"><!-- install step4 -->
          	<header>
          		<h1 class="subheader">STEP 4 <small>Install example content (optionnal)</small></h1>	
          	</header>
          	<div class="content">
          		<p>
          			When you have install the database properly, you can install the example content to view all functionnality of CMS.<br />
          			This will add content in many tables.
          		</p>
	          	<a href="bs-install.php?set-content" class="button">Install example content</a>
          	</div>
          </section><!-- end of install step4 -->
          <hr />
          <section class="install step5"><!-- install step5 -->
          	<header>
          		<h1 class="subheader">STEP 5 <small>Delete the folder</small></h1>	
          	</header>
          	<div class="content">
          		<p>
          			When your ready, <span class="radius label alert">don't forget to delete the install folder</span> for security reasons.
          		</p>
          	</div>
          </section><!-- end of install step5 -->
        </div>
      </div>
    </div><!-- end of main -->

    <footer><!-- footer -->
      <div class="row">
        <div class="twelve columns">
          <p>&copy; BSmarty 2012</p>  
        </div>
      </div>
    </footer><!-- end of footer -->


    <!-- JAVASCRIPTS FILES HERE -->

    <!-- Included JS Files (Compressed) -->
    <script src="../js/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/app.js"></script>
    

  </body>
</html>
