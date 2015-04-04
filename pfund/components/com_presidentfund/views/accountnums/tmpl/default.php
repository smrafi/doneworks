<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   10 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

echo PFundHelper::createList('bankaccount_id', 0, $this->account_nums);

?>

