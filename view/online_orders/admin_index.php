<section class="online_orders">
	<header><!-- header -->
		<h1>Online orders <small>Manage orders, add categories, add items</small></h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->

		<div class="six columns">
			<h2 class="subheader">Manage categories</h2>
			<dl class="tabs two-up">
			  <dd class="active"><a href="#categoryAdd">Add</a></dd>
			  <dd><a href="#categoryEdit">Edit</a></dd>
			</dl>

			<ul class="tabs-content">
			  <li class="active" id="categoryAddTab">
			  	<form action="<?php echo Router::url('admin/Online_Orders/edit/category'); ?>" method="post">
			  		<?php echo $this->Form->input('name', 'Name', array('required' => '')); ?>
			  		<div class="actions">
						<input type="submit" class="button right" value="Validate" >
					</div>
			  	</form>
			  </li>
			  <li id="categoryEditTab">
			  	<form action="<?php echo Router::url('admin/Online_Orders/edit/category'); ?>" method="post">
			  		<?php echo $this->Form->select('id', 'Old name', $categories); ?>
			  		<?php echo $this->Form->input('name', 'New name', array('required' => '')); ?>
			  		<div class="actions">
						<input type="submit" class="button right" value="Validate" >
					</div>
			  	</form>
			  </li>
			</ul>
		</div>
		<div class="six columns">
			<h2 class="subheader">Manage items</h2>
			<dl class="tabs two-up">
			  <dd class="active"><a href="#itemAdd">Add</a></dd>
			  <dd><a href="#itemEdit">Edit</a></dd>
			</dl>

			<ul class="tabs-content">
			  <li class="active" id="itemAddTab">
			  	<form action="<?php echo Router::url('admin/Online_Orders/edit/item'); ?>" method="post">
			  		<?php echo $this->Form->select('category_id', 'Category', $categories); ?>
			  		<?php echo $this->Form->input('name', 'Name', array('required' => '')); ?>
			  		<?php echo $this->Form->input('image', 'Image'); ?>
			  		<?php echo $this->Form->input('factor', 'Factor', array('required' => '')); ?>
			  		<div class="actions">
						<input type="submit" class="button right" value="Validate" >
					</div>
			  	</form>
			  </li>
			  <li id="itemEditTab">
			  	<form action="<?php echo Router::url('admin/Online_Orders/edit/item'); ?>" method="post">
			  		<?php echo $this->Form->select('id', 'Old item', $items); ?>
			  		<?php echo $this->Form->select('category_id', 'Category', $categories); ?>
			  		<?php echo $this->Form->input('name', 'Name', array('required' => '')); ?>
			  		<?php echo $this->Form->input('image', 'Image'); ?>
			  		<?php echo $this->Form->input('factor', 'Factor', array('required' => '')); ?>
			  		<div class="actions">
						<input type="submit" class="button right" value="Validate" >
					</div>
			  	</form>

			  </li>
			</ul>
		</div>

		<hr>

		<?php foreach($rows as $row): ?>
			<h3 class="subheader"><?php echo $row->category->name; ?> <small><a onclick="return confirm('You will delete this item, continue?');" href="<?php echo Router::url('admin/Online_Orders/delete/category/'.$row->category->id); ?>" class="label tiny alert">Delete</a></small></h3>
			<table class="twelve tablesort">
				<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Factor</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row->items as $k=>$v): ?>
					<tr>
						<td><img src="<?php echo $v->image; ?>" alt="<?php echo $v->name; ?>" style="max-height: 50px;" ></td>
						<td><?php echo $v->name; ?></td>
						<td><?php echo $v->factor; ?></td>
						<td>
							<a onclick="return confirm('You will delete this item, continue?');" href="<?php echo Router::url('admin/Online_Orders/delete/item/'.$v->id); ?>" class="button tiny alert">Delete</a>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php endforeach; ?>
	</div><!-- end of content -->
	<footer><!-- footer -->
		<p>Footer</p>
	</footer><!-- end of footer -->
</section>
