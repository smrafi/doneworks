<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   05 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class TellMeMdModelDoctors extends JModel
{
    var $_pagination = null;
    var $_data = null;
    var $_app = null;
    
    function __construct() 
    {
        $this->_app =& JFactory::getApplication();
        parent::__construct();
    }
    
    function pagination()
    {
        if($this->_pagination == NULL)
            $this->_pagination = new JPagination (0, 0, 0);
        return $this->_pagination;
    }
    
    function getNewDoctors()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
        $filter_var = JRequest::getVar('filter_qualy', '');
        
        //get the doctors group id
        $group_query = "Select id From #__usergroups Where title = 'Doctors'";
        $this->_db->setQuery($group_query);
        $docgroup_id = $this->_db->loadResult();
        
        //build the query
        $query_count = "Select count(*)" ;
        $query_cols = "Select users.name, users.username, users.email, users.registerDate, userdata.*, 
                        qualification.speciality, qualification.medical_background ";
        $query_from = "From ".TABLE_PREFIX."doc_qualifications As qualification, #__users As users, #__user_usergroup_map As groupmap, 
                        #__user_data As userdata ";
        $query_where = "Where users.id = userdata.user_id And users.id = qualification.user_id And 
                        users.id = groupmap.user_id And groupmap.group_id = $docgroup_id And users.block = 1 ";
        
        if($filter_var)
            $query_where .= "And qualification.medical_background Like '%$filter_var%' ";
        
        $query_order = "Order By users.name ";
        
        $count_query = $query_count.$query_from.$query_where;
        $this->_db->setQuery($count_query);
	$total = $this->_db->loadResult();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        //setup the pagination
        $this->_pagination = new JPagination($total, $limitstart, $limit);
        
        $query = $query_cols.$query_from.$query_where.$query_order;
        
        //get the data within limits
        $this->_data = $this->_getList($query, $limitstart, $limit);
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getNewDoctor($id)
    {
        $query = "Select user.username, user.email, user.name, personal.id As info_id, personal.*, qualify.id As qualify_id, qualify.* 
                    From ".TABLE_PREFIX."doc_qualifications As qualify, 
                        #__users As user, #__user_data As personal 
                        Where personal.id = $id 
                        And personal.user_id = user.id 
                        And personal.user_id = qualify.user_id ";
        
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
}