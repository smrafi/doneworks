<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   06 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TablePayment extends JTable
{
    var $id = null;
    var $case_num = null;
    var $case_type = null;
    var $invoice = null;
    var $tx_number = null;
    var $currency = null;
    var $answer_medium = null;
    var $urgency_level = null;
    var $detail_level = null;
    var $price_amount = null;
    var $payment_status = null;
    var $updated_time = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'payment_data', 'id', $db);
    }
    
}