<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   09 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableFD extends JTable
{
    var $id = null;
    var $bank_id = null;
    var $bankaccount_id = null;
    var $interest = null;
    var $period_start= null;
    var $period_end = null;
    var $file_name = null;
    var $interest_scheme = null;
    var $amount = null;
    var $approval_doc = null;

    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'interest', 'id', $db);
    }
}
