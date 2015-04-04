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

//$groups = JHTML::_('access.usergroup', $field.'[]', $valuearray, 'multiple="multiple" size="6"');

?>
<h1>Medical Payment</h1>
<div class="comp-button" >
    <div class="comp-button" style="float:right;"><button type="button" name="cancel_btn" class="cancel_btn" >Back</button></div>
</div>
<div class="comp-content">
<form  class="submit-form" action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="medicalpayment" />
    
    
    <table>
        
        <tr> 
            <td width="5%"><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/accounts_receivable.png' ?>" title="Account Administration" /></td>
            <td> <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=medicalpayment&task=reimbursment_medical', 'ReImbursment'); ?></b></td>
        </tr> 
        <tr>
            <td><img src="<?php echo JURI::root().'components/com_presidentfund/assets/images/medical_condition.png' ?>" title="Account Entry" /></td>
            <td> <b><?php echo JHtml::link(COMPONENT_LINK.'&controller=medicalpayment&task=normal_medical','Other Medical Payments'); ?></b></td> 
                
        </tr>
    </table>
</form>
</div>
