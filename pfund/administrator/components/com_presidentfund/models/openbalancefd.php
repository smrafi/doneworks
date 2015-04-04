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


class PFundModelOpenBalanceFD extends JModel
{
    var $_pagination = null;
    var $_data = null;
    var $_app = null;
    
    function __construct() 
    {
        $this->_app =& JFactory::getApplication();
        parent::__construct();
    }
    
    
    function initData()
    {
        $this->_data->id = 0;
        $this->_data->bank_id = 0;
        $this->_data->bankaccount_id = 0;
        $this->_data->interest = '';
        $this->_data->period_start = '';
        $this->_data->period_end = '';
        $this->_data->published = 1;
        $this->_data->amount = '';
        
        return $this->_data;
    }
    
    function pagination()
    {
        if($this->_pagination == NULL)
            $this->_pagination = new JPagination (0, 0, 0);
        return $this->_pagination;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->bank_id = JRequest::getInt('bank_id');
        $this->_data->bankaccount_id = JRequest::getInt('bankaccount_id');
        $this->_data->interest = JRequest::getFloat('interest');
        $this->_data->amount = JRequest::getFloat('amount');
        $this->_data->period_start = JRequest::getVar('period_start');
        $this->_data->period_end = JRequest::getVar('period_end');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
    }
    
    function validate()
    {
          
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
        
        $row =& $this->getTable();
        
        $query = "Update ".TABLE_PREFIX."openbalance Set ob_fd =ob_fd  +   ".$this->_data->amount;
        
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
       

    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."ob_fd Where id = $id ";
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
        $query_cols = "Select fd.*, bank.bank_name, account.acc_number ";
        $query_from = "From ".TABLE_PREFIX."ob_fd As fd, ".TABLE_PREFIX."banks As bank, ".TABLE_PREFIX."bankaccount As account ";
        $query_where = "Where fd.bank_id = bank.id And fd.bankaccount_id = account.id ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."ob_fd Where id = $cid";
            
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

