<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Dry Cleans Word Press
 *  Date            : 06 May 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/

$plugin_path = dirname(__FILE__);
require_once $plugin_path.'/dryclean-helper.php';


class dryCleansAddCategory
{
    function dcmdAddCats()
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'bdcats';

        $cid = absint($_GET['cid']);

        if($cid == '' or $cid == 0)
        {
            $cat_id = 0;
        }

        elseif(!$_POST['submit'])
        {
            $query = "Select * From $table_name Where id = ".$cid;
            $category = $wpdb->get_row($query);

            if($category != '')
            {
                $cat_id = $category->id;
                $cat_name = $category->cat_name;
                $selcted_option = $category->cat_option;
            }
            else
            {
                $cat_id = 0;
                $selcted_option = 0;
            }
        }

        $option_list = array(MD_SERVICE_DIR_NUM => MD_SERVICE_DIR_NAME, MD_BUSINESS_DIR_NUM => MD_BUSINESS_DIR_NAME);

        if($_POST['submit'])
        {
            //validate and get the post var
            $cat_name = preg_replace('/[^a-z ]/i', "", $_POST['cat_name']);
            $cat_id = absint($_POST['cat_id']);
            $cat_option = absint($_POST['cat_option']);
            $selcted_option = $cat_option;

            if($cat_name != '' and $cat_id == 0)      //inserting
            {
                $rows = $wpdb->insert($table_name, array('cat_name' => $cat_name, 'cat_option' => $cat_option));
                $cat_id = $wpdb->insert_id;
                echo '<div class="updated"><p><strong> Category '.$cat_name.' Added </strong></p></div> ';
            }
            elseif($cat_name != '' and $cat_id != 0)  //update
            {
                $wpdb->update($table_name, array('cat_name' => $cat_name, 'cat_option' => $cat_option), array('id' => $cat_id), array('%s', '%d'), array('%d'));
                echo '<div class="updated"><p><strong> Category '.$cat_name.' Updated </strong></p></div> ';
            }
        }

        $catoption_list = mdHelper::createList('cat_option', $option_list, $selcted_option);

        ?>

<div class="wrap">
    <h2>
        <?php
            if($cat_id == 0)
                _e('Add New Category');
            else
                _e('Edit Category');
        ?>
    </h2>
    <form name="dcmd_catform" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <div id="cat-form">
            <span>
                <?php _e('Category Name:'); ?>
            </span>&nbsp;&nbsp;&nbsp;
            <input type="text" name="cat_name" id="county_name" size="40" maxlength="100" value="<?php echo $cat_name; ?>" />
            &nbsp;&nbsp;&nbsp;
            <?php echo $catoption_list; ?>
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="<?php if($cat_id == 0) _e('Add Category'); else _e('Update Category'); ?>" />
            <?php
            if($cat_id != 0)
            {
                ?>
            &nbsp;&nbsp;&nbsp;
            <a class="button" style="padding: 4px 10px;" href="" >Add New Category</a>
            <?php
            }
            ?>
            &nbsp;&nbsp;&nbsp;
            <a class="button" style="padding: 4px 10px;" href="admin.php?page=drycleans-manage-cats" >Cancel</a>
        </div>
        <input type="hidden" name="cat_id" value="<?php _e($cat_id); ?>" />
    </form>
</div>

<?php

    }


    function dcmdManageCats()
    {
        global $wpdb;

        $table_name = $wpdb->prefix.'bdcats';

        //get list of counties available
        //build the query

        $query = "Select * From $table_name Order By cat_name";

        $cat_list = $wpdb->get_results($query);

        ?>

<div class="wrap">
    <h2>
        <?php _e('Manage Categories'); ?>
    </h2>
    <br>
    <div id="county-button">
        <a class="button" style="padding: 4px 10px;" href="admin.php?page=drycleans-add-cats" >Add New Category</a>
    </div>
    <br>
    <div id="county-link">
        <table>
            <thead>
                <tr>
                    <th>
                        <?php _e('Category ID'); ?>
                    </th>
                    <th>
                        <?php _e('Category Name'); ?>
                    </th>
                    <th>
                        <?php _e('Category Option'); ?>
                    </th>
                </tr>
            </thead>
            <?php

            foreach($cat_list as $cat)
            {
                $link = 'admin.php?page=drycleans-add-cats&cid='.$cat->id;
                ?>

            <tr>
                <td>
                    <a href="<?php echo $link; ?>" >
                        <?php _e($cat->id); ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo $link; ?>" >
                        <?php _e($cat->cat_name); ?>
                    </a>
                </td>
                <td>
                    <?php
                    if($cat->cat_option == MD_SERVICE_DIR_NUM)
                        _e(MD_SERVICE_DIR_NAME);
                    if($cat->cat_option == MD_BUSINESS_DIR_NUM)
                        _e(MD_BUSINESS_DIR_NAME);
                    ?>
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
