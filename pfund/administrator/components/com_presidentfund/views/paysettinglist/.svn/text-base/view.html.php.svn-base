<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   13/12/2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
class PFundViewPaySettingList extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
         
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Payment Setting List').'</small></small>');
        JToolBarHelper::cancel('backacc');
        JToolBarHelper::divider();
        JToolBarHelper::addNew();
        JToolBarHelper::editList();
        JToolBarHelper::deleteList();
        JToolBarHelper::divider();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);
        
        parent::display($tpl);
    }
}
