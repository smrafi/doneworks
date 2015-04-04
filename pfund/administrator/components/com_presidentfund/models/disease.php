<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   06 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelDisease extends JModel
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
        $this->_data->disease_name = '';
        $this->_data->private_amount = '';
        $this->_data->sjgh_amount = '';
        $this->_data->gh_amount = '';
        $this->_data->cat_id = 0;
        $this->_data->published = 1;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->disease_name = JRequest::getVar('disease_name');
        $this->_data->private_amount = JRequest::getFloat('private_amount');
        $this->_data->sjgh_amount = JRequest::getFloat('sjgh_amount');
        $this->_data->gh_amount = JRequest::getFloat('gh_amount');
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
    }
    
    
     function validate()
    {
        //check weather category is selected
        if(!$this->_data->cat_id)
        {
            $this->_app->enqueueMessage('Please select a category','error');
            return FALSE;
        }
        
        if($this->_data->disease_name == '')
        {
            $this->_app->enqueueMessage('Enter Name Correctly','error');
            return FALSE;
        }
        
        if($this->_data->private_amount == 0)
        {
            $this->_app->enqueueMessage('Enter a private amount','error');
            return FALSE;
        }
        
        if($this->_data->sjgh_amount == 0)
        {
            $this->_app->enqueueMessage('Enter SJGH Amount','error');
            return FALSE;
        }
        
         if($this->_data->gh_amount == 0)
        {
            $this->_app->enqueueMessage('Enter Government Hospitel Amount','error');
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
    
    
    function getDiseaseList($option = '', $cat_id = '')      //Dev Rafi - function changed to normalize the usage 28/12/2011
    {
        $query = "Select id, disease_name From ".TABLE_PREFIX."disease ";
        
        if($cat_id)
            $query .= "Where cat_id = $cat_id ";
        
        $this->_db->setQuery($query);
	$disease_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $disease_array = array();
        if($option)
            $disease_array[0] = $option;
        
        foreach($disease_list as $disease)
            $disease_array[$disease->id] = $disease->disease_name;
        
        return $disease_array;
    }
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."disease Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select disease.*, cat.category_name ";
        $query_from = "From ".TABLE_PREFIX."category As cat, ".TABLE_PREFIX."disease As disease ";
        $query_where = "Where disease.cat_id = cat.id ";
        
        $query_order = "Order By disease_name ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."disease Where id = $cid";
            
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
