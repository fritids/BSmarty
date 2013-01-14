<section class="categories edit">
	<header><!-- header -->
		<h1>Menu link edit</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<p>You can edit the menu <a href="<?php echo Router::url('admin/menu/'); ?>" title="Menu management">go back to the menu management</a>.</p>
		<h2 class="subheader">Add an item</h2>
		<form action="<?php echo Router::url('admin/menu/edit/item/'.$group_id); ?>" method="post" >
			<div class="row">
				<div class="two columns"><?php echo $this->Form->input('name', 'Name', array('required' => '')); ?></div>
				<div class="four columns"><?php echo $this->Form->input('url', 'Url', array('type' => 'url', 'required' => '')); ?></div>
				<div class="two columns"><?php echo $this->Form->input('class', 'Class'); ?></div>
				<div class="two columns"><?php echo $this->Form->input('target', 'Open in new window', array('type' => 'yesno')); ?></div>
				<div class="two columns"><?php echo $this->Form->select('parent_id', 'Parent', $itemsAssoc); ?></div>
			</div>

			<div class="actions">
				<input type="submit" class="button right" value="Validate" >
			</div>
		</form>

		<h2 class="subheader">Items order</h2>
		<p>Please, be sure that the child item is under his parent.</p>
		<form action="<?php echo Router::url('admin/menu/edit/item/'.$group_id); ?>" method="post" >

			<ul class="menu-sortable">
				<?php foreach($items as $item): ?>
					<li id="<?php echo $item->id; ?>">
						<div class="row">
							<input type="hidden" name="id" value="<?php echo $item->id; ?>">
							<div class="two columns"><?php echo $this->Form->input('name__'.$item->id, 'Name', array('value' => $item->name, 'required' => '')); ?></div>
							<div class="four columns"><?php echo $this->Form->input('url__'.$item->id, 'Url', array('type' => 'url', 'value' => $item->url, 'required' => '')); ?></div>
							<div class="two columns"><?php echo $this->Form->input('class__'.$item->id, 'Class', array('value' => $item->class)); ?></div>
							<div class="one columns"><?php echo $this->Form->input('target__'.$item->id, 'Target', array('type' => 'yesno', 'value' => $item->target)); ?></div>
							<div class="two columns"><?php echo $this->Form->select('parent_id__'.$item->id, 'Parent', $itemsAssoc, array('focus' => $item->parent_id)); ?></div>
							<div class="one columns"><a onclick="return confirm('You will delete this item, continue?');" href="<?php echo Router::url('admin/menu/delete/item/'.$item->id); ?>" class="button tiny alert">Delete</a></div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php echo $this->Form->input('menu_order', 'hidden', array('value' => $itemsOrder)); ?>

			<div class="actions">
				<input type="reset" class="button alert left menu-sortable-reset" value="Reset">
				<input type="submit" class="button right" value="Validate" >
			</div>
		</form>
	</div><!-- end of content -->
</section>

