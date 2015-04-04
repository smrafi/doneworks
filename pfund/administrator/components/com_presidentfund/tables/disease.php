<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   06 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableDisease extends JTable
{
    var $id = null;
    var $published = null;
    var $updated_time = null;
    var $cat_id = null;
    var $disease_name = null;
    var $private_amount = null;
    var $sjgh_amount = null;
    var $gh_amount = null;
    
    
    function __construct(&$db) 
    {
        parent::__construct(TABLE_PREFIX.'disease', 'id', $db);
    }
}
