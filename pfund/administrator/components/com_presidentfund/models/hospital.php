<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelHospital extends JModel
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
        $this->_data->hos_name = '';
        $this->_data->hos_address = '';
        $this->_data->hos_phone = '';
        $this->_data->hos_email = '';
        $this->_data->hos_bank = 0;
        $this->_data->hos_branch = 0;
        $this->_data->hos_accno = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->hos_name = JRequest::getVar('hos_name');
        $this->_data->hos_address = JRequest::getVar('hos_address');
        $this->_data->hos_phone = JRequest::getVar('hos_phone');
        $this->_data->hos_email = JRequest::getVar('hos_email');
        $this->_data->hos_bank = JRequest::getInt('hos_bank');
        $this->_data->hos_branch = JRequest::getInt('hos_branch');
        $this->_data->hos_accno = JRequest::getVar('hos_accno');
        
        return $this->_data;
    }
    
    function validate()
    {
          
        if(!$this->_data->hos_name)
        {
            $this->_app->enqueueMessage('Please Enter a Name','error');
            return FALSE;
        }
        
        if(!$this->_data->hos_address)
        {
            $this->_app->enqueueMessage('Please Enter a Address','error');
            return FALSE;
        }
        
        if(!$this->_data->hos_phone)
        {
            $this->_app->enqueueMessage('Please Enter a Phone Number','error');
            return FALSE;
        }
        
        if(!$this->_data->hos_email)
        {
            $this->_app->enqueueMessage('Please Enter a Email Address','error');
            return FALSE;
        }
        
        if(!JMailHelper::isEmailAddress($this->_data->hos_email))
        {
           $this->_app->enqueueMessage('Please Enter a Correct email','error');
            return FALSE;
        }
        
        if(!$this->_data->hos_bank)
        {
            $this->_app->enqueueMessage('Please select a Bank','error');
            return FALSE;
        }
        
         if(!$this->_data->hos_branch)
        {
            $this->_app->enqueueMessage('Please Enter a Branch Name','error');
            return FALSE;
        }
        
         if(!$this->_data->hos_accno)
        {
            $this->_app->enqueueMessage('Please Enter a Account Number','error');
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
        $query = "Select * From ".TABLE_PREFIX."hospital Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    //Dev Rafi
    //This function to get the list of hispital names
    function getHospitalListArray($option)
    {
        $query = "Select id, hos_name From ".TABLE_PREFIX."hospital ";
        $this->_db->setQuery($query);
	$hospital_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $hospital_array = array();
        
        if($option)
            $hospital_array[0] = $option;
        
        foreach($hospital_list as $hospital)
            $hospital_array[$hospital->id] = $hospital->hos_name;
        
        return $hospital_array;
    }
    
    //Dev Rafi
    //function to get the address of the hospital
    function getHospitalAddress($hospital_id)
    {
        $query = "Select hos_address From ".TABLE_PREFIX."hospital Where id = $hospital_id ";
        $this->_db->setQuery($query);
	$address = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $address;
    }
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select hospital.*, bank.bank_name ";
        $query_from = "From ".TABLE_PREFIX."hospital As hospital, ".TABLE_PREFIX."banks as bank ";
        $query_where = "where bank.id=hospital.hos_bank ";
        
        $query_order = "Order By hospital.hos_name ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."hospital Where id = $cid";
            
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