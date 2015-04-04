<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   21 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

//keep session alive while editing
JHTML::_('behavior.keepalive');

$tabid = JRequest::getVar('tabid',0);
$tabs= &JPane::getInstance('Tabs', array('startOffset'=>$tabid));

//get the array list of titles
$titles = GeneralHelper::getTitles('Select a title');
$relations = GeneralHelper::getRelationships('Select');
$martial_status = GeneralHelper::getMartialStatus('Select');
$districts = PFundHelper::getAllDistrict('Select a district');
$marriage_status = array('Select', CURRENT_STATUS_MARRIED => 'Married', CURRENT_STATUS_UNMARRIED => 'Unmarried');
$logic_array = array('No', 'Yes');
$lang_array = PFundHelper::getLanguageArray('Select a language');

JRequest::setVar('patient_num', $this->application_data->patient_num);

$document =& JFactory::getDocument();
$document->setTitle('Add New Application');

//get the action will come only when view application link is clicked
$action = JRequest::getVar('action');

?>
<?php
if($action == 'view')
    echo '<h1>View Application</h1>';
elseif($this->application_data->id == 0)
    echo '<h1>New Application</h1>';
else
    echo '<h1>Edit Application</h1>';

if(!$action)
{
?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<?php
}
?>
<div class="comp-appcontent">
<form  action="index.php" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
    <input type="hidden" name="task"id="task" value="" />
    <input type="hidden" name="controller" value="application" />
    <input type="hidden" name="id" value="<?php echo $this->application_data->id; ?>" />
    <input type="hidden" name="patient_num" value="<?php echo $this->application_data->patient_num; ?>" />
    <input type="hidden" name="app_type" value="<?php echo $this->application_data->application_type; ?>" />
    
    <?php echo $tabs->startPane('content-pane'); ?>
    <?php echo $tabs->startPanel(JText::_('Patient Details'),"patient-details"); ?>
    
    <table>
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
                <?php echo JText::_('Title').':'; ?>
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
        <tr>
            <td>
                <?php echo JText::_('Address 2').':'; ?>
            </td>
            <td>
                <input name="patient_add2" id="patient_add2"  value="<?php echo $this->application_data->patient_add2; ?>"  size="50" />
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
                <?php echo JText::_('Telephone No. (if available)').':'; ?>
            </td>
            <td>
                <input name="patient_phone" id="patient_phone" value="<?php echo $this->application_data->patient_phone; ?>" size="50" />
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
            <td>
                <?php echo JText::_('Present Occupation').':'; ?>
            </td>
            <td>
                <input name="patient_occupation" id="patient_occupation" value="<?php echo $this->application_data->patient_occupation; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Pensioner').'?'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createCheckBox('pensioner', (int)$this->application_data->pensioner, 1, 'Yes', 'id="pensioner"'); ?>
            </td>
        </tr>
        <tr>
            <td id="served-lasttd" style="display: none;">
                <?php echo JText::_('Place served last').':'; ?>
            </td>
            <td id="served-lasttxt" style="display: none;">
                <input name="last_place" id="last_place" value="<?php echo $this->application_data->last_place; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Present Salary').':'; ?>
            </td>
            <td>
                <input name="present_salary" id="present_salary" value="<?php echo $this->application_data->present_salary; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Address of place of present employment').':'; ?>
            </td>
            <td>
                <input name="patient_empadd1" id="patient_empadd1"  value="<?php echo $this->application_data->patient_empadd1; ?>"  size="50" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="patient_empadd2" id="patient_empadd2"  value="<?php echo $this->application_data->patient_empadd2; ?>"  size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Civil Status').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('patient_martial', (int)$this->application_data->patient_martial, $martial_status, -1); ?>
                <input name="martial_other" id="martial_other" value="<?php echo $this->application_data->martial_other; ?>" size="50" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Relationship of patient to Applicant').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('applicant_relation', (int)$this->application_data->applicant_relation, $relations, -1); ?>
                <input name="etc_relation" id="etc_relation" value="<?php echo $this->application_data->etc_relation; ?>" size="50" style="display: none;"  />
            </td>
        </tr>
    </table>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Applicant Details'),"applicant-details"); ?>
    
    <table>
        <tr>
            <td size="20%">
                <?php echo JText::_('Title').':'; ?>
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
                <?php echo JText::_('Address 1').':'; ?>
            </td>
            <td>
                <input name="applicant_add1" id="applicant_add1"  value="<?php echo $this->application_data->applicant_add1; ?>"  size="50" />
            </td>
        </tr>
         <tr>
            <td>
                <?php echo JText::_('Address 2').':'; ?>
            </td>
            <td>
                <input name="applicant_add2" id="applicant_add2"  value="<?php echo $this->application_data->applicant_add2; ?>"  size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Telephone No. (if available)').':'; ?>
            </td>
            <td>
                <input name="applicant_phone" id="applicant_phone" value="<?php echo $this->application_data->applicant_phone; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Occupation').':'; ?>
            </td>
            <td>
                <input name="applicant_occupation" id="applicant_occupation" value="<?php echo $this->application_data->applicant_occupation; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Address of the place of work').':'; ?>
            </td>
            <td>
                <input name="applicant_empadd1" id="applicant_empadd1"  value="<?php echo $this->application_data->applicant_empadd1; ?>"  size="50" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="applicant_empadd2" id="applicant_empadd2"  value="<?php echo $this->application_data->applicant_empadd2; ?>"  size="50" />
            </td>
        </tr>
    </table>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Other Details'),"other-details"); ?>
    
    <table>
        <tr>
            <td>
                <?php echo JText::_('District of the patient\'s permanent place of residence').':'; ?>
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
        <tr>
            <td>
                <?php echo JText::_('Name of the Doctor treated').':'; ?>
            </td>
            <td>
                <input name="doctor_name" id="doctor_name" value="<?php echo $this->application_data->doctor_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Address of the doctor').':'; ?>
            </td>
            <td>
                <textarea name="doctor_address" id="doctor_address" cols="40" rows="5"><?php echo $this->application_data->doctor_address; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Name of the Hospital').':'; ?>
            </td>
            <td>
                <?php echo PFundHelper::createList('hospital_id', (int)$this->application_data->hospital_id, $this->hospitals); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Address of the hospital').':'; ?>
            </td>
            <td>
                <textarea name="hospital_address" id="hospital_address" cols="40" rows="5"><?php echo $this->application_data->hospital_address; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Estimated cost of medical treatment (Rs)').':'; ?>
            </td>
            <td>
                <input name="estimated_amount" id="estimated_amount" value="<?php echo $this->application_data->estimated_amount; ?>" size="50" />
            </td>
        </tr>
    </table>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Income Details'),"other-details"); ?>
    
    <div id="income-table">
    <table class="income-data-table">
        <tr>
            <td><?php echo JText::_('Name'); ?></td>
            <td><input name="income_data[member_name][]" value="" size="30" /></td>
        </tr>
        <tr>
            <td><?php echo JText::_('Married / Unmarried'); ?></td>
            <td><?php echo PFundHelper::createList('income_data[member_marriage][]', 0, $marriage_status); ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('Occupation / Business'); ?></td>
            <td><input name="income_data[member_occupation][]" value="" size="30" /></td>
        </tr>
        <tr>
            <td><?php echo JText::_('Monthly Income'); ?></td>
            <td><input name="income_data[member_income][]" value="" size="30" /></td>
        </tr>
        <tr>
            <td><?php echo JText::_('Paying Income tax?'); ?></td>
            <td><?php echo PFundHelper::createList('income_data[paying_tax][]', 0, $logic_array); ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('Income Tax file No.'); ?></td>
            <td><input name="income_data[tax_file][]" value="" size="30" /></td>
        </tr>
    </table>
    </div>
    <div class="appendlink income-append">
        <a href="javascript:void(0);">+ Add Another Record</a>
    </div>
    <?php
    if(!empty ($this->income_data))
    {
    ?>
    <div class="income-list">
        <table class="adminlist">
            <thead>
                <tr>
                    <th><?php echo JText::_('Name'); ?></th>
                    <th><?php echo JText::_('Married / Unmarried'); ?></th>
                    <th><?php echo JText::_('Occupation / Business'); ?></th>
                    <th><?php echo JText::_('Monthly Income'); ?></th>
                    <th><?php echo JText::_('Paying Income tex?'); ?></th>
                    <th><?php echo JText::_('Income Tax file No.'); ?></th>
                    <th><?php echo JText::_('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty ($this->income_data))
                {
                    foreach($this->income_data as $income_data)
                    {
                                               
                        if(!$income_data->tax_file)
                            $income_data->tax_file = '-';
                        ?>
                <tr>
                    <td><?php echo $income_data->member_name; ?></td>
                    <td><?php echo $marriage_status[$income_data->member_marriage]; ?></td>
                    <td><?php echo $income_data->member_occupation; ?></td>
                    <td><?php echo $income_data->member_income; ?></td>
                    <td><?php echo $logic_array[$income_data->paying_tax]; ?></td>
                    <td><?php echo $income_data->tax_file; ?></td>
                    <td>
                        <a href="<?php echo COMPONENT_LINK.'&controller=application&task=deleteincdata&cid='.$income_data->id; ?>">
                            <img src="<?php echo JURI::root().'administrator/components/com_presidentfund/assets/images/delete.png' ?>" />
                        </a>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Property Details'),"other-details"); ?>
    
    <table class="file-table">
        <tr>
            <td>
                <?php echo JText::_('Property Details file'); ?>
            </td>
            <td>
                <input type="file" name="property_datafile" id="property_datafile" size="50" />
            </td>
        </tr>
        <?php
        if($this->application_data->property_file)
        {
            ?>
        <tr>
            <td colspan="2">
                <img class="property-file" src="<?php echo JURI::root().'components/com_presidentfund/files/documents/property/'.$this->application_data->property_file; ?>" />
                <input type="hidden" name="property_file" value="<?php echo $this->application_data->property_file; ?>" />
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->startPanel(JText::_('Financial Details'),"other-details"); ?>
    
    <table class="finance-table">
        <tr>
            <td>
                <?php echo JText::_('Patient\'s own resources').' (Rs.)'; ?>
            </td>
            <td>
                <input name="own_resource_amount" id="own_resource_amount" value="<?php echo $this->application_data->own_resource_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Employees\' Trust Fund (ETF)').' (Rs.)'; ?>
            </td>
            <td>
                <input name="etf_amount" id="etf_amount" value="<?php echo $this->application_data->etf_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('National Insurance Trust Fund').' (Rs.)'; ?>
            </td>
            <td>
                <input name="nitf_amount" id="nitf_amount" value="<?php echo $this->application_data->nitf_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Medical Assistance Scheme of the place of employment').' (Rs.)'; ?>
            </td>
            <td>
                <input name="employment_scheme_amount" id="employment_scheme_amount" value="<?php echo $this->application_data->employment_scheme_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Sum of Money received under special scheme').' (Rs.)'; ?>
            </td>
            <td>
                <input name="special_scheme_amount" id="special_scheme_amount" value="<?php echo $this->application_data->special_scheme_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Money received from NGOs').' (Rs.)'; ?>
            </td>
            <td>
                <input name="ngo_amount" id="ngo_amount" value="<?php echo $this->application_data->ngo_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Donations').' (Rs.)'; ?>
            </td>
            <td>
                <input name="donation_amount" id="donation_amount" value="<?php echo $this->application_data->donation_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                <?php echo JText::_('Loans').' (Rs.)'; ?>
            </td>
            <td>
                <input name="loan_amount" id="loan_amount" value="<?php echo $this->application_data->loan_amount; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td colspan="2"><b><?php echo JText::_('Other Sources (state clearly the source)'); ?></b></td>
        </tr>
        <tr>
            <th><?php echo JText::_('Source'); ?></th>
            <th><?php echo JText::_('Amount (Rs.)'); ?></th>
        </tr>
        <tr class="other-source-raw">
            <td>
                <input name="other_source[source_name][]" value="" size="50" />
            </td>
            <td>
                <input name="other_source[source_amount][]" value="" size="50" />
            </td>
        </tr>
    </table>
    <div class="appendlink source-append">
        <a href="javascript:void(0);">+ Add Another Record</a>
    </div>
    <?php
    if(!empty ($this->other_source))
    {
        ?>
    <div class="income-list">
        <table class="adminlist">
            <thead>
                <th><?php echo JText::_('Source'); ?></th>
                <th><?php echo JText::_('Amount (Rs.)'); ?></th>
                <th><?php echo JText::_('Action'); ?></th>
            </thead>
            <tbody>
                <?php
                foreach($this->other_source as $other_source)
                {
                    ?>
                <tr>
                    <td><?php echo $other_source->source_name; ?></td>
                    <td><?php echo $other_source->source_amount; ?></td>
                    <td>
                        <a href="<?php echo COMPONENT_LINK.'&controller=application&task=deletesource&cid='.$other_source->id; ?>">
                            <img src="<?php echo JURI::root().'administrator/components/com_presidentfund/assets/images/delete.png' ?>" />
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
    <div class="extra-finance">
        <table class="finance-table">
            <tr>
                <td>
                    <?php echo JText::_('Amount expected from president fund').' (Rs.)'; ?>
                </td>
                <td>
                    <input name="expect_amount" id="expect_amount" value="<?php echo $this->application_data->expect_amount; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><b><?php echo JText::_('If patient has obtained financial assistant earlier from president fund :'); ?></b></td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Amount Received').' (Rs.)'; ?>
                </td>
                <td>
                    <input name="preobt_amount" id="preobt_amount" value="<?php echo $this->application_data->preobt_amount; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Date'); ?>
                </td>
                <td>
                    <?php echo JHtml::calendar($this->application_data->preobt_date, 'preobt_date', 'preobt_date'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Illness/Treatment'); ?>
                </td>
                <td>
                    <input name="preobt_illness" id="preobt_illness" value="<?php echo $this->application_data->preobt_illness; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('File No.'); ?>
                </td>
                <td>
                    <input name="preobt_filenum" id="preobt_filenum" value="<?php echo $this->application_data->preobt_filenum; ?>" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Date the patient due to be admitted to hospital.'); ?>
                </td>
                <td>
                    <?php echo JHtml::calendar($this->application_data->admitdue_date, 'admitdue_date', 'admitdue_date'); ?>
                </td>
            </tr>
        </table>
    </div>
    
    <?php echo $tabs->endPanel(); ?>
    <?php echo $tabs->endPane(); ?>
    
</form>
</div>