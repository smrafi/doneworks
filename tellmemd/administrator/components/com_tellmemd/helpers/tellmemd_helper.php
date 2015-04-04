<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TellMeMDHelper
{
    static function addSubMenu($controller)
    {
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_ALERTS'), 'index.php?option=com_tellmemd&controller=alert', $controller == 'alert');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_WEBSITE'), 'index.php?option=com_tellmemd&controller=website', $controller == 'website');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_DISPUTES'), 'index.php?option=com_tellmemd&controller=dispute', $controller == 'dispute');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_CASES'), 'index.php?option=com_tellmemd&controller=cases', $controller == 'cases');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_DOCTORS'), 'index.php?option=com_tellmemd&controller=doctors', $controller == 'doctors');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_REPORTS'), 'index.php?option=com_tellmemd&controller=report', $controller == 'report');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_ACCOUNT'), 'index.php?option=com_tellmemd&controller=account', $controller == 'account');
        JSubMenuHelper::addEntry(JText::_('COM_TELLMEMD_NOTICES'), 'index.php?option=com_tellmemd&controller=notice', $controller == 'notice');
    }
    
    //function to check logged in users in joomla
    //this function will give all the users currently logged in at front end
    function getLoggedInUsers()
    {
        $db =& JFactory::getDbo();
        $query = $db->getQuery(TRUE);
        
        $query->select('s.time, s.client_id, u.id, u.name, u.username');
        $query->from('#__session AS s');
        $query->leftJoin('#__users AS u ON s.userid = u.id');
        $query->where('s.guest = 0 And s.client_id = 0 ');
        $db->setQuery($query);
        $users = $db->loadObjectList();
        
        // Check for database errors
        if ($error = $db->getErrorMsg()) {
                JError::raiseError(500, $error);
                return false;
        };
        
        return $users;
    }
    
    //check a given user is logged in
    //we give the user id and return true if the result is available
    function checkUserOnline($user_id)
    {
        $db =& JFactory::getDbo();
        $query = $db->getQuery(TRUE);
        
        $query->select('s.time, s.client_id, u.id, u.name, u.username');
        $query->from('#__session AS s');
        $query->leftJoin('#__users AS u ON s.userid = u.id');
        $query->where('s.guest = 0 And s.client_id = 0 And s.userid = '.$user_id);
        
        $db->setQuery($query);
        $user = $db->loadObject();
        
        // Check for database errors
        if ($error = $db->getErrorMsg()) {
                JError::raiseError(500, $error);
                return false;
        };
        
        if(!$user)
            return FALSE;
        
        return TRUE;
    }
    
    function createList($name, $current_value, &$items, $first = 0, $class = '', $extra='')
    {
        $html = "\n".'<select name="'.$name.'" id="'.$name.'" class="'.$class.'" size="1" '.$extra.'>';
        
        if($items == NULL)
            return;
        
        foreach ($items as $key => $value)
        {
            if ($key < $first)
                continue;
            
            $selected = '';
            
            if($current_value === $key)
                $selected = 'selected = "selected"';
            
            $html .= "\n".'<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
        }
        
        $html .= '</select>'."\n";
        
        return $html;
    }
    
    function createRadio($name, $current_value, $items = array(), $option='')
    {
        
        $html = '';
        if($items == NULL)
            return '';

        foreach ($items as $key => $value)
        {
            $checked = '';
            
            if($current_value == $key)
                $checked = ' checked = "checked" ';
            
            $html .= "\n".'<input type="radio" name="'.$name.'" value="'.$key.'" '.$checked.$option.' ><span>'.$value.'</span>';
            
            if(count($items)> 1)
                $html .= '<br/>';
        }
        
        return $html;
    }
    
    function createCheckBox($name, $current_value, $value, $label='', $extra='', $right=false)
    {
        $html = '';
	if (($label != '') and (!$right))
		$html .= "\n".'<label for="'.$name.'">'.$label.' '.'</label>';
	if ($current_value)
		$checked = 'checked="checked" ';
	else
		$checked = '';
	$html .= '<input type="checkbox" name="'.$name.'" value="'.$value.'" '.$checked.' '.$extra.' />'."\n";
	if (($label != '') and ($right))
		$html .= "\n".'<label for="'.$name.'">'.' '.$label.'</label>';
	return $html;
    }
    
    function getComplexityArray($option = '')
    {
        if($option)
            $complex_array = array($option, JText::_('COM_TELLMEMD_COMPLEX_SIMPLE'), JText::_('COM_TELLMEMD_COMPLEX_MODERATE'), JText::_('COM_TELLMEMD_COMPLEX_COMPLEX'));
        else
            $complex_array = array( 1 => JText::_('COM_TELLMEMD_COMPLEX_SIMPLE'), JText::_('COM_TELLMEMD_COMPLEX_MODERATE'), JText::_('COM_TELLMEMD_COMPLEX_COMPLEX'));
        
        return $complex_array;
    }
    
    function getMediumArray($option = '')
    {
        if($option)
            $medium_array = array($option, 'Form Submit', 'Live Chat Session', 'Skype Call');
        else
            $medium_array = array(1 => 'Form Submit', 'Live Chat Session', 'Skype Call');
        
        return $medium_array;
    }
    
    function getPriorityArray($option = '')
    {
        if($option)
            $priority_array = array($option, 'Low', 'Medium', 'High');
        else
            $priority_array = array(1 => 'Low', 'Medium', 'High');
        
        return $priority_array;
    }
    
    function getStatusArray($index, $option = '')
    {
        
        $status = array(
                    CASE_STATUS_OPEN => 'Open',
                    CASE_STATUS_SENT => 'Sent',
                    CASE_STATUS_ACCEPTED => 'Accepted',
                    CASE_STATUS_INFO => 'Info',
                    CASE_STATUS_ANSWERED => 'Answered',
                    CASE_STATUS_REOPEN => 'Re-open',
                    CASE_STATUS_SOLVED => 'Solved',
                    CASE_STATUS_REVIEW => 'Review',
                    CASE_STATUS_CLOSED => 'Closed',
                    CASE_STATUS_FAILED => 'Failed',
                    CASE_STATUS_REFUNDED => 'Refunded'
        );
        if($option)
            $status[0] = $option;
        
        if($index == 'all'){
            ksort($status);
            return $status;
        }
        
        if($index > 0 && $index < 12)
            return $status[$index];
        else
            return FALSE;
    }
    
    function getPriorityCodeArray($index)
    {
        $priority = array(
                    PRIORITY_TYPE_LOW => 'L',
                    PRIORITY_TYPE_MEDIUM => 'M',
                    PRIORITY_TYPE_HIGH => 'H'
        );
        
        
        if($index == 'all')
            return $priority;
        
        if($index > 0 && $index < 4)
            return $priority[$index];
        else
            return FALSE;
    }
    
    function getDisputeTypeArray($index,$option = '')
    {
        
        
        $dispute = array(
                    CASE_DISPUTE_REVIEW => 'Review',
                    CASE_DISPUTE_REJECT => 'Reject',
                    CASE_DISPUTE_REFUND => 'Refund'
        );
        
        if($option)
            $dispute[0] = $option;
        
        
        if($index == 'all'){
            ksort($dispute);
            return $dispute;
        }
        if($index > 0 && $index < 4)
            return $dispute[$index];
        else
            return FALSE;
    }
    
    function getDisputeStatusArray($index,$option = '')
    {
        
        
        $status = array(
                    CASE_DISPUTE_STATUS_NEW => 'New',
                    CASE_DISPUTE_STATUS_OPEN => 'Open',
                    CASE_DISPUTE_STATUS_CLOSE => 'Closed'
        );
        
        if($option)
            $status[0] = $option;
        
        
        if($index == 'all'){
            ksort($status);
            return $status;
        }
        if($index > 0 && $index < 4)
            return $status[$index];
        else
            return FALSE;
    }
}

?>
