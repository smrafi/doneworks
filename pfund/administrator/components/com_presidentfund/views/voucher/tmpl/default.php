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
$expense_type = PFundHelper::getLedgerExpenseType('Select a Type');
$user =& JFactory::getUser();
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');
$ledgertype_diabled  = 'disabled = "disabled"';
$ledgertype_display = 'display: none';
if($this->voucher_list->ledger_check == 1)
{ 
    $ledgertype_diabled = 'display: show';
    $ledgertype_display = '';
}
$num_file = count($this->file_list);
?>

<form action="index.php" method="post" name="adminForm"  enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="id" value="<?php echo $this->voucher_list->id;?>" />
    <table  id="voucher">
        <tbody>
        <tr><td>Voucher Number</td>  
            <td colspan="2"><strong><?php if(!$this->voucher_list->number ){echo $this->voucher_num->Auto_increment ;} else{echo $this->voucher_list->number ; }?></strong>
                <input type="hidden"  name="number" value="<?php if(!$this->voucher_list->number ){echo $this->voucher_num->Auto_increment ;} else{echo $this->voucher_list->number ; }?>" /></td>
        </tr>
        <tr><td width="30%">Ledger Activity</td>
            <td colspan="2"><?php echo PFundHelper::createList('ledger_activity', (int)$this->voucher_list->ledger_activity, $expense_type); ?></td>
        </tr>
        <tr ><td>Ledger Item Type</td>
            <td   ><?php echo PFundHelper::createCheckBox('ledger_check', (int)$this->voucher_list->ledger_check, 1 ); ?></td>
            <td  id="ledgertype_view" style="<?php echo $ledgertype_display; ?>"><?php  echo PFundHelper::createList('ledger_typeid',(int)$this->voucher_list->ledger_typeid, $this->ledgeritemtype_list ,0 ,'' ,$ledgertype_diabled); ?></td>
        </tr>
        <tr><td>Amount</td>
            <td colspan="2"><input type="Text"  name="amount" value="<?php echo $this->voucher_list->amount;?>" /></td>
        </tr>
        
        <tr ><td>Payable To</td>
            <td colspan="2"><?php echo PFundHelper::createList('contact_id', (int)$this->voucher_list->contact_id, $this->person_list); ?></td>
        </tr>
        
        <tr><td>Prepared By</td>
            <td colspan="2"><input type="text"  name="prepare" value="<?php if(!$this->voucher_list->prepare){ echo $user->username; }else{ echo $this->voucher_list->prepare;} ?>" /></td>
        </tr>
        
        <tr><td>Date</td>
            <td colspan="2"><?php echo JHtml::calendar($this->voucher_list->date, 'date', 'date'); ?></td>
        </tr>
        <tr> <td>Upload Related Document</td>
            <td>Description:<input type="text"  name="docdesc" value="" /></td>
            <td><input type="file" name="documentletter"  value="" size="50" /></td>
        </tr>
        <tr rowspan="<?php echo $num_file;?>">
            <td>Uploaded Documents</td> 
            <td>&nbsp;</td>
            <td>&nbsp;</td> 
        </tr>
        <?php 
         $k = 0;
            
            for($x = 0; $x < $num_file; $x++)
            {
                $row = $this->file_list[$x];
                
                ?>
        <tr > 
            <td><?php  echo  $row->docdesc; ?></td>
            <td><a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo JURI::root().'components/com_presidentfund/files/letters/voucher/'.$row->document_name;  ?> >
               <?php  echo  $row->document_name ; ?></a></td>
             <td>
                    <a href="<?php echo COMPONENT_LINK.'&controller=voucher&task=deletefile&cid='.$row->id; ?>">
                        <img src="<?php echo JURI::root().'administrator/components/com_presidentfund/assets/images/delete.png' ?>" />
                    </a>
                </td>
        </tr>
        
        <?php 
        $k = 1 - $k;
			}
        
        ?>
        </tbody>
        
    </table>

        
   
</form>
