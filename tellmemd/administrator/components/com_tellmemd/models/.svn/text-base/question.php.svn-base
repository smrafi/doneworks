<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   29 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class TellMeMdModelQuestion extends JModel
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
    
    function getPostData()
    {
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->que_subject = JRequest::getVar('que_subject', '');
        $this->_data->que_content = JRequest::getVar('que_content', '');
        $this->_data->added_time = date('Y-m-d H:i:s');
        $this->_data->case_num = uniqid('case');
        
        return $this->_data;
    }
    
    function validate()
    {
        if($this->_data->que_subject == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter the subject to continue.'),'error');
            return false;
        }
        
        if($this->_data->que_content == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter question content.'),'error');
            return false;
        }
        
        return TRUE;
    }
    
    function store()
    {
        $user =& JFactory::getUser();
        $this->getPostData();
        
        $this->_data->patient_id = $user->id;
        
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
    
    function storeTempData()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
        $row =& $this->getTable('tempquestion');
        
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
    
    function getTempData()
    {
        $temp_id = JRequest::getVar('temp_id', '');
        $user =& JFactory::getUser();
        
        if($user->guest || $temp_id == '')
            return FALSE;
        
        $query = "Select * From ".TABLE_PREFIX."tempque Where temp_id = '$temp_id' ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function storePermenent()
    {
        //make id to zero
        if(!$this->getTempData())
            return FALSE;
        
        $this->_data->id = 0;
        
        $user =& JFactory::getUser();
        $this->_data->patient_id = $user->id;
        
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
    
    function deleteTempData()
    {
        $temp_id = JRequest::getVar('temp_id', '');
        
        $query = "Delete From ".TABLE_PREFIX."tempque Where temp_id = '$temp_id'";
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    //check weather case id exist on record and it has access permission to process
    //if this case hase been already processed then we redirect them to new case page
    function checkQuestionCase()
    {
        $case_num = JRequest::getVar('case_num', '');
        $query = "Select * From ".TABLE_PREFIX."questions Where case_num = '$case_num' And processed = 0 ";
        $this->_db->setQuery($query);
        $this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        if($this->_data)
            return TRUE;
        else
            return FALSE;
    }
    
    function updateAccessed()
    {
        $case_num = JRequest::getVar('case_num', '');
        
        $query = "Update ".TABLE_PREFIX."questions Set processed = 1 Where case_num = '$case_num' ";
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
}