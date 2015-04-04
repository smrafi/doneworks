<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCategory extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $category_name = null;
    var $published = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'category', 'id', $db);
    }
}
