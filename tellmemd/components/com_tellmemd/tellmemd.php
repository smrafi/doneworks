<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   10 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//load the helper classes we need all the time
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'general_helper.php';
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'tellmemd_helper.php';

//load needed javacript and style files
$document =& JFactory::getDocument();
$document->addScript(JURI::root().'components/com_tellmemd/assets/script/jquery-1.6.2.min.js');
$document->addScript(JURI::root().'components/com_tellmemd/assets/script/tabs.js');
$document->addScript(JURI::root().'components/com_tellmemd/assets/script/script.js');
$document->addStyleSheet(JURI::root().'components/com_tellmemd/assets/styles/style.css');

//get the task
$task = JRequest::getVar('task','');

//set default controller to cases
$controller = JRequest::getVar('controller','default');

//load the controller file
require_once JPATH_COMPONENT.DS.'controllers'.DS.$controller.'controller.php';

//assign controller class and load it
$classname = 'TellMeMdController'.$controller;

//excute the controller
$controller = new $classname;
$controller->execute($task);

$controller->redirect();

?>
