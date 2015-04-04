<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableFile extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $published = null;
    var $file_purpose = null;
    var $documet_type = null;
    var $document_name = null;
    var $file_description = null;
    var $application_id = null;
    
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'file', 'id', $db);
    }
}
