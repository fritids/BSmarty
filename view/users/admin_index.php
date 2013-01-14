<section class="users">
	<header><!-- header -->
		<h1><?php echo $total; ?> Users <small>Add, edit or delete users</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<table class="twelve tablesort">
			<thead>
				<tr>
					<th>ID</th>
					<th>Login</th>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Created</th>
					<th>Role</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($categories as $k=>$v): ?>
				<tr>
					<td><?php echo $v->id; ?></td>
					<td><?php echo $v->login; ?></td>
					<td><?php echo $v->firstname.' '.$v->name; ?></td>
					<td><?php echo $v->email; ?></td>
					<td>
						<?php
							if($v->status == 'activated'){
								echo '<span class="success label">Activated</span>';
							}elseif($v->status == 'pending'){
								echo '<span class="secondary label">Pending</span>';
							}elseif($v->status == 'unknown'){
								echo '<span class="secondary label">Draft user</span>';
							}else{
								echo '<span class="alert label">Denied</span>';
							}
						?>
					</td>
					<td><small><time><?php echo $v->created; ?></time></small></td>
					<td>
						<?php
							if($v->role == 'admin'){
								echo '<span class="alert label">Admin</span>';
							}elseif($v->status == 'unknown'){
								echo '<span class="secondary label">Unkown</span>';
							}else{
								echo '<span class="label">User</span>';
							}
						?>
					</td>
					<td>
						<a href="<?php echo Router::url('admin/users/edit/' . $v->id); ?>" class="button tiny secondary">Edit</a>
						<a onclick="return confirm('You will delete this user, continue?');" href="<?php echo Router::url('admin/users/delete/' . $v->id); ?>" class="button tiny alert">Delete</a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<p><a href="<?php echo Router::url('admin/users/edit'); ?>" class="button">Add new user</a></p>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<ul class="pagination">
			<?php for($i=1; $i<=$page; $i++): ?>
				<li <?php if($i==$this->request->page) echo 'class="current"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		</ul>
	</footer><!-- end of footer -->
</section>
