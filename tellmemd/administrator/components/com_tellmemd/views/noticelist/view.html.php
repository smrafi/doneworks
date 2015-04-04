<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   28 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewNoticeList extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_MANAGE_NOTICES').'</small></small>');
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
        
        JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('COM_TELLMEMD_HELP'), false);
        
        parent::display($tpl);
    }
}

