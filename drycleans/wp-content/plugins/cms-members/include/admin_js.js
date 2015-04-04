jQuery(document).ready(function() {
				jQuery('#free_members_welcome_mail_div').hide();
				jQuery('#paid_members_welcome_mail_div').hide();
				jQuery('#pay_per_post_mail_div').hide();
				jQuery('#verify_mail_div').hide();
				jQuery('#recap-div').hide();
				jQuery('#discount-div').hide();
				jQuery('#fieldoptions').hide();
				jQuery('#field-type-label').hide();
				jQuery('#field-type-comment').hide();
				jQuery('#rec-div').hide();
				jQuery('#aweber-div').hide();
				
			if ((jQuery('#fieldtype').attr('value')=='dropdown')||(jQuery('#fieldtype').attr('value')=='radio')||(jQuery('#fieldtype').attr('value')=='checkbox')) {
				 jQuery('#fieldoptions').show();
				 jQuery('#field-type-label').hide();
			}
			 
			if ((jQuery('#fieldtype').attr('value')=='file') ) {
				 jQuery('#fieldoptions').show();
				 jQuery('#field-type-label').show();
				 jQuery('#options-label').hide();
			}
				
			jQuery('#showcodes').click(function() {
			if(jQuery('#discount-div').is(':hidden'))
				jQuery('#discount-div').show();
			else
				jQuery('#discount-div').hide();
			return true;
			});
			jQuery('#free_members_welcome_mail').change(function() {
			if(jQuery('#free_members_welcome_mail').attr('checked'))
				jQuery('#free_members_welcome_mail_div').show();
			else
				jQuery('#free_members_welcome_mail_div').hide();
			return true;
			});
			jQuery('#paid_members_welcome_mail').change(function() {
			if(jQuery('#paid_members_welcome_mail').attr('checked'))
				jQuery('#paid_members_welcome_mail_div').show();
			else
				jQuery('#paid_members_welcome_mail_div').hide();
			return true;
			});
			jQuery('#pay_per_post_mail').change(function() {
			if(jQuery('#pay_per_post_mail').attr('checked'))
				jQuery('#pay_per_post_mail_div').show();
			else
				jQuery('#pay_per_post_mail_div').hide();
			return true;
			});
			
			jQuery('#verify_mail').change(function() {
			if(jQuery('#verify_mail').attr('checked'))
				jQuery('#verify_mail_div').show();
			else
				jQuery('#verify_mail_div').hide();
			return true;
			});
			
			jQuery('#aweber').change(function() {
			if(jQuery('#aweber').attr('checked'))
				jQuery('#aweber-div').show();
			else
				jQuery('#aweber-div').hide();
			return true;
			});
			
			jQuery('#rec').change(function() {
			if(jQuery('#rec').attr('checked'))
				jQuery('#rec-div').show();
			else
				jQuery('#rec-div').hide();
			return true;
			});
			
			jQuery('#recap').change(function() {
			if(jQuery('#recap').attr('value')=='recap')
				jQuery('#recap-div').show();
			return true;
			});
				jQuery('#fieldtype').change(function() {
			if( (jQuery('#fieldtype').attr('value')=='radio') ||(jQuery('#fieldtype').attr('value')=='dropdown')|| (jQuery('#fieldtype').attr('value')=='file') || (jQuery('#fieldtype').attr('value')=='checkbox') )
				jQuery('#fieldoptions').show();
			return true;
			});
				jQuery('#fieldtype').change(function() {
			if( (jQuery('#fieldtype').attr('value')=='text') ||(jQuery('#fieldtype').attr('value')=='textarea') )
				jQuery('#fieldoptions').hide();
			return true;
			});
				jQuery('#fieldtype').change(function() {
			if( (jQuery('#fieldtype').attr('value')=='file') ){
				jQuery('#options-label').hide();
				jQuery('#options-comment').hide();
				jQuery('#field-type-label').show();
				jQuery('#field-type-comment').show();
				}
			return true;
			});
			
				jQuery('#fieldtype').change(function() {
			if( (jQuery('#fieldtype').attr('value')!=='file') ){
				jQuery('#field-type-label').hide();
				jQuery('#field-type-comment').hide();
				jQuery('#options-label').show();
				jQuery('#options-comment').show();
				
				}
			return true;
			});
			
			
			jQuery('#wwm_cap_type').change(function() {
			if(jQuery('#wwm_cap_type').attr('value')!=='recap')
				jQuery('#recap-div').hide()
			return true;
			});
			;
			
			jQuery('#form_templates').change(function() {
			if( (jQuery('#form_templates').attr('value')=='default') ){
				jQuery('#wwm_custom_css').val(" /* Default Template */ \n .wwm-star{color:#ff9900}#wwm-submit {width:110px;}.wwm_register_page{padding:5px;}#wwm-members-form{text-align:left;}.wwm_register_page form{padding:5px;} \n .wwm_register_page small {color:#888888;}.wwm_register_page textarea{width:400px;height:140px;} \n #wwm-email,#wwm-address,#wwm-address2,#wwm-url,#wwm-country{width:200px}.wwm-avatar-img {float:right;border:2px solid #ccc ;padding:3px;}\n #wwm_captcha_img{border:1px solid #ccc;padding:1px;margin:3px;margin-top:8px}.wwm-thanksmessage{border:1px solid #FFCC66;color:green;background:#ffffcc;padding:5px;margin:3px;}\n .wwm-errormessage, .limited{border:1px solid #FFCC66;background:#ffffcc;padding:5px;margin:3px;color:red;line-height:18px}.field p {margin:5px;} .field{margin-bottom:2px; padding:5px;padding:10px;}.wwm_buyitform{text-align:left}");
			}
			
			if ( (jQuery('#form_templates').attr('value')=='blue') ){
				jQuery('#wwm_custom_css').val(" /* Light Blue Template */  \n .wwm-star{color:#ff9900;font-size:13px;} #wwm-submit {width:110px;border:none;background:#0066CC;padding:5px;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;color:#eee;border:2px solid #ccc} \n .wwm_register_page {padding:5px;} #wwm-members-form{text-align:left;background:#DAEAFE;-moz-border-radius:8px;-khtml-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;padding:10px;}.wwm_register_page form{padding:5px;}.wwm_register_page small {color:#888888;}.wwm_register_page textarea{width:400px;height:140px;} \n #wwm-email,#wwm-address,#wwm-address2,#wwm-url,#wwm-country{width:200px} \n .wwm-avatar-img {float:right;border:2px solid #ccc ;padding:3px;} #wwm_captcha_img{border:1px solid #ccc;padding:1px;margin:3px;margin-top:8px}.wwm-thanksmessage{border:1px solid #999;color:green;background:#DAEAFE;padding:5px;margin:3px;} \n .wwm-errormessage , .limited{border:1px solid #e5e5e5;background:#DAEAFE;padding:5px;margin:3px;color:red;line-height:18px}.field{background:#E6EEFF;margin-bottom:5px; padding:5px;border:1px solid #eee;-moz-border-radius:8px;-khtml-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;padding:10px;}.field label {font-size:13px;color:#333;} \n .field p {margin:5px;}#wwm-members-form input[type=text], #wwm-members-form input[type=password]{width:180px;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;}.wwm_buyitform{text-align:left}");
			}
			
			if ( (jQuery('#form_templates').attr('value')=='web20') ){
				jQuery('#wwm_custom_css').val(" /* Web 20 Template*/ \n .wwm-star{color:#ff9900;font-size:15px;} #wwm-submit {width:110px;border:none;background:#0066CC;padding:5px;-moz-border-radius:4px;color:#eee;border:2px solid #ccc}.wwm_register_page{padding:5px;} \n #wwm-members-form{text-align:left;font-size:12px;}.wwm_register_page form{padding:5px;}.wwm_register_page small {color:#888888;} \n .wwm_register_page textarea{width:400px;height:140px;} \n #wwm-email,#wwm-address,#wwm-address2,#wwm-url,#wwm-country{width:200px}.wwm-avatar-img {float:right;border:2px solid #ccc ;padding:3px;}#wwm_captcha_img{border:1px solid #ccc;padding:1px;margin:3px;margin-top:8px}.wwm-thanksmessage{border:1px solid #FFCC66;color:green;background:#ffffcc;padding:5px;margin:3px;}\n .wwm-errormessage , .limited{border:1px solid #FFCC66;background:#ffffcc;padding:5px;margin:3px;color:red;line-height:18px}.field{margin-bottom:5px; padding:5px;color:#555}.field p {margin:5px;}.field label{font-size:14px;}#post_title{width:400px} \n#wwm-members-form label{color:#555} \n #wwm-members-form input[type=text], #wwm-members-form input[type=password]{background:url(wp-admin/wp-content/mu-plugins/cms-members/include/input.png) repeat-x;width:180px;border:1px solid #ccc;padding:5px;font-size:120%;-moz-border-radius:8px;-khtml-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;}#wwm-members-form input[type=text]:focus, #wwm-members-form input[type=password]:focus{background:#ffffcc;border-color:#ffcc00;}\nselect{padding:3px;border:1px solid #ccc;};-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;}.wwm_buyitform{text-align:left}");
			}
			
			if ( (jQuery('#form_templates').attr('value')=='red') ){
				jQuery('#wwm_custom_css').val(" /* Red Form*/ \n .wwm-star{color:#ff9900;font-size:18px;} \n #wwm-submit {width:110px;border:1px solid #ccc;background:#FF6600;color:#fff;padding:8px;-moz-border-radius:18px;-khtml-border-radius:18px;-webkit-border-radius:18px;border-radius:18px;}.wwm_register_page{padding:5px;}#wwm-members-form{text-align:left;color:#ffffcc;background:#9F2311;-moz-border-radius:8px;-khtml-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;padding:10px;} \n.wwm_register_page form{padding:5px;} .wwm_register_page small {color:#ddd;} \n .wwm_register_page textarea{width:400px;height:140px;} \n #wwm-email,#wwm-address,#wwm-address2,#wwm-url,#wwm-country{width:200px} .wwm-avatar-img {float:right;border:2px solid #ccc ;padding:3px;} #wwm_captcha_img{border:1px solid #ccc;padding:1px;margin:3px;margin-top:8px} \n .wwm-thanksmessage{border:1px solid #FFCC66;color:green;background:#ffffcc;padding:5px;margin:3px;} \n .wwm-errormessage,.limited {border:1px solid #FFCC66;background:#ffffcc;padding:5px;margin:3px;color:red;line-height:18px} \n .field p {margin:5px;} .field{border-bottom:1px solid #999;margin-bottom:3px;padding:5px;padding:7px;}label{font-size:14px;}.wwm_buyitform{text-align:left}");
			}
			
			
			if ( (jQuery('#form_templates').attr('value')=='dark') ){
				jQuery('#wwm_custom_css').val(" /* Dark Form*/ \n .wwm-star{color:#ff9900;font-size:14px;}#wwm-submit {width:110px;border:1px solid #666;background:#FF6633;color:#fff;padding:8px;-moz-border-radius:18px;-khtml-border-radius:18px;-webkit-border-radius:18px;border-radius:18px;}.wwm_register_page{padding:5px;} \n #wwm-members-form{text-align:left;color:#fff;background:#555;-moz-border-radius:8px;-khtml-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;padding:10px;} .wwm_register_page form{padding:5px;}\n .wwm_register_page small {color:#ddd;} .wwm_register_page textarea{width:400px;height:140px;} #wwm-email,#wwm-address,#wwm-address2,#wwm-url,#wwm-country{width:200px} \n .wwm-avatar-img {float:right;border:2px solid #ccc ;padding:3px;} #wwm_captcha_img{border:1px solid #ccc;padding:1px;margin:3px;margin-top:8px} .wwm-thanksmessage{border:1px solid #FFCC66;color:green;background:#ffffcc;padding:5px;margin:3px;} \n .wwm-errormessage,.limited {border:1px solid #FFCC66;background:#ffffcc;padding:5px;margin:3px;color:red;line-height:18px} \n .field p {margin:5px;} .field{border-bottom:3px solid #666;margin-bottom:3px;padding:5px;padding:7px;}.field label{font-size:12px;font-weight:bold;}.field p label {font-weight:normal;}.wwm_buyitform{text-align:left}");
			}
			
			return true;
			});
			
			
		});