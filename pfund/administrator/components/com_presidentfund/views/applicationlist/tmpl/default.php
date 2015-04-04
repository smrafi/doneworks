<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   26 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->application_list);
$pnum = JRequest::getInt('pnum');
$status_array = PFundHelper::getStatusArray();
$search_by = array(0 => 'Select', SEARCH_BY_NIC => 'National Identy Card', SEARCH_BY_PATIENT_NUM => 'Patient Number');
$search_num = JRequest::getInt('search_by');
$search_word = JRequest::getVar('search_word');

$nic_num = JRequest::getVar('nic_num');
$patient_num = '';

if($nic_num and !empty($this->application_list))
    $patient_num = $this->application_list[0]->patient_num;
?>
    
    <form action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="application" />
        <input type="hidden" name="boxchecked" value="0" />
        
        <table class="adminlist">
            <thead>
                <th width="5%">#</th>
                <th width="5%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Date'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Number'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Name'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Application Status'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Action'); ?></th>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>
            <tbody>
             <div class="search-input">
            <span>Search by: </span>
            <?php echo PFundHelper::createList('search_by', $search_num, $search_by); ?>
            <input type="text" name="search_word" id="search_word" value="<?php echo $search_word; ?>" />
            <button type="submit" name="search_btn" id="serach_btn">Search</button>
             </div>
                
                <?php
                $k = 0;
                
                for($x = 0; $x < $numrows; $x++)
                {
                    $row = $this->application_list[$x];
                    $link = JRoute::_(COMPONENT_LINK.'&controller=application&task=edit&cid[]='.$row->id);
                    $manage_link = JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$row->id);
                    $patient_link = JRoute::_(COMPONENT_LINK.'&controller=application&pnum='.$row->patient_num);
                    $checked = JHtml::_('grid.id', $x, $row->id);
                    
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td align="center">
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y', strtotime($row->added_time)); ?>
                    </td>
                    <td>
                        <?php echo JHtml::link($patient_link, $row->patient_num); ?>
                    </td>
                    <td>
                        <?php echo JHtml::link($link, $row->patient_fullname); ?>
                    </td>
                    <td>
                        <?php echo $status_array[$row->status]; ?>
                    </td>
                    <td>
                        <?php echo JHtml::link($manage_link, 'Manage Application'); ?>
                    </td>
                </tr>
                <?php
                }
                
                ?>
            </tbody>
        </table>
        
    </form>
