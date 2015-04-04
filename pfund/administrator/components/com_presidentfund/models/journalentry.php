<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelJournalEntry extends JModel
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
        $this->_data->je_date = 0;
        $this->_data->je_voucher_no = '';
        $this->_data->je_description = '';
        $this->_data->je_c_amount = 0;
        $this->_data->je_d_amount = 0;
        $this->_data->je_remarks = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->je_date = JRequest::getvar('je_date');
        $this->_data->je_voucher_no = JRequest::getvar('je_voucher_no');
        $this->_data->sub_ledger = JRequest::getvar('ledger_typeid');
        $this->_data->je_description = JRequest::getvar('je_description');
        $this->_data->je_c_amount = JRequest::getFloat('je_c_amount');
        $this->_data->je_d_amount = JRequest::getFloat('je_d_amount');
        $this->_data->je_remarks = JRequest::getvar('je_remarks');
        
        return $this->_data;
        
    }
    
     function validate()
    {
          
        if(!$this->_data->je_voucher_no)
        {
            $this->_app->enqueueMessage('Please Enter Voucher Number','error');
            return FALSE;
        }
        
        if(!$this->_data->je_description)
        {
            $this->_app->enqueueMessage('Please Enter a Description','error');
            return FALSE;
        }
        
        if(!$this->_data->je_d_amount && !$this->_data->je_c_amount)
        {
            $this->_app->enqueueMessage('Please Enter a Credit/Debit Amount','error');
            return FALSE;
        }
        
        if($this->_data->je_d_amount && $this->_data->je_c_amount)
        {
            $this->_app->enqueueMessage('Invalid Entry','error');
            return FALSE;
        }
        
        if(!$this->_data->je_d_amount && $this->_data->je_c_amount)
        {
           
            return TRUE;
        }
        if($this->_data->je_d_amount && !$this->_data->je_c_amount)
        {
           
            return TRUE;
        }
        return TRUE;
    }
    
    function store()
    {
        
        $this->getPostData();
        
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
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "SELECT journalentry.*,ledger.ledger_item  As sub_ledger ";
        $query_from = "FROM ".TABLE_PREFIX."journalentry  As journalentry ";
        $query_from .= ", ".TABLE_PREFIX."ledgeritem As ledger ";
        $query_where = " Where journalentry.sub_ledger=ledger.id ";
        
        $query_order = "Order By je_date ";
        
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
}
