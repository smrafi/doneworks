<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   22 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

class PFundModelBankBalance extends JModel
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
        $this->_data->published = 1;
        $this->_data->bank_id = 0;
        $this->_data->bankaccount_id = 0;
        $this->_data->bal_amount = '';
      
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->bank_id =JRequest::getInt('bank_id');
        $this->_data->bankaccount_id =JRequest::getVar('bankaccount_id');
        $this->_data->bal_amount =JRequest::getFloat('bal_amount');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
        
    }
    
    function validate()
    {
      
        if(!$this->_data->bank_id)
        {
            $this->_app->enqueueMessage('Please Select a Bank', 'error');
            return FALSE;
        }
        
       
        if(!$this->_data->bankaccount_id)
        {
            $this->_app->enqueueMessage('Please Select A Account Number', 'error');
            return FALSE;
        }
        if(!$this->_data->bal_amount)
        {
            $this->_app->enqueueMessage('Please Enter the Blance Amount', 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
               
        if(!$this->validate())
            return FALSE;
        
        $row=& $this->getTable();
        
       
        $query = "Update ".TABLE_PREFIX."openbalance Set ob_bank =ob_bank +   ".$this->_data->bal_amount;
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        
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
    
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "SELECT bankbalance.*, bank.bank_name, bankacc.acc_number,bankacc.acc_name ";
        $query_from = "FROM ".TABLE_PREFIX."bankbalance as bankbalance, ".TABLE_PREFIX."banks as bank, ".TABLE_PREFIX."bankaccount as bankacc ";
        $query_where = "WHERE bankbalance.bank_id=bank.id and bankbalance.bankaccount_id=bankacc.id ";
        
        $query_order = "Order By bankbalance.bal_date ";
        
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
        $query = "Select * From ".TABLE_PREFIX."bankbalance Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
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
            
            $query = "Delete From ".TABLE_PREFIX."bankbalance Where id = $cid";
            
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
}