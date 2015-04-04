<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewSurgeryList extends JView
{
    function display($tpl = null) 
    {
        
        //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_MANAGE_SURGERY').'</small></small>');
        JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
        JToolBarHelper::divider();
        JToolBarHelper::addNew();
        JToolBarHelper::editList();
	JToolBarHelper::deleteList();
        JToolBarHelper::divider();
        JToolBarHelper::custom('backop', 'back.png', 'back_f2.png', JText::_('BACK'), false);
        JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('HELP'), false);
        
        parent::display($tpl);
    }
}
