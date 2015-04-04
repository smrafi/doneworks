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

class PFundControllerChqRegister extends JController
{
    function display()
    {
        $view = $this->getview('chqregisterlist','html');
        $view->display();
    }
    
    function cancel()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountview'));
        return;
    }
}
