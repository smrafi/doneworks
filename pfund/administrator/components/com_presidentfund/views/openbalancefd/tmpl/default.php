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
?>
<form  action="" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="openbalancefd" />
    <input type="hidden" name="id" value="<?php echo $this->fd_list->id; ?>" />
    
    <table>
  <tr>
    <td width="100">Publish</td>
    <td><?php echo PFundHelper::createCheckBox('published',$this->fd_list->published, 1); ?></td>
    
  </tr>
  <tr>
    <td>Bank</td>
    <td>
        <?php  echo PFundHelper::createList('bank_id', (int)$this->fd_list->bank_id, $this->bank_array); ?>
    </td>
   
  </tr>
  <tr>
    <td>Account No</td>
    <td id="account_list">
      
      <?php  echo PFundHelper::createList('bankaccount_id', (int)$this->fd_list->bankaccount_id, $this->account_nums); ?>
   </td>
   
  </tr>
  <tr>
    <td>Interest</td>
    <td>
      
      <input type="text" name="interest" id="interest" value="<?php echo $this->fd_list->interest; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>Period Start</td>
    <td>
    <?php echo JHtml::calendar($this->fd_list->period_start, 'period_start', 'period_start'); ?>
    </td>
   
  </tr>
  <tr>
    <td>Period End</td>
    <td>
        <?php echo JHtml::calendar($this->fd_list->period_end, 'period_end', 'period_end'); ?>
    </td>
   
  </tr>
  
</table>
</form>
