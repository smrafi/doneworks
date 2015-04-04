<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   15 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class TellMeMdModelLabTest extends JModel
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
    
    function initData()
    {
        $this->_data->id = 0;
        $this->_data->published = 1;
        $this->_data->test_name = '';
        $this->_data->test_description = '';
        $this->_data->cat_id = 0;
        $this->_data->complex_id = 0;
        $this->_data->lab_filename = '';
        
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->cat_id = JRequest::getInt('cat_id');
        $this->_data->complex_id = JRequest::getInt('complex_id');
        $this->_data->published = JRequest::getInt('published');
        $this->_data->test_name = JRequest::getVar('test_name', '');
        $this->_data->test_description = JRequest::getVar('test_description', '');
        
        $this->_data->updated_time = date('Y-m-d H:i:s');
        $this->_data->lab_filename = JRequest::getVar('lab_filename', '');
        
        return $this->_data;
    }
    
    function store()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
        $this->saveLabTestFile();
        
        $row =& $this->getTable();
        
        if(!$row->bind($this->_data))
        {
            $this->_app->enqueueMessage($row->getError(), 'error');
            return FALSE;
        }
        
        if(!$row->store())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return false;
        }
        
        $new_id = $this->_db->insertId();
        
        if($new_id > 0)
            $this->_data->id = $new_id;
        
        return true;
    }
    
    function validate()
    {
        if($this->_data->cat_id == 0)
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SELECT_CAT_ERROR'),'error');
            return false;
        }
        if($this->_data->complex_id == 0)
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_SELECT_COMPLEX_ERROR'),'error');
            return false;
        }
        if($this->_data->test_name == '')
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_TESTNAME_NOT_FILLED_ERROR'),'error');
            return false;
        }
        if($this->_data->test_description == '')
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_TESTDESC_NOT_FILLED_ERROR'),'error');
            return false;
        }
        
        return TRUE;
    }
    
    function saveLabTestFile()
    {
        $path = JPATH_COMPONENT_SITE.DS.'uploads'.DS.'labtests/';
        $size_limit = 2 * 1024 * 1024;
        $allowed_ext = array(
            'doc' => 'doc',
            'docx' => 'docx',
            'gif' => 'gif',
            'jpg' => 'jpg',
            'png' => 'png',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'pdf' => 'pdf'
        );
        
        $files = JRequest::get('files');
        $lab_file = $files['lab_file'];
        
        //get the file informations
        $tmp_file = $lab_file['tmp_name'];
        $file_size = $lab_file['size'];
        $info = pathinfo($lab_file['name']);
        
        $unique_id = uniqid();
        
        //if file is not available then we retun true and escape from this function
        if($lab_file['name'] == '')
            return TRUE;
        
        //we compare the file size and return false if file size is exceeded than 2 MB
        if($file_size > $size_limit)
        {
            $this->_app->enqueueMessage(JText::_('COM_TELLMEMD_FILE_SIZE_ERROR'), 'error');
            return false;
        }
        
        //if file extension is not acceptable then we return false
        if(!$allowed_ext[$info['extension']])
        {
            $this->_app->enqueueMessage(strtoupper($info['extension']).' '.JText::_('COM_TELLMEMD_FILE_EXT_ERROR'), 'error');
            return false;
        }
        
        //move the file to path
        $file_name = $unique_id.'_'.basename($lab_file['name']);
        if(move_uploaded_file($tmp_file, $path.$file_name))
            $this->_data->lab_filename = $file_name;
        
        return TRUE;
    }
    
    function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTIOIN_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        //if filter is availabe
        $filter_var = JRequest::getVar('filter_desc', '');
        
        //build the query
        $query_count = "Select count(*) " ;
        $query_cols = "Select test.*, cats.cat_name ";
        $query_from = "From ".TABLE_PREFIX."category As cats, ".TABLE_PREFIX."labtest As test ";
        $query_where = "Where test.cat_id = cats.id ";
        
        if($filter_var)
            $query_where .= "And test.test_description Like '%$filter_var%' ";
        
        $query_order = "Order By test.test_name ";
        
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
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."labtest Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
    function getLabListArray($option = '')
    {
        $query = "Select id, test_name From ".TABLE_PREFIX."labtest Where published = 1 ";
        $this->_db->setQuery($query);
	$labtest = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if($option)
            $labtest_array[] = $option;
        foreach($labtest as $lab)
            $labtest_array[$lab->id] = $lab->test_name;
        
        return $labtest_array;
    }
    
    function publish($p)
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        $row =& $this->getTable();
        
        if (!$row->publish($cids, $p))
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return false;
        }
        
        return TRUE;
    }
    
    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        
        foreach($cids as $cid)
        {
            if($this->getOne($cid) === FALSE)
                return FALSE;
            
            $query = "Delete From ".TABLE_PREFIX."labtest Where id = $cid";
            
            $this->_db->setQuery($query);
            $this->_db->query();
            
            if ($this->_db->getErrorNum())
            {
                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                return FALSE;
            }
        }
        
        return TRUE;
    }
}
