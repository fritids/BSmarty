<?php $title_for_layout = 'Payments'; ?>

<section class="payment index">
	<header>
		<h1>Online payment</h1>
	</header>
	
	<div class="content">
			
		<form action="<?php echo Router::url('payments/form'); ?>" method="post" class="four">
			<?php echo $this->Form->input('folderid', 'Folder ID *'); ?>
			<?php echo $this->Form->input('name', 'Name *'/*, array('onblur' => 'this.value=this.value.toUpperCase()')*/); ?>
			<?php echo $this->Form->input('email', 'Email *', array('type' => 'email')); ?>

			<div class="actions">
				<input type="submit" class="button" value="Validate" >
			</div>
		</form>

	</div>
</section>