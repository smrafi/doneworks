<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//import joomla model class library
jimport('joomla.application.component.model');
jimport('joomla.mail.helper');
jimport('joomla.html.pagination');

class PFundModelFile extends JModel
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
        $this->_data->id= 0;
        $this->_data->published= 1;
        $this->_data->file_purpose= '';
        $this->_data->document_name= '';
        $this->_data->file_description= '';
        $this->_data->application_id= JRequest::getint('application_id');
        
        return $this->_data;
        
    }
    
    function getPostData()
    {
        $this->_data->id=JRequest::getint('id');
        $this->_data->file_purpose=JRequest::getVar('file_purpose');
        $this->_data->file_description=JRequest::getVar('file_description');
        $this->_data->published=JRequest::getVar('published');
        $this->_data->document_name=JRequest::getVar('document_name');
        $this->_data->application_id= JRequest::getint('application_id');
        
        return $this->_data;
        
    }
    
     function validate()
    {
      
        if($this->_data->file_purpose == '')
        {
            $this->_app->enqueueMessage('Please Enter File Purpose', 'error');
            return FALSE;
        }
        
        if($this->_data->file_description == '')
        {
            $this->_app->enqueueMessage('Please Enter File Description', 'error');
            return FALSE;
        }
                
        return TRUE;
    }
    
    function addApplicationNote($text)
    {
        //Dev Rafi
        //add a note saying this document has been uploaded
        $user =& JFactory::getUser();
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$this->_data->application_id.", '".$this->_data->file_purpose." document has been $text.', ".$user->id.")";

        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function addApplicationDetailNote()
    {
        //Dev Rafi
        //add a note saying this document has been uploaded
        $user =& JFactory::getUser();
        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                    Values(".$this->_data->application_id.", '".$this->_data->file_description.' : '.$this->_data->file_purpose." file description.', ".$user->id.")";

        $this->_db->setQuery($query);
        $this->_db->query();

        if ($this->_db->getErrorNum())
        {
            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
            return FALSE;
        }
        
        return TRUE;
    }
    
    function store()
    {
        $this->getPostData();
        
        $this->_data->trackid = $this->_data->id;
               
        if(!$this->validate())
            return FALSE;
        
        if(!$this->storeDocument())
            return false;
        
        $row=& $this->getTable();
        
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
    
    function storeDocument()
    {
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'documents/';

        $allowed_ext='pdf';
        $size_limit = 2 * 1024 * 1024;
        
        $files=JRequest::get('files');
        $document=$files['document'];
        $doc_info= pathinfo($document['name']);
        $doc_name= $document['name'];
        $doc_name = str_replace(' ', '_', $doc_name);
        $doc_size=$document['size'];
        
        $unique_id = uniqid();
        
        if($document['tmp_name'] != '')
        {
            if($allowed_ext == $doc_info['extension'])
            {
                if($doc_size > $size_limit)
                {
                    $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                    return false;
                }

                $file_name = $unique_id.'_'.$doc_name;
                if(move_uploaded_file($document['tmp_name'], $path.$file_name))
                {
                     $this->_data->document_name = $file_name;
//                     $note = $this->_data->filepurpose.'Document has been updated';
//                     $query = "update ".TABLE_PREFIX."Application_note set application_note = '$note' where application_id = '".$this->_data->application_id."'";
//                     $this->_db->setQuery($query);
//                     $this->_data = $this->_db->loadObject();
                     
                     return TRUE;
                }
            }
            else
            {
                $this->_app->enqueueMessage(strtoupper($doc_info['extension']).' '.JText::_('Document type cannot be saved. please upload PDF document only'), 'error');
                return false;
            }
        }
        elseif($this->_data->document_name == '')
        {
            $this->_app->enqueueMessage(JText::_('Document is cannot be saved. Please Select a PDF document to upload'), 'error');
            return false;
        }
        
        return TRUE;
    }
    
    function getOne($id)
    {
        $query = "Select * From ".TABLE_PREFIX."file Where id = $id ";
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
        
        //if application id exists
        $application_id = JRequest::getInt('application_id');
        
        $query_count = "Select count(*) " ;
        $query_cols = "Select * ";
        $query_from = "From ".TABLE_PREFIX."file ";
        $query_where = "Where 1 ";
        
        $query_order = "Order By file_purpose ";
        
        if($application_id)
            $query_where .= "And application_id = $application_id ";
        
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
        
        return $this->_data;
    }
    
    function storeReqDocumet()
    {
        $path=JPATH_COMPONENT_SITE.DS.'files'.DS.'documents/';

        $allowed_ext = array('jpg', 'png', 'gif', 'pdf');
        $size_limit = 2 * 1024 * 1024;
        
        $unique_id = uniqid();
        $user =& JFactory::getUser();
        
        $files=JRequest::get('files');
        $application_id = JRequest::getint('application_id');
        $application = $files['appdocument'];
        $reqletter = $files['reqletter'];
        $doctletter = $files['doctletter'];
        $estimate = $files['estimate'];
        
        if(!empty ($application['tmp_name']) && !empty ($reqletter['tmp_name']) && !empty ($doctletter['tmp_name']) && !empty ($estimate['tmp_name']))
        {
            $extension = end(explode('.', $application['name']));
            if($extension != '' && array_search($extension,$allowed_ext) !== false)
            {
                if($application['size'] < $size_limit)
                {
                    $file_name = $unique_id.'_'.str_replace(' ', '_', $application['name']);

                    if(move_uploaded_file($application['tmp_name'], $path.$file_name))
                    {
                        $file_type = PFundHelper::getDocumentType();
                        $file_purpose = $file_type[DOCUMENT_TYPE_APPLICATION];
                        $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_type, document_name) 
                                    Values('$application_id','$file_purpose',".DOCUMENT_TYPE_APPLICATION.", '$file_name' )";
                        $this->_db->setQuery($query);
                        $this->_db->query();
                
                        if ($this->_db->getErrorNum())
                        {
                            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                            return FALSE;
                        }
                        
                        //Dev Rafi
                        //add a note saying this document has been uploaded
                        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                    Values(".$application_id.", '".$file_type[DOCUMENT_TYPE_APPLICATION]." document has been uploaded.', ".$user->id.")";

                        $this->_db->setQuery($query);
                        $this->_db->query();

                        if ($this->_db->getErrorNum())
                        {
                            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                            return FALSE;
                        }
                        
                                $extension = end(explode('.', $reqletter['name']));
                                if($extension != '' && array_search($extension,$allowed_ext) !== false)
                                {
                                    if($reqletter['size'] < $size_limit)
                                    {
                                        $file_name = $unique_id.'_'.str_replace(' ', '_', $reqletter['name']);
                                        if(move_uploaded_file($reqletter['tmp_name'], $path.$file_name))
                                            {
                                                $file_type = PFundHelper::getDocumentType();
                                                $file_purpose = $file_type[DOCUMENT_TYPE_REQUEST_LETTER];
                                                $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_type, document_name) 
                                                            Values($application_id,'$file_purpose',".DOCUMENT_TYPE_REQUEST_LETTER.", '$file_name' )";
                                                $this->_db->setQuery($query);
                                                $this->_db->query();

                                                if ($this->_db->getErrorNum())
                                                {
                                                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                    return FALSE;
                                                }
                                                
                                                //Dev Rafi
                                                //add a note saying this document has been uploaded
                                                $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                                            Values(".$application_id.", '".$file_type[DOCUMENT_TYPE_REQUEST_LETTER]." document has been uploaded.', ".$user->id.")";

                                                $this->_db->setQuery($query);
                                                $this->_db->query();

                                                if ($this->_db->getErrorNum())
                                                {
                                                    $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                    return FALSE;
                                                }
                                                
                                                $extension = end(explode('.', $doctletter['name']));
                                                if($extension != '' && array_search($extension,$allowed_ext) !== false)
                                                {
                                                    if($doctletter['size'] < $size_limit)
                                                    {
                                                        $file_name = $unique_id.'_'.str_replace(' ', '_', $doctletter['name']);
                                                        if(move_uploaded_file($doctletter['tmp_name'], $path.$file_name))
                                                        {
                                                            $file_type = PFundHelper::getDocumentType();
                                                            $file_purpose = $file_type[DOCUMENT_TYPE_DOCTORS_LETTER];
                                                            $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_type, document_name) 
                                                                        Values('$application_id','$file_purpose',".DOCUMENT_TYPE_DOCTORS_LETTER.", '$file_name' )";
                                                            $this->_db->setQuery($query);
                                                            $this->_db->query();

                                                            if ($this->_db->getErrorNum())
                                                            {
                                                                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                                return FALSE;
                                                            }
                                                            
                                                            //Dev Rafi
                                                            //add a note saying this document has been uploaded
                                                            $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                                                        Values(".$application_id.", '".$file_type[DOCUMENT_TYPE_DOCTORS_LETTER]." document has been uploaded.', ".$user->id.")";

                                                            $this->_db->setQuery($query);
                                                            $this->_db->query();

                                                            if ($this->_db->getErrorNum())
                                                            {
                                                                $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                                return FALSE;
                                                            }
                                                            
                                                            $extension = end(explode('.', $estimate['name']));
                                                            if($extension != '' && array_search($extension,$allowed_ext) !== false)
                                                            {
                                                                if($estimate['size'] < $size_limit)
                                                                {
                                                                    $file_name = $unique_id.'_'.str_replace(' ', '_', $estimate['name']);
                                                                    if(move_uploaded_file($estimate['tmp_name'], $path.$file_name))
                                                                    {
                                                                        $file_type = PFundHelper::getDocumentType();
                                                                        $file_purpose = $file_type[DOCUMENT_TYPE_ESTIMATE];
                                                                        $query = "Insert Into ".TABLE_PREFIX."file (application_id, file_purpose, document_type, document_name) 
                                                                                    Values('$application_id','$file_purpose',".DOCUMENT_TYPE_ESTIMATE.", '$file_name' )";
                                                                        $this->_db->setQuery($query);
                                                                        $this->_db->query();

                                                                        if ($this->_db->getErrorNum())
                                                                        {
                                                                            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                                            return FALSE;
                                                                        }
                                                                        
                                                                        //Dev Rafi
                                                                        //add a note saying this document has been uploaded
                                                                        $query = "Insert Into ".TABLE_PREFIX."application_note (application_id, application_note, user_id) 
                                                                                    Values(".$application_id.", '".$file_type[DOCUMENT_TYPE_ESTIMATE]." document has been uploaded.', ".$user->id.")";

                                                                        $this->_db->setQuery($query);
                                                                        $this->_db->query();

                                                                        if ($this->_db->getErrorNum())
                                                                        {
                                                                            $this->_app->enqueueMessage($this->_db->stderr(), 'error');
                                                                            return FALSE;
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                                                                    return false;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $this->_app->enqueueMessage(strtoupper($extension).' '.JText::_('Document type cannot be saved. please upload PDF, JPG, GIF, PNG document types only'),'error');
                                                                return false;
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                                                        return false;
                                                    }
                                                }
                                                else
                                                {
                                                    $this->_app->enqueueMessage(strtoupper($extension).' '.JText::_('Document type cannot be saved. please upload PDF, JPG, GIF, PNG document types only'),'error');
                                                    return false;
                                                }
                                            }
                                    }
                                    else
                                    {
                                        $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                                        return false;
                                    }
                                }
                                else
                                {
                                    $this->_app->enqueueMessage(strtoupper($extension).' '.JText::_('Document type cannot be saved. please upload PDF, JPG, GIF, PNG document types only'),'error');
                                    return false;
                                }
                        
                        return TRUE;
                    }
                }
                else
                {
                    $this->_app->enqueueMessage(JText::_('Document capacity must be less than 2MB'), 'error');
                    return false;
                }
            }
            else
            {
                $this->_app->enqueueMessage(strtoupper($extension).' '.JText::_('Document type cannot be saved. please upload PDF, JPG, GIF, PNG document types only'),'error');
                return false;
            }
            
        }
        else
            {
                $this->_app->enqueueMessage(JText::_('Please Upload all Required Files'),'error');
                return false;
            }
     
        return TRUE;
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
            
            $query = "Delete From ".TABLE_PREFIX."file Where id = $cid";
            
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