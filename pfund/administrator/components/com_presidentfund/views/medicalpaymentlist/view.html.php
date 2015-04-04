<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewMedicalPaymentList extends JView
{
    function display($tpl = null) 
    {
	   //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Detail View Of Medical Payment').'</small></small>');       
        JToolBarHelper::custom('medical_voucher', 'featured.png', 'featured_f2.png', JText::_('Release Voucher'), false); 
        JToolBarHelper::divider();
        JToolBarHelper::cancel('backentry');
        JToolBarHelper::divider();
        JToolBarHelper::addNew();
        JToolBarHelper::editList();
        JToolBarHelper::deleteList();
        JToolBarHelper::divider();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);

        parent::display($tpl);
    }
}

