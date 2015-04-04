<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   14 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCategory extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $cat_name = null;
    var $cat_description = null;
    var $published = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'category', 'id', $db);
    }
    
}
