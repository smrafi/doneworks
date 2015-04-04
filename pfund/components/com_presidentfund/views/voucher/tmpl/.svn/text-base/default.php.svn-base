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
$ledger_type = PFundHelper::getLedgerType('Select a Type');
$user =& JFactory::getUser();
JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');


$num_file = count($this->file_list);
?>
<h1>Add Voucher</h1>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
<form action="index.php" method="post" name="adminForm" class="submit-form" enctype="multipart/form-data">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="voucher" />
    <input type="hidden" name="id" value="<?php echo $this->voucher_list->id;?>" />
    <table  id="voucher">
        <tbody>
        <tr><td>Number</td>  
            <td ><strong><?php if(!$this->voucher_list->number ){echo $this->voucher_num->Auto_increment ;} else{echo $this->voucher_list->number ; }?></strong>
                <input type="hidden"  name="number" value="<?php if(!$this->voucher_list->number ){echo $this->voucher_num->Auto_increment ;} else{echo $this->voucher_list->number ; }?>" /></td>
        </tr>
        
        <tr ><td>Ledger Type</td>
            <td  ><?php  echo PFundHelper::createList('ledger_typeid',(int)$this->voucher_list->ledger_typeid, $this->ledgeritemtype_list ); ?></td>
        </tr>
        <tr><td>Amount</td>
            <td ><input type="Text"  maxlength="8" name="amount" value="<?php echo $this->voucher_list->amount;?>" /></td>
        </tr>
        
        <tr ><td>Payable To</td>
            <td ><?php echo PFundHelper::createList('contact_id', (int)$this->voucher_list->contact_id, $this->person_list); ?></td>
        </tr>
        
        <tr><td>Prepared By</td>
            <td ><?php if(!$this->voucher_list->prepare){ echo $user->username; }else{ echo $this->voucher_list->prepare;} ?><input type="hidden"  name="prepare" value="<?php if(!$this->voucher_list->prepare){ echo $user->username; }else{ echo $this->voucher_list->prepare;} ?>" /></td>
        </tr>
        
        <tr><td>Date</td>
            <td ><?php echo JHtml::calendar($this->voucher_list->date, 'date', 'date'); ?></td>
        </tr>
        <tr> <td colspan="3"><h4>Upload Related Document:</h4></td>
            
        </tr>
        <tr >
            <td>Document Description</td>
            <td><input type="text"  name="docdesc" value="" /></td>
        </tr>
        <tr >
            <td>Document Upload</td>
            <td><input type="file" name="documentletter"  value="" size="50" /></td>
        </tr>
        <?php  if($this->file_list){
            
            echo '<tr ><td colspan="3"><h4>Uploaded Documents</h4></td></tr>';
        } ?>
       
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
</div>