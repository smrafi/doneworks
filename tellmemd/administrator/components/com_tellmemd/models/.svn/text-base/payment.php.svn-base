<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   06 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelPayment extends JModel
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
    
    function validatePaypalPayment()
    {
        $paypal_url = 'www.sandbox.paypal.com';
        
        $tx_token = JRequest::getVar('tx');
        $auth_token = '9WfNlH-3q4VWi7a-XbCKcgB2Pd91NUra-6OXrbfhJTW-VuafjGPwXF0F52m';
        
        $req = 'cmd=_notify-synch';
        $req.= '&tx='.$tx_token.'&at='.$auth_token;
        
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        
        $message = $header.$req;
        $length = strlen($message);
        
        //first try ssl and then http
        $fp = fsockopen ('ssl://'.$paypal_url, 443, $errno, $errstr, 60);
        if(!$fp)
        {
            $fp = fsockopen($paypal_url, 80, $errno, $errstr, 60);
            if(!$fp)
                return FALSE;
        }
        
        stream_set_timeout($fp,60);
        if (fwrite($fp, $message) != $length)
            return FALSE;
        
        $response = '';
	$headerdone = false;
        
        while (!feof($fp))
        {
            $line = fgets($fp, 1024);
            if (strcmp($line, "\r\n") == 0)		// blank line indicates end of http header
                    $headerdone = true;
            if ($headerdone)
                    $response .= $line;				// accummulate the response
        }
	fclose ($fp);
        
        $lines = explode("\n", $response);
        if ((strcmp($lines[0], "FAIL") == 0) or (strcmp($lines[1], "FAIL") == 0))
            return FALSE;
        
        $count = count($lines);
	$keyarray = array();
        
        for ($i=1; $i < $count; $i++)
        {
            $line_array = explode("=", $lines[$i]);
            if(count($line_array) == 2)
                $keyarray[urldecode($line_array[0])] = urldecode($line_array[1]);
            else
                $keyarray[urldecode($line_array[0])] = '';
        }
        
        return $keyarray;
    }
    
    function verifyPayment()
    {
        $this->_data->case_num = JRequest::getVar('item_number');
        $payment_info = $this->validatePaypalPayment();
        
        if(!$payment_info)
            return FALSE;
        
        $this->_data->price_amount = $payment_info['payment_gross'];
        $this->_data->currency = $payment_info['mc_currency'];
        $this->_data->tx_number = $payment_info['txn_id'];
        $this->_data->invoice = $payment_info['invoice'];
        $this->_data->status = strtolower($payment_info['payment_status']);
        $this->_data->item_number = $payment_info['item_number'];
        
        if($this->_data->case_num !== $this->_data->item_number)
            return FALSE;
        
        //get already available information from table 
        $query = "Select * From ".TABLE_PREFIX."payment_data Where case_num = '".$this->_data->case_num."' And invoice ='".$this->_data->invoice."' ";
        $this->_db->setQuery($query);
        $table_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if(!$table_data)
            return FALSE;
        
        //we check the data matched with previous table data
        if($this->_data->price_amount != $table_data->price_amount)
            return FALSE;
        
        //set the payment status
        if($this->_data->status == 'completed')
            $this->_data->status = PAYMENT_COOMPLETED;
        elseif($this->_data->status == 'pending')
            $this->_data->status = PAYMENT_PENDING;
        else
            $this->_data->status = PAYMENT_FAILED;
        
        $this->_data->table_data = $table_data;
        
        $updated_time = date('Y-m-d H:i:s');
        
        //update the table with rest data
        $query = "Update ".TABLE_PREFIX."payment_data Set tx_number = '".$this->_data->tx_number."', 
                    currency = '".$this->_data->currency."', 
                        payment_status = ".$this->_data->status.", updated_time = '$updated_time' 
                            Where id = ".$table_data->id;
        $this->_db->setQuery($query);
        $this->_db->query();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        //all the functions are true and now return true
        return TRUE;
    }
    
    function getCategoryDoctors()
    {
        //we connect questions or labtest tables with user table and doctor table
        if($this->_data->table_data->case_type == CASE_TYPE_QUEANS)
        {
            $table_connect = TABLE_PREFIX.'questions';
            $query = "Select user.id, user.user_id, user.title, user.first_name, user.last_name, user.other_name 
                    From $table_connect As connector, #__user_data As user, #__users As usermain, ".TABLE_PREFIX."doc_qualifications As qualify  
                    Where connector.case_num = '".$this->_data->case_num."' And connector.cat_id = qualify.cat_id And qualify.user_id = user.user_id And 
                        user.user_id = usermain.id And usermain.block = 0 ";
        }
        
        if($this->_data->table_data->case_type == CASE_TYPE_LABTEST)
        {
            $query = "Select user.id, user.user_id, user.title, user.first_name, user.last_name, user.other_name 
                        From ".TABLE_PREFIX."labcase As labcase, ".TABLE_PREFIX."labtest As labtest, ".TABLE_PREFIX."doc_qualifications As qualify, 
                            #__user_data As user, #__users As usermain 
                            Where labcase.case_num = '".$this->_data->case_num."' And labcase.lab_id = labtest.id And 
                            labtest.cat_id = qualify.cat_id And qualify.user_id = user.user_id And user.user_id = usermain.id And usermain.block = 0 ";
        }
        
        $this->_db->setQuery($query);
        $doctor_data = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $doctor_data;
    }
    
    function storeCasesTable()
    {
        $this->prepareData();
        
        //create the file
        if(!$this->createLogFile())
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
            $this->_data->payment_id = $new_id;
        
        return TRUE;
    }
    
    function prepareData()
    {
        $this->_data->price = $this->_data->price_amount;
        $this->_data->case_type = $this->_data->table_data->case_type;
        $this->_data->answer_medium = $this->_data->table_data->answer_medium;
        $this->_data->urgency_level = $this->_data->table_data->urgency_level;
        $this->_data->detail_level = $this->_data->table_data->detail_level;
        
        //get the case contents
        if($this->_data->case_type == CASE_TYPE_QUEANS)
        {
            $table_name = TABLE_PREFIX.'questions';
            $query = "Select * From $table_name Where case_num = '".$this->_data->case_num."' ";
        }
        if($this->_data->case_type == CASE_TYPE_LABTEST)
        {
            $table_name = TABLE_PREFIX.'labcase';
            $query = "Select cases.*, labtest.cat_id From $table_name As cases, ".TABLE_PREFIX."labtest As labtest Where cases.case_num = '".$this->_data->case_num."' And  cases.lab_id = labtest.id ";
        }
        
        $this->_db->setQuery($query);
        $case_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        $this->_data->patient_id = $case_data->patient_id;
        $this->_data->cat_id = $case_data->cat_id;
        
        if($this->_data->case_type == CASE_TYPE_QUEANS)
        {
            $this->_data->subject = $case_data->que_subject;
            $this->_data->content = $case_data->que_content;
            $this->_data->labreport_file = '';
        }
        else
        {
            $this->_data->subject = $case_data->lab_subject;
            $this->_data->content = $case_data->lab_content;
            $this->_data->labreport_file = $case_data->file_name;
        }
        
        $this->_data->date_added = date('Y-m-d H:i:s');;
        $this->_data->status = CASE_STATUS_OPEN;
        
        //calculate deadlines
        $settings = $this->getPatientSettings();
        if($this->_data->urgency_level == PRIORITY_TYPE_LOW)
            $this->_data->deadline_time = date('Y-m-d H:i:s', (time()+($settings->urgencycasetime_low * 60)));
        if($this->_data->urgency_level == PRIORITY_TYPE_MEDIUM)
            $this->_data->deadline_time = date('Y-m-d H:i:s', (time()+($settings->urgencycasetime_medium * 60)));
        if($this->_data->urgency_level == PRIORITY_TYPE_HIGH)
            $this->_data->deadline_time = date('Y-m-d H:i:s', (time()+($settings->urgencycasetime_high * 60)));
        
        //Deadline 1 and deadline 2 status
        $this->_data->deadline1 = CASE_DEADLINE_NOT_PASSED;
        $this->_data->deadline2 = CASE_DEADLINE_NOT_PASSED;
        
        return $this->_data;
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
    
    function createLogFile()
    {
        $folder = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'logfiles/';
        $filename = $this->_data->case_num.'_log.html';
        
        $ourFileName = "testFile.txt";
        $ourFileHandle = @fopen($folder.$filename, 'w+') or die("can't open file");
        fclose($ourFileHandle);
        
        $this->_data->log_file = $filename;
        return TRUE;
    }
}