<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   16 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableQualifyData extends JTable
{
    var $id = null;
    var $user_id = null;
    var $doc_id = null;
    var $cat_id = null;
    var $cvfile_name = null;
    var $diplomafile_name = null;
    var $internfile_name = null;
    var $intern_place = null;
    var $intern_startdate = null;
    var $intern_enddate = null;
    var $state_license = null;
    var $dea_license = null;
    var $malpractice_info = null;
    var $speciality = null;
    var $year_practice = null;
    var $medical_background = null;
    var $personal_background = null;
    
    function __construct(&$db) 
    {
        parent::__construct('#__com_tmd_doc_qualifications', 'id', $db);
    }
    
}
