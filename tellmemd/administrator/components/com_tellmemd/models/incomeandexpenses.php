<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   18 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelIncomeAndExpenses extends JModel
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
            
       
    function getCaseDetails()
    {       
         
        $filter_var1 = JRequest::getVar('filter_start', date('Y-m-d H:i:s'));
        $filter_var2 = JRequest::getVar('filter_end', date('Y-m-d H:i:s'));
        
        //get Total cases
        $query = "Select Count(*) From ".TABLE_PREFIX."cases Where date_added >= '$filter_var1' And date_added <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$caselist['count'] = $this->_db->loadResult();
             
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }       
       
        //get Solved cases
        $query = "Select Count(*) From ".TABLE_PREFIX."cases Where status=".CASE_STATUS_SOLVED." And date_added >= '$filter_var1' And date_added <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$caselist['solved'] = $this->_db->loadResult();
             
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }       
        
        //get Closed cases
        $query = "Select Count(*) From ".TABLE_PREFIX."cases Where status=".CASE_STATUS_CLOSED." And date_added >= '$filter_var1' And date_added <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$caselist['closed'] = $this->_db->loadResult();
             
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }      
        
        //get Refunded cases
        $query = "Select Count(*) From ".TABLE_PREFIX."cases Where status=".CASE_STATUS_REFUNDED." And date_added >= '$filter_var1' And date_added <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$caselist['refunded'] = $this->_db->loadResult();
             
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }       
        
        
        return $caselist;        
      
    }
    
    function getIncomeDetails()
    {              
        
       
        $filter_var1 = JRequest::getVar('filter_start', date('Y-m-d H:i:s'));
        $filter_var2 = JRequest::getVar('filter_end', date('Y-m-d H:i:s'));
        
        //get Total Case Income
        $query = "Select Sum(price) From ".TABLE_PREFIX."cases Where date_added >= '$filter_var1' And date_added <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$incomelist['total_income'] = $this->_db->loadResult();
        
        if($incomelist['total_income']==null){
            $incomelist['total_income']=0;
        }     
       
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }       
       
        //get Paid to doctors
        $query = "Select Sum(payment_amount) From ".TABLE_PREFIX."payment_invoice Where payment_date >= '$filter_var1' And payment_date <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$incomelist['paid_doctor'] = $this->_db->loadResult();
        
        if($incomelist['paid_doctor']==null){
            $incomelist['paid_doctor']=0;
        }
                
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }       
        
        //get Full Refunds
        $query = "Select Sum(refund_amount) From ".TABLE_PREFIX."refund_invoice Where refund_type=".CASE_REFUND_FULL." And refund_date >= '$filter_var1' And refund_date <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$incomelist['full_refund'] = $this->_db->loadResult();
             
        if($incomelist['full_refund']==null){
            $incomelist['full_refund']=0;
        }
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        } 
        
        //get Half Refunds
        $query = "Select Sum(refund_amount) From ".TABLE_PREFIX."refund_invoice Where refund_type=".CASE_REFUND_HALF." And refund_date >= '$filter_var1' And refund_date <= '$filter_var2' ";
                        
        $this->_db->setQuery($query);
	$incomelist['half_refund'] = $this->_db->loadResult();
        
        if($incomelist['half_refund']==null){
           $incomelist['half_refund']=0;
        }
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }      
        
        
        return $incomelist;
        
      
    }
    
    
}