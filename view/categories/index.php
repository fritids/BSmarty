<section class="categories">
	<header><!-- header -->
		<h1><?php echo $total; ?> Categories</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<ul>
			<?php foreach($categories as $k=>$v): ?>
				<li><?php echo $v->name; ?> | <?php echo $v->type; ?> | <a href="<?php echo Router::url('categories/view/'.$v->id.'/'.$v->slug); ?>">View</a></li>
			<?php endforeach ?>
		</ul>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>
