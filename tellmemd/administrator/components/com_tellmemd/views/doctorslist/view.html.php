<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewDoctorsList extends JView
{
    function display($tpl = null) 
    {
        
        //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_MANAGE_NEW_DOCTORS').'</small></small>');
	JToolBarHelper::custom('approve', 'publish.png', 'publish_f2.png', JText::_('COM_TELLMEMD_APPROVE'), false);
        JToolBarHelper::custom('disapprove', 'unpublish.png', 'unpublish_f2.png', JText::_('COM_TELLMEMD_DISAPPROVE'), false);
        JToolBarHelper::deleteList();
        JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('COM_TELLMEMD_HELP'), false);
        
        parent::display($tpl);
    }
}
