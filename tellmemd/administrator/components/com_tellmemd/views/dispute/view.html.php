<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis    
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 October 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class TellMeMdViewDispute extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        
       JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('COM_TELLMEMD_VIEW_DISPUTES').'</small></small>');
                   
        JToolBarHelper::cancel();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('COM_TELLMEMD_HELP'), false);
        
        parent::display($tpl);
    }
}
