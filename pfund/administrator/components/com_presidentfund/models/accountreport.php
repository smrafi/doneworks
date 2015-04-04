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


class PFundModelAccountReport extends JModel
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
    
    
    function getLedgerList($ledger)
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.* ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from = " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where ledgeritem.ledger_type= ".$ledger;
        $query_where = " And  cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " Group By cashbook.id  ";
        
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
    
     function getTrialBalance()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.*, ledgeritem.ledger_item ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from .= " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where cashbook.sub_ledger = ledgeritem.id and cashbook.main_ledger != ".LEDGER_VARIETY_CASHBOOK ;
        
        
        $query_order = " order By main_ledger  ";
        
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
 
    
    function getAccPayable()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.* ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from = " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " Group By cashbook.id  ";
        
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
    
    
    function getAccReceivable()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.* ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from = " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " Group By cashbook.id  ";
        
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
    
    function getBalanceSheet()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.* ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from = " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " Group By cashbook.id  ";
        
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
    
    function getBudgetAnalys()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select cashbook.* ";
        $query_from = "From ".TABLE_PREFIX."cashbook As cashbook ";
        $query_from = " , ".TABLE_PREFIX."ledgeritem As ledgeritem ";
        $query_where = " Where cashbook.sub_ledger = ledgeritem.id ";
        
        
        $query_order = " Group By cashbook.id  ";
        
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
    
    function getSearchList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
    $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
    $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
       
        $app_type = JRequest::getInt('app_type');
        $district = JRequest::getInt('patient_district');
        $dsoffice = JRequest::getInt('patient_dsoffice');
        $medi_cat = JRequest::getInt('cat_id');
        $medi_con = JRequest::getInt('disease_id');
        $title = JRequest::getInt('patient_title');
        $other_title = JRequest::getInt('othertitle_patient');
        $age_from = JRequest::getInt('age_from');
        $age_to = JRequest::getInt('age_to');
        $app_status = JRequest::getInt('status');
        $period_from = JRequest::getvar('period_from');
        $period_to = JRequest::getvar('period_to');
       
       
        $query_count = "Select count(*) " ;
        $query_cols = "Select app.*, category.category_name as category_name , disease.disease_name as disease_name, manage_app.grant_amount as grant_amount, manage_app.status as status ";
        $query_from = "From ".TABLE_PREFIX."application As app, ".TABLE_PREFIX."manage_application as manage_app,".TABLE_PREFIX."category as category,".TABLE_PREFIX."disease as disease ";
        $query_where= "where app.id=manage_app.application_id and category.id=manage_app.cat_id and disease.id=manage_app.disease_id and disease.cat_id=category.id ";

        if($app_type == 0){
            $query_where .= "";
        }
        else{
           $query_where .= "and app.application_type=$app_type ";
        }
        if($district == 0){
            $query_where .= "";
        }
        else{
            $query_where .= "and app.patient_district=$district ";
        }
        if($dsoffice == 0){
            $query_where .= "";
        }
        else{
            $query_where .= "and app.patient_dsoffice=$dsoffice ";
        }
        if($age_from==0 && $age_to ==0){
            $query_where .= "";
        }
        else{
            $query_where .= "and app.age BETWEEN $age_from and $age_to ";
        }
        if($app_status== 0){
            $query_where .= "";
        }
        else{
             $query_where .= "and manage_app.status = $app_status ";
        }
        if($period_from== 0 && $period_to == 0){
            $query_where .= "";
        }
        else{
            $query_where .= "and app.age BETWEEN '".$period_from."' and '".$period_to."' ";
        }
        if($medi_cat== 0){
            $query_where .= "";
        }
        else{
            $query_where .= "and manage_app.cat_id = $medi_cat ";
        }
        if($medi_con == 0){
            $query_where .= "";
        }
        else{
            $query_where .= "and manage_app.disease_id = $medi_con ";
        }
       
        $query_order = "Order By patient_num ";
       
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