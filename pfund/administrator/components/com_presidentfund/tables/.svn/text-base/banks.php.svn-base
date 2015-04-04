<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableBanks extends JTable
{
    var $id = null;
    var $bank_name = null;
    var $bank_code = null;
    
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'banks', 'id', $db);
    }
}