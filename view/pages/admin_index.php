<section class="pages">
	<header><!-- header -->
        <h1><?php echo $total; ?> Pages <small>Add, edit or delete users</small></h1>
    </header><!-- end of header -->
    <div class="content"><!-- content -->
    	<table class="twelve tablesort">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Category</th>
					<th>Status</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($posts as $k=>$v): ?>
				<tr>
					<td><?php echo $v->id; ?></td>
					<td><?php echo $v->name; ?></td>
					<td><?php echo $v->cat_name; ?></td>
					<td><span class="label <?php echo ($v->online==1) ? 'success' : 'error'; ?>"><?php echo ($v->online==1) ? 'Online' : 'Offline'; ?></span></td>
					<td><small><time><?php echo $v->created; ?></time></small></td>
					<td>
						<a href="<?php echo Router::url('admin/pages/edit/' . $v->id); ?>" class="button tiny secondary">Edit</a>
						<a onclick="return confirm('You will delete this page, continue?');" href="<?php echo Router::url('admin/pages/delete/' . $v->id); ?>" class="button tiny alert">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
    	<p><a href="<?php echo Router::url('admin/pages/edit'); ?>" class="button">Add new page</a></p>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>
