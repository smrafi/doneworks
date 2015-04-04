<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//check weather user can access the component
//if(!JFactory::getUser()->authorise('core.manage', 'com_presidentfund'))
//{
//    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
//}

//load the helper classes we need all the time
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'general_helper.php';
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'pfund_helper.php';
require JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'permission_helper.php';

$document =& JFactory::getDocument();
$application =& JFactory::getApplication();
$user =& JFactory::getUser();
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/jquery-1.7.1.min.js');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/googlejs.js');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/transliterate.js');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/script.js');
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/style.css');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/jquery-1.2.1.pack.js');
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/combo.css');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/combo.js');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/jquery-latest.js');
$document->addScript(JURI::root().'components/com_presidentfund/assets/scripts/jquery.js');

//set default controller to cases
$controller = JRequest::getVar('controller','application');


//get the task
$task = JRequest::getVar('task','');

//check weather user is enabled for task as well
if(!PFundPermissionHelper::checkAcces($user->id, $controller, 'all'))
{
    if(!PFundPermissionHelper::checkAcces($user->id, $controller, $task))
            $application->redirect(JURI::root(), 'You don\'t have permission to access this page!', 'error');
}

//assign controller class and load it
$classname = 'PFundController'.$controller;

//load the controller file
require_once JPATH_COMPONENT.DS.'controllers'.DS.$controller.'controller.php';

//excute the controller
$controller = new $classname;
$controller->execute($task);

$controller->redirect();