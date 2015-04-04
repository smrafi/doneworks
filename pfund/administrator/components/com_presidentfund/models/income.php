<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelIncome extends JModel
{
   var $_pagination = null;
    var $_data = null;
    var $_app = null;
    
    function __construct() 
    {
        $this->_app =& JFactory::getApplication();
        parent::__construct();
    }
    
    
    function pagination()
    {
        if($this->_pagination == NULL)
            $this->_pagination = new JPagination (0, 0, 0);
        return $this->_pagination;
    }
    
        function initData()
    {
        $this->_data->id = 0;
        $this->_data->income_type = 0;
        $this->_data->ledger_activity = 0;
        $this->_data->bank_id = 0;
        $this->_data->chequeno = '';
        $this->_data->chequedate = '';
        $this->_data->ledger_typeid = 0;
        $this->_data->lotteryunclaim_amount = '';
        $this->_data->in_document = '';
        $this->_data->amount = '';
        $this->_data->date = '';
        $this->_data->in_receipt = 0;
        $this->_data->contact_id = '';
        
        return $this->_data;
    }
 
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->income_type = JRequest::getInt('income_type');
        $this->_data->ledger_activity = JRequest::getInt('ledger_activity');
        $this->_data->bank_id = JRequest::getInt('bank_id');
        $this->_data->chequeno = JRequest::getVar('chequeno');
        $this->_data->chequedate = JRequest::getVar('chequedate');
        $this->_data->ledger_typeid = JRequest::getInt('ledger_typeid');
        $this->_data->lotteryunclaim_amount = JRequest::getFloat('lotteryunclaim_amount');
        $this->_data->in_document = JRequest::getVar('in_document');
        $this->_data->amount = JRequest::getFloat('amount');
        $this->_data->date = JRequest::getVar('date');
        $this->_data->in_receipt = JRequest::getInt('in_receipt');
        $this->_data->spcombo = JRequest::getVar('spcombo');
        $this->_data->status=RECEIPT_STATUS_IN;
        
        
        return $this->_data;
    }
    
    
    function validate()
    {
        
        $cheque_lenth=strlen($this->_data->chequeno);
        if($cheque_lenth >  6)
        {
            $this->_app->enqueueMessage('Cheque Number Must Be in 6 Digit', 'error');
            return FALSE;
        }
        
        if(!$this->_data->contact_id)
        {
            $this->_app->enqueueMessage('Please Enter a Person/Company Name', 'error');
            return FALSE;
        }
        
        if(!$this->_data->amount)
        {
            $this->_app->enqueueMessage('Please Enter A Amount', 'error');
            return FALSE;
        }
        
        
        if(!$this->_data->income_type)
        {
            $this->_app->enqueueMessage('Please Select A Type', 'error');
            return FALSE;
        }
        
        return TRUE;
    }
   
    
    function store()
    {    
        $this->getPostData();
     
               
        if(!$this->validate())
            return FALSE;
        
        if(!$this->storeDocument())
        return false;
        
        $row=& $this->getTable();
        
        
        if(!$row->bind($this->_data))
        {
            $this->_app->enqueueMessage($row->getError(), 'error');
            return FALSE;
        }
        
        if(!$row->store())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return false;
        }
        
        $new_id = $this->_db->insertId();
        
        if($new_id > 0)
            $this->_data->id = $new_id;
        
        $query_count = "Select count(*) From ".TABLE_PREFIX."cashbook  " ;
        $query_count .=" Where reciept_id =".$this->_data->id." And account_type=".ACCOUNT_TYPE_CREDIT."  And sub_ledger=".$this->_data->ledger_typeid;
        $this->_db->setQuery($query_count);
        $total = $this->_db->loadResult();
        
        if($total !=0){
                $query = "Update ".TABLE_PREFIX."cashbook ";
                $query .= " SET `amount`=".$this->_data->amount.", `chequenumber`='".$this->_data->chequeno."', `transection_type`=".$this->_data->income_type." ";
                $query .=" Where reciept_id =".$this->_data->id." And account_type=".ACCOUNT_TYPE_CREDIT;
                $this->_db->setQuery($query);
                $this->_db->query();
                
        }
        else{
                $insert_ledger  = "INSERT INTO ".TABLE_PREFIX."cashbook (`date` ,`account_type` ,`main_ledger` ,`sub_ledger` ,`reciept_id` ,`amount` ,`transection_type` ,`chequenumber`) ";
                $insert_ledger .= " VALUES ('".$this->_data->date."',".ACCOUNT_TYPE_CREDIT.", ".$this->_data->ledger_activity.", ".$this->_data->ledger_typeid.", ".$this->_data->id.", ".$this->_data->amount.", ".$this->_data->income_type.",'".$this->_data->chequeno."'),";
                $insert_ledger .= "  ('".$this->_data->date."',".ACCOUNT_TYPE_DEBIT.", ".LEDGER_VARIETY_CASHBOOK.", ".$this->_data->ledger_typeid.", ".$this->_data->id.", ".$this->_data->amount.", ".$this->_data->income_type.",'".$this->_data->chequeno."')";
                $this->_db->setQuery($insert_ledger);
                $this->_db->query();
        }
        
        return true;
    }
    
    
    function getList($status)
    {   
      
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select income.*,contact.contact_name  As name,ledger.ledger_type As ledgertype ";
        $query_from = "From ".TABLE_PREFIX."income As income  ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact "; 
        $query_from .=" , ".TABLE_PREFIX."ledgeritem As ledger  ";
        $query_from .=" , ".TABLE_PREFIX."banks As bank ";
        $query_where = " Where income.contact_id=contact.id ";
        $query_where .=" And income.ledger_typeid=ledger.id ";
        //$query_where .=" And income.bank_id=bank.id ";
        
        $query_order = " Group By income.id  ";
        if($status !=''){ 
            $query_where .=" And income.status=".$status;
            
            }
        else{
            $query_where .="";
            
            }
        
        $count_query = $query_count.$query_from.$query_where;
        $this->_db->setQuery($count_query);
	    $total = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //setup the pagination
        $this->_pagination = new JPagination($total, $limitstart, $limit);
        
        $query = $query_cols.$query_from.$query_where.$query_order;
        
        //get the data within limits
        $this->_data = $this->_getList($query, $limitstart, $limit);
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
        
    }
    
    
    function getOne($id)
    {
        $query = "Select income.*,contact.contact_name As name,ledger.ledger_type As ledgertype  ";
        $query .=" From ".TABLE_PREFIX."income  As income ";
        $query .=" , ".TABLE_PREFIX."contact As contact ";
        $query .=" ,".TABLE_PREFIX."ledgeritem As ledger ";
        $query .=" Where income.id = $id And contact.id=income.contact_id ";
        $query .=" And ledger.id=income.ledger_typeid ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
   function viewrecipt($date_from,$date_to)
   {
       $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select income.*,contact.contact_name  As name,ledger.ledger_type As ledgertype ";
        $query_from = "From ".TABLE_PREFIX."income As income, ".TABLE_PREFIX."ledgeritem As ledger ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact,".TABLE_PREFIX."banks As bank ";
        $query_where = "Where income.contact_id=contact.id And income.ledger_typeid=ledger.id ";
        $query_where .=" and income.bank_id = bank.id ";
        
        
        $query_order = " order By income.id  ";
        
        if($date_from !='' && $date_to !=''){ 
            $query_where .=" And date Between '".$date_from."' and '".$date_to."' ";
            
            }
        else{
            $query_where .="";
            
            }
        
        $count_query = $query_count.$query_from.$query_where;
        $this->_db->setQuery($count_query);
	    $total = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //setup the pagination
        $this->_pagination = new JPagination($total, $limitstart, $limit);
        
        $query = $query_cols.$query_from.$query_where.$query_order;
        
        //get the data within limits
        $this->_data = $this->_getList($query, $limitstart, $limit);
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
   }
    
    function storeDocument()
    {
        $income_path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'income/';

        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $income_document=$files['in_documentletter'];
        $income_doc_info= pathinfo($income_document['name']);
        $income_doc_name= $income_document['name'];
        $income_doc_size=$income_document['size'];
    
        $unique_id = uniqid();

    
        $income_file_name = $unique_id.'_'.basename($income_document['name']);
        if(move_uploaded_file($income_document['tmp_name'], $income_path.$income_file_name))
        {
             $this->_data->in_document = $income_file_name;
             
        } 
        return TRUE;
        
    }
    
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."income Where id = $cid";
            
            $this->_db->setQuery($query);
            $this->_db->query();
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    
    function getSelectedList()
    {   
        
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
       
        $query_count = "Select count(*) " ;
        $query_cols = "Select income.*,contact.contact_name  As name ";
        $query_from = "From ".TABLE_PREFIX."income As income  ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact "; 
        $query_where = " Where (contact.id=income.contact_id ) And ";
        $numrows = count($cids);
        
           $query_where .= "(";
         for($x = 0; $x < $numrows; $x++)
            {
             $query_where .= " income.id = $cids[$x] ";
            if ($x != ($numrows-1)){ $query_where .=" Or ";}
         }
         $query_where .= ")";
        $query_order = " Group By income.id  ";
        
        $count_query = $query_count.$query_from.$query_where;
        $this->_db->setQuery($count_query);
	    $total = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //setup the pagination
        $this->_pagination = new JPagination($total, $limitstart, $limit);
        
        $query = $query_cols.$query_from.$query_where.$query_order;
        
        //get the data within limits
        $this->_data = $this->_getList($query, $limitstart, $limit);
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        
        return TRUE;
        
    }

   
    function receiptupdate()
    {   $bank_id = JRequest::getInt('bank_id');
        $bankaccount_id = JRequest::getVar('bankaccount_id');
        $date = JRequest::getVar('date');
        
        
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            

                $insert_ledger1  = "INSERT INTO ".TABLE_PREFIX."cashbook (`date` ,`account_type` ,`main_ledger` ,`sub_ledger` ,`reciept_id` ,`amount` ,`transection_type`) ";
                $insert_ledger1 .=" Select '".$date."',".ACCOUNT_TYPE_CREDIT.",".LEDGER_VARIETY_CASHBOOK.",income.ledger_typeid,".$cid.",income.amount,".TRANSACTION_TYPE_DIRECT_BANK_DEPOSIT." ";
                $insert_ledger1 .=" From ".TABLE_PREFIX."income As income ";
                $insert_ledger1 .=" Where  income.id=$cid ";
                $this->_db->setQuery($insert_ledger1);
                $this->_db->query();
                $insert_ledger2  = "INSERT INTO ".TABLE_PREFIX."cashbook (`date` ,`account_type` ,`main_ledger` ,`sub_ledger` ,`reciept_id` ,`amount` ,`transection_type`) ";
                $insert_ledger2 .=" Select '".$date."',".ACCOUNT_TYPE_DEBIT.",".LEDGER_VARIETY_BANKBOOK.",income.ledger_typeid,".$cid.",income.amount,".TRANSACTION_TYPE_DIRECT_BANK_DEPOSIT." ";
                $insert_ledger2 .=" From ".TABLE_PREFIX."income As income ";
                $insert_ledger2 .=" Where  income.id=$cid ";
                $this->_db->setQuery($insert_ledger2);
                $this->_db->query();

            
   
            $query = "Update ".TABLE_PREFIX."income As income   ";
            $query .=" Set income.status = ".RECEIPT_STATUS_DEPOSITED;
            $query .=" Where  income.id  = $cid ";
            $this->_db->setQuery($query);
            $this->_db->query();
            
            $insert_query  ="Insert Into ".TABLE_PREFIX."bankbook (`date`, `bank_id`, `bankaccount_id`, `account_type`, `number`, `main_ledger`, `sub_ledger`, `amount`)";
            $insert_query .=" Select '$date',$bank_id,$bankaccount_id,".ACCOUNT_TYPE_CREDIT.",$cid,ledger.ledger_type,income.ledger_typeid,income.amount ";
            $insert_query .=" From ".TABLE_PREFIX."income As income ";
            $insert_query .=" ,".TABLE_PREFIX."ledgeritem As ledger ";
            $insert_query .=" Where  income.id  = $cid And ledger.id=income.ledger_typeid ";
            $this->_db->setQuery($insert_query);
            $this->_db->query();
            
            
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
     
    function receiptupload()
    {      
            $id = JRequest::getInt('id');
            
            if(!$this->storeBankSlip())
            return false;
            
           
            $query = "Update ".TABLE_PREFIX."income   ";
            $query .=" Set status = ".RECEIPT_STATUS_SLIP_UPLOADED;
            $query .=" Where  id  = $id ";
            $this->_db->setQuery($query);
            $this->_db->query();
            
            $update_query ="Update ".TABLE_PREFIX."bankbook  As bankbook,".TABLE_PREFIX."income As income ";
            $update_query .=" Set bankbook.bank_slip ='".$this->_data->document."'";
            $update_query .=" Where income.id=$id And bankbook.number=income.id And bankbook.account_type=".ACCOUNT_TYPE_CREDIT." And  ";
            $update_query .="  bankbook.sub_ledger=income.ledger_typeid";
            print_r($update_query);
            $this->_db->setQuery($update_query);
            $this->_db->query();
            
  
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        
        
        return TRUE;
    }
    
    function slipupdate()
    {      
            $id = JRequest::getInt('id');
            
            if(!$this->storeBankSlip())
            return false;
            
           
            $query = "Update ".TABLE_PREFIX."income   ";
            $query .=" Set status = ".RECEIPT_STATUS_SLIP_UPLOADED;
            $query .=" Where  id  = $id ";
            $this->_db->setQuery($query);
            $this->_db->query();
            
            $update_query ="Update ".TABLE_PREFIX."bankbook  As bankbook,".TABLE_PREFIX."income As income ";
            $update_query .=" Set bankbook.bank_slip ='".$this->_data->document."'";
            $update_query .=" Where income.id=$id And bankbook.number=income.id And bankbook.account_type=".ACCOUNT_TYPE_CREDIT." And  ";
            $update_query .="  bankbook.sub_ledger=income.ledger_typeid";
            print_r($update_query);
            $this->_db->setQuery($update_query);
            $this->_db->query();
            
  
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        
        
        return TRUE;
    }
   
    
     function storeBankSlip()
    {
        $income_path=JPATH_COMPONENT_SITE.DS.'files'.DS.'documents'.DS.'bankslip/';

        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $income_document=$files['documentletter'];
        $income_doc_info= pathinfo($income_document['name']);
        $income_doc_name= $income_document['name'];
        $income_doc_size=$income_document['size'];
    
        $unique_id = uniqid();

    
        $income_file_name = $unique_id.'_'.basename($income_document['name']);
        if(move_uploaded_file($income_document['tmp_name'], $income_path.$income_file_name))
        {
             $this->_data->document = $income_file_name;
             
        } 
        
        return  $this->_data->document;
        
    }
    
    function  mahapola()
    {
        $query = "Select id From ".TABLE_PREFIX."ledgeritem Where ledger_item  = '".LEDGER_VARIETY_INCOME."' And ledger_type ='Mahapola'" ;
        $this->_db->setQuery($query);
	$mahapolaid = $this->_db->loadResult(); 
        return $mahapolaid;
    }
}