<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerAccount extends JController
{
    
    
    function display()
    {
      
        $view = $this->getView('account', 'html');
        $view->display();
    }
    
    function accountsettings()
    {
          $view = $this->getView('accountsetting', 'html');
          $view->display();
    }
    
    
}