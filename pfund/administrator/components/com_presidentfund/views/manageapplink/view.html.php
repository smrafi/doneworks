<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   28 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
jimport('joomla.html.pane');

class PFundViewManageAppLink extends JView
{
    function display($tpl = null)
    {
         JToolBarHelper::cancel('back');
       
        JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);      
        parent::display($tpl);
    }
}