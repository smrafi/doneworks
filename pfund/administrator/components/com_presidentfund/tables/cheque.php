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

class TableCheque extends JTable
{
    var $id = null;
    var $number = null;
    var $account_type = null;
    var $bank_id = null;
    var $bankaccount_id = null;
    var $cheque_date = null;
    var $depositdate = null;
    var $realized = null;
    var $chequenumber = null;
    var $cheque_amount = null;


    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'cheque', 'id', $db);
    }
}
