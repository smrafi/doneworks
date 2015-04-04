<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   29 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableTempQuestion extends JTable
{
    var $id = null;
    var $temp_id = null;
    var $cat_id = null;
    var $que_subject = null;
    var $que_content = null;
    var $added_time = null;
    var $case_num = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'tempque', 'id', $db);
    }
    
}
