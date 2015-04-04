<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCondition extends JTable
{
    var $id = null;
    var $cat_id = null;
    var $condition_name = null;
    var $published = null;
    var $updated_time = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'condition', 'id', $db);
    }
    
}