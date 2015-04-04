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


class PFundModelOpenBalanceLoan extends JModel
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
        $this->_data->al_whom = '';
        $this->_data->al_type = 0;
        $this->_data->al_scheme = 0;
        $this->_data->al_balance = '';
        $this->_data->al_amount = '';
        $this->_data->al_start = '';
        $this->_data->al_due = '';
        $this->_data->al_rate = '';
        $this->_data->al_remark = '';
 
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id=JRequest::getInt('id');
        $this->_data->al_whom=JRequest::getInt('al_whom');
        $this->_data->al_type=JRequest::getint('al_type');
        $this->_data->al_scheme=JRequest::getInt('al_scheme');
        $this->_data->al_balance=JRequest::getFloat('al_balance');
        $this->_data->al_amount=JRequest::getFloat('al_amount');
        $this->_data->al_start=JRequest::getVar('al_start');
        $this->_data->al_due=JRequest::getVar('al_due');
        $this->_data->al_rate=JRequest::getInt('al_rate');
        $this->_data->al_remark=JRequest::getVar('al_remark');
        
        return $this->_data;
        
    }
    
    function validate()
    {
      
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
        
        $row=& $this->getTable();
        
        $query = "Update ".TABLE_PREFIX."openbalance Set ob_loan =ob_loan +".$this->_data->al_balance;
        
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
    
    
    
    
    function getLoanList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select loan.*,(Select contact.contact_name From  ".TABLE_PREFIX."contact  As contact Where contact.id=loan.al_whom ) As name ";
        $query_from = "From ".TABLE_PREFIX."ob_loan As loan , ".TABLE_PREFIX."contact As contact ";
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
        $query = "Select * From ".TABLE_PREFIX."ob_loan Where id = $id ";
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
         $query .= "Where contact_office = 4 ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."ob_loan Where id = $cid";
            
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
