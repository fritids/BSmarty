<h1>Contact</h1>
<div class="row">
	<iframe width="960" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=Google+France,+Avenue+de+l'Op%C3%A9ra,+Paris,+France&amp;aq=0&amp;oq=google+Paris,+France&amp;sll=48.856614,2.352222&amp;sspn=0.161058,0.41851&amp;vpsrc=6&amp;g=Paris,+France&amp;ie=UTF8&amp;hq=&amp;hnear=Google+France,+38+Avenue+de+l'Op%C3%A9ra,+75002+Paris,+France&amp;ll=48.869903,2.332856&amp;spn=0.002516,0.006539&amp;t=h&amp;z=14&amp;output=embed"></iframe>
</div>

<div class="spacer"></div>

<div class="row">
	<div class="span9">
		<h2>	Testimonial</h2>
		<blockquote>
		    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
		    <small>Dr. Julius Hibbert</small>
	    </blockquote>
	</div>
	<div class="span7">
		<h2>Addresses</h2>
		<div class="row">
			<div class="span4">
				<address>
					<strong>Twitter, Inc.</strong><br />
					795 Folsom Ave, Suite 600<br />
					San Francisco, CA 94107<br />
					P: (123) 456-7890
				</address>
			</div>
			<div class="span3">
				<address>
		            <strong>Benjamin Cabanes</strong><br>
		            <a mailto="">first.last@gmail.com</a>
	            </address>
			</div>
		</div>
	</div>
</div>

<hr>
<div class="row">
	<h2>Formulaire</h2>
	<div class="spacer"></div>
	<form action="<?php echo Router::url('contact/index'); ?>" method="post" >
		<?php echo $this->Form->input('name', 'Nom*'); ?>
		<?php echo $this->Form->input('email', 'Adresse email*'); ?>
	    <?php echo $this->Form->input('subject', 'Sujet*'); ?>
		<?php echo $this->Form->input('message', 'Message*', array('class' => 'xxlarge wysiwyg', 'type' => 'texarea', 'rows' => 5)); ?>
		<div class="QapTcha"></div>
		<div class="actions">
			<input type="submit" class="btn primary" value="Envoyer" >
		</div>
	</form>
</div>
