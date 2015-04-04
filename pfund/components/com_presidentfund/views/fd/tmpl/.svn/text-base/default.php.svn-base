<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
$interest_period_type = PFundHelper::getInterestPeriodType('Select a Interest Period Type');
if($this->fd_list->id == 0)
    echo '<h1>New Fixed Deposit</h1>';
else
    echo '<h1>Edit Fixed Deposit</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="fd" />
    <input type="hidden" name="id" value="<?php echo $this->fd_list->id; ?>" />
    
  <table>
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
            <td >Scheme Type</td>
            <td ><?php echo PFundHelper::createList('interest_scheme', (int)$this->fd_list->interest_scheme, $interest_period_type); ?></td>
   </tr>
  <tr>
    <td>Interest Rate</td>
    <td>
      
      <input type="text" name="interest" id="interest" value="<?php echo $this->fd_list->interest; ?>" size="50" />
   </td>
   
  </tr>
  <tr>
    <td>Amount</td>
    <td>
      
      <input type="text" maxlength="8" name="amount" id="amount" value="<?php echo $this->fd_list->amount; ?>" size="50" />
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
  <tr>
      <td>
          FD Certificate Document
      </td>
      <td>
          <input name="fd_file" id="fd_file" type="file" size="50" value /></br>
           <?php 
        if($this->fd_list->file_name)
        {
            
        ?>
        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/fd/'.$this->fd_list->file_name;  ?> ><?php echo $this->fd_list->file_name; ?></a>
        <input type="hidden" name="file_name" value="<?php echo $this->fd_list->file_name; ?>" />
        <?php
        }
                
        ?>
      </td>
  </tr>
  <tr>
      <td>
          FD Approval Document
      </td>
      <td>
          <input name="fd_doc" id="fd_doc" type="file" size="50" value /></br>
           <?php 
        if($this->fd_list->file_name)
        {
            
        ?>
        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/fd/'.$this->fd_list->approval_doc;  ?> ><?php echo $this->fd_list->approval_doc; ?></a>
        <input type="hidden" name="approval_doc" value="<?php echo $this->fd_list->approval_doc; ?>" />
        <?php
        }
                
        ?>
      </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><h4>Related Cheque Details</h4></td>
   
  </tr>
      <tr>
            <td>Related Bank</td>
            <td>
                <?php echo PFundHelper::createList('cheque_bank_id',(int)$this->fd_list->bankid,$this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Related Account Number</td>
            <td >
                 <?php  echo PFundHelper::createList('cheque_bankaccount_id',(int)$this->fd_list->bankaccountid, $this->cheque_account_nums); ?>
            </td>
        </tr>
        <tr>
            <td>Related Cheque Number</td>
            <td><input type="text" name="chequenumber" value="<?php echo (int)$this->fd_list->chequenumber; ?>"  /></td>
        </tr>
        <tr>
            <td>Cheque Date</td>
            <td><?php echo JHtml::calendar($this->fd_list->cheque_date, 'cheque_date', 'cheque_date'); ?></td>
        </tr>
</table>
</form>
    </div>