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

class TableDocSetting extends JTable
{
    var $id = null;
    var $update_time = null;
    var $lockwt_doc = null;
    var $lockntwt_doc = null;
    var $lockassign_doc = null;
    var $low_timelimit = null;
    var $medium_timelimit = null;
    var $high_timelimit = null;
    var $low_relock = null;
    var $medium_relock = null;
    var $high_relock = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'doc_settings', 'id', $db);
    }
    
}
