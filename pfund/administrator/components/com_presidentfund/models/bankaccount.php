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


class PFundModelBankAccount extends JModel
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
        $this->_data->bank = 0;
        $this->_data->acc_name = '';
        $this->_data->acc_type = '';
        $this->_data->acc_number = '';
        $this->_data->published = 1;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->bank = JRequest::getVar('bank');
        $this->_data->acc_name = JRequest::getVar('acc_name');
        $this->_data->acc_type = JRequest::getInt('acc_type');
        $this->_data->acc_number = JRequest::getVar('acc_number');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
    }
    
      function validate()
    {
        //if the category name is not entered we display a error message
        if($this->_data->bank == 0)
        {
            $this->_app->enqueueMessage('Please Select a Bank Name', 'error');
            return FALSE;
        }
        
        if($this->_data->acc_name == '')
        {
            $this->_app->enqueueMessage('Please Enter a Account Name Or Enter Account Number As Account Name', 'error');
            return FALSE;
        }
        
        if($this->_data->acc_number == '')
        {
            $this->_app->enqueueMessage('Please Enter a Account Number', 'error');
            return FALSE;
        }
        
        if($this->_data->acc_type == 0)
        {
            $this->_app->enqueueMessage('Select A Account Type', 'error');
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
        $query = "Select * From ".TABLE_PREFIX."bankaccount Where id = $id ";
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
        
        
        $dbf1=TABLE_PREFIX."";
        $dbf2=TABLE_PREFIX."";
        $query_count = "Select count(*) " ;
        $query_cols = "Select *  (Select ledger_item From ".TABLE_PREFIX."ledgeritem Where id=paysetting.income) As income_source ";
        $query_from = "From ".TABLE_PREFIX."bankaccount ";
        $query_where = "";
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select bankaccount.*, (Select bank_name From ".TABLE_PREFIX."banks Where id=bankaccount.bank) As bank_name   ";
        $query_from = "From ".TABLE_PREFIX."banks As banks, ".TABLE_PREFIX."bankaccount As bankaccount ";
        $query_where = "";
        
        
        
        $query_order = "Group By bankaccount.id ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."bankaccount Where id = $cid";
            
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
    
    function getAccountNumArray($option = '', $bankid = '')
    {
        $query = "Select id, acc_name From ".TABLE_PREFIX."bankaccount ";
        
        if($bankid)
            $query .= "Where bank = $bankid ";
        
        $this->_db->setQuery($query);
	$bankaccount_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $bankaccount_array = array();
        if($option)
            $bankaccount_array[0] = $option;
        
        foreach($bankaccount_list as $cat)
            $bankaccount_array[$cat->id] = $cat->acc_name;
        
        return $bankaccount_array;
    }
    
     function getAccountDetailArray( $bankaccountid)
    {
        $query = "Select acc_number From ".TABLE_PREFIX."bankaccount Where id= ".$bankaccountid;
        
        $this->_db->setQuery($query);
	$this->_data->accountnum = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        
        
        return $this->_data;
    }
    
    
}
