<section class="categories edit">
	<header><!-- header -->
		<h1>Category edit</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<form action="<?php echo Router::url('admin/categories/edit/' . $id); ?>" method="post" >
			<?php echo $this->Form->input('name', 'Title'); ?>
			<?php echo $this->Form->input('slug', 'Slug'); ?>
			<?php echo $this->Form->input('id', 'hidden'); ?>
			<?php echo $this->Form->input('type', 'Type'); ?>
			<div class="actions">
				<input type="submit" class="button" value="Validate" >
			</div>
		</form>
	</div><!-- end of content -->
</section>


