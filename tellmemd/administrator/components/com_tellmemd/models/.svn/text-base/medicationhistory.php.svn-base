<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class TellMeMdModelMedicationHistory extends JModel
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
        $this->_data->medication_name = '';
        $this->_data->dose = '';
        $this->_data->frequency = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->medication_name = JRequest::getVar('medication_name', '');
        $this->_data->dose = JRequest::getVar('dose', '');
        $this->_data->frequency = JRequest::getVar('frequency', '');
        $this->_data->added_time = date('Y-m-d H:i:s');
        
        $user =&JFactory::getUser();
        $this->_data->user_id = $user->id;
        
        return $this->_data;
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
    
    function validate()
    {
        if($this->_data->medication_name == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter the name for medication.'),'error');
            return false;
        }
        if($this->_data->dose == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter the dose for medication.'),'error');
            return false;
        }
        if($this->_data->frequency == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter how frequency you use.'),'error');
            return false;
        }
        
        return TRUE;
    }
    
    function getAllMedication()
    {
        $user =& JFactory::getUser();
        $user_id = $user->id;
        
        $query = "Select * From ".TABLE_PREFIX."medication_history Where user_id = $user_id ";
        $this->_db->setQuery($query);
	$medi_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $medi_list;
    }
    
    function getPostIDs()
    {
        $this->_data->medication_ids = JRequest::getVar('medication_ids', '');
        $this->_data->added_time = date('Y-m-d H:i:s');
        
        $user =&JFactory::getUser();
        $this->_data->user_id = $user->id;
        
        return $this->_data;
    }
    
    function arrangeIDs()
    {
        $medication_ids = $this->_data->medication_ids;
        $count = 1;
        $this->_data->medication_ids = '';
        foreach ($medication_ids as $id)
        {
            if($count < count($medication_ids))
                $this->_data->medication_ids .= $id.', ';
            else
                $this->_data->medication_ids .= $id;
            $count++;
        }
        
        return TRUE;
    }
    
    function storeIDs()
    {
        $this->getPostIDs();
        $this->arrangeIDs();
        
        $row =& $this->getTable('medicationids');
        
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
}
