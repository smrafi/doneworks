<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelSurgery extends JModel
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
        $this->_data->published = 1;
        $this->_data->cat_id = 0;
        $this->_data->surgery_name = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->published = JRequest::getInt('published');
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->surgery_name = JRequest::getVar('surgery_name', '');
        
        $this->_data->updated_time = date('Y-m-d H:i:s');
        
        return $this->_data;
    }
    
    function validate()
    {
        if($this->_data->cat_id == 0)
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SELECT_CAT_ERROR'),'error');
            return false;
        }
        
        if($this->_data->surgery_name == '')
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SURGERY_NAME_NOT_FILLED_ERROR'),'error');
            return false;
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
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
//        $filter_var = JRequest::getVar('filter_desc', '');
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select cats.cat_name, surg.* ";
        $query_from = "From ".TABLE_PREFIX."category As cats, ".TABLE_PREFIX."surgery As surg ";
        $query_where = "Where surg.cat_id = cats.id ";
        
//        if($filter_var)
//            $query_where .= "Where cats.cat_description Like '%$filter_var%' ";
        
        $query_order = "Order By surg.surgery_name ";
        
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
        $query = "Select * From ".TABLE_PREFIX."surgery Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getByCatID($cat_id)
    {
        $query = "Select * From ".TABLE_PREFIX."surgery Where cat_id = $cat_id And published = 1 ";
        $this->_db->setQuery($query);
        $data_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $data_list;
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
            
            $query = "Delete From ".TABLE_PREFIX."surgery Where id = $cid";
            
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
    
    function getPostPastSurgery()
    {
        $this->_data->surgery_type = JRequest::getVar('surgery_type', '');
        $this->_data->added_time = date('Y-m-d H:i:s');
        
        $user =&JFactory::getUser();
        $this->_data->user_id = $user->id;
        
        return $this->_data;
    }
    
    function arrangePastSurgeryArray()
    {
        $surgery_array = $this->_data->surgery_type;
        $count = 1;
        $this->_data->surgery_type = '';
        foreach ($surgery_array as $id)
        {
            if($count < count($surgery_array))
                $this->_data->surgery_type .= $id.', ';
            else
                $this->_data->surgery_type .= $id;
            $count++;
        }
        
        return TRUE;
    }
    
    function storePastSugery()
    {
        $this->getPostPastSurgery();
        
        if(empty ($this->_data->surgery_type))
            return;
        
        $this->arrangePastSurgeryArray();
        
        $row =& $this->getTable('surgerytypeids');
        
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
