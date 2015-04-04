<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
$editor = & JFactory::getEditor();
$lang_type=PFundHelper::getLanguageArray('Select a language');


?>

<form  action="index.php" method="post" name="adminForm">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="template" />
    <input type="hidden" name="id" value="<?php echo $this->template_data->id; ?>" />
     
    <table>
        
        <tr>
            <td width="15%">Publish</td>
            <td>
                <?php echo PFundHelper::createCheckBox('published', $this->template_data->published, 1); ?>
            </td>
        </tr> 
        <tr>
            <td>Language</td>
            <td>
                <?php echo PFundHelper::createList('language_id',(int)$this->template_data->language_id, $lang_type); ?>
            </td>
        </tr>
        <tr>
            <td>Template Name</td>
            <td><input type="text" name="template_name" id="template_name" value="<?php echo $this->template_data->template_name; ?>" size="50"/></td>
        </tr>
        <tr>
            <td valign="top">Content</td>
            <td>
                <?php echo $editor->display('template_content', $this->template_data->template_content, 550, 400, 70, 10) ?>
            </td>
            <td valign="top">
                <table>
				<tr>
                                    <td valign="top">
					<fieldset class="adminform">
					<legend><?php echo JText::_('Template Variables');?></legend>
                                        <?php
                                        
                                        echo PF_TITLE.' = '.JText::_('Title')."<br />";
                                        echo PF_FULLNAME.' = '.JText::_('Name')."<br />";
                                        echo PF_APPLICATION_NUMBER.' = '.JText::_('Application Number')."<br />";
                                        echo PF_ADDRESS.' = '.JText::_('Address')."<br />";
                                        echo PF_NIC_NUMBER.' = '.JText::_('NIC Number')."<br />";
                                        echo PF_DS_OFFICE.' = '.JText::_('DS Office')."<br />";
                                        
                                        ?>
                                        
                                        </fieldset>
                                    </td>
                                </tr>
                </table>
            </td>
        </tr>
        
       
    </table>
    
</form>