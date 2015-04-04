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

class TableIncome extends JTable
{
    var $id = null;
    var $income_type = null;
    var $ledger_activity = null;
    var $bank_id = null;
    var $interest = null;
    var $chequeno= null;
    var $chequedate = null;
    var $ledger_typeid = null;
    var $lotteryunclaim_amount = null;
    var $in_document= null;
    var $amount = null;
    var $date = null;
    var $contact_id= null;
 	 	 	 	
     	 	 	 	 	
     	 	 	 	 	 	 
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'income', 'id', $db);
    }
}
