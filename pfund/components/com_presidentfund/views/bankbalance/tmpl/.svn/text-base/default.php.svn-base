<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

if($this->bankbalance_data->id == 0)
    echo '<h1>New Bank Balance</h1>';
else
    echo '<h1>Edit Bank Balance</h1>';

?>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" id="task" />
    <input type="hidden" name="controller" value="bankbalance" />
    <input type="hidden" name="id" value="<?php echo $this->bankbalance_data->id; ?>" />
   
     
    <table>
        
        <tr>
            <td>Bank</td>
            <td>
                <?php echo PFundHelper::createList('bank_id',(int)$this->bankbalance_data->bank_id, $this->bank_array); ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td id="account_list">
                 <?php  echo PFundHelper::createList('bankaccount_id', (int)$this->bankbalance_data->bankaccount_id, $this->account_nums); ?>
                 
            </td>
            <td id="bankaccount_detail_dev" ></td>
        </tr>
        <tr>
            <td>Balance</td>
            <td>
                <input type="text" name="bal_amount" value="<?php echo $this->bankbalance_data->bal_amount; ?>" size="35" />
                <div id="bankaccount_detail_dev"></div>
                    
            </td>
        </tr>
    </table>

</form>
    </div>