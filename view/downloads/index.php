<section class="donwloads">
	<header><!-- header -->
		<h1><?php echo $total; ?> Files <small>available to download</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->

		<?php foreach($files as $k=>$v): ?>
			<article class="six columns">
				<header>
					<h1 class="subheader"><?php echo $v->name; ?></h1>
				</header>
				<div class="entry" style="height: 150px; overflow: auto; padding: 5px;">
					<?php echo $v->description; ?>
				</div>
				<footer>
					<p>I accept the CGU <input type="checkbox" id="cgucheck-<?php echo $v->id; ?>" name="cgucheck"></p>
					<p><a data-download-id="<?php echo $v->id; ?>" href="<?php echo Router::url('downloads/download/'.$v->id); ?>" class="button secondary expand download">Download the file</a></p>
				</footer>
			</article>
		<?php endforeach; ?>
		<hr>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>


<div id="alert-cgu" class="reveal-modal large">
  <h2>Alert CGU not accepted</h2>
  <p class="lead">To download the file, you have to accept the CGU.</p>
  <p>If you aren't agree with this process, contact the system administrator.</p>
  <a class="close-reveal-modal">&#215;</a>
</div>

