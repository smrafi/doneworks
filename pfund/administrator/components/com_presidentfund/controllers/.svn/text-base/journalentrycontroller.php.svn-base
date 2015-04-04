<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerJournalEntry extends JController
{
    
    function display()
    {
      
        $view = $this->getView('journalentry', 'html');
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }
    
}
