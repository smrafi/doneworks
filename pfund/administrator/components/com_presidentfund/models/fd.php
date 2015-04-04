<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   09 December 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelFD extends JModel
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
        $this->_data->bank_id = 0;
        $this->_data->bankaccount_id = 0;
        $this->_data->interest = '';
        $this->_data->period_start = '';
        $this->_data->period_end = '';
        $this->_data->interest_scheme = 0;
        $this->_data->file_name='';
        $this->_data->amount='';
        $this->_data->approval_doc='';
        $this->_data->bankid='';
        $this->_data->bankaccountid='';
        $this->_data->chequenumber='';
        $this->_data->cheque_date='';
        
        return $this->_data;
    }
    	 	
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->bank_id = JRequest::getInt('bank_id');
        $this->_data->bankaccount_id = JRequest::getInt('bankaccount_id');
        $this->_data->interest = JRequest::getFloat('interest');
        $this->_data->period_start = JRequest::getVar('period_start');
        $this->_data->period_end = JRequest::getVar('period_end');
        $this->_data->interest_scheme = JRequest::getInt('interest_scheme');
        $this->_data->file_name = JRequest::getvar('file_name');
        $this->_data->amount = JRequest::getFloat('amount');
        $this->_data->approval_doc = JRequest::getVar('approval_doc');
        $this->_data->bankid = JRequest::getVar('cheque_bank_id');
        $this->_data->bankaccountid = JRequest::getVar('cheque_bankaccount_id');
        $this->_data->chequenumber = JRequest::getVar('chequenumber');
        $this->_data->cheque_date = JRequest::getVar('cheque_date');
        
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
        
        
        
        if(!$this->_data->bank_id)
        {
            $this->_app->enqueueMessage('Please select a bank','error');
            return FALSE;
        }
        
        if(!$this->_data->bankaccount_id)
        {
            $this->_app->enqueueMessage('Please select an account number','error');
            return FALSE;
        }
        
        if(!$this->_data->interest)
        {
            $this->_app->enqueueMessage('Please Enter interset rate','error');
            return FALSE;
        }
        
        if(!$this->_data->period_start)
        {
            $this->_app->enqueueMessage('Please select a start date','error');
            return FALSE;
        }
        
        if(!$this->_data->period_end)
        {
            $this->_app->enqueueMessage('Please select a end date','error');
            return FALSE;
        }
        
        
        return TRUE;
    }
    
    
    function store()
    {
        $this->getPostData();
        
        
        if(!$this->validate())
            return FALSE;
        
        if(!$this->storeFile())
            return FALSE;
        
        $row =& $this->getTable();
        
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
        
        $query_count = "Select count(*) From  ".TABLE_PREFIX."cheque  " ;
        $query_count .=" Where number =".$this->_data->id." And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_INVESTMENT;
        $this->_db->setQuery($query_count);
        $total = $this->_db->loadResult();
        
        if($total !=0){
                $query = "Update ".TABLE_PREFIX."cheque ";
                $query .= " SET `bank_id`=".$this->_data->bankid.", `bankaccount_id`=".$this->_data->bankaccountid.", `chequenumber`='".$this->_data->chequenumber."', `cheque_amount`=".$this->_data->amount.", `cheque_date`='".$this->_data->cheque_date."'";
                $query .=" Where number =".$this->_data->id." And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_INVESTMENT;
                $this->_db->setQuery($query);
                $this->_db->query();
        }
        else{
                $query = "Insert Into ".TABLE_PREFIX."cheque (`number`, `account_type`, `ledger_item`, `bank_id`, `bankaccount_id`, `chequenumber`, `cheque_amount`, `cheque_date`) 
                            Values(".$this->_data->id.", ".ACCOUNT_TYPE_DEBIT.", ".LEDGER_VARIETY_INVESTMENT.", ".$this->_data->bankid.", ".$this->_data->bankaccountid.",'".$this->_data->chequenumber."', ".$this->_data->amount.", '".$this->_data->cheque_date."')";
                $this->_db->setQuery($query);
                $this->_db->query();
        }
        
        
        return true;
    }
    
    
    function storeFile()
    {
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'fd/';

        $allowed_ext=array('jpg', 'png', 'gif');
        $size_limit = 2 * 1024 * 1024;
        
        $files = JRequest::get('files');        
        $fd_document=$files['fd_file'];
        $fd_doc_info= pathinfo($fd_document['name']);
        $fd_doc_name= $fd_document['name'];
        $fd_doc_size=$fd_document['size'];
        
        
        $approval_document=$files['fd_doc'];
        $approval_doc_info= pathinfo($approval_document['name']);
        $approval_doc_name= $approval_document['name'];
        $approval_doc_size=$approval_document['size'];
       
       
        $unique_id = uniqid();
        $extension_fd = end(explode('.', $fd_doc_name));
        $extension_app = end(explode('.', $approval_doc_name));
      
                $fd_file_name = $unique_id.'_'.basename($fd_document['name']);
                if(move_uploaded_file($fd_document['tmp_name'], $path.$fd_file_name))
                {
                     $this->_data->file_name  = $fd_file_name;
                     
                }
                $app_file_name = $unique_id.'_'.basename($approval_document['name']);
                if(move_uploaded_file($approval_document['tmp_name'], $path.$app_file_name))
                {
                     $this->_data->approval_doc  = $app_file_name;
                     
                }
        
        return TRUE;
        
    }
       

    function getOne($id)
    {
        
        $query = "Select interest.*,cheque.bank_id As bankid,cheque.bankaccount_id As bankaccountid,cheque.chequenumber As chequenumber,cheque.cheque_date As cheque_date  ";
        $query .=" From ".TABLE_PREFIX."interest  As interest  ";
        $query .=" ,".TABLE_PREFIX."cheque As cheque ";
        $query .=" Where interest.id = $id And cheque.number =$id And cheque.account_type=".ACCOUNT_TYPE_DEBIT."  And cheque.ledger_item=".LEDGER_VARIETY_INVESTMENT;
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select interest.*, bank.bank_name, account.acc_number ";
        $query_from = "From ".TABLE_PREFIX."interest As interest, ".TABLE_PREFIX."banks As bank, ".TABLE_PREFIX."bankaccount As account ";
        $query_where = "Where interest.bank_id = bank.id And interest.bankaccount_id = account.id ";
        
        $query_order = "Order By bank.bank_name ";
        
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
    
    function publish($p)
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        $row =& $this->getTable();
        
        if (!$row->publish($cids, $p))
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return false;
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
            
            $query = "Delete From ".TABLE_PREFIX."interest Where id = $cid";
            
            $this->_db->setQuery($query);
            $this->_db->query();
            $query_cheque = "Delete From ".TABLE_PREFIX."cheque Where number = $cid  And account_type=".ACCOUNT_TYPE_DEBIT."  And ledger_item=".LEDGER_VARIETY_INVESTMENT;
            
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
