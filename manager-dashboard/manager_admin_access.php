<?php 
	if($user_profile['type']!= "manager" && $user_profile['type']!= "admin" ) {
	 	echo "<script> window.location= '../logout.php' </script>";
	} 

	else if($user_profile['is_active'] == 0) {
	 	echo "<script> window.location= '../logout.php' </script>";
	} 

?>