<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   15 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

$titles = GeneralHelper::getTitles('Select a title');
$link = COMPONENT_LINK.'&controller=manageapp&app_id='.$this->application_data->application_id.'&pnum='.$this->application_data->patient_num;

?>

<h1>Application Data Review - SAS</h1>
<div class="comp-button">
    <a href="<?php echo $link; ?>" target="_blank"><button type="button" name="jstbtn" id="jstbtn">View</button> </a>
   <button type="button" name="recommend_btn" class="recommend_btn">Recommend</button>
   <button type="button" name="amend_btn" class="amend_btn">Amend</button>
   <button type="button" name="reject_btn" class="reject_btn">Reject</button>
   <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('asstsec', 'backappreview');">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="asstsec" />
        <input type="hidden" name="application_id" value="<?php echo $this->application_data->application_id; ?>" />
        
        <table>
             <tr>
                <td>
                    <?php echo JText::_('Full name of the patient').':'; ?>
                </td>
                <td>
                    <?php echo $titles[$this->application_data->patient_title].' '.$this->application_data->patient_fullname; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Post Town').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->patient_city; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Name of the Applicant').':'; ?>
                </td>
                <td>
                    <?php echo $titles[$this->application_data->applicant_title].' '.$this->application_data->applicant_fullname; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Nature of Illness').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->illness_nature; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Doctor\'s Recommendation').':'; ?>
                </td>
                <td>
                    <?php echo 'Surgery'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Place of Surgery/Treatment').':'; ?>
                </td>
                <td>
                    <?php echo $this->hospitals[$this->application_data->hospital_id]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Cost of Surgery / Treatment').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->estimated_amount; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Amount Requested by applicant').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->expect_amount; ?>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <?php echo JText::_('Applicant\'s Contribution').':'; ?>
                </td>
                <td>
                    <?php echo '<span>Own Resources (Rs.)</span>: '.$this->application_data->own_resource_amount; ?><br/>
                    <?php echo '<span>ETF (Rs.)</span>: '.$this->application_data->etf_amount; ?><br/>
                    <?php echo '<span>National Insurance Trust (Rs.)</span>  : '.$this->application_data->nitf_amount; ?><br/>
                    <?php echo '<span>Medical Assistance Scheme (Rs.)</span> : '.$this->application_data->employment_scheme_amount; ?><br/>
                    <?php echo '<span>Special Scheme (Rs.)</span> : '.$this->application_data->special_scheme_amount; ?><br/>
                    <?php echo '<span>NGO (Rs.)</span> : '.$this->application_data->ngo_amount; ?><br/>
                    <?php echo '<span>Donations (Rs.)</span>: '.$this->application_data->donation_amount; ?><br/>
                    <?php echo '<span>Loans (Rs.)</span> : '.$this->application_data->loan_amount; ?><br/>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('DS Recommendation').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->dsoffice_note; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Secy./Health\'s recommendation').':'; ?>
                </td>
                <td>
                    <?php echo $this->application_data->healthministry_note; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo JText::_('Previus grant given/and the illness').':'; ?>
                </td>
                <td>
                    <?php echo 'NIL'; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Checked by: <br/>A grant of Rs. <?php echo number_format($this->application_data->grant_amount, 2, '.', ','); ?> may be considered pl.
                </td>
            </tr>
        </table>
        
        <div id="grant-input">
            <div id="amount-input">
                <span>Senior Assistant Secretary (PF)</span><br/><br/>
                A grant of Rs. <input type="text" name="sas_grant" id="sas_grant" value="" /> may be considered pl.
            </div>
            <div id="note-input">
                <span>Comment:</span><br/>
                <textarea cols="30" rows="5" name="sas_comment" id="sas_comment"></textarea>
            </div>
        </div>
    </form>
</div>