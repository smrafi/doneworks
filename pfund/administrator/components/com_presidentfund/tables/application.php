<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   14 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableApplication extends JTable
{
    var $id = null;
    var $published = null;
    var $updated_time = null;
    var $added_time = null;
    var $patient_num = null;
    var $patient_title = null;
    var $patient_fullname = null;
    var $patient_fullname_ta = null; //dev meril 01 02 2012
    var $patient_fullname_si = null;
    var $patient_nic = null;
//    var $patient_address = null;  //dev meril 01 02 2012
    var $patient_add1 = null;
    var $patient_add1_ta = null;
    var $patient_add1_si = null;
    var $patient_add2 = null;
    var $patient_add2_ta = null;
    var $patient_add2_si = null;
    var $patient_city = null;
    var $patient_phone = null;
    var $age = null;
    var $patient_occupation = null;
    var $pensioner = null;
    var $last_place = null;
    var $present_salary = null;
//    var $patient_empaddress = null; //dev meril 01 02 2012
    var $patient_empadd1 = null;
    var $patient_empadd2 = null;
    var $patient_martial = null;
    var $applicant_relation = null;
    var $etc_relation = null;
    var $applicant_title = null;
    var $applicant_fullname = null;
    var $applicant_fullname_ta = null;
    var $applicant_fullname_si = null;
    var $applicant_nic = null;
    var $applicant_address = null;
    var $applicant_phone = null;
    var $applicant_occupation = null;
//    var $applicant_empaddress = null;
    var $applicant_add1 = null;
    var $applicant_add1_ta = null;
    var $applicant_add1_si = null;
    var $applicant_add2 = null;
    var $applicant_add2_ta = null;
    var $applicant_add2_si = null;
    var $patient_district = null;
    var $patient_dsoffice = null;
    var $illness_nature = null;
    var $doctor_name = null;
    var $doctor_address = null;
    var $hospital_id = null;
    var $hospital_address = null;
    var $estimated_amount = null;
    var $own_resource_amount = null;
    var $etf_amount = null;
    var $nitf_amount = null;
    var $employment_scheme_amount = null;
    var $special_scheme_amount = null;
    var $ngo_amount = null;
    var $donation_amount = null;
    var $loan_amount = null;
    var $othertitle_patient = null;
    var $othertitle_applicant = null;
    var $martial_other = null;
    var $application_lang = null;
    var $expect_amount = null;
    var $preobt_amount = null;
    var $preobt_date = null;
    var $preobt_illness = null;
    var $preobt_filenum = null;
    var $admitdue_date = null;
    var $application_type = null; //added 08/01/2012
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'application', 'id', $db);
    }
}
