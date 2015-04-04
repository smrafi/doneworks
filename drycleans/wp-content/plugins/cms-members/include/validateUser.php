<?php 
include('../../../../wp-blog-header.php');
update_option('good','good222');

$validateValue=esc_attr(strip_tags(stripslashes(trim($_POST['validateValue']))));
$validateId=$_POST['validateId'];
$validateError=$_POST['validateError'];

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	$arrayToJs[1] = $validateError;


		if (username_exists($validateValue)) {
			echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';	
		}elseif (!validate_username($validateValue)) {
			echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';

		}else{	// RETURN ARRAY WITH ERROR
			$arrayToJs[2] = "true";			// RETURN TRUE
			echo '{"jsonValidateReturn":'.json_encode($arrayToJs).'}';			// RETURN ARRAY WITH success
		}
		?>
	<?php

/* RECEIVE VALUE */

?>

	
		
	