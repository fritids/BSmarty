<section class="users login">
    <header><!-- header -->
        <h1>User login</h1>
    </header><!-- end of header --> 
    <div class="content"><!-- content -->
    	<form action="<?php echo Router::url('users/login'); ?>" method="post" class="four">
			<?php echo $this->Form->input('login', 'Login', array('required' => '')); ?>
			<?php echo $this->Form->input('password', 'Password', array('type' => 'password', 'required' => '')); ?>
			<div class="actions">
				<input type="submit" class="button" value="Login"> or
				<a href="<?php echo Router::url('users/register/'); ?>" class="button">Register</a>
			</div>
			<p><a href="<?php echo Router::url(''); ?>" title="Back to the website">Back to the website.</a></p>
		</form>
    </div><!-- end of content -->
</section>
