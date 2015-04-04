<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class TellMeMdModelLabCase extends JModel
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
        $this->_data->lab_id = JRequest::getInt('lab_id');
        $this->_data->lab_subject = JRequest::getVar('lab_subject', '');
        $this->_data->lab_content = JRequest::getVar('lab_content', '');
        $this->_data->added_time = date('Y-m-d H:i:s');
        $this->_data->case_num = uniqid('case');
        $this->_data->file_name = '';
        
        return $this->_data;
    }
    
    function validate()
    {
        if($this->_data->lab_subject == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter the subject to continue.'),'error');
            return false;
        }
        
        if($this->_data->lab_content == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter report content.'),'error');
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
        
        //process the file that has  been uploaded
       if(!$this->processReportFile())
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
        
        //process the file that has  been uploaded
       if(!$this->processReportFile())
           return FALSE;
        
        $row =& $this->getTable('templabdata');
        
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
    
    function getTempData()
    {
        $temp_id = JRequest::getVar('temp_id', '');
        $user =& JFactory::getUser();
        
        if($user->guest || $temp_id == '')
            return FALSE;
        
        $query = "Select * From ".TABLE_PREFIX."templab Where temp_id = '$temp_id' ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function processReportFile()
    {
        $path = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'labreports/';
        $size_limit = 2 * 1024 * 1024;
        $allowed_ext = array(
            'doc' => 'doc',
            'docx' => 'docx',
            'gif' => 'gif',
            'jpg' => 'jpg',
            'png' => 'png',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'pdf' => 'pdf'
        );
        
        $files = JRequest::get('files');
        $template_file = $files['template_file'];
        
        //get the file informations
        $tmp_file = $template_file['tmp_name'];
        $file_size = $template_file['size'];
        $info = pathinfo($template_file['name']);
        
        $unique_id = uniqid();
        
        //if file is not available then we retun true and escape from this function
        if($template_file['name'] == '')
            return TRUE;
        
        //we compare the file size and return false if file size is exceeded than 2 MB
        if($file_size > $size_limit)
        {
            $this->_app->enqueueMessage(JText::_('Maximum upload file size limit 2MB'), 'error');
            return false;
        }
        
        //if file extension is not acceptable then we return false
        if(!$allowed_ext[$info['extension']])
        {
            $this->_app->enqueueMessage(strtoupper($info['extension']).' '.JText::_('file extesnion is not allowed'), 'error');
            return false;
        }
        
        //move the file to path
        $file_name = $unique_id.'_'.basename($template_file['name']);
        if(move_uploaded_file($tmp_file, $path.$file_name))
            $this->_data->file_name = $file_name;
        
        return TRUE;
    }
    
    //check weather case id exist on record and it has access permission to process
    //if this case hase been already processed then we redirect them to new case page
    function checkLabCase()
    {
        $case_num = JRequest::getVar('case_num', '');
        $query = "Select * From ".TABLE_PREFIX."labcase Where case_num = '$case_num' And processed = 0 ";
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
    
    function deleteTempData()
    {
        $temp_id = JRequest::getVar('temp_id', '');
        
        $query = "Delete From ".TABLE_PREFIX."templab Where temp_id = '$temp_id'";
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