<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.calendar');

$filter_start = JRequest::getVar('filter_start', date('Y-m-d H:i:s'));
$filter_end = JRequest::getVar('filter_end', date('Y-m-d H:i:s'));
?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="expense" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="report" />
    
    <table>
        <tr>
            <td style="vertical-align:text-top;">
                <?php echo JText::_('COM_TELLMEMD_MANAGE_FILTER_START'); ?>
            </td>
             <td style="vertical-align:text-top;">
                <?php echo JHTML::calendar(date('Y-m-d', strtotime($filter_start)),'filter_start','filter_start','%Y-%m-%d');?>
            </td>
            <td style="vertical-align:text-top;">
                <?php echo JText::_('COM_TELLMEMD_MANAGE_FILTER_END'); ?>
            </td>
             <td style="vertical-align:text-top;">
                <?php echo JHTML::calendar(date('Y-m-d', strtotime($filter_end)),'filter_end','filter_end','%Y-%m-%d');?>
            </td>
             <td style="vertical-align:text-top;">
                <input type="submit" name="sbmit_btn" id="sbmit_btn" value="Calculate" />
            </td>
        </tr>
    </table>
    <br/><br/>
    <h3><?php echo JText::_('COM_TELLMEMD_CASE_DETAILS'); ?></h3>
    <table class="adminlist">        
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_TOTAL_CASES'); ?></th>
                <td><?php echo $this->case_list['count']; ?></td>
            </tr>
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_SOLVED_CASES'); ?></th>
                <td><?php echo $this->case_list['solved']; ?></td>
            </tr>  
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_CLOSED_CASES'); ?></th>
                 <td><?php echo $this->case_list['closed']; ?></td>
            </tr>
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_REFUNDED_CASES'); ?></th>
                 <td><?php echo $this->case_list['refunded']; ?></td>
            </tr>  
    </table>
    
    <br/><br/>
    <h3><?php echo JText::_('COM_TELLMEMD_INCOME_DETAILS'); ?></h3>
    <table class="adminlist">        
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_TOTAL_CASE_INCOME'); ?></th>
                <td><?php if($this->income_list['total_income']>0){echo "$".$this->income_list['total_income'];}else{echo $this->income_list['total_income'];} ?></td>
            </tr>
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_PAID_TO_DOCTOR'); ?></th>
                <td><?php if($this->income_list['paid_doctor']>0){echo "$".$this->income_list['paid_doctor'];}else{echo $this->income_list['paid_doctor'];} ?></td>
            </tr>  
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_FULL_REFUNDS'); ?></th>
                <td><?php if($this->income_list['full_refund']>0){echo "$".$this->income_list['full_refund'];}else{echo $this->income_list['full_refund'];} ?></td>
            </tr>
            <tr>
                <th style="width:10%"><?php echo JText::_('COM_TELLMEMD_REPORT_HALF_REFUNDS'); ?></th>
                 <td><?php if($this->income_list['half_refund']>0){echo "$".$this->income_list['half_refund'];}else{echo $this->income_list['half_refund'];} ?></td>
            </tr>  
    </table>
    <br/><br/>
    
</form>