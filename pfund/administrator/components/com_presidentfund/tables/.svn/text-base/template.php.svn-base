<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableTemplate extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $language_id=null;
    var $template_name = null;
    var $published = null;
    var $template_content = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'template', 'id', $db);
    }
}