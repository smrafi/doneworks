<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelLedgerItem extends JModel
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
        $this->_data->ledger_type = 0;
        $this->_data->ledger_item ='';
        $this->_data->bank_id = 0;
        $this->_data->bankaccount_id = 0;
        $this->_data->account_type=0;
        
        return $this->_data;
    }
    
    function getpostdata()
    {
        $this->_data->id = JRequest::getVar('id');
        $this->_data->ledger_item = JRequest::getVar('ledger_item');
        $this->_data->ledger_type = JRequest::getint('ledger_type');
        $this->_data->bank_id = JRequest::getint('bank_id');
        $this->_data->bankaccount_id = JRequest::getint('bankaccount_id');
        $this->_data->account_type = JRequest::getint('account_type');
       
        return $this->_data;
        
    }
   
    function ledgercheck()
    {
        $query = "Select count(*) From ".TABLE_PREFIX."ledgeritem Where ledger_type  = '".LEDGER_VARIETY_LIABILITY."' And 	ledger_item ='Mahapola'" ;
        $this->_db->setQuery($query);
	$total = $this->_db->loadResult(); 
        if($total == 0 ){
            $query = "Insert Into ".TABLE_PREFIX."ledgeritem(`ledger_type`, `ledger_item`, `account_type`) " ;
            $query .= " Value(".LEDGER_VARIETY_LIABILITY.",'Mahapola',".ACCOUNT_TYPE_DEBIT.")" ;
            $this->_db->setQuery($query);
            $this->_db->query();
             
        }
        $query_lottery = "Select count(*) From ".TABLE_PREFIX."ledgeritem Where ledger_type  = '".LEDGER_VARIETY_LIABILITY."' And 	ledger_item ='Development Lotteries Board'" ;
        $this->_db->setQuery($query_lottery);
	$total_lottery = $this->_db->loadResult(); 
        if($total_lottery == 0 ){
            $query = "Insert Into ".TABLE_PREFIX."ledgeritem(`ledger_type`, `ledger_item`, `account_type`) " ;
            $query .= " Value(".LEDGER_VARIETY_LIABILITY.",'Development Lotteries Board',".ACCOUNT_TYPE_DEBIT.")" ;
            $this->_db->setQuery($query);
            $this->_db->query();
             
        }
        
    }


    function store()
    {
        
        $this->ledgercheck();
        $this->getpostdata();
                
        
        if(!$this->validate())
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
        
        return true;
               
    }
     function validate()
    {
      
        
        if(!$this->_data->account_type)
        {
            $this->_app->enqueueMessage('Please select the Account Type', 'error');
            return FALSE;
        }
        
        $query = "Select count(*) From ".TABLE_PREFIX."ledgeritem Where ledger_item  = '".$this->_data->ledger_item."' And ledger_type =".$this->_data->ledger_type ;
        $this->_db->setQuery($query);
	$total = $this->_db->loadResult();
        if($total != 0 ){
            
             $this->_app->enqueueMessage('Entered Sub Ledger Item Already have', 'error');
             return FALSE;
        }
        
        if($this->_data->ledger_item=='mahapola'||$this->_data->ledger_item=='Mahapola'||$this->_data->ledger_item=='MHESTF')
        {
            $this->_app->enqueueMessage('Entered Sub Ledger Item Already have', 'error');
            return FALSE;
        }
        
        if(!$this->_data->ledger_item)
        {
            $this->_app->enqueueMessage('Please Enter A Sub Ledger Item', 'error');
            return FALSE;
        }
        
        
         if(!$this->_data->ledger_type)
        {
            $this->_app->enqueueMessage('Please Select A Main Ledger Item', 'error');
            return FALSE;
        }
        
        
        return TRUE;
    }
    
      function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."ledgeritem Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getLedgerItemList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select ledgeritem.* ,(Select bank.bank_name From ".TABLE_PREFIX."banks As bank Where ledgeritem.bank_id = bank.id) As bank_name  ";
        $query_cols .= " ,(Select bankacc.acc_number  From ".TABLE_PREFIX."bankaccount as bankacc Where ledgeritem.bankaccount_id = bankacc.id) As acc_number  ";
        $query_from = "From  ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = "";
         
        $query_order = "Order By ledger_item ";
        
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
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."ledgeritem Where id = $cid";
            
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
    
     //dev asfaran
    //Function for get  ledger item separatedly according to ledger activity
    
     function getLedgerItemArray($option = '', $option_id = '',$task='')
    {
        
        $query = "Select id, ledger_item From ".TABLE_PREFIX."ledgeritem ";
        if($task=='account_type'){
            $query .= " Where account_type = $option_id";
		}
	    if($task=='ledger_type'){
			 $query .= " Where ledger_type = $option_id ";
		}
        
        $this->_db->setQuery($query);
	$ledgeritem_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $ledgeritem_array = array();
        if($option)
            $ledgeritem_array[0] = $option;
        
        foreach($ledgeritem_list as $cat)
            $ledgeritem_array[$cat->id] = $cat->ledger_item;
        
        return $ledgeritem_array;
    }
    
    
    
    
}
