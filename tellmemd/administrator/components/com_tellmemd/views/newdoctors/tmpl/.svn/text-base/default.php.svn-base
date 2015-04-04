<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   07 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.html.pane');
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

//process tabs
//we are going to have 3 tabs here
$tabid = JRequest::getVar('tabid',0);
$tabs= &JPane::getInstance('Tabs', array('startOffset'=>$tabid));

//common arrays
$genders = array('Select a gender', 'Male', 'Female');
$martial_states = array('Select a status', 'Single', 'Married');
$country_array = TellMeMDGeneralHelper::getCountryArray();


//dropdown list we are going to use
$gender_list = TellMeMDHelper::createList('gender', $this->doc_data->gender, $genders, 0, 'inputlist');
$martial_state_list = TellMeMDHelper::createList('martial_status', $this->doc_data->martial_status, $martial_states, 0, 'inputlist');
$country_list = TellMeMDHelper::createList('country', $this->doc_data->country_id, $country_array, 0, 'inputlist');
?>

<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="doctors" />
    <input type="hidden" name="id" value="<?php echo $this->doc_data->info_id; ?>" />
    <input type="hidden" name="hidemainmenu" value="0" />
    
    <?php echo $tabs->startPane('content-pane'); ?>
    <?php echo $tabs->startPanel(JText::_('Account Informations'),"user-info"); ?>
    <table cellspacing="0" cellpadding="0" border="0" width="40%">
        <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="username" id="nd-username" disabled="disabled" value="<?php echo $this->doc_data->username; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" id="nd-email" disabled="disabled" value="<?php echo $this->doc_data->email; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" id="nd-name" disabled="disabled" value="<?php echo $this->doc_data->name; ?>" size="50" />
            </td>
        </tr>
    </table>
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Personal Informations'),"personal-info"); ?>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td width="10%">First Name:</td>
            <td>
                <input type="text" name="first_name" id="nd-first_name" value="<?php echo $this->doc_data->first_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td>
                <input type="text" name="last_name" id="nd-last_name" value="<?php echo $this->doc_data->last_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Other Name:</td>
            <td>
                <input type="text" name="other_name" id="nd-other_name" value="<?php echo $this->doc_data->other_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>
                <?php echo $gender_list;?>
            </td>
        </tr>
        <tr>
            <td>Nationality:</td>
            <td>
                <input type="text" name="nationality" id="nd-nationality" value="<?php echo $this->doc_data->nationality; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Date of Birth:</td>
            <td>
                <input type="text" name="date_birth" id="nd-date_birth" value="<?php echo $this->doc_data->date_birth; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Address 1:</td>
            <td>
                <input type="text" name="address1" id="nd-address1" value="<?php echo $this->doc_data->address1; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Address 2:</td>
            <td>
                <input type="text" name="address2" id="nd-address2" value="<?php echo $this->doc_data->address2; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td>
                <input type="text" name="city" id="nd-city" value="<?php echo $this->doc_data->city; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Region:</td>
            <td>
                <input type="text" name="region" id="nd-region" value="<?php echo $this->doc_data->region; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>
                <input type="text" name="country" id="nd-country" value="<?php echo $this->doc_data->country; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Personal Phone:</td>
            <td>
                <input type="text" name="mobile_phone" id="nd-mobile_phone" value="<?php echo $this->doc_data->mobile_phone; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Work Phone:</td>
            <td>
                <input type="text" name="work_phone" id="nd-work_phone" value="<?php echo $this->doc_data->work_phone; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Skype ID:</td>
            <td>
                <input type="text" name="skype_id" id="nd-skype_id" value="<?php echo $this->doc_data->skype_id; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Paypal Email:</td>
            <td>
                <input type="text" name="paypal_email" id="nd-paypal_email" value="<?php echo $this->doc_data->paypal_email; ?>" size="50" />
            </td>
        </tr>
    </table>
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Quallification Informations'),"qualify-info"); ?>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td width="15%">CV File:</td>
            <td>
                <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/cvfiles/'.$this->doc_data->cvfile_name; ?>"><span><?php echo $this->doc_data->cvfile_name; ?></span></a>
            </td>
        </tr>
        <tr>
            <td width="10%">Medical School Diploma File:</td>
            <td>
                <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/diplomafiles/'.$this->doc_data->diplomafile_name; ?>"><span><?php echo $this->doc_data->diplomafile_name; ?></span></a>
            </td>
        </tr>
        <tr>
            <td width="10%">Internship Proof:</td>
            <td>
                <a href="<?php echo JURI::root().'components/com_tellmemd/uploads/internproof/'.$this->doc_data->internfile_name; ?>"><span><?php echo $this->doc_data->internfile_name; ?></span></a>
            </td>
        </tr>
        <tr>
            <td>Internship Place:</td>
            <td>
                <input type="text" name="intern_place" id="nd-intern_place" value="<?php echo $this->doc_data->intern_place; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Internship Start Date:</td>
            <td>
                <input type="text" name="intern_startdate" id="nd-intern_startdate" value="<?php echo $this->doc_data->intern_startdate; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Internship End Date:</td>
            <td>
                <input type="text" name="intern_enddate" id="nd-intern_enddate" disabled="disabled" value="<?php echo $this->doc_data->intern_enddate; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>State License:</td>
            <td>
                <input type="text" name="state_license" id="nd-state_license" value="<?php echo $this->doc_data->state_license; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>DEA License:</td>
            <td>
                <input type="text" name="dea_license" id="nd-dea_license" value="<?php echo $this->doc_data->dea_license; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Malpractice Information:</td>
            <td>
                <textarea name="malpractice_info" id="nd-malpractice_info" rows="4" cols="31"><?php echo $this->doc_data->malpractice_info; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Specialty:</td>
            <td>
                <textarea name="speciality" id="nd-speciality" rows="4" cols="31"><?php echo $this->doc_data->speciality; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Year of Practice:</td>
            <td>
                <input type="text" name="year_practice" id="nd-year_practice" value="<?php echo $this->doc_data->year_practice; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>Medical Background:</td>
            <td>
                <textarea name="medical_background" id="nd-medical_background" rows="4" cols="31"><?php echo $this->doc_data->medical_background; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Personal Background:</td>
            <td>
                <textarea name="personal_background" id="nd-personal_background" rows="4" cols="31"><?php echo $this->doc_data->personal_background; ?></textarea>
            </td>
        </tr>
    </table>
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->endPane(); ?>
    
</form>