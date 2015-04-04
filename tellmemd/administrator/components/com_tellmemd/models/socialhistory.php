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


class TellMeMdModelSocialHistory extends JModel
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
        $this->_data->smoking_status = 0;
        $this->_data->quit_smoke_timeago = 0;
        $this->_data->quit_smoke_duration = 0;
        $this->_data->yes_packpd = 0;
        $this->_data->yes_smoke_duration = 0;
        $this->_data->alchohol_status = 0;
        $this->_data->drug_usage = 0;
        $this->_data->drug_type = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = 0;
        $this->_data->smoking_status = JRequest::getInt('smoking_status');
        $this->_data->quit_smoke_timeago = JRequest::getInt('quit_smoke_timeago');
        $this->_data->quit_smoke_duration = JRequest::getInt('quit_smoke_duration');
        $this->_data->yes_packpd = JRequest::getInt('yes_packpd');
        $this->_data->yes_smoke_duration = JRequest::getInt('yes_smoke_duration');
        $this->_data->alchohol_status = JRequest::getInt('alchohol_status');
        $this->_data->drug_usage = JRequest::getInt('drug_usage');
        $this->_data->drug_type = JRequest::getVar('drug_type');
        
        return $this->_data;
    }
    
    function store()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
        //make ready data to store on table
        $this->formatData();
        
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
        return TRUE;
    }
    
    function validate()
    {
        if($this->_data->smoking_status == 0)
        {
            $this->_app->enqueueMessage('Select your smoking status','error');
            return false;
        }
        
        //if smoking status is quit
        if($this->_data->smoking_status == OPTION_QUIT)
        {
            if($this->_data->quit_smoke_timeago == 0)
            {
                $this->_app->enqueueMessage('Select how long ago you quit from smoking','error');
                return false;
            }
            if($this->_data->quit_smoke_duration == 0)
            {
                $this->_app->enqueueMessage('Select duration you smoked','error');
                return false;
            }
        }
        
        //if smoking status is yes
        if($this->_data->smoking_status == OPTION_YES)
        {
            if($this->_data->yes_packpd == 0)
            {
                $this->_app->enqueueMessage('Select average packs per day you are using.','error');
                return false;
            }
            if($this->_data->yes_smoke_duration == 0)
            {
                $this->_app->enqueueMessage('Select duration you are smoking','error');
                return false;
            }
        }
        
        if($this->_data->alchohol_status == 0)
        {
            $this->_app->enqueueMessage('Select your alchohol status','error');
            return false;
        }
        if($this->_data->drug_usage == 0)
        {
            $this->_app->enqueueMessage('Select your drung usage','error');
            return false;
        }
        
        if($this->_data->drug_usage == OPTION_YES && empty ($this->_data->drug_type))
        {
            $this->_app->enqueueMessage('Select drugs you are using','error');
            return false;
        }
        
        return TRUE;
    }
    
    function formatData()
    {
        if($this->_data->smoking_status == OPTION_QUIT)
        {
            $this->_data->smoking_howlong = $this->_data->quit_smoke_timeago;
            $this->_data->smoking_duration = $this->_data->quit_smoke_duration;
        }
        if($this->_data->smoking_status == OPTION_QUIT)
        {
            $this->_data->average_packs = $this->_data->yes_packpd;
            $this->_data->smoking_duration = $this->_data->yes_smoke_duration;
        }
        
        if($this->_data->drug_usage == OPTION_YES && (!empty ($this->_data->drug_type)))
        {
            $posted_drugs = $this->_data->drug_type;
            $this->_data->drug_type = '';
            foreach($posted_drugs as $drugs)
                    $this->_data->drug_type .= $drugs.', ';
        }
        
        //setup user id
        $user =& JFactory::getUser();
        $this->_data->user_id = $user->id;
        
        $this->_data->added_time = date('Y-m-d H:i:s');
        
        return TRUE;
    }
}