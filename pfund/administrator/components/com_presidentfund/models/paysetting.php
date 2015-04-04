<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   13/12/2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelPaySetting extends JModel
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
        $this->_data->income =0;
        $this->_data->pay_item = 0;
        $this->_data->pay_per = 0;
        
        return $this->_data;
    }
    
    function getpostdata()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->income = JRequest::getInt('income');
        $this->_data->pay_item = JRequest::getInt('pay_item');
        $this->_data->pay_per = JRequest::getInt('pay_per');
       
        return $this->_data;
        
    }
    
    function store()
    {
        $this->getpostdata();
                
        
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
      
        if(!$this->_data->income)
        {
            $this->_app->enqueueMessage('Please Select a Income Source', 'error');
            return FALSE;
        }
         if(!$this->_data->pay_item)
        {
            $this->_app->enqueueMessage('Please select a  Ledger Item', 'error');
            return FALSE;
        }
         if(!$this->_data->pay_per)
        {
            $this->_app->enqueueMessage('% From Income Source To Ledger Item', 'error');
            return FALSE;
        }
       
        
        
        return TRUE;
    }
    
      function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."paysetting Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getPaySettingList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select paysetting.*, (Select ledger_item From ".TABLE_PREFIX."ledgeritem Where id=paysetting.income) As income_source ,(Select ledger_item From ".TABLE_PREFIX."ledgeritem Where id=paysetting.pay_item) As payable_item  ";
        $query_from = "From ".TABLE_PREFIX."paysetting As paysetting, ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = "";
         
        $query_order = "Group By paysetting.id ";
        
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
        
        return TRUE;
    }
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."paysetting Where id = $cid";
            
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
