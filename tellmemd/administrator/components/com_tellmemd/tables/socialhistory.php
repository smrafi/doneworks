<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableSocialHistory extends JTable
{
    var $id = null;
    var $user_id = null;
    var $smoking_status = null;
    var $smoking_howlong = null;
    var $smoking_duration = null;
    var $average_packs = null;
    var $alchohol_status = null;
    var $drug_usage = null;
    var $drug_type = null;
    var $added_time = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'social_history', 'id', $db);
    }
    
}
