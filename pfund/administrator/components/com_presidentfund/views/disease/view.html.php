<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');
class PFundViewDisease extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
        if($this->disease_data->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Medical Condition').'</small></small>');
          else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Medical Condition').'</small></small>');
        
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
    }
}