<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// load component helper class of joomla to enable this module work with our rentalot componenet
jimport('joomla.application.component.helper');

// load the helper class
require_once (dirname(__FILE__).DS.'helper.php');

// check weather our rentalot component is enabled and return error if its not enabled
//if (!JComponentHelper::isEnabled('com_brandboodle', true))
//{
//    JError::raiseError('500', JText::_('Brandboodle component is not found'));
//}


$obj = new modQuestionPanelHelper();
// get the values from helper class
//$category_list = $categorylistobj->getCatagaries();

require(JModuleHelper::getLayoutPath('mod_question_panel'));
