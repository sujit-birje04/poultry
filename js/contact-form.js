jQuery(document).ready(function($) {	
	var focusColor = "#169fe6";
	var labelError = { "color" : "#fff", "background" :"#ff4444" };
	var formError = { "border-color" : "#ff4444" };

	var contactForm = $('.contact-form');

	$('#buttonsend').click( function() {

		var name    = $('.contact-form #name').val();
		var subject = $('.contact-form #subject').val();
		var email   = $('.contact-form #email').val();
		var message = $('.contact-form #message').val();

		$('.loading').css('display','inline-block').fadeIn('slow');

		if (name != "" && subject != "" && email != "" && message != "") {

			$.ajax({
				url: 'sendemail.php',
				type: 'POST',
				data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message,
				success: function(result) {
					$('.loading').fadeOut('fast');
					
					console.log(result);
					
					if(result == "email_error") {
						$('#email').css(formError).next('.require').text(' !');
						$('label[for="email"]').css(labelError);
					} else {
						$('#name, #subject, #email, #message').val("","Name","Subject","Email","Message");
						$('.success-contact').fadeIn();
						$('.success-contact').fadeOut(5000, function(){ $(this).remove(); });
					}
				}
			});

			return false;

		} else {
			$('.loading').fadeOut('slow');

			if(name <= 0) {
				contactForm.find("#name").parent('.form-group').addClass('has-danger');
			} else {
				contactForm.find("#name").parent('.form-group').removeClass('has-danger');
			}

			if(subject <= 0) {
				contactForm.find("#subject").parent('.form-group').addClass('has-danger');
			} else {
				contactForm.find("#subject").parent('.form-group').removeClass('has-danger');
			}

			if(email <= 0) {
				contactForm.find("#email").parent('.form-group').addClass('has-danger');
			} else {
				contactForm.find("#email").parent('.form-group').removeClass('has-danger');
			}

			if(message <= 0) {
				contactForm.find("#message").parent('.form-group').addClass('has-danger');
			} else {
				contactForm.find("#message").parent('.form-group').removeClass('has-danger');
			}

			return false;
		}
	});
		
	$("#name, #subject, #email, #message").focus(function() {
		$(this).parent('.form-group').removeClass('has-danger');
	}).blur(function() {
		$(this).parent('.form-group').removeClass('has-danger');
	});      	
});