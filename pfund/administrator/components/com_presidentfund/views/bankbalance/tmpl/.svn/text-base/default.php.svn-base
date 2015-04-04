<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="bankbalance" />
    <input type="hidden" name="id" value="<?php echo $this->bankbalance_data->id; ?>" />
   
     
    <table>
        <tr>
            <td>Publish</td>
            <td>
                <?php echo PFundHelper::createCheckBox('published', $this->bankbalance_data->published, 1); ?>
            </td>
        </tr> 
        <tr>
            <td width="45%">Date</td>
            <td>
                <?php echo JHtml::calendar($this->bankbalance_data->bal_date, 'bal_date', 'bal_date'); ?>
            </td>
        </tr>
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
        </tr>
        <tr>
            <td>Balance Amount Rs.</td>
            <td>
                <input type="text" name="bal_amount" value="<?php echo $this->bankbalance_data->bal_amount; ?>" size="35" />
            </td>
        </tr>
    </table>

</form>