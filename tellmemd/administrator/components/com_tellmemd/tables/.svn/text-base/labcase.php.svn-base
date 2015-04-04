<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableLabCase extends JTable
{
    var $id = null;
    var $patient_id = null;
    var $lab_id = null;
    var $lab_subject = null;
    var $lab_content = null;
    var $added_time = null;
    var $case_num = null;
    var $file_name = null;
    var $processed = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'labcase', 'id', $db);
    }
    
}
