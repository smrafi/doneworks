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

class TableMedicalPayment  extends JTable
{
    var $id = null;
    var $application_id = null;
    var $application_type = null;
    var $grant_amount  = null;
    var $voucher_date = null;
    var $receipt_date = null;
    var $receipt_document = null;
    var $bank_id = null;
    var $bankaccount_id = null;
    var $chequenumber = null;
    

    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'medicalpayment', 'id', $db);
    }
    
}