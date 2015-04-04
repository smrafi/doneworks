<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableContact extends JTable
{
    var $id = null;
    var $updated_time = null;
    var $contact_office = null;
    var $contact_name = null;
    var $address = null;
    var $email = null;
    var $phone = null;
    var $published = null;
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'contact', 'id', $db);
    }
}
