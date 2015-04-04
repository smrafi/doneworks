<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Dry Cleans Word Press
 *  Date            : 03 May 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/


/*
Plugin Name: Dry Clean Manager
Plugin URI: http://www.archmage.lk
Description: This plugin will manage the dry clean place information. Plugin will handle the information about dryclean places and will display it according to the users
Version: 1.0
Author: Archmage Software
Author URI: mailto:rafi@archmage.lk
License: GNU/GPL
*/


/*  Copyright 2011  Mohamed Rafi  (email : rafi@archmage.lk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$plugin_path = dirname(__FILE__);
require_once $plugin_path.'/dryclean-addlisting.php';
require_once $plugin_path.'/dryclean-managelisting.php';
require_once $plugin_path.'/dryclean-addcats.php';
require_once $plugin_path.'/dryclean-addcounty.php';


function dcmdAdminMenu()
{
    add_utility_page('Dryclean List Manager Dashboard', 'Business Directory', 1, 'drycleans-dashboard', 'dcmdAdmin', '');
    add_submenu_page('drycleans-dashboard', 'Add a dryclean listing', 'Add Listing', 1, 'drycleans-add-listing', array('dryCleansAddListing', 'dcmdAddList'));
    add_submenu_page('drycleans-dashboard', 'Mangage dryclean listings', 'Manage Listings', 1, 'drycleans-manage-listing', array('dryCleansManageListing', 'dcmdManageList'));
    add_submenu_page('', 'Add dryclean category', '', 8, 'drycleans-add-cats', array('dryCleansAddCategory', 'dcmdAddCats'));
    add_submenu_page('drycleans-dashboard', 'Manage category List', 'Manage Category', 8, 'drycleans-manage-cats', array('dryCleansAddCategory', 'dcmdManageCats'));
    add_submenu_page('', 'Add dryclean county', '', 8, 'drycleans-add-county', array('dryCleansAddCounty', 'dcmdAddCounty'));
    add_submenu_page('drycleans-dashboard', 'Manage county List', 'Manage County', 8, 'drycleans-manage-county', array('dryCleansAddCounty', 'dcmdManageCounty'));
}

function dcmdAdmin()
{
    echo 'this is dashboard to manage. This will be finalized later';
}

//testing creating widget
function wpmsWidgetTest()
{
    //echo 'hello there';
    echo '<ul><li><a href="http://www.google.com" > Google </a></li></ul>';
    $test = wp_page_menu();
    print_r($test);
    

}

//control of the widget
function wpmsWidgetControl()
{
    echo 'this is a control';
}

function wpmsLinkTest()
{
    echo 'This is a link test';
    
}

//widget html
function wpmsWidgetTestHtml($args)
{
    extract($args);
    echo $before_widget;
    //echo $before_title;
    ?>

<h2 class="widget-title">Testing Widget</h2>
<?php echo $after_title;
 wpmsWidgetTest(); ?>


<?php
echo $after_widget;

}

//init the widget
function wpmsWidgetTestInit()
{
    register_sidebar_widget(__('Testing Widget'), 'wpmsWidgetTestHtml');
    register_widget_control(__('Testing Control'), 'wpmsWidgetControl');
}


add_action('admin_menu', 'dcmdAdminMenu');
add_action('plugins_loaded', 'wpmsWidgetTestInit');


?>