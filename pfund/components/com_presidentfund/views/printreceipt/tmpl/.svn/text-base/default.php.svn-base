<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

//$numrows = count($this->selected_list);
//$district_name= PFundHelper::getAllDistrict('Select a type');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/print.css', '', 'print');

$numrows = count($this->receipt_data);
$title = GeneralHelper::getTitles();

for($x = 0; $x < $numrows; $x++)
    {
        $row = $this->receipt_data;

        $lang = $row->application_lang;
        
        if($lang == LANGUAGE_TYPE_ENGLISH)
        {
            $rcptitle = '<h3>PRESIDENT FUND</h3>';
            $note = '<strong>please bring this receipt with you for office use</strong>';
            $fileno = '<strong>File No :</strong>PF/M/T/'.$row->patient_num;
            $applicantname = '<strong>Full name of Applicant :</strong> '.$title[$row->applicant_title].''.$row->applicant_fullname;
            $app_address = '<strong>Address :</strong> '.$row->applicant_add1.','.$row->applicant_add2;
            $app_nic = '<strong>NIC No :</strong> '.$row->applicant_nic;
            $fullname = '<strong>Fullname of patient :</strong> '.$title[$row->patient_title].''.$row->patient_fullname;
            $p_address = '<strong>Address :</strong> '.$row->patient_add1.','.$row->patient_add2;
            $p_nic = '<strong>NIC No :</strong> '.$row->patient_nic;
            $date = '<strong>Date :</strong> '.$row->updated_time;
        }
        elseif($lang == LANGUAGE_TYPE_SINHALA)
        {
            $rcptitle = '<h3>ජනාතිපති අරමුදල</h3>';
            $note = '<strong>වෛත්‍ය ප්‍රතිකාර සඳහා මූල්‍යාධාර ලබා ගැනීමට එනවිට මෙම කාඩ්පත රෝගියා හෝ ඉල්ලුම්කරු පමණක් රැගෙන ආ යුතුය</strong>';
            $fileno = '<strong>ගොනු අංකය :පීඑෆ් /එම/ටී/</strong>'.$row->patient_num;
            $applicantname = '<strong>ඉල්ලුම්කරුගේ සම්පූර්ණ නම :</strong> '.$row->applicant_fullname_si.' '.$row->SI;
            $app_address = '<strong>ලිපිනය :</strong> '.$row->applicant_add1_si.','.$row->applicant_add2_si;
            $app_nic = '<strong>ජාතික හැඳුනුම්පත් අංකය :</strong> '.$row->applicant_nic;
            $fullname = '<strong>රෝගියාගේ සම්පූර්ණ නම :</strong> '.$title[$row->patient_title].''.$row->patient_fullname_si;
            $p_address = '<strong>ලිපිනය :</strong> '.$row->patient_add1_si.','.$row->patient_add2_si;
            $p_nic = '<strong>ජාතික හැඳුනුම්පත් අංකය :</strong> '.$row->patient_nic;
            $date = '<strong>දිනය </strong> '.$row->updated_time;
        }
        elseif($lang == LANGUAGE_TYPE_TAMIL)
        {
            $rcptitle = '<h3>ஜனாதிபதி நிதியம்</h3>';
            $note = '<strong>தயவு செய்து</strong>';
            $fileno = '<strong>எண் :</strong>PF/M/T/'.$row->patient_num;
            $applicantname = '<strong>விண்ணப்பதாரியின் முழு பெயர் :</strong> '.$title[$row->applicant_title].''.$row->applicant_fullname_ta;
            $app_address = '<strong>முகவரி  :</strong> '.$row->applicant_add1_ta.','.$row->applicant_add2_ta;
            $app_nic = '<strong>அடையாள அட்டை இல  :</strong> '.$row->applicant_nic;
            $fullname = '<strong>நோயாளியின் முழு பெயர்  :</strong> '.$title[$row->patient_title].''.$row->patient_fullname_ta;
            $p_address = '<strong>முகவரி  :</strong> '.$row->patient_add1_ta.','.$row->patient_add2_ta;
            $p_nic = '<strong>அடையாள அட்டை இல  :</strong> '.$row->patient_nic;
            $date = '<strong>திகதி :</strong> '.$row->updated_time;
        }
        
        
    }

?>
<div class="comp-button">
<!--    <button type="button" name="print_btn" class="print_btn">Print</button>-->
<!--<a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="<?php //echo COMPONENT_LINK.'&controller=manageapp&task=printrecpt&application_id='.$row->id.'&tmpl=component';  ?>">
        <button type="button" name="print_btn" class="printlink_btn">Print</button>
    </a>    -->
<button type="button" name="print_btn" class="print_btn">Print</button>
</div>
<div class="comp-print"> 
         <table width="500">
              <tr>
                    <td colspan="2" align="center" valign="middle"><?php echo $rcptitle; ?></td>
              </tr> 
              <tr>
                    <td colspan="2" align="right"><?php echo $fileno; ?> </td>
              </tr>
              <tr>
                    <td width="176">&nbsp;</td>
                    <td width="312">&nbsp;</td>
              </tr>
              <tr>
                    <td colspan="2"><?php echo $note; ?></td>
              </tr>
              <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              </tr>
              <tr>
                    <td colspan="2"><?php echo $applicantname; ?></td>
              </tr>
              <tr>
                    <td colspan="2"><?php echo $app_address; ?></td>
                    
              </tr>
              <tr>
                    <td colspan="2"><?php echo $app_nic; ?></td>
              </tr>
            
              <tr>
                    <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                    <td colspan="2"><?php echo $fullname; ?></td>
              </tr>
              <tr>
                    <td colspan="2"><?php echo $p_address; ?></td>
              </tr>
              <tr>
                   <td colspan="2"><?php echo $p_nic; ?></td>
              </tr>
              <tr>
                    <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                    <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                    <td height="55">&nbsp;</td>
                    <td align="center">Signature</td>
              </tr>
              <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              </tr>
              <tr>
                    <td><?php echo $date; ?></td>
                    <td>&nbsp;</td>
              </tr>
        </table>
        </div>
</div>