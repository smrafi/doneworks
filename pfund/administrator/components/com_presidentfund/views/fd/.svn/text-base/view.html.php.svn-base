<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
class PFundViewFD extends JView
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