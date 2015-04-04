<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableNotice extends JTable
{
    var $id = null;
    var $patient_ids = null;
    var $doctor_ids = null;
    var $subject = null;
    var $notice = null;
    var $status = null;
    var $created_date = null;
    var $sent_date = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'notices', 'id', $db);
    }
    
}