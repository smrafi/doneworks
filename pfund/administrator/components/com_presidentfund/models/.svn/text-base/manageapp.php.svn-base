<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   28 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelManageApp extends JModel
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
    
    function getManageAppData($app_id)
    {
        $query = "Select * From ".TABLE_PREFIX."manage_application Where application_id = $app_id ";
        $this->_db->setQuery($query);
        $this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if(!$this->_data)
            return FALSE;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->status = JRequest::getInt('status');
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->disease_id = JRequest::getInt('disease_id');
        $this->_data->amount_type = JRequest::getVar('amount_type');
        $this->_data->grant_amount = JRequest::getFloat('grant_amount');
        $this->_data->application_id = JRequest::getInt('app_id');
        $this->_data->grant_amount = JRequest::getInt('grant_amount');
        $this->_data->app_note = JRequest::getVar('app_note');
        $this->_data->dsoffice_status = JRequest::getInt('dsoffice_status');
        $this->_data->healthministry_status = JRequest::getInt('healthministry_status');
        
        return $this->_data;
    }
    
    function validate()
    {
        if(!$this->_data->cat_id)
        {
            $this->_app->enqueueMessage(JText::_('Select a category for medical conditions.'),'error');
            return FALSE;
        }
        
        if(!$this->_data->disease_id)
        {
            $this->_app->enqueueMessage(JText::_('Select a medical condition.'),'error');
            return FALSE;
        }
        
        return TRUE;
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
        
        $new_id = $this->_db->insertId();
        
        if($new_id > 0)
            $this->_data->id = $new_id;
        
        //store the application note to the table
        if($this->_data->app_note != '')
            $this->addApplicationNote();
        
        return true;
    }
    
    function addApplicationNote()
    {
        $user =& JFactory::getUser();
        
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$this->_data->application_id.", '".$this->_data->app_note."', ".$user->id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
        
    function getApplicationNotes($application_id)
    {
        $query = "Select * From ".TABLE_PREFIX."application_note Where application_id = $application_id ";
        $this->_db->setQuery($query);
	$application_notes = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $application_notes;
    }
    
    function updateHMStatus()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            //first varify weather data is there
            if(!$this->getManageAppData($cid))
                continue;
            $app_type = JRequest::getInt('app_type');
            
            $query = "Update ".TABLE_PREFIX."manage_application Set healthministry_status = ".COMMON_STATUS_PENDING.", hmnoted_date = '".  date('Y-m-d')."' 
                        Where application_id = $cid ";
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
    
    //a function to note all the data into healthministry letter table
    function noteHeathMinistryLetter()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $template_id = JRequest::getInt('template_id');
        $ids = '';
        
        $user =& JFactory::getUser();
        
        foreach($cids as $cid)
            $ids .= $cid.',';
        
        //first check weather there is a entry already in the table for today
        $query = "Select * From ".TABLE_PREFIX."hmletters Where date = '".  date('Y-m-d')."' ";
        $this->_db->setQuery($query);
	$data = $this->_db->loadObject();
        
        if($data)
            return FALSE;
        
        //then we insert the record
        $query = "Insert Into ".TABLE_PREFIX."hmletters (date, template_id, application_ids) 
                    Values('".  date('Y-m-d')."', $template_id, '$ids')";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //after all we create a note that saying a letter has been created for application
        $application_note = "Health Ministry letter has been created!";
        foreach($cids as $cid)
        {
            $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                        Values($cid, '$application_note', ".$user->id.")";
            
            $this->_db->setQuery($query);
            $this->_db->query();

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
            
            //then change the application status by checking the status of the letter of both
            //hm letter and ds office letter
            if($this->checkAllStatusPending($cid))
            {
                $upquery = "Update ".TABLE_PREFIX."manage_application Set status = ".APPLICATION_STATUS_SUBJECT_CLEARK_PENDING." Where application_id = $cid ";
            }
            else
            {
                $upquery = "Update ".TABLE_PREFIX."manage_application Set status = ".APPLICATION_STATUS_PENDING." Where application_id = $cid ";
            }
            
            $this->_db->setQuery($upquery);
            $this->_db->query();

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    function notePrLetters()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $template_id = JRequest::getInt('template_id');
        $file_no = JRequest::getVar('letterfile_num');
        $ids = '';
        
        $user =& JFactory::getUser();
        
        foreach($cids as $cid)
            $ids .= $cid.',';
        
        $query = "Insert Into ".TABLE_PREFIX."prletters (date, template_id,file_no, application_ids) 
                    Values('".  date('Y-m-d')."', $template_id, '$file_no', '$ids')";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //application note
        $application_note = "President Approval Letter Generated";
        foreach($cids as $cid)
        {
            $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                        Values($cid, '$application_note', ".$user->id.")";
            
            $this->_db->setQuery($query);
            $this->_db->query();

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
            
            
            $upquery = "Update ".TABLE_PREFIX."manage_application Set status = ".APPLICATION_STATUS_PRESIDENT_APPROVAL_PENDING." Where application_id = $cid ";
            
            $this->_db->setQuery($upquery);
            $this->_db->query();

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            
            }
           
        }
        
    }
       
    
    //get all availabe health ministry letters
    function getAllHMLetters()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."hmletters ";
        $query_where = "";
        
        $query_order = "Order By date DESC ";
        
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
    
    function getAllPRLetters()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
        $limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."prletters ";
        $query_where = "";
        
        $query_order = "Order By date DESC ";
        
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
    
    //a function to get the list of documents avialable on each application and list the applications so far we have
    function getIndividualDocuments()
    {
        //first get the record data
        $record_id = JRequest::getVar('record_id');
        
        $query = "Select * From ".TABLE_PREFIX."hmletters Where id = $record_id";
        $this->_db->setQuery($query);
	$data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //prepare set of ids
        $cids = explode(',', $data->application_ids);
        $cids = array_filter($cids);
        
        $count = 0;
        foreach ($cids as $cid)
        {
            $query = "Select patient_num, patient_fullname From ".TABLE_PREFIX."application Where id = $cid ";
            
            $this->_db->setQuery($query);
            $app_data = $this->_db->loadObject();
            
            $total_data[$count]->app_data = $app_data;

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
            
            $query = "Select file_purpose, document_name From ".TABLE_PREFIX."file Where application_id = $cid And published = 1";
            
            $this->_db->setQuery($query);
            $total_data[$count]->file_data = $this->_db->loadObjectList();

            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
            
            $count++;
        }
        
        
        return $total_data;
    }
    
    //Dev Rafi
    //upload DS office response
    function uploadDSResponse($action_type, $app_type)
    {
        $path = JPATH_COMPONENT_SITE.DS.'files'.DS.'documents'.DS;
        
        $uniqid = uniqid('');
        
        $allowed_ext = array('pdf', 'doc', 'docx');
        
        $files = JRequest::get('files');
        $prfile_reply = $files['dsresponse_file'];
        
        
        $extension = end(explode('.', $prfile_reply['name']));
        
        if(!empty ($prfile_reply['tmp_name']))
        {
            if($extension != '' && array_search($extension,$allowed_ext) !== false)
            {
                $file_name = $uniqid.'_'.str_replace(' ', '_', $prfile_reply['name']);
                
                //move the file to folder
                if(move_uploaded_file($prfile_reply['tmp_name'], $path.$file_name))
                {
                    $app_id = JRequest::getInt('app_id');
                    $dsoffice_note = JRequest::getVar('dsoffice_note');
                    
                    //update the document info
                    $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_name) 
                                    Values($app_id, 'DS Office Response ".date('d/m/Y')." ', '$file_name')";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                    
                    //add note to application_note
                    $user =& JFactory::getUser();
        
                    $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                Values('$app_id', 'DS Respond uploaded', ".$user->id.")";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                     //add detail note to application_note
                    $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                Values('$app_id', 'DS Office Respond :- ".$dsoffice_note."', ".$user->id.")";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                    
                    
                    //update the ds office status on manage application
                    if($app_type == APPLICATION_TYPE_REIMBURSMENT )
                    {
                        $app_status = APPLICATION_STATUS_ACCOUNT_HEAD_PENDING;
                    }
                    else{
                        $app_status = APPLICATION_STATUS_SAS_PENDING;
                    }
                    $query = "Update ".TABLE_PREFIX."manage_application Set dsoffice_status = $action_type, dsoffice_note = '$dsoffice_note', status = '$app_status' Where application_id = '$app_id' ";
                    
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
            else
            {
                return FALSE;
            }
        }
        else
            return FALSE;
    }
    
    function uploadHMResponse($action_type)
    {
        $path = JPATH_COMPONENT_SITE.DS.'files'.DS.'documents'.DS;
        
        $uniqid = uniqid('');
        
        $allowed_ext = array('pdf', 'doc', 'docx');
        
        $files = JRequest::get('files');
        $prfile_reply = $files['hmresponse_file'];
        
        $extension = end(explode('.', $prfile_reply['name']));
        
        if(!empty ($prfile_reply['tmp_name']))
        {
            if($extension != '' && array_search($extension,$allowed_ext) !== false)
            {
                $file_name = $uniqid.'_'.str_replace(' ', '_', $prfile_reply['name']);
                
                //move the file to folder
                if(move_uploaded_file($prfile_reply['tmp_name'], $path.$file_name))
                {
                    $app_id = JRequest::getInt('app_id');
                    $healthministry_note = JRequest::getVar('healthministry_note');
                    
                    //update the document info
                    $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_name) 
                                    Values($app_id, 'Health Ministry Response ".date('d/m/Y')." ', '$file_name')";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                    
                    //add note to application_note
                    $user =& JFactory::getUser();
        
                    $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                Values('$app_id', 'Health Ministry Respond uploaded', ".$user->id.")";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                    
                    //add detail note to application_note
                    $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                Values('$app_id', 'Helth Ministry Respond :- ".$healthministry_note."', ".$user->id.")";
                    
                    $this->_db->setQuery($query);
                    $this->_db->query();

                    if ($this->_db->getErrorNum())
                    {
                        $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                        return FALSE;
                    }
                    
                    //update the ds office status on manage application
                    $query = "Update ".TABLE_PREFIX."manage_application Set healthministry_status = $action_type, healthministry_note = '$healthministry_note' Where application_id = $app_id ";
                    
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
            else
            {
                return FALSE;
            }
        }
        else
            return FALSE;
    }
    
    //check both ds office status and hm status are done and make it application status forward
    function checkAllStatusDone($application_id)
    {
        $data = $this->getManageAppData($application_id);
        if($data->dsoffice_status == COMMON_STATUS_RECOMMEND && $data->healthministry_status == COMMON_STATUS_RECOMMEND)
            return TRUE;
        else
            return FALSE;
    }
    
    //check ds office status and hm letter staus have been come to pending
    function checkAllStatusPending($application_id,$app_type)
    {
        $data = $this->getManageAppData($application_id);
        if($data->dsoffice_status == COMMON_STATUS_PENDING && $data->healthministry_status == COMMON_STATUS_PENDING && $app_type == APPLICATION_TYPE_NORMAL)
            return TRUE;
        else
            return FALSE;
    }
}
