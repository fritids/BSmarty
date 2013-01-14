<section class="categories">
	<header><!-- header -->
		<h1><?php echo $total; ?> Categories <small>Add, edit or delete categories</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<table class="twelve tablesort">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Type</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($categories as $k=>$v): ?>
				<tr>
					<td><?php echo $v->id; ?></td>
					<td><?php echo $v->name; ?></td>
					<td><?php echo $v->type; ?></td>
					<td>
						<a href="<?php echo Router::url('admin/categories/edit/' . $v->id); ?>" class="button tiny secondary">Edit</a>
						<a onclick="return confirm('You will delete this category, continue?');" href="<?php echo Router::url('admin/categories/delete/' . $v->id); ?>" class="button tiny alert">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<p><a href="<?php echo Router::url('admin/categories/edit'); ?>" class="button">Add new categorie</a></p>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>
