<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   04 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelCase extends JModel
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
    
    function priceCalculation()
    {
        //get all vars
        $answer_medium = JRequest::getInt('answer_medium');
        $urgency_level = JRequest::getInt('urgency_level');
        $detail_level = JRequest::getInt('detail_level');
        $case_type = JRequest::getInt('case_type');
        $case_num = JRequest::getVar('case_num', '');
        
        //if this is question and answer type then, we call for the word counting
        if($case_type == CASE_TYPE_QUEANS)
            $que_content = $this->getQueData ($case_num);
        if($case_type == CASE_TYPE_LABTEST)
            $lab_content = $this->getLabData ($case_num);
        
        if($que_content)
            $total_words = strlen($que_content->que_subject) + strlen($que_content->que_content);
        
        //get the setting data
        $settings = $this->getPatientSettings();
        
        //setup the price for labtest type
        if($lab_content)
        {
            if($lab_content->complex_id == PRIORITY_TYPE_LOW)
                $labtest_price = $settings->simple_labtest_price;
            if($lab_content->complex_id == PRIORITY_TYPE_MEDIUM)
                $labtest_price = $settings->mod_labtest_price;
            if($lab_content->complex_id == PRIORITY_TYPE_HIGH)
                $labtest_price = $settings->complex_labtest_price;
        }
        
        //setup factors for calculation
        $urgency_percentage = $settings->priceinc_urglow;
        $detail_percentage = $settings->priceinc_level_low;
        $medium_percentage = $settings->priceinc_medium_submit;
        $word_devider = $settings->words_divide;
        
        //setup urgency percentage
        if($urgency_level == PRIORITY_TYPE_MEDIUM)
            $urgency_percentage = $settings->priceinc_urgmedium;
        elseif($urgency_level == PRIORITY_TYPE_HIGH)
            $urgency_percentage = $settings->priceinc_urghigh;
        
        //setup level of detail percentage
        if($detail_level == PRIORITY_TYPE_MEDIUM)
            $detail_percentage = $settings->priceinc_level_medium;
        if($detail_level == PRIORITY_TYPE_HIGH)
            $detail_percentage = $settings->priceinc_level_high;
        
        //setup medium percentage
        if($answer_medium == MEDIUM_TYPE_LIVE_CHAT)
            $medium_percentage = $settings->priceinc_medium_chat;
        if($answer_medium == MEDIUM_TYPE_SKYPE)
            $medium_percentage = $settings->priceinc_medium_skype;
        
        $base_price = '';
        if($case_type == CASE_TYPE_QUEANS)
            $base_price = $total_words / $word_devider;
        if($case_type == CASE_TYPE_LABTEST)
            $base_price = $labtest_price;
        $base_price = round($base_price + (($base_price * $urgency_percentage)/100) + (($base_price * $detail_percentage)/100) + (($base_price * $medium_percentage)/100));
        
        return $base_price;
    }
    
    function getQueData($case_num)
    {
        if($case_num == '')
            return FALSE;
        
        $query = "Select que_subject, que_content From ".TABLE_PREFIX."questions Where case_num = '$case_num' And processed = 0 ";
        $this->_db->setQuery($query);
        $contents = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $contents;
    }
    
    function getLabData($case_num)
    {
        if($case_num == '')
            return FALSE;
        
        $query = "Select labtest.complex_id From ".TABLE_PREFIX."labcase As lbcase, ".TABLE_PREFIX."labtest As labtest Where 
                    lbcase.case_num = '$case_num' And processed = 0 And lbcase.lab_id = labtest.id ";
        $this->_db->setQuery($query);
        $contents = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $contents;
    }
    
    function getPatientSettings()
    {
        $query = "Select * From ".TABLE_PREFIX."patient_settings ";
        $this->_db->setQuery($query);
        $settings = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $settings;
    }
    
    function validatePrice()
    {
        $this->_data->price_amount = JRequest::getFloat('price_amount');
        $this->_data->calc_price = $this->priceCalculation();
        $this->_data->answer_medium = JRequest::getInt('answer_medium');
        $this->_data->urgency_level = JRequest::getInt('urgency_level');
        $this->_data->detail_level = JRequest::getInt('detail_level');
        $this->_data->case_type = JRequest::getInt('case_type');
        $this->_data->case_num = JRequest::getVar('case_num', '');
        
        if(!$this->_data->price_amount)
            return FALSE;
        
        if(!$this->_data->calc_price)
            return FALSE;
        
        $this->_data->max_price = round($this->_data->calc_price + (($this->_data->calc_price * 20)/100));
        $this->_data->min_price = round($this->_data->calc_price - (($this->_data->calc_price * 20)/100));
        
        //validate it
        if($this->_data->price_amount < $this->_data->min_price)
        {
            $this->_app->enqueueMessage('You have to enter a price between $'.$min_price.' to $'.$max_price, 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function createPaypalHtml()
    {
        $this->_data->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr/';
        $this->_data->invoice = uniqid('IN');
        $return_url = COMPONENT_FRONT_LINK.'?controller=payment&task=ppreturn';
        $cancel_url = htmlentities(COMPONENT_FRONT_LINK.'?controller=payment&task=ppcancel');
        $business_email = 'rafi_1317808217_biz@archmage.lk';
        
        $hidden_html = '';
        $hidden_html .= '<input type="hidden" name="cmd" value="_xclick" />';
        $hidden_html .= '<input type="hidden" name="charset" value="utf-8" />';
        $hidden_html .= '<input type="hidden" name="business" value="'.$business_email.'" />';
        $hidden_html .= '<input type="hidden" name="item_name" value="Testing-'.$this->_data->case_num.'" />';
        $hidden_html .= '<input type="hidden" name="item_number" value="'.$this->_data->case_num.'" />';
        $hidden_html .= '<input type="hidden" name="invoice" value="'.$this->_data->invoice.'" />';
        $hidden_html .= '<input type="hidden" name="amount" value="'.$this->_data->price_amount.'" />';
        $hidden_html .= '<input type="hidden" name="tax" value="0" />';
        $hidden_html .= '<input type="hidden" name="no_shipping" value="1" />';
        $hidden_html .= '<input type="hidden" name="no_note" value="1" />';
        $hidden_html .= '<input type="hidden" name="return" value="'.$return_url.'" />';
        $hidden_html .= '<input type="hidden" name="cancel_return" value="'.$cancel_url.'" />';
        $hidden_html .= '<input type="hidden" name="rm" value="2" />';
        $hidden_html .= '<input type="hidden" name="lc" value="EN" />';
        $hidden_html .= '<input type="hidden" name="currency_code" value="USD" />';
        
        return $hidden_html;
    }
    
    //record the payment information
    function storePaymentData()
    {
        //first we check weather payment id is available
        $payment_id = JRequest::getInt('payment_id');
        $this->_data->id = $payment_id;
        $this->_data->updated_time = date('Y-m-d H:i:s');
        
        $row =& $this->getTable('payment');
        
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
            $this->_data->payment_id = $new_id;
        
        return TRUE;
    }
    
    function getCaseByUserID($type = '')
    {
        $user =& JFactory::getUser();
        
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select cases.*, cats.cat_name ";
        $query_from = "From ".TABLE_PREFIX."cases As cases, ".TABLE_PREFIX."category As cats ";
        $query_where = "Where cases.patient_id = ".$user->id." ";
        
        if($type == 'pool')
            $query_where = "Where cases.status = ".CASE_STATUS_OPEN." ";
        
        if($type == 'doc')
            $query_where = "Where cases.doctor_id = ".$user->id." ";
        
        $query_where .= "And cases.cat_id = cats.id ";
        $query_order = '';
        
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
    
    function getUserCaseInfo($cid, $view_type)
    {
        $user =& JFactory::getUser();
        $query = "Select cases.*, cats.cat_name From ".TABLE_PREFIX."cases As cases, ".TABLE_PREFIX."category As cats 
                    Where cases.id = $cid And cases.cat_id = cats.id ";
        
        //connect the case with user who has been logged in.
        //No body can access other user's cases
        if($view_type == CASE_VIEW_TYPE_PATIENT)
            $query .= "And cases.patient_id = ".$user->id." ";
        
        if($view_type == CASE_VIEW_TYPE_DOCTOR)
            $query .= "And cases.doctor_id = ".$user->id." ";
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();

	if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function validatePermitUser($view_type)
    {
        $user =& JFactory::getUser();
        $groups = $user->groups;
        
        if($view_type == CASE_VIEW_TYPE_PATIENT)
        {
            foreach($groups as $gname => $gid)
                if($gname == 'Patients')
                    return TRUE;
                else
                    return FALSE;
        }
        else
        {
            foreach($groups as $gname => $gid)
                if($gname == 'Doctors')
                    return TRUE;
                else
                    return FALSE;
        }
             
    }
    
    function acceptCase()
    {
        $this->_data->accept_case = JRequest::getInt('accept_var');
        $this->_data->case_id = JRequest::getInt('case_id');
        if(!$this->_data->accept_case)
            return FALSE;
        
        //first we check weather doctor  can accept the case
        if(!$this->checkDoctorCanAccept())
            return FALSE;
        
        //we update the doctor case track table
        if(!$this->recoredDocCaseTrack())
            return FALSE;
        
        //we update the case status table
        if(!$this->recordCaseStatusTable())
            return FALSE;
        
        //we update the cases table first
        if(!$this->acceptCaseTableUpdate())
            return FALSE;
        
        return TRUE;
        
    }
    
    function getDoctorCaseSettings()
    {
        $query = "Select * From ".TABLE_PREFIX."doc_settings";
        $this->_db->setQuery($query);
        $settings = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $settings;
    }
    
    function checkDoctorCanAccept()
    {
        $user =& JFactory::getUser();
        
        //get the doctor case settings
        $doc_setting = $this->getDoctorCaseSettings();
        if(!$doc_setting)
            return FALSE;
        
        //get doctor's current case track status
        $query = "Select * From ".TABLE_PREFIX."doc_casetrack Where doctor_id = ".$user->id;
        $this->_db->setQuery($query);
        $doc_record = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //if the doctor have no record yet, then he can accept the case
        if(!$doc_record)
            return TRUE;
        
        if(($doc_record->active < $doc_setting->lockwt_doc) && ($doc_record->total < $doc_setting->lockwt_doc))
            return TRUE;
        else
            return FALSE;
    }
    
    function acceptCaseTableUpdate()
    {
        $user =& JFactory::getUser();
        
        $query = "Update ".TABLE_PREFIX."cases Set status = ".CASE_STATUS_ACCEPTED.", 
                    doctor_id = ".$user->id.", 
                        spent_time = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, date_added, Now())), 
                        remain_time = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, Now(), deadline_time)) 
                        Where id = ".$this->_data->case_id;
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function recoredDocCaseTrack()
    {
        $user =& JFactory::getUser();
        
        //first check for the record already have on table for this user
        $query = "Select * From ".TABLE_PREFIX."doc_casetrack Where doctor_id = ".$user->id;
        $this->_db->setQuery($query);
        $doc_record = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //insert a new if no record found yet
        if(!$doc_record)
        {
            $query = "Insert Into ".TABLE_PREFIX."doc_casetrack 
                        (doctor_id, accepted, active, total) 
                        Values(".$user->id.", 1, 1, 1)";
        }
        //if already record is available then, we update the table
        else
        {
            $query = "Update ".TABLE_PREFIX."doc_casetrack 
                        Set accepted = (accepted+1), active = (active+1), total = (total+1) 
                        Where id = ".$doc_record->id." And doctor_id = ".$user->id;
        }
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function recordCaseStatusTable()
    {
        //first check for an existing case status record
        $query = "Select * From ".TABLE_PREFIX."casetrack Where case_id = ".$this->_data->case_id;
        $this->_db->setQuery($query);
        $case_record = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //if record not exist then we add a new row
        if(!$case_record)
        {
            $query = "Insert Into ".TABLE_PREFIX."casetrack 
                        (case_id, accept_time, case_live) 
                        Values(".$this->_data->case_id.", '".date('Y-m-d H:i:s')."', 1)";
        }
        //if record exist we return false
        else
        {
            return FALSE;
        }
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function getAnswerPostData()
    {
        $this->_data->case_id = JRequest::getInt('case_id');
        $this->_data->patient_id = JRequest::getInt('patient_id');
        $this->_data->doctor_id = JRequest::getInt('doctor_id');
        $this->_data->information_radio = JRequest::getInt('information_radio');
        $this->_data->answer_msg = JRequest::getVar('answer_msg');
        
        return $this->_data;
    }
    
    function processAnswer()
    {
        $this->getAnswerPostData();
        
        //if information needed, then we mark the case as info and stop the timer
        if($this->_data->information_radio)
        {
            if(!$this->updateStatusInfo())
                return FALSE;
        }
        
        //store the message in the message table
        $query = "Insert Into ".TABLE_PREFIX."message (case_id, from_id, )";
        return TRUE;
    }
    
    function updateStatusInfo()
    {
        //update the cases table first
        $query = "Update ".TABLE_PREFIX."cases Set status = ".CASE_STATUS_INFO.", 
                    spent_time = Addtime(spent_time, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, onlive_time, Now()))),
                    remain_time = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, Now(), deadline_time)) 
                    Where id = ".$this->_data->case_id;
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //then update the case track table
        $query = "Update ".TABLE_PREFIX."casetrack Set docspent_time = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, accept_time, Now())), 
                    respond_reqtime = '".date('Y-m-d H:i:s')."', 
                        case_live = 0 Where case_id = ".$this->_data->case_id;
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function processPatientAnswer()
    {
        $this->getAnswerPostData();
        
        if($this->_data->information_radio)
        {
            if(!$this->updateStatusPatientResponse())
                return FALSE;
        }
        
        return TRUE;
    }
    
    function updateStatusPatientResponse()
    {
        $query = "Update ".TABLE_PREFIX."cases As cases, ".TABLE_PREFIX."casetrack As track 
                    Set track.responded_time = '".date('Y-m-d H:i:s')."', 
                        track.wait_time = SEC_TO_TIME(TIMESTAMPDIFF(SECOND, track.respond_reqtime, Now())), 
                        track.case_live = 1, 
                        cases.status = ".CASE_STATUS_ACCEPTED.", 
                            cases.onlive_time = '".date('Y-m-d H:i:s')."', 
                                cases.deadline_time = Addtime(cases.deadline_time, (SEC_TO_TIME(TIMESTAMPDIFF(SECOND, track.respond_reqtime, Now())))) 
                                Where cases.id = ".$this->_data->case_id." And cases.id = track.case_id";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function updateStatusAnswered()
    {
        $this->getAnswerPostData();
        
        $query = "Update ".TABLE_PREFIX."cases As cases, ".TABLE_PREFIX."casetrack As track 
                    Set cases.status = ".CASE_STATUS_ANSWERED.", 
                        cases.deadline_time = '".date('Y-m-d H:i:s')."', 
                            cases.spent_time = Addtime(cases.spent_time, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, cases.onlive_time, Now()))), 
                            cases.remain_time = 0,  
                            track.case_live = 0 
                            Where cases.id = ".$this->_data->case_id." And cases.id = track.case_id";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE; 
    }
    
    //Dev Rafi's functions end here
    
    function &getOne($id='')
    {
	$query = "SELECT * FROM ".TABLE_PREFIX."cases WHERE id=".$id;
	$this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();

	if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getCases()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
        $filter_var1 = JRequest::getVar('filter_subject', '');
        $filter_var2 = JRequest::getVar('filter_status', '');
        
        
        
        //get the doctors group id
        $doctor_Table = " Select T1.id,T1.name From #__users AS T1, #__user_usergroup_map AS T2, #__usergroups AS T3
                        Where T1.id=T2.user_id AND T3.id=T2.group_id AND T3.title='Doctors' ";
        $patients_Table =" Select T1.id,T1.username
                        From #__users AS T1, #__user_usergroup_map AS T2, #__usergroups AS T3
                        Where T1.id=T2.user_id AND T3.id=T2.group_id AND T3.title='Patients' ";
        
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select cases.id, cases.date_added, cases.subject,category.cat_name,cases.status,
                       cases.price, patient.username as p_name, doctor.name as d_name, cases.deadline1, cases.deadline2,
                       cases.case_type,cases.answer_medium,cases.urgency_level,cases.detail_level,cases.patient_feedback_id, cases.doctor_feedback_id ";
        $query_from = "From ".TABLE_PREFIX."cases As cases LEFT JOIN ($doctor_Table) AS doctor ON cases.doctor_id=doctor.id, ($patients_Table) AS patient,
                      ".TABLE_PREFIX."category As category ";
        $query_where ="Where cases.patient_id=patient.id AND cases.cat_id=category.id ";
        
        if($filter_var1)
            $query_where .= "And cases.subject Like '%$filter_var1%' ";
        if($filter_var2)
            $query_where .= "And cases.status Like '%$filter_var2%' ";
        
        $query_order = "Order By cases.date_added desc";
        
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
}