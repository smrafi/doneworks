<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   01 feb 2012
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelBankReconcilate extends JModel
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
    
    function getList($type)
    {
//        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limit = 0;
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select bankbook.*,income.chequeno as chq_no, contact.contact_name as name ";
        $query_from = "From ".TABLE_PREFIX."bankbook as bankbook, ".TABLE_PREFIX."income as income, ".TABLE_PREFIX."contact as contact ";
        $query_where = "where  income.id = bankbook.number and contact.id = income.contact_id " ;
        if(!empty($type)){
            if($type==ACCOUNT_TYPE_CREDIT)
               $query_where .=" And bankbook.account_type = ".ACCOUNT_TYPE_CREDIT;
             if($type==ACCOUNT_TYPE_DEBIT)
                $query_where .=" And bankbook.account_type = ".ACCOUNT_TYPE_DEBIT;
        }

        $query_order = " Order By bankbook.date ";
        
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
    
    
     function updateStatus()
    {
        $id = JRequest::getInt('cid');
        
        $query = "Update  ".TABLE_PREFIX."bankbook Set 	status=".COMMON_STATUS_RECOMMEND." Where id = $id ";
        print_r( $query);
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
