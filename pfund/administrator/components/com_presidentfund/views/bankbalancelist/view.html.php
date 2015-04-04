<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   23 Dec 2011
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewBankBalanceList extends JView
{
    function display($tpl = null) 
    {
	   //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Bank Blance').'</small></small>');       
        JToolBarHelper::cancel('backob');
        JToolBarHelper::divider();
        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();
        JToolBarHelper::divider();
        JToolBarHelper::addNew();
        JToolBarHelper::editList();
        JToolBarHelper::deleteList();
        JToolBarHelper::divider();
	    JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);

       parent::display($tpl);
    }
}
