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

class TableOpenBalanceLoan extends JTable
{
    var $id = null;
    var $al_whom = null;
    var $al_type = null;
    var $al_scheme = null;
    var $al_balance= null;
    var $al_amount = null;
    var $al_start = null;
    var $al_due = null;
    var $al_rate = null;
    var $al_remark = null;
  
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'ob_loan', 'id', $db);
    }
}
