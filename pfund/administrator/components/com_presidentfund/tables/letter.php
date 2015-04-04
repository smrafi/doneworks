<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   31 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableLetter extends JTable
{
    var $id = null;
    var $application_id = null;
    var $generated_time = null;
    var $user_id = null;
    var $office_type = null;
    var $template_id = null;
    var $letter_note = null;
    var $letter_content = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'letter', 'id', $db);
    }
}
