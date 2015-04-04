<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewSettingList extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('MANAGE_WEBSITE').'</small></small>');
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('HELP'), false);
        
        parent::display($tpl);
    }
}
