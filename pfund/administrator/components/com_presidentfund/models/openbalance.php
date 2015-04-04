<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelOpenbalance extends JModel
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
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->ob_date = JRequest::getVar('ob_date');
        $this->_data->ob_accumulate = JRequest::getFloat('ob_accumulate');
        
        return $this->_data;
    }

    function validate()
    {
          
        if(!$this->_data->ob_accumulate)
        {
            $this->_app->enqueueMessage('Please Enter Accumulate','error');
            return FALSE;
        }
        
        if(!$this->_data->ob_date )
        {
            $this->_app->enqueueMessage('Please Select Date','error');
            return FALSE;
        }
        
        
        return TRUE;
    }
    
    function getOne()
    {
        $query = "Select * From ".TABLE_PREFIX."openbalance ";
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
        
        
        
        return true;
    }
    
       
    function getList()
    {
        $query_count = "Select count(*) " ;
        $query_cols = "Select openbalance.*";
        $query_from = "From ".TABLE_PREFIX."openbalance As openbalance ";
        $query_where = "";
        
        $query_order = "Order By openbalance.id  ";
       
        $query = $query_cols.$query_from.$query_where.$query_order;
        
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
    
    
     function getOpenBalanceList()
    {
        $query_bank = "Select SUM(bal_amount) ";
        $query_bank .= "From ".TABLE_PREFIX."bankbalance  ";
       
        $this->_db->setQuery($query_bank);
	$this->_data->bankbalance = $this->_db->loadResult();
        
        
        $query_receivable = "Select SUM(rec_amount) ";
        $query_receivable .= "From ".TABLE_PREFIX."ob_receivable  ";
       
        $this->_db->setQuery($query_receivable);
	$this->_data->receivablebalance = $this->_db->loadResult();
        
        
        $query_payable = "Select SUM(pl_amount) ";
        $query_payable .= "From ".TABLE_PREFIX."ob_payable  ";
       
        $this->_db->setQuery($query_payable);
	$this->_data->payablebalance = $this->_db->loadResult();
        
        
        $query_loan = "Select SUM(al_balance) ";
        $query_loan .= "From ".TABLE_PREFIX."ob_loan  ";
       
        $this->_db->setQuery($query_loan);
	$this->_data->loanbalance = $this->_db->loadResult();
        
        $query_fd = "Select SUM(amount) ";
        $query_fd .= "From ".TABLE_PREFIX."ob_fd  ";
       
        $this->_db->setQuery($query_fd);
	$this->_data->fdbalance = $this->_db->loadResult();
       
       
        return $this->_data;
        
    }
    
 
}
