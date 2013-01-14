<section class="posts view">
	<header><!-- header -->
        <h1>The blog</h1>
    </header><!-- end of header -->

    <div class="content">
    	<?php foreach($posts as $k=>$v): ?>
    		<article>
    			<h2><?php echo $v->name; ?></h2>
				<?php echo $v->excerpt; ?>
				<p><a href="<?php echo Router::url("posts/view/id:{$v->id}/slug:{$v->slug}"); ?>">Read more&rarr;</a></p>
    		</article>
		<?php endforeach; ?>
    </div>

	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>