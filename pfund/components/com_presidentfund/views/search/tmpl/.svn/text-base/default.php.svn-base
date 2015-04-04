<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');
$application_type = PFundHelper::getApplicationTypes('All');
$districts = PFundHelper::getAllDistrict('All');
$titles = GeneralHelper::getTitles('All');
$status_array = PFundHelper::getStatusArray('All');
$numrows = count($this->report_data);
$app_status = PFundHelper::getStatusArray();
$app_type = PFundHelper::getApplicationTypes();
$district = PFundHelper::getAllDistrict();
?>

<h1>Search</h1>
<div class="comp-button"> 
<button type="button" name="cancel_btn" class="cancel_btn">Back</button>
</div>
<div class="comp-content">
    <form action="index.php" method="post" name="adminForm" class="submit-form">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
        <input type="hidden" name="task" value="search_app" id="task" />
        <input type="hidden" name="controller" value="accountreport" />
        
        <table class="adminlist">
                <tr>
                    <td>
                        <?php echo JText::_('Application Type'); ?>
                    </td>
                    <td>
                        <?php echo PFundHelper::createList('app_type', 0 ,$application_type); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('District'); ?>
                    </td>
                    <td>
                        <?php echo PFundHelper::createList('patient_district', 0 ,$districts); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('DS Office'); ?>
                    </td>
                    <td>
                         <?php echo PFundHelper::createList('patient_dsoffice',0, $this->dsoffices); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Medical Condition Category'); ?>
                    </td>
                    <td>
                        <?php echo PFundHelper::createList('cat_id', 0, $this->cat_array, 0, 'catid-select'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Medical Condition'); ?>
                    </td>
                    <td id="disease_list">
                        <?php echo PFundHelper::createList('disease_id', 0, $this->disease_array); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Title').':'; ?>
                    </td>
                    <td>
                        <?php echo PFundHelper::createList('patient_title', -1, $titles, -1); ?>
                        <input name="othertitle_patient" id="othertitle_patient" value="" size="50" style="display: none;" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Age From'); ?>
                    </td>
                    <td>
                        <input type="text" id="age_from" name="age_from" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Age To'); ?>
                    </td>
                    <td>
                        <input type="text" id="age_to" name="age_to" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Application Status'); ?>
                    </td>
                    <td>
                        <?php echo PFundHelper::createList('status', 0, $status_array); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Period From'); ?>
                    </td>
                    <td>
                        <?php echo JHtml::calendar('', 'period_from', 'period_from',$format = '%Y-%m-%d'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo JText::_('Period To'); ?>
                    </td>
                    <td>
                        <?php echo JHtml::calendar('', 'period_to', 'period_to',$format = '%Y-%m-%d'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="search_btn" id="search_btn" onclick="routeback('accountreport','search_app')">Search</button>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" class="bulkchk">
                       <input type="checkbox" id="app_id" name="app_id" value="" /> <?php echo JText::_('Application No'); ?>
                       <input type="checkbox" id="name" name="name" /> <?php echo JText::_('Name'); ?>
                       <input type="checkbox" id="medi_con" name="medi_con" /> <?php echo JText::_('Medical Condition'); ?>
                       <input type="checkbox" id="medi_cat" name="medi_cat" /> <?php echo JText::_('Medical Category'); ?>
                       <input type="checkbox" id="app_type" name="app_type" /> <?php echo JText::_('Application Type'); ?>
                       <input type="checkbox" id="app_status" name="app_status" /> <?php echo JText::_('Application Status'); ?>
                       <input type="checkbox" id="age" name="age" /> <?php echo JText::_('Age'); ?>
                       <input type="checkbox" id="grnt_amount" name="grnt_amount" /> <?php echo JText::_('Grant Amount'); ?>
                       <input type="checkbox" id="req_amount" name="req_amount" /> <?php echo JText::_('Requested Amount'); ?>
                       <input type="checkbox" id="city" name="city" /> <?php echo JText::_('City'); ?>
                       <input type="checkbox" id="district" name="district" /> <?php echo JText::_('District'); ?>
                       <input type="checkbox" id="date" name="date" /> <?php echo JText::_('Date'); ?>
                       <input type="checkbox" id="option" name="option" /> <?php echo JText::_('Option'); ?>
                    </td>
                    <td>
                </td>
                </tr>
        </table>
        <table class="adminlist">
            <thead>
                    <th width="5%" class="magic-num" style="display:none">
                        <?php echo JText::_('#'); ?>
                    </th>
                    <th class="date_cols magic-cols" style="display:none">
                        <?php echo JText::_('Date'); ?>
                    </th>
                    <th class="app_id_cols magic-cols" style="display:none">
                        <?php echo JText::_('Application No'); ?>
                    </th>
                    <th class="app_type_cols magic-cols" style="display:none">
                        <?php echo JText::_('Application Type'); ?>
                    </th>
                    <th class="app_status_cols magic-cols" style="display:none">
                        <?php echo JText::_('Status'); ?>
                    </th>
                    <th class="name_cols magic-cols" style="display:none">
                        <?php echo JText::_('Name'); ?>
                    </th>
                    <th class="age_cols magic-cols" style="display:none">
                        <?php echo JText::_('Age'); ?>
                    </th>
                    <th class="city_cols magic-cols" style="display:none">
                        <?php echo JText::_('City'); ?>
                    </th>
                    <th class="district_cols magic-cols" style="display:none">
                        <?php echo JText::_('District'); ?>
                    </th>
                    <th class="medi_cat_cols magic-cols" style="display:none">
                        <?php echo JText::_('Medical Category'); ?>
                    </th>
                    <th class="medi_con_cols magic-cols" style="display:none">
                        <?php echo JText::_('Medical Condition'); ?>
                    </th>
                    <th class="req_amount_cols magic-cols" style="display:none">
                        <?php echo JText::_('Requested Amount'); ?>
                    </th >
                    <th class="grnt_amount_cols magic-cols" style="display:none">
                        <?php echo JText::_('Grant Amount'); ?>
                    </th>
                    <th class="option_cols magic-cols" style="display:none">
                        <?php echo JText::_('Option'); ?>
                    </th>
                    
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
                $row = $this->report_data[$x];
                $link = JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$row->id.'&pnum='.$row->patient_num);
                
                ?>
            <tr class="<?php echo 'row'.$k; ?>">
                <td align="center" class="magic-num" style="display:none">
                    <?php echo $this->pagination->getRowOffset($x); ?>
                </td>
                <td class="date_cols magic-cols" style="display:none">
                    <?php echo $row->updated_time; ?>
                </td>
                <td class="app_id_cols magic-cols" style="display:none">
                    <?php echo $row->id; ?>
                </td>
                <td class="app_type_cols magic-cols" style="display:none">
                    <?php echo $app_type[$row->application_type]; ?>
                </td>
                <td class="app_status_cols magic-cols" style="display:none">
                    <?php echo $app_status[$row->status]; ?>
                </td>
                <td class="name_cols magic-cols" style="display:none">
                    <?php echo $row->patient_fullname; ?>
                </td>
                <td class="age_cols magic-cols" style="display:none">
                    <?php echo $row->age; ?>
                </td>
                <td class="city_cols magic-cols" style="display:none">
                    <?php echo $row->patient_city; ?>
                </td>
                <td class="district_cols magic-cols" style="display:none">
                    <?php echo $district[$row->patient_district]; ?>
                </td>
                <td class="medi_cat_cols magic-cols" style="display:none">
                    <?php echo $row->category_name; ?>
                </td>
                <td class="medi_con_cols magic-cols" style="display:none">
                    <?php echo $row->disease_name; ?>
                </td>
                <td class="req_amount_cols magic-cols" style="display:none">
                    <?php echo $row->expect_amount; ?>
                </td>
                <td class="grnt_amount_cols magic-cols" style="display:none">
                    <?php echo $row->grant_amount; ?>
                </td>
                <td class="option_cols magic-cols" style="display:none">
                    <?php echo JHtml::link($link, 'View','target=_blank'); ?>
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