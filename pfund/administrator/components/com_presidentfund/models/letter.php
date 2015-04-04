<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   30 December 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelLetter extends JModel
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
        $this->_data->application_id = JRequest::getInt('application_id');
        $this->_data->office_type = 0;
        $this->_data->template_id = 0;
        $this->_data->letter_note = '';
        $this->_data->letter_content = '';
        
        $this->_data->approved = 0;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->application_id = JRequest::getInt('application_id');
        $this->_data->office_type = JRequest::getInt('office_type');
        $this->_data->template_id = JRequest::getInt('template_id');
        $this->_data->letter_note = JRequest::getVar('letter_note');
        $this->_data->letter_content = JRequest::getVar( 'letter_content', '', 'post', 'string', JREQUEST_ALLOWHTML );
        
        $this->_data->approved = JRequest::getInt('approved');
        
        return $this->_data;
    }
    
    function getLetterData($application_id)
    {
        $query = "Select app.patient_title, app.othertitle_patient, app.patient_add1,app.patient_add1_si,app.patient_add1_ta, app.patient_add2,app.patient_add2_si,app.patient_add2_ta, app.patient_fullname,app.patient_fullname_si,app.patient_fullname_ta, app.patient_num, app.patient_nic, dsoffice.ds_office 
                    From ".TABLE_PREFIX."application As app, ".TABLE_PREFIX."dsoffice As dsoffice 
                        Where app.patient_dsoffice = dsoffice.id And app.id = $application_id ";
        
        $this->_db->setQuery($query);
	$letter_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $letter_data;
    }
    
    function validate()
    {
        if(!$this->_data->application_id)
        {
            $this->_app->enqueueMessage(JText::_('Can\'t process the request.'),'error');
            return FALSE;
        }
        if(!$this->_data->office_type)
        {
            $this->_app->enqueueMessage(JText::_('Please select a target place you are sending.'),'error');
            return FALSE;
        }
        if(!$this->_data->template_id)
        {
            $this->_app->enqueueMessage(JText::_('Please select a template.'),'error');
            return FALSE;
        }
        if($this->_data->letter_content == '')
        {
            $this->_app->enqueueMessage(JText::_('Can\'t generate a empty letter.'),'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
        
        //validate it
        if(!$this->validate())
            return FALSE;
        
        //setup user id
        $user =& JFactory::getUser();
        $this->_data->user_id = $user->id;
        
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
        
        return TRUE;
    }
    
    function updateManageTable($application_id, $office_type)
    {
        if(!$application_id or !$office_type)
            return FALSE;
        
        $query = "Update ".TABLE_PREFIX."manage_application ";
        
        if($office_type == OFFICE_TYPE_DSOFFICE)
            $query .= "Set dsoffice_status = ".COMMON_STATUS_PENDING." ";
        if($office_type == OFFICE_TYPE_HEALTH_MINISTRY)
            $query .= "Set healthministry_status = ".COMMON_STATUS_PENDING." ";
        if($office_type == OFFICE_TYPE_APPROVAL_LETTER)
            $query .= "Set status = ".APPLICATION_STATUS_GUARANTEE_LETTER_PENDING." ";
        if($office_type == OFFICE_TYPE_GUARANTEE_LETTER)
            $query .= "Set status = ".APPLICATION_STATUS_VOUCHER_RELEASE_PENDING." ";
        
        $query .= "Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function addApplicationNote()
    {
        $office_array = PFundHelper::getOfficeType('Select');
        
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$this->_data->application_id.", '".$office_array[$this->_data->office_type]." letter has been created.', ".$this->_data->user_id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function addDetailApplicationNote()
    {
        $office_array = PFundHelper::getOfficeType('Select');
        
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$this->_data->application_id.", '".$this->_data->letter_note.' : '.$office_array[$this->_data->office_type]." letter Description.', ".$this->_data->user_id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."letter Where id = $id ";
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $pnum = JRequest::getInt('pnum');
        $app_id=JRequest::getInt('application_id');
        
        $query_count = "Select count(*) " ;
        $query_cols = "select tmp.template_name, letter.* ";
        $query_from = "from ".TABLE_PREFIX."template as tmp, ".TABLE_PREFIX."letter as letter, ".TABLE_PREFIX."application as app ";
        $query_where = "where app.id=letter.application_id and tmp.id=letter.template_id and letter.application_id=$app_id ";
        
        $query_order = "Order By app.added_time Desc ";
        
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
    
    function getApprovalList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //get the letter for approvals
        //if the approval pending letters are being searched we are getting specifically at here
        //Dev Rafi
        $letter_status = JRequest::getInt('letter_status'); //if get 1 we search for it
        
        $query_count = "Select count(*) " ;
        $query_cols = "select tmp.template_name, letter.* ";
        $query_from = "from ".TABLE_PREFIX."template as tmp, ".TABLE_PREFIX."letter as letter ";
        $query_where = "where tmp.id=letter.template_id ";
        
        if($letter_status)
            $query_where .= "And letter.approved = 0 ";
        
        $query_order = "Order By letter.generated_time ";
        
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
    
    function updateApprovedLetter($letter_id, $letter_content)
    {
        $user =& JFactory::getUser();
        
        $query = "Update ".TABLE_PREFIX."letter Set approved = 1, approved_user = ".$user->id.", letter_content = '$letter_content' Where id = $letter_id ";
        
        $this->_db->setQuery($query);
        $this->_db->query();

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
            
            $query = "Delete From ".TABLE_PREFIX."letter Where id = $cid";
            
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
