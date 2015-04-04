<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TablePendingPayment extends JTable
{
    var $id = null;
    var $doctor_id = null;
    var $lp_date = null;
    var $lp_amount = null;
    var $rem_payment = null;
    var $total_paid = null;    
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'pending_payment', 'id', $db);
    }
    
}
