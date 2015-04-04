<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableReceivable extends JTable
{
    var $id = null;
    var $rec_from = null;
    var $rec_amount = null;
    var $rec_date = null;
    var $rec_certification= null;
    var $rec_duedate = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'receivable', 'id', $db);
    }
}
