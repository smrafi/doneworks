<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   11 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerDefault extends JController
{
    function display()
    {
        echo 'hi there';
    }
    
    function thank()
    {
        //get the user object
        //check user is logged in or not
        //if user is logged in instantly after registraion, 
        //then user type is patient otherwise it is a doctor
        $user =& JFactory::getUser();
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //get the common model
        $common_model = $this->getModel('common');
        
        if(!$common_model->validateTokenRegister($token_info))
        {
            $this->setRedirect ('index.php', 'Invalid token found!', 'Notice');
        }
        
        if($user->id === 0)
        {
            $view_name = 'doctorthank';
        }
        else
            $view_name = 'patientthank';
        
        $view = $this->getView($view_name, 'html');
        $view->assignRef('token_info', $token_info);
        $view->display();
    }
}
