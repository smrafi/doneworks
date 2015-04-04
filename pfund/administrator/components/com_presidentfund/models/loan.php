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


class PFundModelLoan extends JModel
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
        $this->_data->al_whom = 0;
        $this->_data->al_type = 0;
        $this->_data->al_scheme = 0;
        $this->_data->al_amount = '';
        $this->_data->al_start = '';
        $this->_data->al_due = '';
        $this->_data->al_rate = '';
        $this->_data->al_request = '';
        $this->_data->al_offer = '';
        $this->_data->bank_id = '';
        $this->_data->bankaccount_id = '';
        $this->_data->chequenumber = '';
        $this->_data->cheque_date = '';
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->al_whom=JRequest::getint('al_whom');
        $this->_data->al_type=JRequest::getint('al_type');
        $this->_data->al_scheme=JRequest::getint('al_scheme');
        $this->_data->al_amount=JRequest::getFloat('al_amount');
        $this->_data->al_start=JRequest::getVar('al_start');
        $this->_data->al_due=JRequest::getVar('al_due');
        $this->_data->al_rate=JRequest::getVar('al_rate');
        $this->_data->al_request=JRequest::getVar('al_request');
        $this->_data->al_offer=JRequest::getVar('al_offer');
        $this->_data->bank_id=JRequest::getVar('cheque_bank_id');
        $this->_data->bankaccount_id=JRequest::getVar('cheque_bankaccount_id');
        $this->_data->chequenumber=JRequest::getVar('chequenumber');
        $this->_data->cheque_date=JRequest::getVar('cheque_date');
        
        return $this->_data;
        
    }
    
    function validate()
    {
        $cheque_lenth=strlen($this->_data->chequenumber);
        if($cheque_lenth >  6)
        {
            $this->_app->enqueueMessage('Cheque Number Must Be in 6 Digit', 'error');
            return FALSE;
        } 
        
        if(!$this->_data->al_whom)
        {
            $this->_app->enqueueMessage('Please Select A  Creditor', 'error');
            return FALSE;
        }
        
        if(!$this->_data->al_type)
        {
            $this->_app->enqueueMessage('Please Select A Interest Type', 'error');
            return FALSE;
        }
        
        if(!$this->_data->al_scheme)
        {
            $this->_app->enqueueMessage('Please Select A Interest Period', 'error');
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
        
        $query_count = "Select count(*) From ".TABLE_PREFIX."cheque  " ;
        $query_count .=" Where number =".$this->_data->id." And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_RECEIVABLE;
        $this->_db->setQuery($query_count);
        $total = $this->_db->loadResult();
        
        if($total !=0){
                $query = "Update ".TABLE_PREFIX."cheque ";
                $query .= " SET `bank_id`=".$this->_data->bank_id.", `bankaccount_id`=".$this->_data->bankaccount_id.", `chequenumber`='".$this->_data->chequenumber."', `cheque_amount`=".$this->_data->al_amount.", `cheque_date`='".$this->_data->cheque_date."'";
                $query .=" Where number =".$this->_data->id." And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_RECEIVABLE;
                $this->_db->setQuery($query);
                $this->_db->query();
                
        }
        else{
                $query = "Insert Into ".TABLE_PREFIX."cheque (`number`, `account_type`, `ledger_item`, `bank_id`, `bankaccount_id`, `chequenumber`, `cheque_amount`, `cheque_date`) 
                            Values(".$this->_data->id.", ".ACCOUNT_TYPE_DEBIT.", ".LEDGER_VARIETY_RECEIVABLE.", ".$this->_data->bank_id.", ".$this->_data->bankaccount_id.",'".$this->_data->chequenumber."', ".$this->_data->al_amount.", '".$this->_data->cheque_date."')";
                $this->_db->setQuery($query);
                $this->_db->query();
        }
        
        return true;
    }
    
    
    function storeDocument()
    {
        $request_path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'loan'.DS.'request/';
        $offer_path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'loan'.DS.'offer/';

        $allowed_ext = array('jpg', 'png', 'gif' ,'pdf');
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $request_document=$files['al_requestletter'];
        $request_doc_info= pathinfo($request_document['name']);
        $request_doc_name= $request_document['name'];
        $request_doc_size=$request_document['size'];
        
        $offer_document=$files['al_offerletter'];
        $offer_doc_info= pathinfo($offer_document['name']);
        $offer_doc_name= $offer_document['name'];
        $offer_doc_size=$offer_document['size'];
       
        $unique_id = uniqid();

        $request_file_name = $unique_id.'_'.basename($request_document['name']);
        if(move_uploaded_file($request_document['tmp_name'], $request_path.$request_file_name))
        {
             $this->_data->al_request = $request_file_name;
             
        }
        $offer_file_name = $unique_id.'_'.basename($offer_document['name']);
        if(move_uploaded_file($offer_document['tmp_name'], $offer_path.$offer_file_name))
        {
             $this->_data->al_offer = $offer_file_name;
             
        }
           
       
        return TRUE;
        
    }
    
    
    function getLoanList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select loan.*,(Select contact.contact_name From  ".TABLE_PREFIX."contact  As contact Where contact.id=loan.al_whom ) As name ";
        $query_from = "From ".TABLE_PREFIX."loan As loan , ".TABLE_PREFIX."contact As contact ";
        $query_where = "";
        
        $query_order = " Group By loan.id  ";
        
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
        $query = "Select loan.*,cheque.bank_id As bank_id,cheque.bankaccount_id As bankaccount_id,cheque.chequenumber As chequenumber,cheque.cheque_date As cheque_date  ";
        $query .=" From ".TABLE_PREFIX."loan  As loan  ";
        $query .=" ,".TABLE_PREFIX."cheque As cheque ";
        $query .=" Where loan.id = $id And cheque.number =$id And cheque.account_type=".ACCOUNT_TYPE_DEBIT."  And cheque.ledger_item=".LEDGER_VARIETY_RECEIVABLE;
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getCreditorArray($option = '')
    {    
         $query = "Select id, contact_name From ".TABLE_PREFIX."contact ";
         $query .= "Where contact_office =  ".OFFICE_TYPE_CREDITOR;
        
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
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."loan Where id = $cid";
            
            $this->_db->setQuery($query);
            $this->_db->query();
            $query_cheque = "Delete From ".TABLE_PREFIX."cheque Where number = $cid  And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_RECEIVABLE;
            
            $this->_db->setQuery($query_cheque);
            $this->_db->query();
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
}