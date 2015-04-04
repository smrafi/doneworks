<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   
 * ***************************************************************************** */
?>
<div class="registration">

	<form id="member-registration" action="/tellmemd/index.php/component/users/?task=registration.register" method="post" class="form-validate">
            
	            7			<fieldset>
					<legend>User Registration</legend>
					<dl>
									<dt>
				<span class="spacer"><span class="before"></span><span class="text"><label id="jform_spacer-lbl" class=""><strong class="red">*</strong> Required field</label></span><span class="after"></span></span>								</dt>

				<dd> </dd>
												<dt>
				<label id="jform_name-lbl" for="jform_name" class="hasTip required" title="Name::Enter your full name">Name:<span class="star">&#160;*</span></label>								</dt>
				<dd><input type="text" name="jform[name]" id="jform_name" value="" class="required" size="30"/></dd>
												<dt>
				<label id="jform_username-lbl" for="jform_username" class="hasTip required" title="Username::Enter your desired user name">Username:<span class="star">&#160;*</span></label>								</dt>

				<dd><input type="text" name="jform[username]" id="jform_username" value="" class="validate-username required" size="30"/></dd>
												<dt>
				<label id="jform_password1-lbl" for="jform_password1" class="hasTip required" title="Password::Enter your desired password - Enter a minimum of 4 characters">Password:<span class="star">&#160;*</span></label>								</dt>
				<dd><input type="password" name="jform[password1]" id="jform_password1" value="" autocomplete="off" class="validate-password required" size="30"/></dd>
												<dt>
				<label id="jform_password2-lbl" for="jform_password2" class="hasTip required" title="Confirm Password::Confirm your password">Confirm Password:<span class="star">&#160;*</span></label>								</dt>

				<dd><input type="password" name="jform[password2]" id="jform_password2" value="" autocomplete="off" class="validate-password required" size="30"/></dd>
												<dt>
				<label id="jform_email1-lbl" for="jform_email1" class="hasTip required" title="Email Address::Enter your email address">Email Address:<span class="star">&#160;*</span></label>								</dt>
				<dd><input type="text" name="jform[email1]" class="validate-email required" id="jform_email1" value="" size="30"/></dd>
												<dt>
				<label id="jform_email2-lbl" for="jform_email2" class="hasTip required" title="Confirm email Address::Confirm your email address">Confirm email Address:<span class="star">&#160;*</span></label>								</dt>

				<dd><input type="text" name="jform[email2]" class="validate-email required" id="jform_email2" value="" size="30"/></dd>
								</dl>
		</fieldset>
	            
	            20			<fieldset>
					<legend>User Profile</legend>
					<dl>
									<dt>
				<label id="jform_profile_title-lbl" for="jform_profile_title" class="hasTip" title="Title::Title of the user">Title</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><select id="jform_profile_title" name="jform[profile][title]">
	<option value="0">Select Title</option>
	<option value="1">Mr.</option>
	<option value="2">Ms.</option>
	<option value="3">Mrs.</option>
</select>

</dd>
												<dt>
				<label id="jform_profile_first_name-lbl" for="jform_profile_first_name" class="hasTip" title="First Name::First Name of the user">First Name</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][first_name]" id="jform_profile_first_name" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_last_name-lbl" for="jform_profile_last_name" class="hasTip" title="Last Name::Last Name of the user">Last Name</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><input type="text" name="jform[profile][last_name]" id="jform_profile_last_name" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_other_name-lbl" for="jform_profile_other_name" class="hasTip" title="Other Name::Other Name of the user">Other Name</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][other_name]" id="jform_profile_other_name" value="" size="30"/></dd>
												<dt>

				<label id="jform_profile_gender-lbl" for="jform_profile_gender" class="hasTip" title="Gender::Gender of the user">Gender</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><select id="jform_profile_gender" name="jform[profile][gender]">
	<option value="0">Select Gender</option>
	<option value="1">Male</option>
	<option value="2">Female</option>

</select>
</dd>
												<dt>
				<label id="jform_profile_nationality-lbl" for="jform_profile_nationality" class="hasTip" title="Nationality::Nationality of the user">Nationality</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][nationality]" id="jform_profile_nationality" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_martial_status-lbl" for="jform_profile_martial_status" class="hasTip" title="Martial Status::Martial status of the user">Martial Status</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><select id="jform_profile_martial_status" name="jform[profile][martial_status]">
	<option value="0">Select status</option>
	<option value="1">Single</option>
	<option value="2">Married</option>
</select>
</dd>
												<dt>

				<label id="jform_profile_date_birth-lbl" for="jform_profile_date_birth" class="hasTip" title="Date of Birth::Choose an option for the field Date of Birth">Date of Birth:</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" title="" name="jform[profile][date_birth]" id="jform_profile_date_birth" value=""  /><img src="/tellmemd/templates/beez_20/images/system/calendar.png" alt="Calendar" class="calendar" id="jform_profile_date_birth_img" /></dd>
												<dt>
				<label id="jform_profile_address1-lbl" for="jform_profile_address1" class="hasTip" title="Address 1::Choose an option for the field Address1">Address 1:</label>									<span class="optional">(optional)</span>
								</dt>

				<dd><input type="text" name="jform[profile][address1]" id="jform_profile_address1" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_address2-lbl" for="jform_profile_address2" class="hasTip" title="Address 2::Choose an option for the field Address2">Address 2:</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][address2]" id="jform_profile_address2" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_city-lbl" for="jform_profile_city" class="hasTip" title="City::Choose an option for the field City">City:</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><input type="text" name="jform[profile][city]" id="jform_profile_city" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_region-lbl" for="jform_profile_region" class="hasTip" title="Region::Choose an option for the field Region">Region:</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][region]" id="jform_profile_region" value="" size="30"/></dd>
												<dt>

				<label id="jform_profile_country-lbl" for="jform_profile_country" class="hasTip" title="Country::Choose an option for the field Country">Country:</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][country]" id="jform_profile_country" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_postal_code-lbl" for="jform_profile_postal_code" class="hasTip" title="Postal / ZIP Code::Choose an option for the field Postal Code">Postal / ZIP Code:</label>									<span class="optional">(optional)</span>
								</dt>

				<dd><input type="text" name="jform[profile][post_zip]" id="jform_profile_postal_code" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_mobile_phone-lbl" for="jform_profile_mobile_phone" class="hasTip" title="Mobile Phone::Mobile Number of the user">Mobile Phone</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][mobile_phone]" id="jform_profile_mobile_phone" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_work_phone-lbl" for="jform_profile_work_phone" class="hasTip" title="Work Phone::Work number of the user">Work Phone</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><input type="text" name="jform[profile][work_phone]" id="jform_profile_work_phone" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_designation-lbl" for="jform_profile_designation" class="hasTip" title="Designation::Designation of user">Designation</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><textarea name="jform[profile][designation]" id="jform_profile_designation" cols="30" rows="5"></textarea></dd>
												<dt>

				<label id="jform_profile_employment-lbl" for="jform_profile_employment" class="hasTip" title="Employment::Employment of user">Employment</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><textarea name="jform[profile][employment]" id="jform_profile_employment" cols="30" rows="5"></textarea></dd>
												<dt>
				<label id="jform_profile_paypal_email-lbl" for="jform_profile_paypal_email" class="hasTip" title="Paypal Email::Paypal Email of the user">Paypal Email</label>									<span class="optional">(optional)</span>

								</dt>
				<dd><input type="text" name="jform[profile][paypal_email]" id="jform_profile_paypal_email" value="" size="30"/></dd>
												<dt>
				<label id="jform_profile_skype_id-lbl" for="jform_profile_skype_id" class="hasTip" title="Skype ID::Skype ID of the user">Skype ID</label>									<span class="optional">(optional)</span>
								</dt>
				<dd><input type="text" name="jform[profile][skype_id]" id="jform_profile_skype_id" value="" size="30"/></dd>
								</dl>

		</fieldset>
			<div>
			<button type="submit" class="validate">Register</button>
			or			<a href="/tellmemd/" title="Cancel">Cancel</a>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="registration.register" />
			<input type="hidden" name="2f07984d0401d394c31dc871832931b3" value="1" />		</div>

	</form>
</div>