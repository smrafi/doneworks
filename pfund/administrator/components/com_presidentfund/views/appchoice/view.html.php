<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   05 January 2012
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
jimport('joomla.html.pane');

class PFundViewAppChoice extends JView
{
    function display($tpl = null)
    {
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Application').'</small></small>');
        
        JToolBarHelper::cancel();
        
        parent::display($tpl);
    }
}