<section class="users edit">
	<header><!-- header -->
		<h1>User edit</h1>
	</header><!-- end of header -->
	<div class="content"><!-- content -->
		<form action="<?php echo Router::url('admin/users/edit/' . $id); ?>" method="post" >
			<?php echo $this->Form->input('id', 'hidden'); ?>
			<div class="row">
				<div class="six columns">
					<?php echo $this->Form->input('login', 'Login'); ?>
					<?php echo $this->Form->input('name', 'Name'); ?>
					<?php echo $this->Form->input('firstname', 'Firstname'); ?>					
				</div>
				<div class="six columns">
					<?php echo $this->Form->input('email', 'Email', array('placeholder' => 'nicename@host.com')); ?>
					<?php echo $this->Form->input('password', 'Password', array('type' => 'password', 'value' => '')); ?>
					<?php echo $this->Form->input('password_confirm', 'Password confirmation', array('type' => 'password', 'value' => '')); ?>
					<?php 
						if($this->User->is_admin()){
							echo $this->Form->input('created', 'Created', array('type' => 'datetime', 'class' => 'datepicker'));
							echo $this->Form->select('role', 'Role', $role_available, $role);
							echo $this->Form->select('status', 'Status', $status_available, $status);
						}
					?>
					<div class="actions">
						<input type="submit" class="button" value="Validate" >
					</div>
				</div>
			</div>
		</form>	
	</div><!-- end of content -->
</section>


