<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   20 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAllergyIDs extends JTable
{
    var $id = null;
    var $user_id = null;
    var $allergy_ids = null;
    var $added_time = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'allergy_ids', 'id', $db);
    }
    
}