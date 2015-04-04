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

class TellMeMdModelDisputes extends JModel
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
	$query = "SELECT * FROM ".TABLE_PREFIX."cases WHERE id=".$id;
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
    
    function getDisputes()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
        $filter_var1 = JRequest::getVar('filter_subject', '');
        $filter_var2 = JRequest::getVar('filter_type', '');
        
        
        
        //get the doctors group id
        $doctor_Table = " Select T1.id,T1.name From #__users AS T1, #__user_usergroup_map AS T2, #__usergroups AS T3
                        Where T1.id=T2.user_id AND T3.id=T2.group_id AND T3.title='Doctors' ";
        $patients_Table =" Select T1.id,T1.username
                        From #__users AS T1, #__user_usergroup_map AS T2, #__usergroups AS T3
                        Where T1.id=T2.user_id AND T3.id=T2.group_id AND T3.title='Patients' ";
        
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select disputes.id,  disputes.case_id, disputes.added_date, disputes.subject,disputes.dispute_type,doctor.name as d_name,
                       patient.username as p_name, disputes.case_type,disputes.status, disputes.answer_medium,disputes.urgency_level,disputes.detail_level ";
        $query_from = "From ".TABLE_PREFIX."disputes As disputes LEFT JOIN ($doctor_Table) AS doctor ON disputes.doctor_id=doctor.id, ($patients_Table) AS patient ";
        $query_where ="Where disputes.patient_id=patient.id ";
        
        if($filter_var1)
            $query_where .= "AND disputes.subject LIKE '%$filter_var1%' ";
        if($filter_var2)
            $query_where .= "AND disputes.dispute_type=$filter_var2 ";
        
        $query_order = "Order By disputes.status asc, disputes.added_date desc";
        
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
    
    //Function for get Doctor Name List - Dev Sara
    function getDoctorNameList($option = '')
    {
        $query = "SELECT T1.id,T1.username FROM #__users as T1, #__usergroups as T2, #__user_usergroup_map as T3
                  WHERE T1.id=T3.user_id AND T2.id=T3.group_id AND T2.title='Doctors'";
        $this->_db->setQuery($query);
	$doclist = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if($option)
            $doclist_array[0] =$option;
        foreach($doclist as $doc)
            $doclist_array[$doc->id] = $doc->username;
        
        return $doclist_array;
    }
     
   //Function for get Feed Back By User Id - Dev Sara 
   function getFeedBackByUserId($usr_id=''){
       
        $query = "SELECT feedback FROM tellmemd_com_tmd_feedback WHERE id=".$usr_id;
        $this->_db->setQuery($query);
        $feedback = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $feedback;     
       
   }
   
   function validate(){
       
        if($this->_data->subject == '')
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SUBJECT_NOT_FILLED_ERROR'),'error');
            return false;
        }
        if($this->_data->cat_id == 0)
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SELECT_CAT_ERROR'),'error');
            return false;
        }
        
        
        
        return TRUE;
       
   }
   function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->subject = JRequest::getVar('subject');
        $this->_data->cat_id = JRequest::getVar('cat_id', '');
        $this->_data->doctor_id = JRequest::getVar('doctor_id', '');
        
        
        
        return $this->_data;
    }
    
    function store()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
        $row =& $this->getTable('cases');
        
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
    
    function setStatusUpdate($cid=''){
       
       $query = "SELECT id FROM ".TABLE_PREFIX."disputes WHERE case_id=".$cid;
       $this->_db->setQuery($query);
       $data = $this->_db->loadObject();  
        
       $query="Update ".TABLE_PREFIX."disputes Set status=".CASE_DISPUTE_STATUS_OPEN." Where id=".$data->id;
       $this->_db->setQuery($query);
       $this->_db->query();
       
              
       if ($this->_db->getErrorNum())
       {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
       }       
        
    }
}