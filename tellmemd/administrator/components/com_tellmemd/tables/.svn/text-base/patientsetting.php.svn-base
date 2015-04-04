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

class TablePatientSetting extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $specific_doctor = null;
    var $urgencycasetime_low = null;
    var $urgencycasetime_medium = null;
    var $urgencycasetime_high = null;
    var $newdoctime_urglow = null;
    var $newdoctime_urgmedium = null;
    var $newdoctime_urghigh = null;
    var $priceinc_urglow = null;
    var $priceinc_urgmedium = null;
    var $priceinc_urghigh = null;
    var $priceinc_level_low = null;
    var $priceinc_level_medium = null;
    var $priceinc_level_high = null;
    var $priceinc_medium_submit = null;
    var $priceinc_medium_chat = null;
    var $priceinc_medium_skype = null;
    var $words_divide = null;
    var $simple_labtest_price = null;
    var $mod_labtest_price = null;
    var $complex_labtest_price = null;
    var $maxprice_percentage = null;
    var $minprice_percentage = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'patient_settings', 'id', $db);
    }
    
}
