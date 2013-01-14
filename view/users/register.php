<section class="users register">
	<header><!-- header -->
		<h1>User edit</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<form action="<?php echo Router::url('users/register/'); ?>" method="post" >
			<div class="row">
				<div class="six columns">
					<?php echo $this->Form->input('login', 'Login'); ?>
					<?php echo $this->Form->input('name', 'Name'); ?>
					<?php echo $this->Form->input('firstname', 'Firstname'); ?>					
				</div>
				<div class="six columns">
					<?php echo $this->Form->input('email', 'Email', array('placeholder' => 'nicename@host.com')); ?>
					<?php echo $this->Form->input('password', 'Password', array('type' => 'password')); ?>

					<?php echo $this->Form->input('password_confirm', 'Password confirmation', array('type' => 'password')); ?>
					<div class="actions">
						<input type="submit" class="button" value="Validate" >
					</div>
				</div>
			</div>
		</form>	
	</div><!-- end of content -->
</section>
