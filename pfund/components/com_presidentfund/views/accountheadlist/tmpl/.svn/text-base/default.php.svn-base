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
$numrows = count($this->application_list);

$application_type = PFundHelper::getApplicationTypes();
?>

<h1>Applications to Review Account Head</h1>
<div class="comp-button">
   <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('application', 'linkback');">Back</button>
</div>
<div class="comp-content">
    
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="asstsec" />
        
        
        <table class="adminlist">
            <thead>
                <th width="7%">#</th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Number'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Name'); ?></th>
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
                    $row = $this->application_list[$x];
                    $link = JRoute::_(COMPONENT_LINK.'&controller=account&task=viewapp&cid='.$row->id);
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($x); ?>
                    </td>
                    <td>
                        <?php echo $row->patient_num; ?>
                    </td>
                    <td>
                        <?php echo $row->patient_fullname; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><button type="button" name="jstbtn" id="jstbtn">View</button></a>
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