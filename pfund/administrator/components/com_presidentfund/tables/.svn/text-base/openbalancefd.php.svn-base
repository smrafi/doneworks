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

class TableOpenBalanceFD extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $bank_id = null;
    var $bankaccount_id = null;
    var $interest = null;
    var $period_start= null;
    var $period_end = null;
    var $published = null;
    var $amount = null;
    

    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'ob_fd', 'id', $db);
    }
}
