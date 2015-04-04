<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   07 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');


class TellMeMdModelCommon extends JModel
{
    var $_data = null;
    var $_app = null;
    
    function __construct() 
    {
        parent::__construct();
        $this->_app =& JFactory::getApplication();
    }
    
    function validateTokenRegister(&$token_info)
    {
        //get the token from get
        $user_token = JRequest::getVar('utoken', '');
        $user =& JFactory::getUser();
        
        if($user_token == '')
            return FALSE;
        
        //decode the user token
        $user_token = base64_decode($user_token);
        
        //check weather user token is available in the table
        $query = "Select * From #__com_tmd_registration_record Where token = '$user_token' and visited = 0";        //@TODO : should chage 1 to 0
        $this->_db->setQuery($query);
        $result = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(),'error');
            return false;
        }
        
        //if result is not coming we return false
        if(!$result)
            return FALSE;
        
        //if current user not responsible for current token then we return false at here
        if($user->id != 0 && $user->id !== $result->user_id)
            return FALSE;
        
        //after all current user is responsible for this token
        //so we record here we have displayed the thank you page for him
        $query = "Update #__com_tmd_registration_record Set visited = 1 Where token = '$user_token'";
        $this->_db->setQuery($query);
        $this->_db->query();
        
        $token_info->token = $user_token;
        $token_info->id = $result->user_id;
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(),'error');
            return false;
        }
        
        return TRUE;
    }
    
    function getUserInfo()
    {
        //get the id and token from post
        $user_id = JRequest::getCmd('uid');
        $user_token = JRequest::getCmd('token');
        
        $query = "Select userdata.user_id, userdata.first_name, userdata.last_name 
                    From #__user_data As userdata, ".TABLE_PREFIX."registration_record As regirecord 
                        Where userdata.user_id = $user_id And userdata.user_id = regirecord.user_id And regirecord.token = '$user_token'";
        
        $this->_db->setQuery($query);
        $user_info = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(),'error');
            return false;
        }
        
        if(!$user_info)
            return FALSE;
        
        return $user_info;
    }
    
    function getPersonalPostData()
    {
        $this->_data->user_id = JRequest::getInt('user_id', 0);
        $this->_data->first_name = JRequest::getVar('first_name', '');
        $this->_data->last_name = JRequest::getVar('last_name', '');
        $this->_data->other_name = JRequest::getVar('other_name', '');
        $this->_data->nationality = JRequest::getVar('nationality', '');
        $this->_data->martial_status = JRequest::getCmd('martial_status', '');
        $this->_data->address1 = JRequest::getVar('address1', '');
        $this->_data->address2 = JRequest::getVar('address2', '');
        $this->_data->city = JRequest::getVar('city', '');
        $this->_data->region = JRequest::getVar('region', '');
        $this->_data->country = JRequest::getCmd('country', '');
        $this->_data->gender = JRequest::getCmd('gender', '');
        $this->_data->mobile_phone = JRequest::getCmd('mobile_phone', '');
        $this->_data->work_phone = JRequest::getCmd('work_phone', '');
        $this->_data->skype_id = JRequest::getCmd('skype_id', '');
        $this->_data->date_birth = JRequest::getVar('date_birth');
        $this->_data->paypal_email = JRequest::getVar('paypal_email');
        
        return $this->_data;
    }
    
    function getQualifyPostData()
    {
        $this->_data->user_id = JRequest::getInt('user_id', 0);
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->intern_place = JRequest::getVar('internplace', '');
        $this->_data->intern_startdate = JRequest::getVar('intern_start', '');
        $this->_data->intern_enddate = JRequest::getVar('intern_end', '');
        $this->_data->state_license = JRequest::getVar('state_license', '');
        $this->_data->dea_license = JRequest::getVar('dealicense', '');
        $this->_data->malpractice_info = JRequest::getVar('malpractice', '');
        $this->_data->speciality = JRequest::getVar('speciality', '');
        $this->_data->year_practice = JRequest::getVar('yearpractice', '');
        $this->_data->medical_background = JRequest::getVar('medicalbg', '');
        $this->_data->personal_background = JRequest::getVar('personalbg', '');
        $this->_data->cvfile_name = '';
        $this->_data->diplomafile_name = '';
        $this->_data->internfile_name = '';
        
        return $this->_data;
    }
    
    function storeForm()
    {
        //get the posted data
        $this->getPersonalPostData();
        
        //validate the posted data
        if(!$this->validatePostData())
            return FALSE;
        
        //update the id into data
        if(!$this->getUserFieldID())
            return FALSE;
        
        $row =& $this->getTable('userdata');
        
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
    
    function storeQualification()
    {
        //get qualification post data
        $this->getQualifyPostData();
        
        //store the cv file
        if(!$this->saveCVFile())
            return FALSE;
        
        //store the diploma file details
        if(!$this->saveDiploma())
            return FALSE;
        
        //store the intern proof file details
        if(!$this->saveInternProof())
            return FALSE;
        
        //if category is not selected, we return an error
        if($this->_data->cat_id == 0)
        {
            $this->_app->enqueueMessage('Category is not selected', 'error');
            return false;
        }
        
        //format the date and validate it
        $this->_data->intern_startdate = date('Y-m-d', strtotime($this->_data->intern_startdate));
        $this->_data->intern_enddate = date('Y-m-d', strtotime($this->_data->intern_enddate));
        $this->_data->doc_id = 'D'.  str_pad((int)$this->_data->user_id, 6, '0', STR_PAD_LEFT);
        
        $row =& $this->getTable('qualifydata');
        
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
    
    //save cv file of the doctor
    function saveCVFile()
    {
        $path = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'cvfiles/';
        $size_limit = 2 * 1024 * 1024;
        $allowed_ext = array(
            'doc' => 'doc',
            'docx' => 'docx',
            'gif' => 'gif',
            'jpg' => 'jpg',
            'png' => 'png',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'pdf' => 'pdf'
        );
        
        $files = JRequest::get('files');
        $cvfile = $files['cvfile'];
        
        //get the file informations
        $tmp_file = $cvfile['tmp_name'];
        $file_size = $cvfile['size'];
        $info = pathinfo($cvfile['name']);
        
        $unique_id = uniqid();
        
        //if file is not available then we retun true and escape from this function
        if($cvfile['name'] == '')
            return TRUE;
        
        //we compare the file size and return false if file size is exceeded than 2 MB
        if($file_size > $size_limit)
        {
            $this->_app->enqueueMessage('File size can not be exceeded than 2MB', 'error');
            return false;
        }
        
        //if file extension is not acceptable then we return false
        if(!$allowed_ext[$info['extension']])
        {
            $this->_app->enqueueMessage(strtoupper($info['extension']).' file format can not be accepted', 'error');
            return false;
        }
        
        //move the file to path
        $file_name = $unique_id.'_'.basename($cvfile['name']);
        if(move_uploaded_file($tmp_file, $path.$file_name))
            $this->_data->cvfile_name = $file_name;
        
        return TRUE;
    }
    
    //save medical school diploma file of the doctor
    function saveDiploma()
    {
        $path = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'diplomafiles/';
        $size_limit = 2 * 1024 * 1024;
        $allowed_ext = array(
            'doc' => 'doc',
            'docx' => 'docx',
            'gif' => 'gif',
            'jpg' => 'jpg',
            'png' => 'png',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'pdf' => 'pdf'
        );
        
        $files = JRequest::get('files');
        $diplomafile = $files['diplomafile'];
        
        //get the file informations
        $tmp_file = $diplomafile['tmp_name'];
        $file_size = $diplomafile['size'];
        $info = pathinfo($diplomafile['name']);
        
        $unique_id = uniqid();
        
        //if file is not available then we retun true and escape from this function
        if($diplomafile['name'] == '')
            return TRUE;
        
        //we compare the file size and return false if file size is exceeded than 2 MB
        if($file_size > $size_limit)
        {
            $this->_app->enqueueMessage('File size can not be exceeded than 2MB', 'error');
            return false;
        }
        
        //if file extension is not acceptable then we return false
        if(!$allowed_ext[$info['extension']])
        {
            $this->_app->enqueueMessage(strtoupper($info['extension']).' file format can not be accepted', 'error');
            return false;
        }
        
        //move the file to path
        $file_name = $unique_id.'_'.basename($diplomafile['name']);
        if(move_uploaded_file($tmp_file, $path.$file_name))
            $this->_data->diplomafile_name = $file_name;
        
        return TRUE;
    }
    
    //save the doctor intern proof file
    function saveInternProof()
    {
        $path = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'internproof/';
        $size_limit = 2 * 1024 * 1024;
        $allowed_ext = array(
            'doc' => 'doc',
            'docx' => 'docx',
            'gif' => 'gif',
            'jpg' => 'jpg',
            'png' => 'png',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'pdf' => 'pdf'
        );
        
        $files = JRequest::get('files');
        $internfile = $files['internfile'];
        
        //get the file informations
        $tmp_file = $internfile['tmp_name'];
        $file_size = $internfile['size'];
        $info = pathinfo($internfile['name']);
        
        $unique_id = uniqid();
        
        //if file is not available then we retun true and escape from this function
        if($internfile['name'] == '')
            return TRUE;
        
        //we compare the file size and return false if file size is exceeded than 2 MB
        if($file_size > $size_limit)
        {
            $this->_app->enqueueMessage('File size can not be exceeded than 2MB', 'error');
            return false;
        }
        
        //if file extension is not acceptable then we return false
        if(!$allowed_ext[$info['extension']])
        {
            $this->_app->enqueueMessage(strtoupper($info['extension']).' file format can not be accepted', 'error');
            return false;
        }
        
        //move the file to path
        $file_name = $unique_id.'_'.basename($internfile['name']);
        if(move_uploaded_file($tmp_file, $path.$file_name))
            $this->_data->internfile_name = $file_name;
        
        return TRUE;
    }
    
    //get the id of current doctor user field
    function getUserFieldID()
    {
        $query = "Select id From #__user_data Where user_id = ".$this->_data->user_id;
        $this->_db->setQuery($query);
        $this->_data->id = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(),'error');
            return false;
        }
        
        if(!$this->_data->id)
            return FALSE;
        
        return $this->_data;
    }
    
    function validatePostData()
    {
        if($this->_data->user_id === 0)
        {
            $this->_app->enqueueMessage('Wrong information submitted', 'error');
            return FALSE;
        }
        
        //validate email
        if($this->_data->paypal_email && !(JMailHelper::isEmailAddress($this->_data->paypal_email)))
        {
            $this->_app->enqueueMessage('Incorrect Email Address', 'error');
            return FALSE;
        }
        
        //format the date to write into database
        $this->_data->date_birth = date('Y-m-d', strtotime($this->_data->date_birth));
        
        //enter the correct country name
        $country_array = TellMeMDGeneralHelper::getCountryArray();
        if($this->_data->country !== 0)
        {
            $this->_data->country = $country_array[$this->_data->country];
        }
        
        return TRUE;
    }
}
