<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableLedgerItem extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $published = null;
    var $income_type = null;
    var $expense_type = null;
    var $ledger_item = null;
    var $bank_id = null;
    var $bankaccount_id = null;
    var $account_type = null;
    
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'ledgeritem', 'id', $db);
    }
}
