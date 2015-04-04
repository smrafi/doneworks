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

class TableDsOffice extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $district = null;
    var $ds_office = null;
    var $published = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'dsoffice', 'id', $db);
    }
}