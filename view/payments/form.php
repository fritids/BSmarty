<?php $title_for_layout = 'Payments'; ?>
<section class="payment form">
    <header><!-- header -->
        <h1>Payment Form</h1>
    </header><!-- end of header --> 
    <div class="content"><!-- content -->
    	<form action="<?php echo Router::url('payments/checkout'); ?>" method="post">
            <?php //debug($customer); ?>
    		<p>Some informations about yourself:</p>
    		<ul>
    			<li>Name: <?php echo $customer->patronyme.' '.$customer->prenom.' '.$customer->nom; ?></li>
    			<li>Email: <?php echo $customer->email; ?></li>
    			<li>Price: <?php echo $customer->mtfacture; ?> €</li>
    		</ul>

    		<hr>

    		<div class="step1">
    			<?php echo $this->Form->input('fastpayment', 'I want fast payment:', array('type' => 'yesno')); ?>	
    		</div>

    		<hr>

    		<div class="step2 disable">
    			<?php echo $this->Form->input('health', 'The person is insured:', array('type' => 'yesno')); ?>	
    		</div>

    		<hr>

            <div class="step3 disable">
                <input type="hidden" name="email" value="<?php echo $customer->email; ?>">
                <input type="hidden" name="customerkey" value="<?php echo $customer->clepatient; ?>">
                <input type="hidden" name="amount" value="<?php echo $customer->mtfacture; ?>">
                <input type="hidden" name="folderid" value="<?php echo $customer->identfacture; ?>">
                <input type="hidden" name="name" value="<?php echo $customer->nom; ?>">
                <input type="hidden" name="firstname" value="<?php echo $customer->prenom; ?>">
                <?php // echo $this->Form->input('folderid', 'Folder ID *', array('value' => $customer->identfacture, 'disabled' => '')); ?>
                <?php // echo $this->Form->input('name', 'Name *', array('value' => $customer->nom, 'disabled' => '')); ?>
                <?php // echo $this->Form->input('firstname', 'First name *', array('value' => $customer->prenom, 'disabled' => '')); ?> 
                <?php // echo $this->Form->input('amount', 'Amount *', array('value' => $customer->mtfacture, 'disabled' => '')); ?> 
                <?php echo $this->Form->input('birthday', 'Birthday *', array('value' => $customer->datnaissance, 'class' => 'datepicker')); ?> 
                <?php echo $this->Form->input('insuranceid', 'Insurance ID *'); ?>
                <?php echo $this->Form->select('insurancezipcode', 'Insurance zipcode *', $insurances['zipcodes']); ?>
                <?php echo $this->Form->select('insurancelabel', 'Insurance name *', $insurances['labels']); ?>
                <?php echo $this->Form->input('twinrow', 'Twin row', array('value'=> '1', 'required' => '')); ?> 
            </div>

            <div class="action">
                <input type="submit" class="button" value="Validate" >
            </div>
    	</form>
    </div><!-- end of content -->
</section>