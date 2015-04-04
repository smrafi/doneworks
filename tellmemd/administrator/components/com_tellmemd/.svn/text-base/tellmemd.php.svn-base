<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   25 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//check weather user can access the component
if(!JFactory::getUser()->authorise('core.manage', 'com_tellmemd'))
{
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//load the helper classes we need all the time
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'general_helper.php';
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'tellmemd_helper.php';


//set default controller to cases
$controller = JRequest::getVar('controller','alert');

//call the submenus
TellMeMDHelper::addSubMenu($controller);

//get the task
$task = JRequest::getVar('task','');

//assign controller class and load it
$classname = 'TellMeMdController'.$controller;

//load the controller file
require_once JPATH_COMPONENT.DS.'controllers'.DS.$controller.'controller.php';

//excute the controller
$controller = new $classname;
$controller->execute($task);

$controller->redirect();
