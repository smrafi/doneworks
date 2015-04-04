<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//check weather user can access the component
if(!JFactory::getUser()->authorise('core.manage', 'com_presidentfund'))
{
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//load the helper classes we need all the time
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'general_helper.php';
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'pfund_helper.php';

$document =& JFactory::getDocument();
$document->addScript(JURI::root().'administrator/components/com_presidentfund/assets/scripts/jquery-1.7.1.min.js');
$document->addScript(JURI::root().'administrator/components/com_presidentfund/assets/scripts/script.js');
$document->addStyleSheet(JURI::root().'administrator/components/com_presidentfund/assets/styles/style.css');

//set default controller to cases
$controller = JRequest::getVar('controller','configure');

//call the submenus
PFundHelper::addSubMenu($controller);

//get the task
$task = JRequest::getVar('task','');

//assign controller class and load it
$classname = 'PFundController'.$controller;

//load the controller file
require_once JPATH_COMPONENT.DS.'controllers'.DS.$controller.'controller.php';

//excute the controller
$controller = new $classname;
$controller->execute($task);

$controller->redirect();