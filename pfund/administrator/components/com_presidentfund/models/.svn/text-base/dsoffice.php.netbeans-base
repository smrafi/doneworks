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


class PFundModelDsOffice extends JModel
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
        $this->_data->district = 0;
        $this->_data->ds_office = '';
        
        return $this->_data;
    }
    
     function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->district = JRequest::getInt('district');
        $this->_data->ds_office = JRequest::getVar('ds_office');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
    }
    
      function validate()
    {
          if(!$this->_data->district)
          {
              $this->_app->enqueueMessage('Please select a district','error');
              return FALSE;
          }
        //if the company name or seller name is not entered we display a error message
        if($this->_data->ds_office == '')
        {
            $this->_app->enqueueMessage('Please Enter a DS Office Name','error');
            return FALSE;
        }

        return TRUE;
    }
    
     function store()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
        $row =& $this->getTable('dsoffice');
        
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
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."dsoffice";
        $query_where = "";
        
        $query_order = " Order By district ";
        
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
        $query = "Select * From ".TABLE_PREFIX."dsoffice Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
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
            
            $query = "Delete From ".TABLE_PREFIX."dsoffice Where id = $cid";
            
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
    
    //Dev Rafi
    //A function to get a list of ds offices as array
    function dsOfficeListArray($option = '', $district_id = 0)
    {
        $query = "Select id, ds_office From ".TABLE_PREFIX."dsoffice ";
        
        if($district_id)
            $query .= "Where district = $district_id ";
        
        $this->_db->setQuery($query);
	$office_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $office_array = array();
        
        if($option)
            $office_array[0] = $option;
        
        foreach($office_list as $office)
            $office_array[$office->id] = $office->ds_office;
        
        return $office_array;
    }
}