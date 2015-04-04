<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   15 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewNewLabTest extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        if($this->labtest_data->id == 0)
            JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_NEW_LABTEST').'</small></small>');
        else
            JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_EDIT_LABTEST').'</small></small>');
        
        JToolBarHelper::custom('back', 'back.png', 'back_f2.png', JText::_('BACK'), false);
        JToolBarHelper::apply();
	JToolBarHelper::save();
        JToolBarHelper::save2new();
        JToolBarHelper::cancel();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('COM_TELLMEMD_HELP'), false);
        
        parent::display($tpl);
    }
}
