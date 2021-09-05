(function ($) {
 "use strict";
 
		$("#adminpro-form").validate(
		{					
			rules:
			{	
				usuario:
				{
					required: true,
					email: true
				},
				password:
				{
					required: true,
					minlength: 3,
					maxlength: 20
				}
                                
			},
			messages:
			{	
				usuario:
				{
					required: 'Por Favor digite um e-mail',
					email: 'Por Favor digite um email VALIDO!'
				},
				password:
				{
					required: 'Por Favor digite o password'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	
        $("#cpf-form").validate(
		{					
			rules:
			{	
				cpf:
				{
					required: true,
                                        minlength: 11,
					maxlength: 14
				}
                                
			},
			messages:
			{	
				cpf:
				{
					required: 'Por Favor digite um cpf',
				}
				
			},					
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	
	// Validation for Register form
		$("#registro_form").validate(
		{					
			rules:
			{	
				nome:
				{
					required: true
				},
                                
                                sobrenome:
				{
					required: true
				},
                                
				email:
				{
					required: true,
					email: true
				},
				password:
				{
					required: true,
					minlength: 3,
					maxlength: 20
				},
				confirme_password:
				{
					required: true,
					minlength: 3,
					maxlength: 20
				}
			},
			messages:
			{	
				nome:
				{
					required: 'Digite um nome'
				},
                                
                                sobrenome:
				{
					required: 'Digite um Sobrenome'
				},
				email:
				{
					required: 'Escreva um email cabeça!',
					email: 'Digite um email valido'
				},
				password:
				{
					required: 'Por favor o Password'
				},
				confirme_password:
				{
					required: 'Por favor confirme o Password'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for Contact form
		$("#adminpro-contact-form").validate(
		{					
			rules:
			{	
				email:
				{
					required: true,
					email: true
				},
				subject:
				{
					required: true
				},
				message:
				{
					required: true
				}
			},
			messages:
			{	
				email:
				{
					required: 'Please enter your email address',
					email: 'Digite um email Valido'
				},
				subject:
				{
					required: 'Please enter your subject'
				},
				message:
				{
					required: 'Please enter your message'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for Comment form
		$("#adminpro-comment-form").validate(
		{					
			rules:
			{	
				name:
				{
					required: true
				},
				email:
				{
					required: true,
					email: true
				},
				phone:
				{
					required: true
				},
				website:
				{
					required: true
				},
				comment:
				{
					required: true
				}
			},
			messages:
			{	
				name:
				{
					required: 'Please enter your full name'
				},
				email:
				{
					required: 'Please enter your email address',
					email: 'Digite um email Valido'
				},
				phone:
				{
					required: 'Please enter phone number'
				},
				website:
				{
					required: 'Please enter your website'
				},
				comment:
				{
					required: 'Please enter description'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for review form
		$("#adminpro-review-form").validate(
		{					
			rules:
			{	
				name:
				{
					required: true
				},
				email:
				{
					required: true,
					email: true
				},
				subject:
				{
					required: true
				},
				review:
				{
					required: true
				}
			},
			messages:
			{	
				name:
				{
					required: 'Please enter your full name'
				},
				email:
				{
					required: 'Please enter your email address',
					email: 'Digite um email valido'
				},
				subject:
				{
					required: 'Please enter your subject'
				},
				review:
				{
					required: 'Please enter your review text'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for masking form
		$("#campanha").validate(
		{					
			rules:
			{	
				nome_camp:
				{
					required: true
				},
				bancos:
				{
					required: true
				}
                                
				
			},
			messages:
			{	
				nome_camp:
				{
					required: 'Coloque o Nome da Camapanha'
				},
				bancos:
				{
					required: 'Escolha Um ou mais bancos'
				}
                                
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
                
                $("#campanhaCpf").validate(
		{					
			rules:
			{	
				nome_camp_cpf:
				{
					required: true
				},
                                dados_input:
				{
					required: true
				}

			},
			messages:
			{	
				nome_camp_cpf:
				{
					required: 'Coloque o Nome da Camapanha'
				},
                                dados_input:
				{
					required: 'Escolha Um arquivo'
				}
				
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for checkout form
		$("#adminpro-checkout-form").validate(
		{					
			rules:
			{	
				firstname:
				{
					required: true
				},
				lastname:
				{
					required: true
				},
				email:
				{
					required: true,
					email: true
				},
				phone:
				{
					required: true
				},
				address:
				{
					required: true
				},
				interested:
				{
					required: true
				},
				city:
				{
					required: true
				},
				interestedbd:
				{
					required: true
				},
				cartname:
				{
					required: true
				},
				cardnumber:
				{
					required: true
				},
				cvv2:
				{
					required: true
				},
				finish:
				{
					required: true
				}
			},
			messages:
			{	
				firstname:
				{
					required: 'Please enter first name'
				},
				lastname:
				{
					required: 'Please enter last name'
				},
				email:
				{
					required: 'Please enter your email address',
					email: 'DIgite um email Valido'
				},
				phone:
				{
					required: 'Please enter your phone number'
				},
				address:
				{
					required: 'Please enter your address'
				},
				interested:
				{
					required: 'Please select your country'
				},
				city:
				{
					required: 'Please enter your city'
				},
				interestedbd:
				{
					required: 'Please select your Budgets'
				},
				cartname:
				{
					required: 'Please enter your cartname'
				},
				cardnumber:
				{
					required: 'Please enter your card number'
				},
				cvv2:
				{
					required: 'Please enter your cvv2 number'
				},
				finish:
				{
					required: 'Please select expired date'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for order form
		$("#adminpro-order-form").validate(
		{					
			rules:
			{	
				fullname:
				{
					required: true
				},
				email:
				{
					required: true,
					email: true
				},
				phone:
				{
					required: true
				},
				companyname:
				{
					required: true
				},
				start:
				{
					required: true
				},
				finish:
				{
					required: true
				},
				interestedcategory:
				{
					required: true
				},
				interestedbudget:
				{
					required: true
				},
				cardnumber:
				{
					required: true
				},
				cvv2:
				{
					required: true
				},
				finish:
				{
					required: true
				}
			},
			messages:
			{	
				fullname:
				{
					required: 'Please enter full name'
				},
				email:
				{
					required: 'Please enter your email address',
					email: 'Digite um email Valido'
				},
				phone:
				{
					required: 'Please enter your phone number'
				},
				companyname:
				{
					required: 'Please enter your company name'
				},
				start:
				{
					required: 'Please select your start date'
				},
				finish:
				{
					required: 'Please enter your end date'
				},
				interestedcategory:
				{
					required: 'Please select category'
				},
				interestedbudget:
				{
					required: 'Please enter your budgets'
				},
				cardnumber:
				{
					required: 'Please enter your card number'
				},
				cvv2:
				{
					required: 'Please enter your cvv2 number'
				},
				finish:
				{
					required: 'Please select expired date'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
	// Validation for captcha form
		$("#adminpro-captcha-form").validate(
		{					
			rules:
			{	
				captcha:
				{
					required: true
				}
			},
			messages:
			{	
				captcha:
				{
					required: 'Please enter captcha'
				}
			},					
			
			errorPlacement: function(error, element)
			{
				error.insertAfter(element.parent());
			}
		});
		
 
})(jQuery); 