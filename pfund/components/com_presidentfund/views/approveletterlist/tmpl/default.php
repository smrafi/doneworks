<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   15 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );
$numrows = count($this->letter_list);

$office_array = PFundHelper::getOfficeType('Select');
?>

<h1>Applications to Review SAS</h1>
<div class="comp-button">
   <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('<?php echo $this->link_data->controller; ?>', 'backop');">Back</button>
</div>
<div class="comp-content">
    
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="letterreview" />
        <input type="hidden" name="controller" value="<?php echo $this->link_data->controller; ?>" />
        
        
        <table class="adminlist">
            <thead>
                <th width="7%">#</th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Letter to'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Letter Template'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Action'); ?></th>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $k = 0;
                
                for($x = 0; $x < $numrows; $x++)
                {
                    $row = $this->letter_list[$x];
                    $link = JRoute::_(COMPONENT_LINK.'&controller=letter&task=letterapprove&cid='.$row->id.'&rtcontroller='.$this->link_data->controller);
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td>
                        <?php echo $office_array[$row->office_type]; ?>
                    </td>
                    <td>
                        <?php echo $row->template_name; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link;  ?>">
                            <button type="button" name="view_btn" class="printlink_btn">View</button>
                        </a>
                    </td>
                </tr>
                <?php
                    
                    $k = 1 - $k;
                }
                ?>
            </tbody>
        </table>
        
    </form>
</div>