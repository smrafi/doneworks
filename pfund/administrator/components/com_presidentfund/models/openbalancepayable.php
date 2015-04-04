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

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelOpenbalancePayable extends JModel
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
        $this->_data->pl_whom = '';
        $this->_data->pl_date = '';
        $this->_data->pl_amount = 0;
        $this->_data->pl_type = '';
        $this->_data->pl_remark = '';
        
        return $this->_data;
    }

    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->pl_whom=JRequest::getVar('pl_whom');
        $this->_data->pl_date=JRequest::getVar('pl_date');
        $this->_data->pl_amount=JRequest::getFloat('pl_amount');
        $this->_data->pl_type=JRequest::getInt('pl_type');
        $this->_data->pl_remark=JRequest::getVar('pl_remark');
        
        return $this->_data;
        
    }
    
    function validate()
    {
      
        if(!$this->_data->pl_whom)
        {
            $this->_app->enqueueMessage('Please Select A  Creditor', 'error');
            return FALSE;
        }
        
        if(!$this->_data->pl_date)
        {
            $this->_app->enqueueMessage('Please Select the Date', 'error');
            return FALSE;
        }
        
        if(!$this->_data->pl_amount)
        {
            $this->_app->enqueueMessage('Please Enter Amount', 'error');
            return FALSE;
        }
        
       
        if(!$this->_data->pl_type)
        {
            $this->_app->enqueueMessage('Please Select A Type', 'error');
            return FALSE;
        }
        if(!$this->_data->pl_remark)
        {
            $this->_app->enqueueMessage('Please Enter Reamrks', 'error');
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
        
        $query = "Update ".TABLE_PREFIX."openbalance Set ob_payable  =ob_payable  +   ".$this->_data->pl_amount;
        
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
        $query_cols = "SELECT payable.*, ledgeritem.ledger_item , contact.contact_name ";
        $query_from = "FROM ".TABLE_PREFIX."ob_payable as payable , ".TABLE_PREFIX."ledgeritem as ledgeritem , ".TABLE_PREFIX."contact as contact ";
        $query_where = "WHERE payable.pl_type= ledgeritem.id ";
        
        $query_order = " Group By payable.id  ";
        
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
        $query = "Select * From ".TABLE_PREFIX."ob_payable Where id = $id ";
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
            
            $query = "Delete From ".TABLE_PREFIX."ob_payable Where id = $cid";
            
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
