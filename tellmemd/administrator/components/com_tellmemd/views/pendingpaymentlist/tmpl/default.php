<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saranitpha@archmage.lk  
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::base().'components/'.OPTIOIN_NAME.'/assets/css/tellmemd.style.css');

$numrows = count($this->pp_list);


$filter_subject = JRequest::getVar('filter_subject', '');
$filter_status = JRequest::getVar('filter_status', '');


?>

<form action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTIOIN_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="report" />
    
    
   
    <table class="adminlist">
        <thead>
            <tr>
                <th width="50"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_ID'); ?></th>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_DOCTOR_NAME'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_PAYPAL'); ?></th>               
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_LAST_PAYMENT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_LAST_PAYMENT_DATE'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_REM_PAYMENT'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_TOTAL_PAID'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('COM_TELLMEMD_PEN_PAY_ACTION'); ?></th>
            </tr>
       </thead>
       
       <tfoot>
            <tr>
                <td colspan="18"><?php //echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $k = 0;
            
            for($x = 0; $x < $numrows; $x++)
            {
                $row = $this->pp_list[$x];
                  $checked = JHtml::_('grid.id', $x, $row->id);//                
                                 
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center">
                    <?php  echo $row->id; ?>
                </td>
                <td align="center">
                    <?php echo $checked; ?>
                </td>
                <td align="center">
                     <?php if($row->name){ echo "Dr. ".$row->name;} ?>
                </td>
                <td align="center">
                    <?php echo $row->paypal_email; ?>
                </td>               
                <td align="center">
                    <?php echo $row->lp_date; ?>
                </td>
                <td align="center">
                    <?php if($row->lp_amount>0){echo "$".$row->lp_amount;}else{echo "0";} ?>
                </td>
                <td align="center">
                    <?php if($row->rem_payment>0){echo "$".$row->rem_payment;}else{echo "0";} ?>
                </td>
                <td align="center">
                    <?php if($row->total_paid>0){echo "$".$row->total_paid;}else{echo "0";} ?>
                </td>
                <td align="center">
                    <?php if($row->rem_payment>0){echo JHTML::link(JRoute::_(COMPONENT_LINK.'&controller=report&task=pay&cid='.$row->id),JText::_('COM_TELLMEMD_PEN_PAY'),'class="pay"');}else{echo "-";} ?>
                </td>
                
                
            </tr>
            <?php
            
            $k = 1 - $k;
            
            }
            
            ?>
        </tbody>
    </table>
    
</form>