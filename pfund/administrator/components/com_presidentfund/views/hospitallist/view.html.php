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
class PFundViewHospitalList extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
         
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Approved Hospitals & pharmaceuticals').'</small></small>');
        JToolBarHelper::cancel('back');
        JToolBarHelper::divider();
        JToolBarHelper::addNew();
        JToolBarHelper::editList();
        JToolBarHelper::deleteList();
        JToolBarHelper::divider();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);
        
       parent::display($tpl);
    }
}