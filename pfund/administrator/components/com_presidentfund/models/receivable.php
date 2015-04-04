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


class PFundModelReceivable extends JModel
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
        $this->_data->rec_from = 0;
        $this->_data->rec_amount = 0;
        $this->_data->rec_date = '';
        $this->_data->rec_certification = '';
        $this->_data->rec_per = 0;
        $this->_data->rec_duedate = '';
        
 
        return $this->_data;
    }
   // rec_from 	 	 	 	 	 
    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->rec_from=JRequest::getint('rec_from');
        $this->_data->rec_amount=JRequest::getFloat('rec_amount');
        $this->_data->rec_date=JRequest::getVar('rec_date');
         $this->_data->rec_certification=JRequest::getVar('rec_certification');
        $this->_data->rec_per=JRequest::getFloat('rec_per');
        $this->_data->rec_duedate=JRequest::getVar('rec_duedate');
        
        
        return $this->_data;
        
    }
    
    function validate()
    {
      
        if(!$this->_data->rec_from)
        {
            $this->_app->enqueueMessage('Please Select A Debiters ', 'error');
            return FALSE;
        }
        
        if(!$this->_data->rec_amount)
        {
            $this->_app->enqueueMessage('Please Enter A Amount', 'error');
            return FALSE;
        }
        
        if(!$this->_data->rec_date)
        {
            $this->_app->enqueueMessage('Please Select Amount Paided Date', 'error');
            return FALSE;
        }
        
       
        
        if(!$this->_data->rec_per)
        {
            $this->_app->enqueueMessage('Please Enter a Perchentage What will recieve', 'error');
            return FALSE;
        }
        
        if(!$this->_data->rec_duedate)
        {
            $this->_app->enqueueMessage('Please Select A  Due Date for This Receivable', 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
               
        if(!$this->validate())
            return FALSE;
        
        if(!$this->storeDocument())
        return false;
        
        $row=& $this->getTable();
        
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
    
    
    function storeDocument()
    {
        $certification_path=JPATH_COMPONENT_SITE.DS.'files'.DS.'letters'.DS.'receivable/';
        
        $allowed_ext='jpg';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $certification_document=$files['rec_certificationletter'];
        $certification_doc_info= pathinfo($certification_document['name']);
        $certification_doc_name= $certification_document['name'];
        $certification_doc_size=$certification_document['size'];
        
        
       
        $unique_id = uniqid();

//        if(empty($files['document']))
//        {
//            $this->_app->enqueueMessage(JText::_('Document is cannot be saved. Please Select a PDF document to upload'), 'error');
//            return false;
//        }
//        if($allowed_ext!=$doc_info['extension'])  
//        {
//            $this->_app->enqueueMessage(strtoupper($doc_info['extension']).' '.JText::_('Document type cannot be saved. please upload PDF document only'), 'error');
//            return false;
//        }
//        
//        if($doc_size > $size_limit)
//        {
//            $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
//            return false;
//        }
//        
        $certification_file_name = $unique_id.'_'.basename($certification_document['name']);
        if(move_uploaded_file($certification_document['tmp_name'], $certification_path.$certification_file_name))
        {
             $this->_data->rec_certification = $certification_file_name;
             
        }
        
        return TRUE;
        
    }
    
    
    function getList()
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select receivable.*,(Select contact.contact_name From  ".TABLE_PREFIX."contact  As contact Where contact.id=receivable.rec_from ) As name ";
        $query_from = "From ".TABLE_PREFIX."receivable As receivable , ".TABLE_PREFIX."contact As contact ";
        $query_where = "";
        
        $query_order = " Group By receivable.id  ";
        
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
    
    function getinterestList($date_from, $date_to)
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //        select interest.bank_id, interest.bankaccount_id ,interest.amount as int_amount, bank.bank_name,bankacc.acc_name as acount_name
        //from jos_com_pf_interest as interest, jos_com_pf_banks as bank, jos_com_pf_bankaccount as bankacc
        //where interest.bank_id = bank.id and interest.bankaccount_id = bankacc.id
        
        $query_count = "Select count(*) " ;
        $query_cols = "select interest.*, interest.bank_id, bankacc.acc_number as account_no ,interest.amount as int_amount, bank.bank_name,bankacc.acc_name as account_name ";
        $query_from = "from ".TABLE_PREFIX."interest as interest, ".TABLE_PREFIX."banks as bank, ".TABLE_PREFIX."bankaccount as bankacc ";
        $query_where = "where interest.bank_id = bank.id and interest.bankaccount_id = bankacc.id ";
        
        $query_order = " order By bank_id  ";
        
        if($date_from != 0 || $date_from != '' && $date_to != 0 || $date_to != '')
        {
            $query_where .=" and period_start Between '".$date_from."' and '".$date_to."'";
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
    
    function getloantList($date_from, $date_to)
    {   
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //        select loan.al_whom as name, loan.al_amount as loan_amount , contact.contact_name as person
        //from jos_com_pf_loan as loan, jos_com_pf_contact as contact
        //where loan.al_whom = contact.id 
        
        $query_count = "Select count(*) " ;
        $query_cols = "select loan.*, loan.al_amount as loan_amount , contact.contact_name as person ";
        $query_from = "from jos_com_pf_loan as loan, jos_com_pf_contact as contact ";
        $query_where = "where loan.al_whom = contact.id ";
        
        $query_order = " order By al_whom  ";
        
        if($date_from != 0 || $date_from != '' && $date_to != 0 || $date_to != '')
        {
            $query_where .=" and al_start Between '".$date_from."' and '".$date_to."'";
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
    
     function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."receivable Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getDebtorArray($option = '')
    {    
         $query = "Select id, contact_name From ".TABLE_PREFIX."contact ";
         $query .= "Where contact_office = 3 ";
        
        $this->_db->setQuery($query);
	$debtor_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $debtor_array = array();
        if($option)
            $debtor_array[0] = $option;
        
        foreach($debtor_list as $cat)
            $debtor_array[$cat->id] = $cat->contact_name;
        
        return $debtor_array;
        
    }
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."receivable Where id = $cid";
            
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