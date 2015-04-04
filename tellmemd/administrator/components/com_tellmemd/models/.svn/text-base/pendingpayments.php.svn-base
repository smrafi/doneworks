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

class TellMeMdModelPendingPayments extends JModel
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
            
    function &getOne($id='')
    {
	$query = "SELECT * FROM ".TABLE_PREFIX."pending_payment WHERE id=".$id;
	$this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();

	if ($this->_data)
	{
		return $this->_data;
	}
	else
	{
		$this->_app->enqueueMessage(JText::_('No Record'), 'error');
		return false;
	}

    }
    
    function getPendingPayments()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
//        $filter_var1 = JRequest::getVar('filter_subject', '');
//        $filter_var2 = JRequest::getVar('filter_type', '');
        
        
        
        //get the doctors group id
        $doctor_Table = " Select T1.id,T1.name,T4.paypal_email 
                          From #__users AS T1 ,#__user_usergroup_map AS T2, #__usergroups AS T3, #__user_data AS T4 
                          Where T1.id=T2.user_id AND T3.id=T2.group_id AND T1.id=T4.user_id AND T3.title='Doctors' ";
        
        
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select pp.id, doctor.name, doctor.paypal_email, pp.lp_date, pp.lp_amount, pp.rem_payment, pp.total_paid ";
        $query_from = "From ".TABLE_PREFIX."pending_payment As pp,($doctor_Table) AS doctor ";
        $query_where ="Where  pp.doctor_id=doctor.id ";
        
        if($filter_var1)
            $query_where .= " ";
        if($filter_var2)
            $query_where .= " ";
        
        $query_order = "Order By pp.rem_payment desc";
        
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
    
    function paymentUpdate($id=''){
        
       //get payment details
       $query = "SELECT * FROM ".TABLE_PREFIX."pending_payment WHERE id=".$id;
       $this->_db->setQuery($query);
       $payment_data = $this->_db->loadObject(); 
        
        
       //upadte pending_payment table
       $query="Update ".TABLE_PREFIX."pending_payment Set total_paid=total_paid+rem_payment , rem_payment=0 Where id=".$id;
       $this->_db->setQuery($query);
       $this->_db->query();
       
              
       if ($this->_db->getErrorNum())
       {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
       }      
             
       
       //insert payment details into payment invoice table
       $query="Insert Into ".TABLE_PREFIX."payment_invoice (doctor_id,payment_date,payment_amount) Values(".$payment_data->doctor_id.",'".date('Y-m-d H:i:s')."',".$payment_data->rem_payment.")";
       $this->_db->setQuery($query);
       $this->_db->query();
       
       if ($this->_db->getErrorNum())
       {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
       }
              
              
       return true;       
       
    }
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."cases Where id = $cid";
            
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
    
    function setRefund($case_id='',$type=''){
       
       $refund_type='';
        
       $query = "SELECT * FROM ".TABLE_PREFIX."cases WHERE id=".$case_id;
       $this->_db->setQuery($query);
       $case_data = $this->_db->loadObject();  
        
       
       if($type==CASE_REFUND_HALF){
         $query="Insert Into ".TABLE_PREFIX."refund_invoice (patient_id,refund_date,refund_amount,refund_type) Values(".$case_data->patient_id.",'".date('Y-m-d H:i:s')."',".$case_data->price*0.5.",'".CASE_REFUND_HALF."') ";
         $this->_db->setQuery($query);
         $this->_db->query();
       } 
       if($type==CASE_REFUND_FULL){
         $query="Insert Into ".TABLE_PREFIX."refund_invoice (patient_id,refund_date,refund_amount,refund_type) Values(".$case_data->patient_id.",'".date('Y-m-d H:i:s')."',".$case_data->price.",'".CASE_REFUND_FULL."') ";
         $this->_db->setQuery($query);
         $this->_db->query();
       }
       
       
       
       if ($this->_db->getErrorNum())
       {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
       }
              
       $query="Update ".TABLE_PREFIX."disputes Set status=".CASE_DISPUTE_STATUS_CLOSE." Where case_id=".$case_data->id;
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