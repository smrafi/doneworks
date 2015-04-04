<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   12 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
jimport('joomla.html.pane');

class PFundViewApplication extends JView
{
    function display($tpl = null)
    {
        //make the top heading a menu bar
        if($this->application_data->id)
            JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Application').'</small></small>');
        else
            JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Application').'</small></small>');
        
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
    }
}