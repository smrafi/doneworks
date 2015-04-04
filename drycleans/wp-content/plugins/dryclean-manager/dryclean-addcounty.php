<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Dry Cleans Word Press
 *  Date            : 06 May 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/


class dryCleansAddCounty
{

    /**
     * This function will generate the html for add county
     * @global object $wpdb
     */

    function dcmdAddCounty()
    {

        global $wpdb;
        $table_name = $wpdb->prefix.'bdcounty';

        $cid = absint($_GET['cid']);

        if($cid == '' or $cid == 0)
        {
            $county_id = 0;
        }
        elseif(!$_POST['submit'])
        {
            $query = "Select * From $table_name Where id = ".$cid;
            $county = $wpdb->get_row($query);

            if($county != '')
            {
                $county_id = $county->id;
                $county_name = $county->county_name;
            }
            else
                $county_id = 0;
        }

        if($_POST['submit'])
        {
            //validate and get the post var
            $county_name = preg_replace('/[^a-z ]/i', "", $_POST['county_name']);
            $county_id = absint($_POST['county_id']);
            
            if($county_name != '' and $county_id == 0)      //inserting
            {
                $rows = $wpdb->insert($table_name, array('county_name' => $county_name));
                $county_id = $wpdb->insert_id;
                echo '<div class="updated"><p><strong> County '.$county_name.' Added </strong></p></div> ';
            }
            elseif($county_name != '' and $county_id != 0)  //update
            {
                $wpdb->update($table_name, array('county_name' => $county_name), array('id' => $county_id), array('%s'), array('%d'));
                echo '<div class="updated"><p><strong> County '.$county_name.' Updated </strong></p></div> ';
            }
        }

        
        ?>

<div class="wrap">
    <h2>
        <?php 
            if($county_id == 0)
                _e('Add New County');
            else
                _e('Edit County');
        ?>
    </h2>
    <form name="dcmd_countyform" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <div id="county-form">
            <span>
                <?php _e('County Name:'); ?>
            </span>&nbsp;&nbsp;&nbsp;
            <input type="text" name="county_name" id="county_name" size="40" maxlength="100" value="<?php echo $county_name; ?>" />
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="<?php if($county_id == 0) _e('Add County'); else _e('Update County'); ?>" />
            <?php
            if($county_id != 0)
            {
                ?>
            &nbsp;&nbsp;&nbsp;
            <a class="button" style="padding: 4px 10px;" href="" >Add New County</a>
            <?php
            }
            ?>
            &nbsp;&nbsp;&nbsp;
            <a class="button" style="padding: 4px 10px;" href="admin.php?page=drycleans-manage-county" >Cancel</a>
        </div>
        <input type="hidden" name="county_id" value="<?php _e($county_id); ?>" />
    </form>
</div>

<?php



    }
    
    function dcmdManageCounty()
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'bdcounty';

        //get list of counties available
        //build the query

        $query = "Select * From $table_name Order By county_name";

        $county_list = $wpdb->get_results($query);

        ?>

<div class="wrap">
    <h2>
        <?php _e('Manage Counties'); ?>
    </h2>
    <br>
    <div id="county-button">
        <a class="button" style="padding: 4px 10px;" href="admin.php?page=drycleans-add-county" >Add New County</a>
    </div>
    <br>
    <div id="county-link">
        <table>
            <thead>
                <tr>
                    <th>
                        <?php _e('County ID'); ?>
                    </th>
                    <th>
                        <?php _e('County Name'); ?>
                    </th>
                </tr>
            </thead>
            <?php

            foreach($county_list as $county)
            {
                $link = 'admin.php?page=drycleans-add-county&cid='.$county->id;
                ?>

            <tr>
                <td>
                    <a href="<?php echo $link; ?>" >
                        <?php _e($county->id); ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo $link; ?>" >
                        <?php _e($county->county_name); ?>
                    </a>
                </td>
            </tr>

            <?php
            }

            ?>
        </table>
    </div>
</div>

<?php
    }


}


?>
