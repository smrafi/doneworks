<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   08 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelDocSetting extends JModel
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
        $this->_data->lockwt_doc = '';
        $this->_data->lockntwt_doc = '';
        $this->_data->lockassign_doc = '';
        $this->_data->low_timelimit = '';
        $this->_data->medium_timelimit = '';
        $this->_data->high_timelimit = '';
        $this->_data->low_relock = '';
        $this->_data->medium_relock = '';
        $this->_data->high_relock = '';
        
        return $this->_data;
    }
    
    function getDocSettings()
    {
        $query = "Select * From ".TABLE_PREFIX."doc_settings ";
        $this->_db->setQuery($query);
        $this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(),'error');
            return false;
        }
        
        if($this->_data == '')
            $this->initData ();
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->lockwt_doc = JRequest::getInt('lockwt_doc');
        $this->_data->lockntwt_doc = JRequest::getInt('lockntwt_doc');
        $this->_data->lockassign_doc = JRequest::getInt('lockassign_doc');
        $this->_data->low_timelimit = JRequest::getInt('low_timelimit');
        $this->_data->medium_timelimit = JRequest::getInt('medium_timelimit');
        $this->_data->high_timelimit = JRequest::getInt('high_timelimit');
        $this->_data->low_relock = JRequest::getInt('low_relock');
        $this->_data->medium_relock = JRequest::getInt('medium_relock');
        $this->_data->high_relock = JRequest::getInt('high_relock');
        $this->_data->update_time = date('Y-m-d H:i:s');
        
        return $this->_data;
    }
    
    function store()
    {
        $this->getPostData();
        
        //validate the values has been entered
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
        if($this->_data->lockwt_doc == 0 || 
                $this->_data->lockntwt_doc == 0 ||
                $this->_data->lockassign_doc == 0 || 
                $this->_data->low_timelimit == 0 || 
                $this->_data->medium_timelimit == 0 || 
                $this->_data->high_timelimit == 0 || 
                $this->_data->low_relock == 0 || 
                $this->_data->medium_relock == 0 )
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_NOT_FILLED_ERROR'),'error');
            return false;
        }
        
        return TRUE;
    }
}

?>
