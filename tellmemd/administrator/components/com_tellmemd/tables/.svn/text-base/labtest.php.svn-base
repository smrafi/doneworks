<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   15 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableLabTest extends JTable
{
    var $id = null;
    var $update_time = null;
    var $test_name = null;
    var $test_description = null;
    var $cat_id = null;
    var $complex_id = null;
    var $lab_filename = null;
    var $published = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'labtest', 'id', $db);
    }
    
}
