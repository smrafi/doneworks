<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableLoan extends JTable
{
    var $id = null;
    var $al_whom = null;
    var $al_type = null;
    var $al_scheme = null;
    var $al_amount = null;
    var $al_start = null;
    var $al_due = null;
    var $al_rate = null;
    var $al_request = null;
    var $al_offer = null;
  
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'loan', 'id', $db);
    }
}
