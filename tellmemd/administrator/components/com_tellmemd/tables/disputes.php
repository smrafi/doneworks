<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis    
 * Developer Email  :   saraniptha@archmage.lk  
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   18 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableDisputes extends JTable
{
    var $id = null;
    var $case_id = null;
    var $added_date = null;
    var $subject = null;
    var $dispute_type = null;
    var $doctor_id = null;
    var $patient_id = null;
    var $award_type = null;
    var $refund_type = null;
    var $case_type = null;
    var $answer_medium = null;
    var $urgency_level = null;
    var $detail_level = null;
        
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'disputes', 'id', $db);
    }
    
}
