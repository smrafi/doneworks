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

class PFundModelVoucher extends JModel
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
        $this->_data->number = 0;
        $this->_data->ledger_typeid = 0;
        $this->_data->amount = 0;
        $this->_data->contact_id = '';
        $this->_data->prepare = '';
        $this->_data->date = '';
        
 
        return $this->_data;
    }
   	 	 	 	
   
    
    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->number=JRequest::getint('number');
        $this->_data->ledger_typeid=JRequest::getint('ledger_typeid');
        $this->_data->amount=JRequest::getFloat('amount');
        $this->_data->contact_id=JRequest::getVar('contact_id');
        $this->_data->prepare=JRequest::getVar('prepare');
        $this->_data->date=JRequest::getVar('date');
        $this->_data->docdesc=JRequest::getVar('docdesc');
        
        
        return $this->_data;
        
    }
    

    
    function store()
    {
        $this->getPostData();
               
        if(!$this->storeDocument())
        return false;
         
        $row=& $this->getTable('voucher');
       
        
        
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
        
       
        return true;
    }
    
   
    function storeDocument()
    {
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'voucher/';

        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $document=$files['documentletter'];
        $doc_info= pathinfo($document['name']);
        $doc_name= $document['name'];
        $doc_size=$document['size'];
        
        $unique_id = uniqid();
        
       
        
        if($document['tmp_name'] != '')
        {
            if($allowed_ext == $doc_info['extension'])
            {
                if($doc_size > $size_limit)
                {
                    $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                    return false;
                }

                $file_name = $unique_id.'_'.basename($document['name']);
                if(move_uploaded_file($document['tmp_name'], $path.$file_name))
                {
                     $this->_data->document_name = $file_name;
                    
                     
                $query = "Insert Into ".TABLE_PREFIX."voucher_file (voucher_id, docdesc, document_name) 
                            Values( ".$this->_data->number.", '".$this->_data->docdesc."', '".$this->_data->document_name."')";
                $this->_db->setQuery($query);
                $this->_db->query();
                
                if ($this->_db->getErrorNum())
                {
                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                    return FALSE;
                }
                      return TRUE;
                     
                }
            }
            else
            {
                $this->_app->enqueueMessage(strtoupper($doc_info['extension']).' '.JText::_('Document type cannot be saved. please upload jpg image only'), 'error');
                return false;
            }
        }
        
        
        return TRUE;
    }
    
    
    function getList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select voucher.*,contact.contact_name  As name ";
        $query_from = "From ".TABLE_PREFIX."voucher As voucher ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact ";
        $query_where = " Where voucher.contact_id= contact.id And voucher.status =".APPROVE_STATUS_PENDING;
        
        $query_order = " Group By voucher.id  ";
        
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
    
    function getvoucherviewList($date_from,$date_to)
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select voucher.*,contact.contact_name  As name, ledger.ledger_item as subledger ";
        $query_from = "From ".TABLE_PREFIX."voucher As voucher ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact, ".TABLE_PREFIX."ledgeritem as ledger";
        $query_where = " Where contact.id=voucher.contact_id and ledger.id=voucher.ledger_typeid  ";
        
        $query_order = " Order By voucher.id  ";
        
        if($date_from != '' && $date_to !='')
        {
          $query_where .= " and Date between '".$date_from."' and '".$date_to."'  ";

        }
        else
        {
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
        $query = "Select * From ".TABLE_PREFIX."voucher Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete voucher ,voucher_file   ";
            $query .=" From ".TABLE_PREFIX."voucher As voucher, ".TABLE_PREFIX."voucher_file As voucher_file ";
            $query .=" Where voucher.number=voucher_file.voucher_id And voucher.number = $cid ";
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
        $query_cols = "Select voucher.*,contact.contact_name  As name ";
        $query_from = "From ".TABLE_PREFIX."voucher As voucher ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact "; 
        $query_where = " Where (contact.id=voucher.contact_id ) And ";
        $numrows = count($cids);
        
         for($x = 0; $x < $numrows; $x++)
            {
             $query_where .= " voucher.id = $cids[$x] ";
            if ($x != ($numrows-1)){ $query_where .=" Or ";}
         }
        $query_order = " Group By voucher.id  ";
        
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
    
    function getFiles($id)
    {  if($id){
        $query = "Select id,docdesc,document_name  From ".TABLE_PREFIX."voucher_file Where voucher_id = $id ";
        $this->_db->setQuery($query);
	$file_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $file_data;
    }
    else{return False;}
    }
    
    
    function deletefile()
    {
        $id = JRequest::getInt('cid');
        
        $query = "Delete From ".TABLE_PREFIX."voucher_file Where id = $id ";
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    
    
     function voucherupdate()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            
            $query = "Update ".TABLE_PREFIX."voucher As voucher   ";
            $query .=" Set voucher.status = ".APPROVE_STATUS_VOUCHER_RELEASED;
            $query .=" Where  voucher.number = $cid ";
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
    
    
    function generateNumber()
    {
        $query = "Show Table Status Where name = 'jos_com_pf_voucher' ";
        $this->_db->setQuery($query);
        $table_info = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        
        
        return $table_info;
    }
    
    function getCreditorArray($option = '')
    {    
         $query = "Select id, contact_name From ".TABLE_PREFIX."contact ";
         $query .= "Where contact_office = ".OFFICE_TYPE_CREDITOR;
        
        $this->_db->setQuery($query);
	$creditor_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $creditor_array = array();
        if($option)
            $creditor_array[0] = $option;
        
        foreach($creditor_list as $cat)
            $creditor_array[$cat->id] = $cat->contact_name;
        
        return $creditor_array;
        
    }
    
    function getPersonArray($option = '')
    {    
         $query = "Select id, contact_name From ".TABLE_PREFIX."contact ";
         
        
        $this->_db->setQuery($query);
	$person_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $creditor_array = array();
        if($option)
            $person_array[0] = $option;
        
        foreach($person_list as $cat)
            $person_array[$cat->id] = $cat->contact_name;
        
        return $person_array;
        
    }
    
    function getReceiptUploadedList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select voucher.*,contact.contact_name As name,ledgeritem.ledger_item As ledger_item  ";
        $query_from = "From ".TABLE_PREFIX."voucher As voucher ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact ";
        $query_from .=" , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where voucher.document !='' And  voucher.status =3  And contact.id=voucher.contact_id And ledgeritem.id=voucher.ledger_typeid 	 ";
        
        $query_order = " Group By voucher.id  ";
        
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
      
    
    function getVoucherReleasedOne($id)
    {    
                $query = "Select voucher.*,contact.contact_name As name,ledgeritem.ledger_item As ledger_item ";
                $query .= "From ".TABLE_PREFIX."voucher As voucher ";  
                $query .=" , ".TABLE_PREFIX."contact As contact ";  
                $query .=" , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
                $query .= " Where voucher.id = $id  And contact.id=voucher.contact_id And ledgeritem.id=voucher.ledger_typeid ";

                
                $this->_db->setQuery($query);
                $release_list = $this->_db->loadObject();

                if ($this->_db->getErrorNum())
                {
                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                    return FALSE;
                }
                
                return $release_list;
        
       
    }
    
    
    function getReceiptChequeOne($id)
    {    
                $query = "Select cheque.* ";
                $query .= "From ".TABLE_PREFIX."cheque As cheque ";  
                $query .= " Where cheque.number = $id   ";

                
                $this->_db->setQuery($query);
                $this->_data = $this->_db->loadObject();

                if ($this->_db->getErrorNum())
                {
                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                    return FALSE;
                }
                
                return $this->_data;
        
       
    }    
    

    
    function getVoucherReleasedList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select voucher.*,contact.contact_name As name  ";
        $query_from = "From ".TABLE_PREFIX."voucher As voucher ";
        $query_from .=" , ".TABLE_PREFIX."contact As contact  ";
        $query_where = " Where voucher.status =2 And contact.id=voucher.contact_id ";
        
        $query_order = " Group By voucher.id  ";

        
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
    
     function initChequeData()
    {
        $this->_data->id = 0;
        $this->_data->number = 0;
        $this->_data->account_type = 0;
        $this->_data->bank_id = 0;
        $this->_data->bankaccount_id = 0;
        $this->_data->chequenumber = '';
        $this->_data->cheque_amount = 0;
        $this->_data->cheque_date = '';
        
        return $this->_data;
    }
 
    
    function getPostChequeData()
    {
        $this->_data->id=JRequest::getInt('id');
        $this->_data->number=JRequest::getInt('number');
        $this->_data->account_type=JRequest::getInt('account_type');
        $this->_data->bank_id=JRequest::getInt('bank_id');
        $this->_data->bankaccount_id=JRequest::getInt('bankaccount_id');
        $this->_data->chequenumber=JRequest::getVar('chequenumber');
        $this->_data->cheque_amount=JRequest::getFloat('cheque_amount');
        $this->_data->cheque_date=JRequest::getVar('cheque_date');
   
        return $this->_data;
        
    }
    
    
     function storeReciept()
    {
        $this->getPostChequeData();
           
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'voucher/';

        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $document=$files['documentletter'];
        $doc_info= pathinfo($document['name']);
        $doc_name= $document['name'];
        $doc_size=$document['size'];
        
        $unique_id = uniqid();
        
       
        
        if($document['tmp_name'] != '')
        {
            if($allowed_ext == $doc_info['extension'])
            {
                if($doc_size > $size_limit)
                {
                    $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                    return false;
                }

                $file_name = $unique_id.'_'.basename($document['name']);
                if(move_uploaded_file($document['tmp_name'], $path.$file_name))
                {
                $this->_data->document=$file_name;    
                     
                $query = "Update ".TABLE_PREFIX."voucher As voucher Set voucher.document='".$file_name."',voucher.status=3  Where  voucher.number=".$this->_data->number;
                $this->_db->setQuery($query);
                $this->_db->query();
                
                if ($this->_db->getErrorNum())
                {
                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                    return FALSE;
                }
                      return TRUE;
                     
                }
            }
            else
            {
                $this->_app->enqueueMessage(strtoupper($doc_info['extension']).' '.JText::_('Document type cannot be saved. please upload jpg image only'), 'error');
                return false;
            }
        }
        
        
        return TRUE;
    }
    
    function getUpdateLedger()
    {   
        
        $bank_id=JRequest::getInt('bank_id');
        $bankaccount_id=JRequest::getInt('bankaccount_id');
        $chequenumber=JRequest::getVar('chequenumber');
        $cheque_date=JRequest::getVar('cheque_date');
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
                $insert_ledger_credit  = "INSERT INTO ".TABLE_PREFIX."cashbook (`date` ,`account_type` ,`main_ledger` ,`sub_ledger` ,`voucher_id` ,`amount` ,`transection_type` ,`chequenumber`) ";
                $insert_ledger_credit .= " Select 'voucher.date',".ACCOUNT_TYPE_CREDIT.", ledger.ledger_type, voucher.ledger_typeid, ".$cid.", voucher.amount, ".TRANSACTION_TYPE_CHEQUE.",'".$chequenumber."' ";
                $insert_ledger_credit .= "  From ".TABLE_PREFIX."voucher As voucher ,".TABLE_PREFIX."ledgeritem As ledger ";
                $insert_ledger_credit .= "  Where  voucher.id=".$cid."  And ledger.id=voucher.ledger_typeid ";
                $this->_db->setQuery($insert_ledger_credit);
                $this->_db->query();
                
                $insert_ledger_debit  = "INSERT INTO ".TABLE_PREFIX."cashbook (`date` ,`account_type` ,`main_ledger` ,`sub_ledger` ,`voucher_id` ,`amount` ,`transection_type` ,`chequenumber`) ";
                $insert_ledger_debit .= " Select 'voucher.date',".ACCOUNT_TYPE_DEBIT.", ".LEDGER_VARIETY_BANKBOOK.", voucher.ledger_typeid, ".$cid.", voucher.amount, ".TRANSACTION_TYPE_CHEQUE.",'".$chequenumber."' ";
                $insert_ledger_debit .= "  From ".TABLE_PREFIX."voucher As voucher ";
                $insert_ledger_debit .= "  Where  voucher.id=".$cid;
                $this->_db->setQuery($insert_ledger_debit);
                $this->_db->query();
                
                $insert_ledger_Cheque  = "INSERT INTO ".TABLE_PREFIX."cheque (`number`, `account_type`, `ledger_item`, `bank_id`, `bankaccount_id`, `chequenumber`, `cheque_amount`, `cheque_date`) ";
                $insert_ledger_Cheque .= " Select ".$cid.",".ACCOUNT_TYPE_DEBIT.", voucher.ledger_typeid, ".$bank_id.", ".$bankaccount_id.",'".$chequenumber."',voucher.amount,'".$cheque_date."'";
                $insert_ledger_Cheque .= "  From ".TABLE_PREFIX."voucher As voucher ";
                $insert_ledger_Cheque .= "  Where  voucher.id=".$cid;
                $this->_db->setQuery($insert_ledger_Cheque);
                $this->_db->query();
               
           
        }
        
        return TRUE;
    }
    
    
}
