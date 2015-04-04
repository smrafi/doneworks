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

if($this->fd_list->id == 0)
    echo '<h1>New Fixed Deposit</h1>';
else
    echo '<h1>Edit Fixed Deposit</h1>';

?>
<div class="comp-button">
    <div class="comp-button" style="float: left"><button type="button" name="back_btn" class="back_btn" >Cancel</button></div>
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Bank</button>
</div>
<div class="comp-content">
<form  action="" method="post" class="submit-form" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="controller" value="openbalancefd" />
    <input type="hidden" name="id" value="<?php echo $this->fd_list->id; ?>" />
    
    <table class="acctable">
  
  <tr>
    <td>Bank</td>
    <td colspan="3">
        <?php  echo PFundHelper::createList('bank_id', (int)$this->fd_list->bank_id, $this->bank_array); ?>
    </td>
   
  </tr>
  <tr>
    <td>Account No</td>
    <td id="account_list" colspan="3">
      
      <?php  echo PFundHelper::createList('bankaccount_id', (int)$this->fd_list->bankaccount_id, $this->account_nums); ?>
   </td  >
   
  </tr>
  <tr>
    <td>Amount</td>
    <td colspan="3">
      
      <input type="text" maxlength="8" name="amount" id="amount" value="<?php echo $this->fd_list->amount; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>Rate</td>
    <td colspan="3">
      
      <input type="text" name="interest" id="interest" value="<?php echo $this->fd_list->interest; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>From</td>
    <td>
    <?php echo JHtml::calendar($this->fd_list->period_start, 'period_start', 'period_start'); ?>
    </td>
    <td>To</td>
    <td>
        <?php echo JHtml::calendar($this->fd_list->period_end, 'period_end', 'period_end'); ?>
    </td>
   
  </tr>
  
  
</table>
</form>
</div>