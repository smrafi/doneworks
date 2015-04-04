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
class PFundViewOpenBalanceFD extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        if($this->fd_list->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Account Fixed Diposits').'</small></small>');
          else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Account Fixed Diposits').'</small></small>');
        
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
    }
}
