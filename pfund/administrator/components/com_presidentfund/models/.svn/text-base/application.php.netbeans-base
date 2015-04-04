<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   12 December 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelApplication extends JModel
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
        $this->_data->published = 1;
        $this->_data->patient_title = -1;
        $this->_data->othertitle_patient = '';
        $this->_data->patient_ref_num = 0;
        $this->_data->patient_fullname = '';
        $this->_data->patient_fullname_ta = '';
        $this->_data->patient_fullname_si = '';
        $this->_data->patient_nic = JRequest::getVar('nic_num');
        $this->_data->patient_add1 = '';
        $this->_data->patient_add1_ta = '';
        $this->_data->patient_add1_si = '';
        $this->_data->patient_add2 = '';
        $this->_data->patient_add2_ta = '';
        $this->_data->patient_add2_si = '';
        $this->_data->patient_city = '';
        $this->_data->patient_phone = '';
        $this->_data->age = '';
        $this->_data->patient_occupation = '';
        $this->_data->pensioner = 0;
        $this->_data->last_place = '';
        $this->_data->present_salary = '';
        $this->_data->patient_empadd1 = '';
        $this->_data->patient_empadd2 = '';
        $this->_data->patient_martial = -1;
        $this->_data->martial_other = '';
        $this->_data->applicant_relation = 0;
        $this->_data->etc_relation = '';
        $this->_data->applicant_title = -1;
        $this->_data->othertitle_applicant = '';
        $this->_data->applicant_fullname = '';
        $this->_data->applicant_fullname_ta = '';
        $this->_data->applicant_fullname_si = '';
        $this->_data->applicant_nic = '';
        $this->_data->applicant_add1 = '';
        $this->_data->applicant_add1_ta = '';
        $this->_data->applicant_add1_si = '';
        $this->_data->applicant_add2 = '';
        $this->_data->applicant_add2_ta = '';
        $this->_data->applicant_add2_si = '';
        $this->_data->applicant_phone = '';
        $this->_data->applicant_occupation = '';
        $this->_data->applicant_empadd1 = '';
        $this->_data->applicant_empadd2 = '';
        $this->_data->patient_district = 0;
        $this->_data->patient_dsoffice = 0;
        $this->_data->illness_nature = '';
        $this->_data->doctor_name = '';
        $this->_data->doctor_address = '';
        $this->_data->hospital_id = '';
        $this->_data->hospital_address = '';
        $this->_data->estimated_amount = '';
        $this->_data->own_resource_amount = '';
        $this->_data->etf_amount = '';
        $this->_data->nitf_amount = '';
        $this->_data->employment_scheme_amount = '';
        $this->_data->special_scheme_amount = '';
        $this->_data->ngo_amount = '';
        $this->_data->donation_amount = '';
        $this->_data->loan_amount = '';
        $this->_data->property_file = '';
        $this->_data->application_lang = 0;
        $this->_data->expect_amount = '';
        $this->_data->preobt_amount = '';
        $this->_data->preobt_date = date('Y-m-d');
        $this->_data->preobt_illness = '';
        $this->_data->preobt_filenum = '';
        $this->_data->admitdue_date = date('Y-m-d');
        
        $this->_data->application_type = APPLICATION_TYPE_NORMAL;
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->patient_num = JRequest::getInt('patient_num');
        $this->_data->patient_ref_num = JRequest::getInt('patient_ref_num');
        $this->_data->application_lang = JRequest::getInt('application_lang');
        $this->_data->published = JRequest::getInt('published', 1);
        $this->_data->patient_title = JRequest::getInt('patient_title', -1);
        $this->_data->patient_fullname = JRequest::getVar('patient_fullname');
        $this->_data->patient_fullname_ta = JRequest::getVar('patient_fullname_ta');
        $this->_data->patient_fullname_si = JRequest::getVar('patient_fullname_si');
        $this->_data->patient_nic = JRequest::getVar('patient_nic');
        $this->_data->patient_add1 = JRequest::getVar('patient_add1');
        $this->_data->patient_add1_ta = JRequest::getVar('patient_add1_ta');
        $this->_data->patient_add1_si = JRequest::getVar('patient_add1_si');
        $this->_data->patient_add2 = JRequest::getVar('patient_add2');
        $this->_data->patient_add2_ta = JRequest::getVar('patient_add2_ta');
        $this->_data->patient_add2_si = JRequest::getVar('patient_add2_si');
        $this->_data->patient_city = JRequest::getVar('patient_city');
        $this->_data->patient_phone = JRequest::getVar('patient_phone');
        $this->_data->age = JRequest::getVar('age');
        $this->_data->patient_occupation = JRequest::getVar('patient_occupation');
        $this->_data->pensioner = JRequest::getInt('pensioner');
        $this->_data->last_place = JRequest::getVar('last_place');
        $this->_data->present_salary = JRequest::getVar('present_salary');
        $this->_data->patient_empadd1 = JRequest::getVar('patient_empadd1');
        $this->_data->patient_empadd2 = JRequest::getVar('patient_empadd2');
        $this->_data->patient_martial = JRequest::getInt('patient_martial', -1);
        $this->_data->applicant_relation = JRequest::getInt('applicant_relation');
        $this->_data->etc_relation = JRequest::getVar('etc_relation');
        $this->_data->applicant_title = JRequest::getInt('applicant_title', -1);
        $this->_data->applicant_fullname = JRequest::getVar('applicant_fullname');
        $this->_data->applicant_fullname_ta = JRequest::getVar('applicant_fullname_ta');
        $this->_data->applicant_fullname_si = JRequest::getVar('applicant_fullname_si');
        $this->_data->applicant_nic = JRequest::getVar('applicant_nic');
        $this->_data->applicant_add1 = JRequest::getVar('applicant_add1');
        $this->_data->applicant_add1_ta = JRequest::getVar('applicant_add1_ta');
        $this->_data->applicant_add1_si = JRequest::getVar('applicant_add1_si');
        $this->_data->applicant_add2 = JRequest::getVar('applicant_add2');
        $this->_data->applicant_add2_ta = JRequest::getVar('applicant_add2_ta');
        $this->_data->applicant_add2_si = JRequest::getVar('applicant_add2_si');
        $this->_data->applicant_phone = JRequest::getVar('applicant_phone');
        $this->_data->applicant_occupation = JRequest::getVar('applicant_occupation');
        $this->_data->applicant_empadd1 = JRequest::getVar('applicant_empadd1');
        $this->_data->applicant_empadd2 = JRequest::getVar('applicant_empadd2');
        $this->_data->patient_district = JRequest::getInt('patient_district');
        $this->_data->patient_dsoffice = JRequest::getInt('patient_dsoffice');
        $this->_data->illness_nature = JRequest::getVar('illness_nature');
        $this->_data->doctor_name = JRequest::getVar('doctor_name');
        $this->_data->doctor_address = JRequest::getVar('doctor_address');
        $this->_data->hospital_id = JRequest::getInt('hospital_id');
        $this->_data->hospital_address = JRequest::getVar('hospital_address');
        $this->_data->estimated_amount = JRequest::getVar('estimated_amount');
        $this->_data->own_resource_amount = JRequest::getVar('own_resource_amount');
        $this->_data->etf_amount = JRequest::getVar('etf_amount');
        $this->_data->nitf_amount = JRequest::getVar('nitf_amount');
        $this->_data->employment_scheme_amount = JRequest::getVar('employment_scheme_amount');
        $this->_data->special_scheme_amount = JRequest::getVar('special_scheme_amount');
        $this->_data->ngo_amount = JRequest::getVar('ngo_amount');
        $this->_data->donation_amount = JRequest::getVar('donation_amount');
        $this->_data->loan_amount = JRequest::getVar('loan_amount');
        
        $this->_data->othertitle_patient = JRequest::getVar('othertitle_patient');
        $this->_data->othertitle_applicant = JRequest::getVar('othertitle_applicant');
        $this->_data->martial_other = JRequest::getVar('martial_other');
        $this->_data->property_file = JRequest::getVar('property_file');
        
        $this->_data->expect_amount = JRequest::getFloat('expect_amount');
        $this->_data->preobt_amount = JRequest::getFloat('preobt_amount');
        $this->_data->preobt_date = JRequest::getVar('preobt_date');
        $this->_data->preobt_illness = JRequest::getVar('preobt_illness');
        $this->_data->preobt_filenum = JRequest::getVar('preobt_filenum');
        $this->_data->admitdue_date = JRequest::getVar('admitdue_date');
        
        $this->_data->application_type = JRequest::getInt('app_type');  //added 08/01/2012
        
        //get the arrays
        $this->_data->income_data = JRequest::getVar('income_data');
        $this->_data->other_source = JRequest::getVar('other_source');
        
        //record the date time that application has been added at very first time
        if($this->_data->id == 0)
            $this->_data->added_time = date('Y-m-d H:i:s');
        
        //we are going to use a type variable at here
        //this will decide weather to insert a new record at application manger table or not
        if($this->_data->id)
            $this->_data->type = 0;
        else
            $this->_data->type = 1;
        
        return $this->_data;
    }
    
    function validate()
    {
        if($this->_data->application_lang == 0)
        {
            $this->_app->enqueueMessage(JText::_('Select a language for the application.'),'error');
            return FALSE;
        }
        if($this->_data->patient_title == -1)
        {
            $this->_app->enqueueMessage(JText::_('Select a title for patient.'),'error');
            return FALSE;
        }
        if($this->_data->patient_title == 0 and !$this->_data->othertitle_patient)
        {
            $this->_app->enqueueMessage(JText::_('Please specify patient other tilte clearly.'),'error');
            return FALSE;
        }
        if(!$this->_data->patient_fullname)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s full name.'),'error');
            return FALSE;
        }
        if($this->_data->age > 16)
        {
            if(!$this->_data->patient_nic)
            {
                $this->_app->enqueueMessage(JText::_('Please enter patient\'s NIC number.'),'error');
                return FALSE;
            }
            if(!is_numeric($this->_data->patient_nic) or strlen($this->_data->patient_nic) != 10)
            {
                $this->_app->enqueueMessage(JText::_('Please enter a correct NIC number.'),'error');
                return FALSE;
            }
        }
        if(!$this->_data->patient_add1)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s Address.'),'error');
            return FALSE;
        }
        
        if(!$this->_data->patient_add2)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s Address Completely.'),'error');
            return FALSE;
        }
        
        if(!$this->_data->patient_city)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s city.'),'error');
            return FALSE;
        }
        if(!$this->_data->age)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s age.'),'error');
            return FALSE;
        }
        if(!is_numeric($this->_data->age))
        {
            $this->_app->enqueueMessage(JText::_('Please enter a correct age.'),'error');
            return FALSE;
        }
        //Dev Rafi - validation for these fileds has been removed
        //Removed on 06/01/2012
//        if(!$this->_data->patient_occupation)
//        {
//            $this->_app->enqueueMessage(JText::_('Please enter patient\'s current occupation.'),'error');
//            return FALSE;
//        }
//        if($this->_data->pensioner and !$this->_data->last_place)
//        {
//            $this->_app->enqueueMessage(JText::_('Please enter the place served last by the patient.'),'error');
//            return FALSE;
//        }
        if($this->_data->present_salary and !is_numeric($this->_data->present_salary))
        {
            $this->_app->enqueueMessage(JText::_('Please enter correct value for current salary.'),'error');
            return FALSE;
        }
        if($this->_data->patient_martial == -1)
        {
            $this->_app->enqueueMessage(JText::_('Please select patient\'s civil status.'),'error');
            return FALSE;
        }
        if($this->_data->patient_martial == 0 and !$this->_data->martial_other)
        {
            $this->_app->enqueueMessage(JText::_('Please specify patient\'s other civil status clearly.'),'error');
            return FALSE;
        }
        if($this->_data->applicant_relation == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select applicant relationship to patient.'),'error');
            return FALSE;
        }
        if($this->_data->applicant_relation == -1 && !$this->_data->etc_relation)
        {
            $this->_app->enqueueMessage(JText::_('Please select patient\'s martial status.'),'error');
            return FALSE;
        }
        
        //we only validate the applicant details only if applicant is not applying himself
        if($this->_data->applicant_relation != RELATIONSHIP_TYPE_PERSON_SELF)
        {
            if($this->_data->applicant_title == -1)
            {
                $this->_app->enqueueMessage(JText::_('Select a title of the applicant.'),'error');
                return FALSE;
            }
            if($this->_data->applicant_title == 0 and !$this->_data->othertitle_applicant)
            {
                $this->_app->enqueueMessage(JText::_('Please specify applicant other tilte clearly.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_fullname)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant full name.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_nic)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant\'s NIC number.'),'error');
                return FALSE;
            }
            if(!is_numeric($this->_data->applicant_nic) or strlen($this->_data->applicant_nic) > 10)
            {
                $this->_app->enqueueMessage(JText::_('Please enter a correct NIC number.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_add1)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant address.'),'error');
                return FALSE;
            }
            
            if(!$this->_data->applicant_add2)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant address completely.'),'error');
                return FALSE;
            }
            //Validation removed for these variables
//            if(!$this->_data->applicant_occupation)
//            {
//                $this->_app->enqueueMessage(JText::_('Please enter applicant occupation.'),'error');
//                return FALSE;
//            }
//            if(!$this->_data->applicant_empaddress)
//            {
//                $this->_app->enqueueMessage(JText::_('Please enter applicant place of work.'),'error');
//                return FALSE;
//            }
        }
        if($this->_data->patient_district == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select a district.'),'error');
            return FALSE;
        }
        if($this->_data->patient_dsoffice == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select a DS office.'),'error');
            return FALSE;
        }
        if(!$this->_data->illness_nature)
        {
            $this->_app->enqueueMessage(JText::_('Please enter illness nature.'),'error');
            return FALSE;
        }
        //validation removed
//        if(!$this->_data->doctor_name)
//        {
//            $this->_app->enqueueMessage(JText::_('Please enter name of the doctor.'),'error');
//            return FALSE;
//        }
//        if(!$this->_data->doctor_address)
//        {
//            $this->_app->enqueueMessage(JText::_('Please enter address of the doctor.'),'error');
//            return FALSE;
//        }
        if($this->_data->hospital_id == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select a hospital.'),'error');
            return FALSE;
        }
        if(!$this->_data->hospital_address)
        {
            $this->_app->enqueueMessage(JText::_('Please enter address of the doctor.'),'error');
            return FALSE;
        }
        if(!$this->_data->estimated_amount)
        {
            $this->_app->enqueueMessage(JText::_('Please enter a estimated amount.'),'error');
            return FALSE;
        }
        
        
        return TRUE;
    }
    
    function validatefirst()
    {
        if($this->_data->application_lang == 0)
        {
            $this->_app->enqueueMessage(JText::_('Select a language for the application.'),'error');
            return FALSE;
        }
        if($this->_data->patient_title == -1)
        {
            $this->_app->enqueueMessage(JText::_('Select a title for patient.'),'error');
            return FALSE;
        }
        if($this->_data->patient_title == 0 and !$this->_data->othertitle_patient)
        {
            $this->_app->enqueueMessage(JText::_('Please specify patient other tilte clearly.'),'error');
            return FALSE;
        }
        if(!$this->_data->patient_fullname)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s full name.'),'error');
            return FALSE;
        }
        if($this->_data->age > 16)
        {
            if(!$this->_data->patient_nic)
            {
                $this->_app->enqueueMessage(JText::_('Please enter patient\'s NIC number.'),'error');
                return FALSE;
            }
            if(!is_numeric($this->_data->patient_nic) or strlen($this->_data->patient_nic) != 12)
            {
                $this->_app->enqueueMessage(JText::_('Please enter a correct NIC number.'),'error');
                return FALSE;
            }
        }
        if(!$this->_data->patient_add1)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s Address.'),'error');
            return FALSE;
        }
        
        if(!$this->_data->patient_add2)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s Address Completely.'),'error');
            return FALSE;
        }
        
        if(!$this->_data->patient_city)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s city.'),'error');
            return FALSE;
        }
        if(!$this->_data->age)
        {
            $this->_app->enqueueMessage(JText::_('Please enter patient\'s age.'),'error');
            return FALSE;
        }
        if(!is_numeric($this->_data->age))
        {
            $this->_app->enqueueMessage(JText::_('Please enter a correct age.'),'error');
            return FALSE;
        }
       
            if($this->_data->applicant_title == -1)
            {
                $this->_app->enqueueMessage(JText::_('Select a title of the applicant.'),'error');
                return FALSE;
            }
            if($this->_data->applicant_title == 0 and !$this->_data->othertitle_applicant)
            {
                $this->_app->enqueueMessage(JText::_('Please specify applicant other tilte clearly.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_fullname)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant full name.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_nic)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant\'s NIC number.'),'error');
                return FALSE;
            }
            if(!is_numeric($this->_data->applicant_nic) or strlen($this->_data->applicant_nic) > 12)
            {
                $this->_app->enqueueMessage(JText::_('Please enter a correct NIC number.'),'error');
                return FALSE;
            }
            if(!$this->_data->applicant_add1)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant address.'),'error');
                return FALSE;
            }
            
            if(!$this->_data->applicant_add2)
            {
                $this->_app->enqueueMessage(JText::_('Please enter applicant address completely.'),'error');
                return FALSE;
            }

   
        if($this->_data->patient_district == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select a district.'),'error');
            return FALSE;
        }
        if($this->_data->patient_dsoffice == 0)
        {
            $this->_app->enqueueMessage(JText::_('Please select a DS office.'),'error');
            return FALSE;
        }
        if(!$this->_data->illness_nature)
        {
            $this->_app->enqueueMessage(JText::_('Please enter illness nature.'),'error');
            return FALSE;
        }
    
       
        return TRUE;
    }
    
    function generateApplicationNumber()
    {
        $query = "Show Table Status Where name = 'jos_com_pf_application' ";
        $this->_db->setQuery($query);
        $table_info = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //set the application number
        $this->_data->patient_num = APPLICATION_START_NUMBER + $table_info->Auto_increment;
        
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
        
        //validate it
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
        
        //we store other values
        $this->storeIncomeData();
        
        //save other income sources
        $this->storeOtherSource();
        
        //save the uploaded file
        $this->storePropertyFile();
        
        return true;
    }
    
    
    function storefirst()
    {
        $this->getPostData();
        
        //validate it
        if(!$this->validatefirst())
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
        
        return true;
    }
    
    
    
    //Dev Rafi - 08/01/2012
    //This function to sycnhronize the data with already exist application
    function syncExistData()
    {
        $patient_num = JRequest::getInt('patient_num');
        $query = "Select * From ".TABLE_PREFIX."application Where patient_num = $patient_num ";
        
        $this->_db->setQuery($query);
	$source_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //sync needed data
        $this->_data->application_lang = $source_data->application_lang;
        $this->_data->patient_title = $source_data->patient_title;
        $this->_data->othertitle_patient = $source_data->othertitle_patient;
        $this->_data->patient_fullname = $source_data->patient_fullname;
        $this->_data->patient_nic = $source_data->patient_nic;
        //        $this->_data->patient_address = $source_data->patient_address;
         //dev meril 01 02 2012
        $this->_data->patient_add1 = $source_data->patient_add1;
        $this->_data->patient_add2 = $source_data->patient_add2;
        $this->_data->patient_phone = $source_data->patient_phone;
        $this->_data->age = $source_data->age;
        $this->_data->patient_occupation = $source_data->patient_occupation;
        $this->_data->pensioner = $source_data->pensioner;
        $this->_data->last_place = $source_data->last_place;
        $this->_data->present_salary = $source_data->present_salary;
//        $this->_data->patient_empaddress = $source_data->patient_empaddress;
        $this->_data->patient_empadd1 = $source_data->patient_empadd1;
        $this->_data->patient_empadd2 = $source_data->patient_empadd2;
        $this->_data->patient_martial = $source_data->patient_martial;
        $this->_data->martial_other = $source_data->martial_other;
        $this->_data->patient_district = $source_data->patient_district;
        $this->_data->patient_dsoffice = $source_data->patient_dsoffice;
        $this->_data->patient_num = $source_data->patient_num;
        
        $this->_data->application_type = APPLICATION_TYPE_EXIST_NORMAL;
        
        return $this->_data;
    }
    
    function storePropertyFile()
    {
        $path = JPATH_COMPONENT_SITE.DS.'files'.DS.'documents'.DS.'property'.DS;
        
        $uniqid = uniqid('');
        
        $allowed_ext = array('jpg', 'png', 'gif');
        
        $files = JRequest::get('files');
        $property_file = $files['property_datafile'];
        
        $extension = end(explode('.', $property_file['name']));
        
        if(!empty ($property_file['tmp_name']))
        {
            if($extension != '' && array_search($extension,$allowed_ext) !== false)
            {
                $file_name = $uniqid.'_'.str_replace(' ', '_', $property_file['name']);
                
                //move the file to folder
                if(move_uploaded_file($property_file['tmp_name'], $path.$file_name))
                {
                    $this->_data->property_file = $file_name;
                    
                    //update the table
                    $query = "Update ".TABLE_PREFIX."application Set property_file = '".$file_name."' Where id = ".$this->_data->id;
                    
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
                $this->_app->enqueueMessage(JText::_('File extension must be a image type.'),'error');
                return FALSE;
            }
        }
        else
            return FALSE;
    }
    
    function storeIncomeData()
    {
        if(!empty ($this->_data->income_data))
        {
            $total = count($this->_data->income_data['member_name']);
            
            for($x = 0; $x < $total; $x++)
            {
                $member_name = $this->_data->income_data['member_name'][$x];
                $member_marriage = $this->_data->income_data['member_marriage'][$x];
                $member_occupation = $this->_data->income_data['member_occupation'][$x];
                $member_income = $this->_data->income_data['member_income'][$x];
                $paying_tax = $this->_data->income_data['paying_tax'][$x];
                $tax_file = $this->_data->income_data['tax_file'][$x];
                
                //validate them
                if(!$member_name or !$member_marriage or !$member_occupation)
                    continue;
                
                if(!is_numeric($member_income))
                    continue;
                
                if($paying_tax and !$tax_file)
                    continue;
                
                $query = "Insert Into ".TABLE_PREFIX."incomedata (application_id, member_name, member_marriage, member_occupation, member_income, tax_file, paying_tax) 
                            Values(".$this->_data->id.", '$member_name', $member_marriage, '$member_occupation', $member_income, '$tax_file', $paying_tax)";
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
        
        return FALSE;
    }
    
    function storeOtherSource()
    {
        if(!empty ($this->_data->other_source))
        {
            $total = count($this->_data->other_source['source_name']);
            
            for($x = 0; $x < $total; $x++)
            {
                $source_name = $this->_data->other_source['source_name'][$x];
                $source_amount = $this->_data->other_source['source_amount'][$x];
                
                //validate it
                if(!$source_name)
                    continue;
                
                if(!is_numeric($source_amount))
                    continue;
                
                $query = "Insert Into ".TABLE_PREFIX."other_financesource (application_id, source_name, source_amount) 
                            Values(".$this->_data->id.", '$source_name', $source_amount)";
                
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
        
        return FALSE;
    }
    
    function getIncomeData($application_id)
    {
        $query = "Select * From ".TABLE_PREFIX."incomedata Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
	$income_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $income_data;
    }
    
    function getOtherSourceData($application_id)
    {
        $query = "Select * From ".TABLE_PREFIX."other_financesource Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
	$source_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $source_data;
    }
    
    //Dev Rafi
    //This function is to check the exist application using NIC number
    function getExistByNIC($nic_number, &$source_data = '')
    {
        $query = "Select * From ".TABLE_PREFIX."application Where patient_nic = '$nic_number' ";
        
        $this->_db->setQuery($query);
	$source_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if(!empty ($source_data))
            return FALSE;
        
        return TRUE;
    }
    
    //Dev Rafi
    //This function is to record a track starting information at application manage table
    function insertManageData()
    {
            $app_type = $this->_data->application_type;
            
            if($app_type == APPLICATION_TYPE_REIMBURSMENT)
            {
                $hmstaus = COMMON_STATUS_RECOMMEND;
                $dsstatus = COMMON_STATUS_NOTPROCESSED;
                $app_status = APPLICATION_STATUS_PENDING;
            }
            elseif($app_type == APPLICATION_TYPE_KANDY_KARAPITIYA)
            {
                $hmstaus = COMMON_STATUS_PENDING;
                $dsstatus = COMMON_STATUS_PENDING;
                $app_status = APPLICATION_STATUS_PENDING;
            }
            elseif($app_type == APPLICATION_TYPE_SPECIAL || $app_type == APPLICATION_TYPE_SPECIAL_REIMBURSMENT)
            {
                $hmstaus = COMMON_STATUS_RECOMMEND;
                $dsstatus = COMMON_STATUS_RECOMMEND;
                $app_status = APPLICATION_STATUS_SAS_PENDING;
            }
            else
            {
                $hmstaus = COMMON_STATUS_NOTPROCESSED;
                $dsstatus = COMMON_STATUS_NOTPROCESSED;
                $app_status = APPLICATION_STATUS_PENDING;
            }
            
        $query = "Insert Into ".TABLE_PREFIX."manage_application (added_date, application_id, status,dsoffice_status, healthministry_status ) 
                    Values('".date('Y-m-d H:i:s')."', ".$this->_data->id.", ".$app_status.",".$dsstatus.",".$hmstaus.")";
        
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
        $query = "Select * From ".TABLE_PREFIX."application Where id = $id ";
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
     function getfirstreciptdata($id)
    {
//         $query = "Select * From ".TABLE_PREFIX."application Where id = $id ";
        $query = "Select * From ".TABLE_PREFIX."application as app, ".TABLE_PREFIX."translate as trns
                Where app.id = $id and app.patient_title = trns.title_id ";
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    //function get one for SAS
    function getOneForSAS($id)
    {
        $query = "Select app.*, manageapp.* From 
                    ".TABLE_PREFIX."application As app, ".TABLE_PREFIX."manage_application As manageapp 
                        Where app.id = $id and app.id = manageapp.application_id ";
        
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
        $search_by = JRequest::getInt('search_by');
        $search_word = JRequest::getVar('search_word');
        $nic_num = JRequest::getVar('nic_num');
        $app_status = JRequest::getInt('app_status');
        $office_type = JRequest::getInt('office_type');
        $list_by = JRequest::getInt('list_by');
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select app.*, manageapp.status ";
        $query_from = "From ".TABLE_PREFIX."application As app, ".TABLE_PREFIX."manage_application As manageapp ";
        $query_where = "Where app.published = 1 And app.id = manageapp.application_id ";
        
        $query_order = "Order By app.added_time Desc ";
        
        //modify the query according to search options
        if($pnum)
            $query_where .= "And app.patient_num = $pnum ";
        if($search_by == SEARCH_BY_NIC)
            $query_where .= "And app.patient_nic = '$search_word' ";
        if($search_by == SEARCH_BY_PATIENT_NUM)
            $query_where .= "And app.patient_num = $search_word ";
        if($search_by == SEARCH_BY_REFERENCE_NUM)
            $query_where .= "And app.patient_ref_num = $search_word ";
        if($nic_num)
            $query_where .= "And app.patient_nic = '$nic_num' ";
        if($app_status)
            $query_where .= "And manageapp.status = $app_status ";
        if($office_type && $office_type == OFFICE_TYPE_HEALTH_MINISTRY)
            $query_where .= "And manageapp.healthministry_status = ".COMMON_STATUS_NOTPROCESSED." ";
        if($list_by != 0)
        {
            $query_where .="and app.application_type = $list_by ";
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
    
    //Dev Rafi
    //A function to create a list of application data as a table
    function createApplicationListTable()
    {
        $table_html = '<table class="application-list">';
        $table_html .= '<thead><tr>';
        $table_html .= '<th></th>';
        $table_html .= '<th>File No.</th>';
        $table_html .= '<th>Name of Patient</th>';
        $table_html .= '<th>Postal Town</th>';
        $table_html .= '<th>Nature of Surgery/ Treatment</th>';
        $table_html .= '<th>Amount Recommended (Rs.)</th>';
        $table_html .= '</tr></thead>';
        $table_html .= '<tbody>';
        
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $count = 1;
        $titles_array = GeneralHelper::getTitles();
        
        foreach($cids as $cid)
        {
            $app_data = $this->getTemplateApplicationData($cid);
            $table_html .= '<tr>';
            $table_html .= '<td>'.$count.'</td>';
            $table_html .= '<td>'.'PF/M/T/'.$app_data->patient_num;
            if($app_data->application_type == APPLICATION_TYPE_REIMBURSMENT)
                $table_html .= ' &reg;';
            $table_html .= '</td>';
            $table_html .= '<td>'.$titles_array[$app_data->patient_title].' '.$app_data->patient_fullname.'</td>';
            $table_html .= '<td>'.$app_data->patient_city.'</td>';
            $table_html .= '<td>'.$app_data->disease_name.'</td>';
            $table_html .= '<td>'.number_format($app_data->grant_amount, 2, '.', ',').'</td>';
            $table_html .= '';
            $count++;
        }
        
        $table_html .= '</tbody>';
        $table_html .= '</table>';
        
        return $table_html;
    }
    
    function getTemplateApplicationData($application_id)
    {
        $query = "Select app.*, manageapp.grant_amount, disease.disease_name 
                    From ".TABLE_PREFIX."application As app, ".TABLE_PREFIX."manage_application As manageapp, ".TABLE_PREFIX."disease As disease 
                        Where app.id = $application_id 
                        And manageapp.application_id = app.id 
                        And disease.id = manageapp.disease_id ";
        
        $this->_db->setQuery($query);
	$data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $data;
    }
    
    //Dev Rafi
    //To get the template data to list the applications
    function prepareHMAppListData()
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
        
        $table_html = '<table class="numlist">';
        if(count($cids) % 2 == 1)
            $times = count($cids) + 1;
        else
            $times = count($cids);
        $count = 1;
        
        foreach($cids as $cid)
        {
            $app_data = $this->getTemplateApplicationData($cid);
            if($count % 2 == 1)
                $table_html .= '<tr>';
            $table_html .= '<td>'.'PF/M/T/'.$app_data->patient_num.'</td>';
            if($count % 2 == 0)
                $table_html .= '</tr>';
            
            $count++;
        }
        
        if($count == $times)
            $table_html .= '<td></td>';
        
        $table_html .= '</table>';
        
        $final_data->template_id = $data->template_id;
        $final_data->applist_table = $table_html;
        $final_data->application_table = '';
        
        return $final_data;
    }
    
    //Dev Rafi
    //Change the application types
    function changeApplicationType()
    {
        $type_vars = JRequest::getVar('type_vars');
        $type_vars = explode(',', $type_vars);
        $query = "Update ".TABLE_PREFIX."application Set application_type = ".$type_vars[0]." Where id = ".$type_vars[1];
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $type_vars[1];
    }
    
    function changeApplicationStatus($application_id, $status)
    {
        $query = "Update ".TABLE_PREFIX."manage_application Set status = $status Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function recordSASRecommend()
    {
        $sas_grant = JRequest::getFloat('sas_grant');
        $sas_comment = JRequest::getVar('sas_comment');
        $application_id = JRequest::getInt('application_id');
        
        if(!$sas_grant)
            return FALSE;
        
        if(!$application_id)
            return FALSE;
        
        $user = &JFactory::getUser();
        $user_id = $user->id;
        
        $query = "Insert Into ".TABLE_PREFIX."sas_recommend (application_id, user_id, sas_grant, sas_comment) 
                    Values($application_id, $user_id, $sas_grant, '$sas_comment')";
        
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //if this is done we record a note at applicatioin note
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$application_id.", 'SAS recommended the application.', ".$user->id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function recordAccountRecommend()
    {
        $account_grant = JRequest::getFloat('account_grant');
        $account_comment = JRequest::getVar('account_comment');
        $application_id = JRequest::getInt('application_id');
        
        if(!$account_grant)
            return FALSE;
        
        if(!$application_id)
            return FALSE;
        
        $user = &JFactory::getUser();
        $user_id = $user->id;
        
        $query = "Insert Into ".TABLE_PREFIX."account_recommend (application_id, user_id, account_grant, account_comment) 
                    Values($application_id, $user_id, $account_grant, '$account_comment')";
        
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //if this is done we record a note at applicatioin note
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$application_id.", 'Account Head recommended the application.', ".$user->id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function recordPRSecRecommend()
    {
        $sec_grant = JRequest::getFloat('sec_grant');
        $sec_comment = JRequest::getVar('sec_comment');
        $application_id = JRequest::getInt('application_id');
        
        if(!$application_id)
            return FALSE;
        
        $user = &JFactory::getUser();
        $user_id = $user->id;
        
        $query = "Insert Into ".TABLE_PREFIX."secretary_recommend (application_id, user_id, sec_grant, sec_comment) 
                    Values($application_id, $user_id, $sec_grant, '$sec_comment')";
        
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //we update the amount that has been recommended at here
        //Dev Rafi
        $query = "Update ".TABLE_PREFIX."manage_application Set grant_amount = $sec_grant Where application_id = $application_id " ;
        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //if this is done we record a note at applicatioin note
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$application_id.", 'Secretary of President Fund recommended the application.', ".$user->id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    //Record a note specifically
    function addApplicationNote($application_id, $person, $text)
    {
        $user =& JFactory::getUser();
        //if this is done we record a note at applicatioin note
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$application_id.", '$person $text the application.', ".$user->id.")";
        
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    //function get SAS record
    function getSASRecord($application_id)
    {
        $query = "Select * From ".TABLE_PREFIX."sas_recommend Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
	$data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $data;
    }
    
    //Dev Rafi
    //function get SAS record
    function getAccountRecord($application_id)
    {
        $query = "Select * From ".TABLE_PREFIX."account_recommend Where application_id = $application_id ";
        
        $this->_db->setQuery($query);
	$data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $data;
    }
    
    //function to upload president letter
    function uploadPresidentLetter()
    {
        $path = JPATH_COMPONENT_SITE.DS.'files'.DS.'documents'.DS;
        
        $uniqid = uniqid('');
        
        $allowed_ext = array('pdf', 'doc', 'docx');
        
        $files = JRequest::get('files');
        $prfile_reply = $files['prfile_reply'];
        
        $extension = end(explode('.', $prfile_reply['name']));
        
        if(!empty ($prfile_reply['tmp_name']))
        {
            if($extension != '' && array_search($extension,$allowed_ext) !== false)
            {
                $file_name = $uniqid.'_'.str_replace(' ', '_', $prfile_reply['name']);
                
                //move the file to folder
                if(move_uploaded_file($prfile_reply['tmp_name'], $path.$file_name))
                {
                    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
                    
                    foreach ($cids as $cid)
                    {
                        $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_name) 
                                    Values($cid, 'President Reply', '$file_name')";
                        
                        $this->_db->setQuery($query);
                        $this->_db->query();

                        if ($this->_db->getErrorNum())
                        {
                            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                            return FALSE;
                        }
                        
                        //then we update the manage application table
                        $this->changeApplicationStatus($cid, APPLICATION_STATUS_APPROVAL_LETTER_PENDING);
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
    
    //dev meril
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."application Where id = $cid";
            
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
