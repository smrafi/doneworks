<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );



//get the array list of titles
$titles = GeneralHelper::getTitles('Select a title');
$relations = GeneralHelper::getRelationships('Select');
$districts = PFundHelper::getAllDistrict('Select a district');
$lang_array = PFundHelper::getLanguageArray('Select a language');

JRequest::setVar('patient_num', $this->application_data->patient_num);

//get the action will come only when view application link is clicked
$action = JRequest::getVar('action');

$app_type = JRequest::getInt('app_type');


?>
<h1>New Application</h1>
<div class="comp-button">
    <button type="button" name="sv_btn" class="sv_btn" onclick="routeback('application','savefirst');">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>

<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
    <input type="hidden" name="task"id="task" value="" />
    <input type="hidden" name="controller" value="application" />
    <input type="hidden" name="id" value="<?php echo $this->application_data->id; ?>" />
    <input type="hidden" name="patient_num" value="<?php echo $this->application_data->patient_num; ?>" />
<!--    <input type="hidden" name="application_type" value="<?php //echo $this->application_data->application_type; ?>" />-->
    <input type="hidden" name="app_type" id="ap_type" value="<?php echo $app_type; ?>" /> <!-- dev meril -->
    
   
    
    <table>
        <tr id="ref_tr">
            <td>
                <?php echo JText::_('Refference Number').':'; ?>
            </td>
            <td>
                 <input name="patient_ref_num" id="patient_ref_num" value="" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Application Language').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('application_lang', (int)$this->application_data->application_lang, $lang_array); ?>
            </td>
        </tr>
        <tr>
            <td size="20%">
                <?php echo JText::_('Patient Title').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('patient_title', (int)$this->application_data->patient_title, $titles, -1); ?>
                <input name="othertitle_patient" id="othertitle_patient" value="<?php echo $this->application_data->othertitle_patient; ?>" size="50" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Full name of the patient').':'; ?>
            </td>
            <td>
                <input name="patient_fullname" id="patient_fullname" value="<?php echo $this->application_data->patient_fullname; ?>" size="50" />
            </td>
        </tr>
        <tr class="otherlang-name" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="patient_fullname_si" id="patient_fullname_si" value="<?php echo $this->application_data->patient_fullname_si; ?>" />
                <input type="hidden" name="patient_fullname_ta" id="patient_fullname_ta" value="<?php echo $this->application_data->patient_fullname_ta; ?>" />
            </td>
        </tr>
        <tr class="otherlang-name" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('NIC Number').':'; ?>
            </td>
            <td>
                <input name="patient_nic" id="patient_nic" value="<?php echo $this->application_data->patient_nic; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Address 1').':'; ?>
            </td>
            <td>
                <input name="patient_add1" id="patient_add1"  value="<?php echo $this->application_data->patient_add1; ?>"  size="50" />
            </td>
        </tr>
        <tr class="otherlang-add1" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr class="otherlang-add1" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="patient_add1_si" id="patient_add1_si" value="<?php echo $this->application_data->patient_add1_si; ?>" />
                <input type="hidden" name="patient_add1_ta" id="patient_add1_ta" value="<?php echo $this->application_data->patient_add1_ta; ?>" />
            </td>
        </tr>
         <tr>
            <td>
                <?php echo JText::_('Address 2').':'; ?>
            </td>
            <td>
                <input name="patient_add2" id="patient_add2"  value="<?php echo $this->application_data->patient_add2; ?>"  size="50" />
            </td>
        </tr>
        <tr class="otherlang-add2" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr class="otherlang-add2" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="patient_add2_si" id="patient_add2_si" value="<?php echo $this->application_data->patient_add2_si; ?>" />
                <input type="hidden" name="patient_add2_ta" id="patient_add2_ta" value="<?php echo $this->application_data->patient_add2_ta; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('City').':'; ?>
            </td>
            <td>
                <input name="patient_city" id="patient_city" value="<?php echo $this->application_data->patient_city; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Age').':'; ?>
            </td>
            <td>
                <input name="age" id="age" value="<?php echo $this->application_data->age; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td size="20%">
                <?php echo JText::_('Applicant Title').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('applicant_title', (int)$this->application_data->applicant_title, $titles, -1); ?>
                <input name="othertitle_applicant" id="othertitle_applicant" value="<?php echo $this->application_data->othertitle_applicant; ?>" size="50" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Full name of the Applicant').':'; ?>
            </td>
            <td>
                <input name="applicant_fullname" id="applicant_fullname" value="<?php echo $this->application_data->applicant_fullname; ?>" size="50" />
            </td>
        </tr>
        <tr class="otherlang-applicantname" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr class="otherlang-applicantname" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="applicant_fullname_si" id="applicant_fullname_si" value="<?php echo $this->application_data->applicant_fullname_si; ?>" />
                <input type="hidden" name="applicant_fullname_ta" id="applicant_fullname_ta" value="<?php echo $this->application_data->applicant_fullname_ta; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('NIC Number').':'; ?>
            </td>
            <td>
                <input name="applicant_nic" id="applicant_nic" value="<?php echo $this->application_data->applicant_nic; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Applicant\'s Address 1').':'; ?>
            </td>
            <td>
                <input name="applicant_add1" id="applicant_add1"  value="<?php echo $this->application_data->applicant_add1; ?>"  size="50" />
            </td>
        </tr>
        <tr class="otherlang-applicantadd1" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr class="otherlang-applicantadd1" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="applicant_add1_si" id="applicant_add1_si" value="<?php echo $this->application_data->applicant_add1_si; ?>" />
                <input type="hidden" name="applicant_add1_ta" id="applicant_add1_ta" value="<?php echo $this->application_data->applicant_add1_ta; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Applicant\'s Address 2').':'; ?>
            </td>
            <td>
                <input name="applicant_add2" id="applicant_add2"  value="<?php echo $this->application_data->applicant_add2; ?>"  size="50" />
            </td>
        </tr>
        <tr class="otherlang-applicantadd2" style="display:none;">
            <td>
                <?php echo JText::_('Sinhala').':'; ?>
            </td>
            <td class="sinhalatxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
            </td>
        </tr>
        <tr class="otherlang-applicantadd2" style="display:none;">
            <td>
                <?php echo JText::_('Tamil').':'; ?>
            </td>
            <td class="tamiltxt">
                <span></span>
                &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>
                <input type="hidden" name="applicant_add2_si" id="applicant_add2_si" value="<?php echo $this->application_data->applicant_add2_si; ?>" />
                <input type="hidden" name="applicant_add2_ta" id="applicant_add2_ta" value="<?php echo $this->application_data->applicant_add2_ta; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Patient\'s Residence District').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('patient_district', (int)$this->application_data->patient_district, $districts); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Divisional Secretary\'s Division').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('patient_dsoffice', (int)$this->application_data->patient_dsoffice, $this->dsoffices); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Nature of Illness').':'; ?>
            </td>
            <td>
                <input name="illness_nature" id="illness_nature" value="<?php echo $this->application_data->illness_nature; ?>" size="50" />
            </td>
        </tr>
        
        
        
    </table>

    
</form>
</div>
