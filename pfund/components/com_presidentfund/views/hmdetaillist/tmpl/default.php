<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   14 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$numrows = count($this->list_data);
$application_type = PFundHelper::getApplicationTypes();
?>

<h1>Generate Letter to Health Ministry</h1>
<div class="comp-button">
    <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('special', 'hmlistback');">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="special" />
        <input type="hidden" name="boxchecked" value="0" />
        
        
        <table class="adminlist">
            <thead>
                <th width="7%">#</th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Number'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Patient Name'); ?></th>
                <th class="title" nowrap="nowrap"><?php echo JText::_('Documents'); ?></th>
            </thead>
            <tbody>
                <?php
                $k = 0;
                $count = 1;
                
                for($x = 0; $x < $numrows; $x++)
                {
                    $app_data = $this->list_data[$x]->app_data;
                    $file_data = $this->list_data[$x]->file_data;
                    
                    ?>
                <tr class="<?php echo 'row'.$k; ?>">
                    <td align="center">
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $app_data->patient_num; ?>
                    </td>
                    <td>
                        <?php echo $app_data->patient_fullname; ?>
                    </td>
                    <td>
                        <?php
//                        print_r($file_data);echo'<br>';
                        foreach($file_data as $file)
                        {
//                            print_r($file);echo'<br>';
                            $file_link = JURI::root().'components/com_presidentfund/files/documents/'.$file->document_name;
                            ?>
                        <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}" href=<?php echo $file_link;  ?> ><?php echo $file->file_purpose; ?></a>
                        <br/><br/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
                $count++;
                }
                
                ?>
            </tbody>
        </table>
        
    </form>
</div>