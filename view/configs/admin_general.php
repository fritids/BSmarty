<section class="options general edit">
	<header><!-- header -->
        <h1>General Options</h1>
    </header><!-- end of header --> 
    <div class="content"><!-- content -->
    	<?php
			foreach($data as $k=>$v):
		?>
			<section>
				<h3><?php echo $v->name; ?></h3>
				<form action="<?php echo Router::url('admin/configs/general/'); ?>" method="post" >
					
					<?php echo $this->Form->input('id', 'hidden', array('value' => $v->id)); ?>
					<?php echo $this->Form->input('name', 'hidden', array('value' => $v->name)); ?>
					<?php echo $this->Form->input('value', 'Value', array('value' => $v->value)); ?>
					<?php echo $this->Form->input('slug', 'Slug', array('value' => $v->slug)); ?>
					<?php echo $this->Form->input('category', 'Category', array('value' => $v->category)); ?>
					<div class="actions">
						<input type="submit" class="button" value="Validate" >
					</div>
				</form>
			</section>
		<?php
			endforeach;
		?>
    </div><!-- end of content -->
</section>