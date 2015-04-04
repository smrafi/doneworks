<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundHelper
{    
    function addSubMenu($controller)
    {
        JSubMenuHelper::addEntry(JText::_('Applications'), 'index.php?option=com_presidentfund&controller=application', $controller == 'application');
        JSubMenuHelper::addEntry(JText::_('COM_PFUND_CONFIGURE'), 'index.php?option=com_presidentfund&controller=configure', $controller == 'configure');
        JSubMenuHelper::addEntry(JText::_('Account Admin'), 'index.php?option=com_presidentfund&controller=account', $controller == 'account');
        JSubMenuHelper::addEntry(JText::_('Account Entry'), 'index.php?option=com_presidentfund&controller=accountentry', $controller == 'accountentry');
        JSubMenuHelper::addEntry(JText::_('Account Reports'), 'index.php?option=com_presidentfund&controller=accountreport', $controller == 'accountreport');
        JSubMenuHelper::addEntry(JText::_('Account Views'), 'index.php?option=com_presidentfund&controller=accountview', $controller == 'accountview');
//        
        
    }
    
    //Dev Rafi
    //To get all user groups
    
    function createList($name, $current_value, &$items, $first = 0, $class = '', $extra='')
    {
        $html = "\n".'<select name="'.$name.'" id="'.$name.'" class="'.$class.'" size="1" '.$extra.'>';
        
        if($items == NULL)
            return;
        
        foreach ($items as $key => $value)
        {
            if ($key < $first)
                continue;
            
            $selected = '';
            
            if($current_value === $key)
                $selected = 'selected = "selected"';
            
            $html .= "\n".'<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
        }
        
        $html .= '</select>'."\n";
        
        return $html;
    }
    
    function createRadio($name, $current_value, $items = array(), $option='')
    {
        
        $html = '';
        if($items == NULL)
            return '';

        foreach ($items as $key => $value)
        {
            $checked = '';
            
            if($current_value == $key)
                $checked = ' checked = "checked" ';
            
            $html .= "\n".'<input type="radio" name="'.$name.'" value="'.$key.'" '.$checked.$option.' ><span>'.$value.'</span>';
            
            if(count($items)> 1)
                $html .= '<br/>';
        }
        
        return $html;
    }
    
    function createCheckBox($name, $current_value, $value, $label='', $extra='', $right=false)
    {
        $html = '';
	if (($label != '') and (!$right))
		$html .= "\n".'<label for="'.$name.'">'.$label.' '.'</label>';
	if ($current_value)
		$checked = 'checked="checked" ';
	else
		$checked = '';
	$html .= '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$checked.' '.$extra.' />'."\n";
	if (($label != '') and ($right))
		$html .= "\n".'<label for="'.$name.'">'.' '.$label.'</label>';
	return $html;
    }
     function getAllDistrict($option='')
    {
        $district = array(
	1 => "Ampara",
        2 => "Anuradhapura",
        3 => "Badulla",
        4 => "Batticaloa",
        5 => "Colombo",
        6 => "Galle",
        7 => "Gampaha",
        8 => "Hambantota",
        9 => "Jaffna",    
        10 => "Kalutara",    
        11 => "Kandy",    
        12 => "Kegalle",    
        13 => "Kilinochchi",
        14 => "Kurunegala",    
        15 => "Mannar",
        16 => "Matale",    
        17 => "Matara",    
        18 => "Moneragala",
        19 => "Mullaitivu",
        20 => "Nuwara Eliya",
        21 => "Polonnaruwa",    
        22 => "Puttalam",
        23 => "Ratnapura",
        24 => "Trincomalee",    
	25 => "Vavuniya");
        
        if($option)
            $district[0] = $option;
        ksort($district);
        return $district;
    }
    
    
    function getOfficeType($option='')
    {
        
        $office_type=array(
                        OFFICE_TYPE_DSOFFICE => 'DS Office',
                        OFFICE_TYPE_HEALTH_MINISTRY => 'Health Ministry',
                        OFFICE_TYPE_DEBTOR => 'Debtor',
                        OFFICE_TYPE_CREDITOR => 'Creditor',
                        OFFICE_TYPE_APPLICANT => 'Applicant',
                        OFFICE_TYPE_APPROVAL_LETTER =>'Approval Letter',
                        OFFICE_TYPE_GUARANTEE_LETTER =>'Guarantee Letter',
                        OFFICE_TYPE_OTHER => 'Other'
        );
        if($option)
            $office_type[0] = $option;
        
        ksort($office_type);
        
        return $office_type;
    }
    
    function getBankAccountType($option='')
    {
        
        $bank_account_type=array(
                        ACCOUNT_TYPE_CURRENT => 'Current Account',
                        ACCOUNT_TYPE_SAVING => 'Saving Account'
        );
        if($option)
            $bank_account_type[0] = $option;
        
        ksort($bank_account_type);
        
        return $bank_account_type;
    }
    
    function getAccountType($option='')
    {
        
        $account_type=array(
                        ACCOUNT_TYPE_DEBIT => 'Debit',
                        ACCOUNT_TYPE_CREDIT => 'Credit'
        );
        if($option)
            $account_type[0] = $option;
        
        ksort($account_type);
        
        return $account_type;
    }
    
    function getStatusArray($option = '')
    {
        $status_array = array(
                        APPLICATION_STATUS_CANCELED => 'Cancel Request',
                        APPLICATION_STATUS_PENDING => 'Pending',
                        APPLICATION_STATUS_REVIEW => 'Review',
                        APPLICATION_STATUS_ACCEPTED => 'Approved',
                        APPLICATION_STATUS_SUBJECT_CLEARK_PENDING => 'Subject Cleark Pending',
                        APPLICATION_STATUS_SAS_PENDING => 'SAS Pending',
                        APPLICATION_STATUS_ACCOUNT_HEAD_PENDING => 'Account Head Pending',
                        APPLICATION_STATUS_SECRETORY_PENDING => 'Secretory of President Fund Pending',
                        APPLICATION_STATUS_PRESIDENT_PENDING => 'President Letter Generation Pending',
                        APPLICATION_STATUS_APPROVAL_LETTER_PENDING => 'Approval Letter Pending',
                        APPLICATION_STATUS_GUARANTEE_LETTER_PENDING => 'Guarantee Letter Pending',
                        APPLICATION_STATUS_VOUCHER_RELEASED => 'Voucher Released',
                        APPLICATION_STATUS_RECEIPT_UPLOADED => 'Receipt Uploaded',
                        APPLICATION_STATUS_PAYMENT_RELEASED => 'Payment Released',
                        APPLICATION_STATUS_VOUCHER_RELEASE_PENDING =>'Voucher Release Pending',
                        APPLICATION_STATUS_REJECTED =>'Cancel Request',
                        APPLICATION_STATUS_PRESIDENT_APPROVAL_PENDING => 'President Approval Pending'
        );
        
        if($option)
            $status_array[0] = $option;
        
        ksort($status_array);
        
        return $status_array;
    }
    
    function getLanguageArray($option = '')
    {
        $language_array = array(
                            LANGUAGE_TYPE_ENGLISH => 'English',
                            LANGUAGE_TYPE_SINHALA => 'Sinhala',
                            LANGUAGE_TYPE_TAMIL => 'Tamil'
        );
        
        if($option)
            $language_array[0] = $option;
        
        ksort($language_array);
        
        return $language_array;
    }
    
    
    ///Function for get a Single value From Specitic table
    ///$table mean -table name  -----$field field name  >>>$selectedField,$value are where clauses items
    function getSingleValue($table,$field,$selectedField,$value)
    {  

     $db =& JFactory::getDBO();
      $query = "Select ".$field." From ".$table." Where ".$selectedField." = ".$value;
      $db->setQuery( $query );
      $rows = $db->loadObject();
      
      return $rows->$field;
 
    }
    
    function getInterestPeriodType($option='')
    {
        
        $interest_period=array(
                        INTEREST_TYPE_MONTH => 'Monthly',
                        INTEREST_TYPE_QUARTER => 'Quarterly',
                        INTEREST_TYPE_SEMI_ANNUAL => 'Semi-Annually',
                        INTEREST_TYPE_ANNUAL => 'Annually',
                        INTEREST_TYPE_MATURITY => 'On Maturity'
           );
        

        if($option)
            $interest_period[0] = $option;
        
        ksort($interest_period);
        
        return $interest_period;
    }
    
    function getInterestType($option='')
    {
        
        $interest_type=array(
                        LOAN_TYPE_SIMPLE => 'Simple Interest',
                        LOAN_TYPE_COMPOUND => 'Compound Interest'
        );
        if($option)
            $interest_type[0] = $option;
        
        ksort($interest_type);
        
        return $interest_type;
    }
    
    //Function to get income Transection Types
    function getTransactionType($option='')
    {
        
        $transaction_type=array(
                        TRANSACTION_TYPE_CASH => 'Cash',
                        TRANSACTION_TYPE_CHEQUE => 'Cheque',
                        TRANSACTION_TYPE_MONEY_ORDER => 'Money Order',
                        TRANSACTION_TYPE_CASH_DEPOSIT_BANK => 'Cash Deposit to Bank',
                        TRANSACTION_TYPE_CHEQUE_DEPOSIT_BANK => 'Cheque Deposit to Bank',
                        TRANSACTION_TYPE_ONLINE_BANK_DEPOSIT => 'Online Deposit to Bank'
        );
        
        if($option)
            $transaction_type[0] = $option;
        
        ksort($transaction_type);
        
        return $transaction_type;
    }
    
    
    //Function to get every ledger  Types
    function getLedgerType($option='')
    {
        
        $ledger_type=array(
                        LEDGER_VARIETY_INVESTMENT => 'Investments',
                        LEDGER_VARIETY_RECEIVABLE => 'Loans Receivable',
                        LEDGER_VARIETY_ASSET => 'Current Assets',
                        LEDGER_VARIETY_LIABILITY => 'Current Liabilities',
                        LEDGER_VARIETY_INCOME => 'Income',
                        LEDGER_VARIETY_DISBURSEMENT => 'Disbursements',
                        LEDGER_VARIETY_EXPENDITURE => 'Expenditure',
                        LEDGER_VARIETY_ACCUMULATED_FUND => 'Accumulated Fund'
            
        );
        if($option)
            $ledger_type[0] = $option;
        
        ksort($ledger_type);
        
        return $ledger_type;
    }
    //define main Ledger

 
    
     //Function to get  approval Status Type  
    function getApprovalStatusType($option='')
    {
        
        $approval_status_type=array(
                        APPROVE_STATUS_PENDING => 'Voucher Requested',
                        APPROVE_STATUS_VOUCHER_RELEASED => 'Voucher Released',
                        APPROVE_STATUS_RECEIPT_UPLOADED  => 'Receipt Uploaded & Cheque Issued'
                       
        );
        
        if($option)
            $approval_status_type[0] = $option;
        
        ksort($approval_status_type);
        
        return $approval_status_type;
    }
    
    //Dev Rafi
    //A function to get the array of current status of letters from ds office and health ministry
    function getCommonStatus()
    {
        $status = array(
                    COMMON_STATUS_NOTPROCESSED => 'Not Processed',
                    COMMON_STATUS_PENDING => 'Pending',
                    COMMON_STATUS_RECEIVED => 'Receieved',
                    COMMON_STATUS_RECOMMEND => 'Recommended'
        );
        
        return $status;
    }
    
    //Dev Rafi
    //A function to get the list of amount types
    function getAmountTypeList($option)
    {
        
        if($option)
        {
            $amount_type = array(
                            0 => $option,
                            'private_amount' => 'Private Hospital Amount',
                            'sjgh_amount' => 'SJGH Amount',
                            'gh_amount' => 'GH Amount',
                            'other' => 'Other Amount'
            );
        }
        else
        {
            $amount_type = array(
                            'private_amount' => 'Private Hospital Amount',
                            'sjgh_amount' => 'SJGH Amount',
                            'gh_amount' => 'GH Amount',
                            'other' => 'Other Amount'
            );
        }
        
        return $amount_type;
    }
    
    //Dev Rafi
    //Get all temporary status
    function getTempStatus($option)
    {
        $temp_status = array(
                            TEMP_STATUS_RECOMMEND => 'Recommended',
                            TEMP_STATUS_AMEND => 'Amended',
                            TEMP_STATUS_REJECT => 'Rejected'
        );
        
        if($option)
            $temp_status[0] = $option;
        
        ksort($temp_status);
        
        return $temp_status;
    }
    
    //Dev Rafi
    //To get all application types
    function getApplicationTypes($option = '')
    {
        $application_type = array(
                                APPLICATION_TYPE_NORMAL => 'Normal',
                                APPLICATION_TYPE_EXIST_NORMAL => 'Normal',
                                APPLICATION_TYPE_REIMBURSMENT => 'Reimbursment',
                                APPLICATION_TYPE_KANDY_KARAPITIYA => 'Kandy / Karapitiya Hospital',
                                APPLICATION_TYPE_SPECIAL =>'Special',
                                APPLICATION_TYPE_SPECIAL_REIMBURSMENT => 'Special Reimbursment'
        );
        
        if($option)
            $application_type[0] = $option;
        
        ksort($application_type);
        
        return $application_type;
    }
    
    //dev meril 27 jan 2012
    //required application documets
    function getDocumentType($option = '')
    {
        $document_type = array(
                DOCUMENT_TYPE_APPLICATION =>'Application',
                DOCUMENT_TYPE_REQUEST_LETTER =>'Request Letter',
                DOCUMENT_TYPE_DOCTORS_LETTER =>'Doctors Letter',
                DOCUMENT_TYPE_ESTIMATE =>'Estimate',
            
        );
        
        if ($option)
            $document_type[0]=$option;
        
        ksort($document_type);
        
        $document_type[DOCUMENT_TYPE_OTHER] = 'Other';
        
        return $document_type;
    }
    
    //Function to get every Sub  ledger  Types
    function getSubLedgerType($option='')
    {
        
        $ledger_type=array(
                        SUB_LEDGER_VARIETY_MAHAPOLA => 'Mahapola',
                        SUB_LEDGER_VARIETY_LOTTERY_BOARD => 'Lotteries Board'
            
        );
        if($option)
            $ledger_type[0] = $option;
        
        ksort($ledger_type);
        
        return $ledger_type;
    }
    
     //Function to get every ledger  Types with none show items
    function getEveryLedgerType($option='')
    {
        
        $ledger_type=array(
                        LEDGER_VARIETY_INVESTMENT => 'Investment',
                        LEDGER_VARIETY_RECEIVABLE => 'Loan Receivable',
                        LEDGER_VARIETY_ASSET => 'Current Asset',
                        LEDGER_VARIETY_LIABILITY => 'Less-Current Liability',
                        LEDGER_VARIETY_INCOME => 'Income',
                        LEDGER_VARIETY_DISBURSEMENT => 'Disbursement',
                        LEDGER_VARIETY_EXPENDITURE => 'Expenditure',
                        LEDGER_VARIETY_MEDICAL => 'Medical',
                        LEDGER_VARIETY_CASHBOOK => 'Cash Book',
                        LEDGER_VARIETY_BANKBOOK => 'Bank Book'
            
        );
        if($option)
            $ledger_type[0] = $option;
        
        ksort($ledger_type);
        
        return $ledger_type;
    }
    
}
