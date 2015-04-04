<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

class TableJournalEntry extends JTable

{
    var $id = null;
    var $je_date = null;
    var $sub_ledger = null;
    var $je_voucher_no = null;
    var $je_description = null;
    var $je_c_amount = null;
    var $je_d_amount = null;
    var $je_remarks = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'journalentry', 'id', $db);
    }
}
