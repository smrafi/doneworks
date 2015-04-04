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


class PFundModelMedicalPayment extends JModel
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
        $this->_data->application_id=JRequest::getVar('application_id');
        $this->_data->application_type =JRequest::getint('application_type');
        $this->_data->print_type=JRequest::getint('print_type');
        $this->_data->bank_id=JRequest::getInt('bank_id');
        $this->_data->bankaccount_id=JRequest::getInt('bankaccount_id');
        $this->_data->chequenumber=JRequest::getVar('chequenumber');
        $this->_data->receipt_date=JRequest::getInt('receipt_date');
        $this->_data->grant_amount =JRequest::getInt('grant_amount');
       
        return $this->_data;
      
    }
    
    function getList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $type = JRequest::getInt('type');
        $search_by = JRequest::getInt('search_by');
        $search_word = JRequest::getVar('search_word');

        
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select application.*,manage.* ";
        $query_from = "From ".TABLE_PREFIX."application As application  ";
        $query_from .=" , ".TABLE_PREFIX."manage_application As manage "; 
        $query_where = " Where manage.application_id=application.id And manage.status=".APPLICATION_STATUS_VOUCHER_RELEASE_PENDING;
        
        $query_order = " Group By application.id  ";
        
        
        if($type == APPLICATION_TYPE_REIMBURSMENT)
             $query_where .= " And (application.patient_fullname = '$search_word' Or  application.patient_nic= '$search_word' Or  application.applicant_nic= '$search_word' )";
        
        
         if($search_by == SEARCH_BY_HOSPITAL)
            $query_where .= " And application.hospital_id = '$search_word' ";
        if($search_by == SEARCH_BY_PHARMACEUTICAL)
            $query_where .= " And application.hospital_id = $search_word ";
        if($search_by == SEARCH_BY_ILLNESS)
            $query_where .= " And application.illness_nature = '$search_word' ";
        if($search_by == SEARCH_BY_APPLICATION_TYPE)
            $query_where .= " And application.application_type  = '$search_word' ";
        
        
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
    
   
    function getSelectedList($type)
    {   
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        $search_by = JRequest::getInt('search_by');
        $search_word = JRequest::getVar('search_word');
       
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
       
        $query_count = "Select count(*) " ;
        $query_cols = "Select application.*,manage.* ,hospital.hos_name As hos_name  ,disease.disease_name As disease_name ";
        $query_from = "From ".TABLE_PREFIX."application As application  ";
        $query_from .=" , ".TABLE_PREFIX."manage_application As manage "; 
        $query_from .=" , ".TABLE_PREFIX."hospital As hospital"; 
        $query_from .=" , ".TABLE_PREFIX."disease As disease";
        $query_where = " Where (manage.application_id=application.id  And " ;
        $query_where .= "  hospital.id =application.hospital_id And manage.disease_id=disease.id ) And";

        
        $numrows = count($cids);
        if($numrows==0){
            
          $cids=$this->_data->cid ;  
        }
         $query_where .="(";
         for($x = 0; $x < $numrows; $x++)
            {
             $query_where .= " application.id = $cids[$x] ";
            if ($x != ($numrows-1)){ $query_where .=" Or ";}
         }
          $query_where .=")";
        if($type == APPLICATION_TYPE_NORMAL)
            $query_where .= " And application.application_type 	 != ".APPLICATION_TYPE_REIMBURSMENT;
        
        if($type == APPLICATION_TYPE_REIMBURSMENT)
            $query_where .= " And application.application_type= ".APPLICATION_TYPE_REIMBURSMENT;
        
        
        if($search_by == SEARCH_BY_HOSPITAL)
            $query_where .= " And application.hospital_id = '$search_word' ";
        if($search_by == SEARCH_BY_PHARMACEUTICAL)
            $query_where .= " And application.hospital_id = $search_word ";
        if($search_by == SEARCH_BY_ILLNESS)
            $query_where .= " And application.illness_nature = '$search_word' ";
        if($search_by == SEARCH_BY_APPLICATION_TYPE)
            $query_where .= " And application.application_type  = '$search_word' ";
         
        $query_order = " Group By application.id  ";
        
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
   
    
     function getOne($id)
    {   
        
         
        $query  = "Select application.*,manage.* ,hospital.hos_name As hos_name  ,disease.disease_name As disease_name ";
        $query .= "From ".TABLE_PREFIX."application As application  ";
        $query .=" , ".TABLE_PREFIX."manage_application As manage "; 
        $query .=" , ".TABLE_PREFIX."hospital As hospital"; 
        $query .=" , ".TABLE_PREFIX."disease As disease";
        $query .= " Where (manage.application_id=application.id  And manage.application_id  = $id ";
        $query .= "  And hospital.id =application.hospital_id And manage.disease_id=disease.id ) ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    
     function voucherupdate()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Update ".TABLE_PREFIX."manage_application As manage   ";
            $query .=" Set manage.status = ".APPLICATION_STATUS_VOUCHER_RELEASED;
            $query .=" Where  manage.application_id  = $cid ";
            $this->_db->setQuery($query);
            $this->_db->query();
            
             $query_insert = "Insert Into ".TABLE_PREFIX."medicalpayment (`application_id`, `application_type`, `grant_amount`)";
             $query_insert  .= " Select $cid, application.application_type, manage.grant_amount ";
             $query_insert  .=  " From ".TABLE_PREFIX."application As application  , ".TABLE_PREFIX."manage_application As manage ";
             $query_insert  .=  " Where (manage.application_id=application.id ) And manage.application_id  = $cid ";
                $this->_db->setQuery($query_insert);
                $this->_db->query();
        
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
       
    
     function SelectedVoucherUpdate()
    {   $this->getPostData();
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $bankid=$this->_data->bank_id;
        $accountid=$this->_data->bankaccount_id;
        $chequenumber=$this->_data->chequenumber;
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Update ".TABLE_PREFIX."manage_application As manage   ";
            $query .=" Set manage.status = ".APPLICATION_STATUS_PAYMENT_RELEASED;
            $query .=" Where  manage.application_id  = $cid ";
            $this->_db->setQuery($query);
            $this->_db->query();
            
             $query_update = "Update ".TABLE_PREFIX."medicalpayment    ";
             $query_update .=" Set bank_id = ".$bankid." ,bankaccount_id  = ".$accountid." ,chequenumber= ".$chequenumber;
             $query_update .=" Where  application_id  = $cid ";
             $this->_db->setQuery($query_update);
             $this->_db->query();
        
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    function getVoucherList($type,$status)
    {  
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select application.*,manage.* ,hospital.hos_name As hos_name  ,disease.disease_name As disease_name ";
        $query_from = " From ".TABLE_PREFIX."application As application  ";
        $query_from .=" , ".TABLE_PREFIX."manage_application As manage "; 
        $query_from .=" , ".TABLE_PREFIX."hospital As hospital"; 
        $query_from .=" , ".TABLE_PREFIX."disease As disease";
        $query_where = " Where manage.application_id=application.id And manage.status=".$status;
       // $query_where .= " And  hospital.id =application.hospital_id And manage.disease_id=disease.id  ";
         $query_where .= " And manage.disease_id=disease.id  ";
        $query_order = " Group By application.id  ";

         if($type == APPLICATION_TYPE_NORMAL)
            $query_where .= " And application.application_type 	 != ".APPLICATION_TYPE_REIMBURSMENT;
        
        if($type == APPLICATION_TYPE_REIMBURSMENT)
            $query_where .= " And application.application_type= ".APPLICATION_TYPE_REIMBURSMENT;
        
        
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
    
     function getLedgerBank()
    {   
        $query  = "Select bank_id,bankaccount_id ";
        $query .= "From ".TABLE_PREFIX."ledgeritem  ";
        $query .= " Where ledger_type  = ".LEDGER_VARIETY_MEDICAL;
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    
    function store()
    {
        $this->getPostData();
        
        $cheque_lenth=strlen($this->_data->chequenumber);
        if($cheque_lenth >  6)
        {
            $this->_app->enqueueMessage('Cheque Number Must Be in 6 Digit', 'error');
            return FALSE;
        }  
        
        if(!$this->storeDocument())
        return false;
         
        $row=& $this->getTable('medicalpayment');
       
        
            $query = "Update ".TABLE_PREFIX."manage_application As manage   ";
            $query .=" Set manage.status = ".APPLICATION_STATUS_RECEIPT_UPLOADED;
            $query .=" Where  manage.application_id  = ".$this->_data->application_id;
            $this->_db->setQuery($query);
            $this->_db->query();
            
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
    
   function update()
    {
        $this->getPostData();
               
        if(!$this->storeDocument())
        return false;
         
        
       
        
            $query = "Update ".TABLE_PREFIX."manage_application As manage   ";
            $query .=" Set manage.status = ".APPLICATION_STATUS_RECEIPT_UPLOADED;
            $query .=" Where  manage.application_id  = ".$this->_data->application_id;
            $this->_db->setQuery($query);
            $this->_db->query();
         
            $query_update = "Update ".TABLE_PREFIX."medicalpayment   ";
            $query_update .=" Set receipt_document = ".$this->_data->receipt_document;
            $query_update .=" Where  application_id  = ".$this->_data->application_id;
            $this->_db->setQuery($query_update);
            $this->_db->query();
              
        
        $new_id = $this->_db->insertId();
        
        if($new_id > 0)
            $this->_data->id = $new_id;
        
        return true;
    }
    
    
    
    function storeDocument()
    {
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'voucher'.DS.'medicalpayment/';

        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $document=$files['receipt_document'];
        $doc_info= pathinfo($document['name']);
        $doc_name= $document['name'];
        $doc_size=$document['size'];
        
        $unique_id = uniqid();
        
       
        
        $file_name = $unique_id.'_'.basename($document['name']);
        if(move_uploaded_file($document['tmp_name'], $path.$file_name))
        {
             $this->_data->receipt_document = $file_name;
             
        }
        
       
        return TRUE;
    } 
   
}
