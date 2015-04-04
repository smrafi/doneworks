<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelLedger extends JModel
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
    
    function getList($search)
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.*,ledgeritem.ledger_item  As ledger_name   ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from .= " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where  cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " order By cashbook.id  ";
        
        
        if($search !=0 || $search !=''){
            
           $query_where .= " And  ledgeritem.ledger_type= ".$search;
        }
        else{
             $query_where .="";
            
        }
        
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

    
    
    function getLedgerList($search)
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select SUM(amount) As amount,cashbook.id As id,cashbook.account_type As account_type,cashbook.main_ledger As main_ledger,ledgeritem.ledger_item  As ledger_name,ledgeritem.ledger_type  As type   ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from .= " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where  cashbook.sub_ledger = ledgeritem.id ";
        
      
        $query_order = " order By cashbook.sub_ledger   ";
        
        if($search != 0 || $search != ''){
            
           $query_where .= " And  ledgeritem.ledger_type= ".$search;
        }
        else{
             $query_where .="";
            
        }
        
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
}
