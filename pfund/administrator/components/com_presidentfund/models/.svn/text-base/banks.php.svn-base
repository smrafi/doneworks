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


class PFundModelBanks extends JModel
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
    
     function validate()
    {
          
        if(!$this->_data->bank_name)
        {
            $this->_app->enqueueMessage('Please Enter a bank','error');
            return FALSE;
        }
        
        if(!$this->_data->bank_code)
        {
            $this->_app->enqueueMessage('Please Enter a Bank code number','error');
            return FALSE;
        }
        
        
        
        
        return TRUE;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->bank_name = JRequest::getVar('bank_name');
        $this->_data->bank_code = JRequest::getVar('bank_code');
        
        return $this->_data;
    }
    
     function storeBanks()
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
    
    
     
    function getBanksList()
    {
        $query = "Select * From ".TABLE_PREFIX."banks ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function deletebanks()
    {
        $id = JRequest::getInt('cid');
        
        $query = "Delete From ".TABLE_PREFIX."banks Where id = $id ";
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
///This function array for list the bank
    function getBankArray($option = '')
    {
        $query = "Select id, bank_name From ".TABLE_PREFIX."banks ";
        $this->_db->setQuery($query);
	$bank_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $bank_array = array();
        if($option)
            $bank_array[0] = $option;
        
        foreach($bank_list as $cat)
            $bank_array[$cat->id] = $cat->bank_name;
        
        return $bank_array;
    }

    
    
}