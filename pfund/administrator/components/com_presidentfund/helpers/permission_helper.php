<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   12 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class PFundPermissionHelper
{
    //get the user group id
    function getGroupID($user_id = '')
    {
        $user =& JFactory::getUser();
        if(!$user_id)
            $user_id = $user->id;
        
        $db =& JFactory::getDbo();
        $app =& JFactory::getApplication();
        
        $query = "Select group_id From #__user_usergroup_map Where user_id = $user_id ";
        $db->setQuery($query);
        $group_id = $db->loadResult();
        
        if ($db->getErrorNum())
        {
            $app->enqueueMessage($db->stderr(), 'error');
            return FALSE;
        }
        
        if($group_id == '')
            return 0;
        
        return $group_id;
    }
    
    function checkAcces($user_id, $controller, $task = '')
    {
        $group_id = self::getGroupID($user_id);
        
        if(!$task)
            $task = 'view';
        
        if($task == 'backop' or $task == 'hmlistback')
            return TRUE;
        
        $db =& JFactory::getDbo();
        $app =& JFactory::getApplication();
        
        $query = "Select groups From #__pf_permissons Where controller  = '$controller' And task = '$task' ";
        $db->setQuery($query);
        $result = $db->loadObject();
        
        if(!$result)
            return FALSE;
        
        if ($db->getErrorNum())
        {
            $app->enqueueMessage($db->stderr(), 'error');
            return FALSE;
        }
        
        $group_array = json_decode($result->groups);
        
        foreach($group_array as $group)
        {
            if($group == $group_id)
                return TRUE;;
        }
        
        return FALSE;
    }
}
