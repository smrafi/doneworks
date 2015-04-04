<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
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


class PFundModelContact extends JModel
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
        $this->_data->contact_office = 0;
        $this->_data->contact_name = '';
        $this->_data->address = '';
        $this->_data->email = '';
        $this->_data->phone = '';
        $this->_data->published = 1;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->contact_office = JRequest::getInt('contact_office');
        $this->_data->contact_name = JRequest::getVar('contact_name');
        $this->_data->address = JRequest::getVar('address');
        $this->_data->email = JRequest::getVar('email');
        $this->_data->phone = JRequest::getVar('phone');
        $this->_data->published = JRequest::getInt('published');
        
        return $this->_data;
    }
    
      function validate()
    {
          
        if(!$this->_data->contact_office)
        {
            $this->_app->enqueueMessage('Please Select a Contact Office','error');
            return FALSE;
        }
        //if the contact name  is not entered we display a error message
        if($this->_data->contact_name == '')
        {
            $this->_app->enqueueMessage('Please Enter a Contact Name','error');
            return FALSE;
        }
        
        if($this->_data->email == '')
        {
            $this->_app->enqueueMessage('Please enter the email address','error');
            return FALSE;
        }
        
        //if email address is entered and if that is wrong we validate it
        if(!JMailHelper::isEmailAddress($this->_data->email))
        {
           $this->_app->enqueueMessage('Please Enter a Correct email','error');
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
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."contact Where id = $id ";
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
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."contact ";
        $query_where = "";
        
        $query_order = "Order By contact_name ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."contact Where id = $cid";
            
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
    
    
     function getContactArray($test_value)
    {
        
        $query = "Select contact_name From ".TABLE_PREFIX."contact WHERE contact_name Like '$test_value%'  ";
      
        
        $this->_db->setQuery($query);
	$ledgeritem_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        $html="";
        $numrows = count($ledgeritem_list);
       
        if($numrows != 0):
        $html .="<ul>";
         for($x = 0; $x < $numrows; $x++)
            {
                $row = $ledgeritem_list[$x];
                
                $html .='<li onClick="fill(\''.$row->contact_name.'\');">'.$row->contact_name.'</li>';
            }
         $html .="</ul>";
     endif;
        return $html;
    }
 
}
