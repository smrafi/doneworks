<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$editor = & JFactory::getEditor();
$lang_type=PFundHelper::getLanguageArray('Select a language');


?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
    
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="save" id="task" />
    <input type="hidden" name="controller" value="template" />
    <input type="hidden" name="id" value="<?php echo $this->template_data->id; ?>" />
     
    <table>
        
        <tr>
            <td>Publish</td>
            <td>
                <?php echo PFundHelper::createCheckBox('published', $this->template_data->published, 1); ?>
            </td>
        </tr> 
        <tr>
            <td>Language</td>
            <td>
                <?php echo PFundHelper::createList('language_id',(int)$this->template_data->language_id, $lang_type); ?>
            </td>
        </tr>
        <tr>
            <td>Template Name</td>
            <td><input type="text" name="template_name" id="template_name" value="<?php echo $this->template_data->template_name; ?>" size="50"/></td>
        </tr>
        <tr>
            <td>Template Variables</td>
            <td valign="top">
                <table>
				<tr>
                                    <td valign="top">
					<fieldset class="adminform">
                                        <?php
                                        
                                        echo PF_TITLE.' = '.JText::_('Title')."<br />";
                                        echo PF_FULLNAME.' = '.JText::_('Name')."<br />";
                                        echo PF_FULLNAME_SI.' = '.JText::_('Name in Sinhala')."<br />";
                                        echo PF_FULLNAME_TA.' = '.JText::_('Name in Tamil')."<br />";
                                        echo PF_APPLICATION_NUMBER.' = '.JText::_('Application Number')."<br />";
                                        echo PF_ADDRESS_L1.' = '.JText::_('Address_Line 1')."<br />";
                                        echo PF_ADDRESS_L1_SI.' = '.JText::_('Address_Line 1 in Sinhala')."<br />";
                                        echo PF_ADDRESS_L1_TA.' = '.JText::_('Address_Line 1')."<br />";
                                        echo PF_ADDRESS_L2.' = '.JText::_('Address_Line 2 in Tamil')."<br />";
                                        echo PF_ADDRESS_L2_SI.' = '.JText::_('Address_Line 2 in Sinhala')."<br />";
                                        echo PF_ADDRESS_L2_TA.' = '.JText::_('Address_Line 2 in Tamil')."<br />";
                                        echo PF_NIC_NUMBER.' = '.JText::_('NIC Number')."<br />";
                                        echo PF_CURRENT_DATE.' = '.JText::_('Today Date')."<br />";
                                        echo PF_CURRENT_MONTH_YEAR.' = '.JText::_('Date with current month and year')."<br />";
                                        echo PF_PRESIDENT_APPLICATION_TABLE.' = '.JText::_('Application Table to President Letter')."<br />";
                                        echo PF_PRESIDENT_LETTER_NUM.' = '.JText::_('Letter Number of President Letter')."<br />";
                                        echo PF_HEALTH_MINISTRY_APPLICAION_LIST.' = '.JText::_('Application Table to Health Ministry')."<br />";
                                        echo PF_CHEQUE_NO.' = '.JText::_('Checque Number')."<br/>";
                                        echo PF_VOUCHER_NO.' = '.JText::_('Voucher Number')."<br/>";
                                        echo PF_SIGN_IMAGE.' = '.JText::_('Digital Sign image')."<br/>";
                                        
                                        ?>
                                        
                                        </fieldset>
                                    </td>
                                </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">Content</td>
            <td>
                <?php echo $editor->display('template_content', $this->template_data->template_content, 500, 400, 70, 10); ?>
            </td>
            
        </tr>
               
    </table>
</form>
</div>