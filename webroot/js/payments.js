/* --- Payment form --- */
jQuery(document).ready(function() { 

    /* Set some variables */
    var stepsForm  = $('section.payment.form');
	var step1 = stepsForm.find('.step1'),
		step2 = stepsForm.find('.step2'),
		step3 = stepsForm.find('.step3');

	/* Disable all step >1 */
	stepsForm.find('.disable').hide();

	/* First interaction : Payment Fast */
	$('input[type="radio"][name="fastpayment"]').on('change', function(){
		if($(this).val() == 1){ // The customer wants to pay rapidly
			step2.slideDown(500).removeClass('disable'); // Show the step2 form
		}else{
			if(!step2.hasClass('disable')) { step2.slideUp(500).addClass('disable').find('input[type="radio"][value="0"]').attr('checked', 'checked'); }
			if(!step3.hasClass('disable')) { step3.slideUp(500).addClass('disable'); }
			step3.find('input[name="birthday"]').removeAttr('required');
			step3.find('input[name="insuranceid"]').removeAttr('required');
		}
	});

	/* Second interaction : Is the person insured? */
	$('input[type="radio"][name="health"]').on('change', function(){
		if($(this).val() == 1){ // The person is insured
			step3.slideDown(500).removeClass('disable'); // Show step3 form
			step3.find('input[name="birthday"]').attr('required', '');
			step3.find('input[name="insuranceid"]').attr('required', '');
		}else{
			if(!step3.hasClass('disable')) { step3.slideUp(500).addClass('disable'); }
			step3.find('input[name="birthday"]').removeAttr('required');
			step3.find('input[name="insuranceid"]').removeAttr('required');
		}
	});

	$('select[name="insurancezipcode"]').on('change', function(){
		console.log(document.location.hostname);

		var selected = $(this).val();

		console.log(selected);

		var target = $('select[name="insurancelabel"]');
		target.html();
		target.load('get_labels/'+selected);

	});



});