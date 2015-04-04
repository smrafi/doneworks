<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');


class PFundModelTemplate extends JModel
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
        $this->_data->language_id=0;
        $this->_data->template_name = '';
        $this->_data->published = 1;
        $this->_data->template_content = '';
        return $this->_data;
    }
    
    function getPostData()
    {
        $this->_data->id = JRequest::getInt('id');
        $this->_data->language_id=JRequest::getInt('language_id');
        $this->_data->template_name = JRequest::getVar('template_name');
        $this->_data->published = JRequest::getInt('published');
         $this->_data->template_content = JRequest::getVar( 'template_content', '', 'post', 'string', JREQUEST_ALLOWHTML );
        
        return $this->_data;
    }
    
     function validate()
    {
      
        if(!$this->_data->language_id)
        {
            $this->_app->enqueueMessage(JText::_('Please select template language'),'error');
            return FALSE;
        }
        
         if($this->_data->template_name == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter a template name'),'error');
            return FALSE;
        }
        
       if($this->_data->template_content == '')
        {
            $this->_app->enqueueMessage(JText::_('Enter content of the template'),'error');
            return FALSE;
        }
                
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
        
        if(!$this->validate())
            return FALSE;
        
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
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."template Where id = $id ";
        $this->_db->setQuery($query);
	$this->_data = $this->_db->loadObject();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return $this->_data;
    }
    
     function getList()
    {
        $limit = $this->_app->getUserStateFromRequest('global.list.limit', 'limit', $this->_app->getCfg('list_limit'), 'int');
	$limitstart = $this->_app->getUserStateFromRequest(OPTION_NAME.'.limitstart', 'limitstart', 0, 'int');
	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0); // In case limit has been changed
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."template ";
        $query_where = "";
        
        $query_order = "Order By template_name ";
        
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
            
            $query = "Delete From ".TABLE_PREFIX."template Where id = $cid";
            
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
    
    //Dev Rafi
    //A function to get all available tempaltes as an array
    function getTemplateListArray($option = '')
    {
        $query = "Select id, template_name From ".TABLE_PREFIX."template ";
        $this->_db->setQuery($query);
	$template_list = $this->_db->loadObjectList();
        
        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        if($option)
            $template_array[0] = $option;
        
        foreach ($template_list as $template)
            $template_array[$template->id] = $template->template_name;
        
        return $template_array;
    }
    
    function prepareTemplateLetter($template_text, $data = '', $group_data = '')
    {
        $titles_array = GeneralHelper::getTitles();
        
        if($data)
        {
            if($data->patient_title == 0)
                $title_name = $data->othertitle_patient;
            else
                $title_name = $titles_array[$data->patient_title];
            
            $signimg = '';
            
            if($data->imgtag != 'nil')
                $signimg = '<img src="'.JURI::root().'components/com_presidentfund/files/signs/'.$data->imgtag.'.png" />';

            $template_text = str_replace(PF_TITLE, $title_name, $template_text);
            $template_text = str_replace(PF_FULLNAME, $data->patient_fullname, $template_text);
            $template_text = str_replace(PF_FULLNAME_SI, $data->patient_fullname_si, $template_text);
            $template_text = str_replace(PF_FULLNAME_TA, $data->patient_fullname_ta, $template_text);
            $template_text = str_replace(PF_APPLICATION_NUMBER, $data->patient_num, $template_text);
            $template_text = str_replace(PF_NIC_NUMBER, $data->patient_nic, $template_text);
            $template_text = str_replace(PF_ADDRESS_L1, $data->patient_add1, $template_text);
            $template_text = str_replace(PF_ADDRESS_L1_SI, $data->patient_add1_si, $template_text);
            $template_text = str_replace(PF_ADDRESS_L1_TA, $data->patient_add1_ta, $template_text);
            $template_text = str_replace(PF_ADDRESS_L2, $data->patient_add2, $template_text);
            $template_text = str_replace(PF_ADDRESS_L2_SI, $data->patient_add2_si, $template_text);
            $template_text = str_replace(PF_ADDRESS_L2_TA, $data->patient_add2_ta, $template_text);
            $template_text = str_replace(PF_DS_OFFICE, $data->ds_office, $template_text);
            $template_text = str_replace(PF_SIGN_IMAGE, $signimg, $template_text);
        }
        
        if($group_data)
        {
            $template_text = str_replace(PF_PRESIDENT_APPLICATION_TABLE, $group_data->application_table, $template_text);
            $template_text = str_replace(PF_HEALTH_MINISTRY_APPLICAION_LIST, $group_data->applist_table, $template_text);
            $template_text = str_replace(PF_PRESIDENT_LETTER_NUM, $group_data->letterfile_num, $template_text);
        }
        
        $template_text = str_replace(PF_CURRENT_MONTH_YEAR, date('F ,Y'), $template_text);
        $template_text = str_replace(PF_CURRENT_DATE, date('d/m/Y'), $template_text);
     
        return $template_text;
    }
}