<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   13 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelPatientSetting extends JModel
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
        $this->_data->specific_doctor = 0;
        $this->_data->urgencycasetime_low = '';
        $this->_data->urgencycasetime_medium = '';
        $this->_data->urgencycasetime_high = '';
        $this->_data->newdoctime_urglow = '';
        $this->_data->newdoctime_urgmedium = '';
        $this->_data->newdoctime_urghigh = '';
        $this->_data->priceinc_urglow = '';
        $this->_data->priceinc_urgmedium = '';
        $this->_data->priceinc_urghigh = '';
        $this->_data->priceinc_level_low = '';
        $this->_data->priceinc_level_medium = '';
        $this->_data->priceinc_level_high = '';
        $this->_data->priceinc_medium_submit = '';
        $this->_data->priceinc_medium_chat = '';
        $this->_data->priceinc_medium_skype = '';
        $this->_data->words_divide = '';
        $this->_data->simple_labtest_price = '';
        $this->_data->mod_labtest_price = '';
        $this->_data->complex_labtest_price = '';
        $this->_data->maxprice_percentage = '';
        $this->_data->minprice_percentage = '';
        
        return $this->_data;
    }
    
    function getDocSettings()
    {
        $query = "Select * From ".TABLE_PREFIX."patient_settings ";
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
        $this->_data->specific_doctor = JRequest::getInt('specific_doctor');
        $this->_data->urgencycasetime_low = JRequest::getInt('urgencycasetime_low');
        $this->_data->urgencycasetime_medium = JRequest::getInt('urgencycasetime_medium');
        $this->_data->urgencycasetime_high = JRequest::getInt('urgencycasetime_high');
        $this->_data->newdoctime_urglow = JRequest::getInt('newdoctime_urglow');
        $this->_data->newdoctime_urgmedium = JRequest::getInt('newdoctime_urgmedium');
        $this->_data->newdoctime_urghigh = JRequest::getInt('newdoctime_urghigh');
        $this->_data->priceinc_urglow = JRequest::getInt('priceinc_urglow');
        $this->_data->priceinc_urgmedium = JRequest::getInt('priceinc_urgmedium');
        $this->_data->priceinc_urghigh = JRequest::getInt('priceinc_urghigh');
        $this->_data->priceinc_level_low = JRequest::getInt('priceinc_level_low');
        $this->_data->priceinc_level_medium = JRequest::getInt('priceinc_level_medium');
        $this->_data->priceinc_level_high = JRequest::getInt('priceinc_level_high');
        $this->_data->priceinc_medium_submit = JRequest::getInt('priceinc_medium_submit');
        $this->_data->priceinc_medium_chat = JRequest::getInt('priceinc_medium_chat');
        $this->_data->priceinc_medium_skype = JRequest::getInt('priceinc_medium_skype');
        $this->_data->words_divide = JRequest::getInt('words_divide');
        $this->_data->simple_labtest_price = JRequest::getInt('simple_labtest_price');
        $this->_data->mod_labtest_price = JRequest::getInt('mod_labtest_price');
        $this->_data->complex_labtest_price = JRequest::getInt('complex_labtest_price');
        $this->_data->maxprice_percentage = JRequest::getInt('maxprice_percentage');
        $this->_data->minprice_percentage = JRequest::getInt('minprice_percentage');
        
        $this->_data->updated_time = date('Y-m-d H:i:s');
        
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
        if($this->_data->urgencycasetime_low == 0 || 
                $this->_data->urgencycasetime_medium == 0 ||
                $this->_data->urgencycasetime_high == 0 || 
                $this->_data->newdoctime_urglow == 0 || 
                $this->_data->newdoctime_urgmedium == 0 || 
                $this->_data->newdoctime_urghigh == 0)
        {
            $this->_data->urgencycasetime_low = '';
            $this->_data->urgencycasetime_medium = '';
            $this->_data->urgencycasetime_high = '';
            $this->_data->newdoctime_urglow = '';
            $this->_data->newdoctime_urgmedium = '';
            $this->_data->newdoctime_urghigh = '';
            
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_NOT_FILLED_ERROR'),'error');
            return false;
        }
        
        return TRUE;
    }
}
