<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundviewFile extends JView
{
    
    function display($tpl = null) 
    {
         if($this->file_data->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Document Details').'</small></small>');
          else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Document Details').'</small></small>');
          
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        
        parent::display($tpl);
        
    }
}
