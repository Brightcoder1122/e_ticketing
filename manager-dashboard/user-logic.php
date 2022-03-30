<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php require_once('access.php') ?>
<?php

	if (isset($_POST['delete'])) {

    $user_id = $_POST['user_id'];

    $delete_user = $dbconnect->prepare("DELETE FROM tbl_user WHERE id=:user_id");
    $delete_user->execute(['user_id'=>$user_id]);

    //if user deleted successfully
    if ($delete_user) {
        $_SESSION['success'] = "User Deleted Successfully";
        header('location:user.php');
    } 
    else {
        $_SESSION['Error'] = "Fail please try agan";
        header('location:user.php');
    }
	}



	// activate user
	else if (isset($_POST['switch_on'])) {

	    $user_id = $_POST['user_id'];

	    $activate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 1 WHERE id=:user_id");
    	$activate_user->execute(['user_id'=>$user_id]);

	    //if user activated successfully
	    if ($activate_user) {
	        $_SESSION['success'] = "User Activated Successfully";
	        header('location:user.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:user.php');
	    }
	}

	// deactivate user account
	else if (isset($_POST['switch_off'])) {

	    $user_id = $_POST['user_id'];

	    $deactivate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 0 WHERE id=:user_id");
    	$deactivate_user->execute(['user_id'=>$user_id]);

	    //if user activated successfully
	    if ($deactivate_user) {
	        $_SESSION['success'] = "User Diactivated Successfully";
	        header('location:user.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:user.php');
	    }
	}


	//user registration
	else if(isset($_POST['register']) && $user_profile['type']=="admin") {

		$first_name = clean_input($_POST['first_name']);
		$last_name = clean_input($_POST['last_name']);
		$phone = clean_input($_POST['phone']);
		$sex = clean_input($_POST['sex']);
		$type = "manager";
		$region = clean_input($_POST['region']);
		$district = clean_input($_POST['district']);
		$address = $_POST['address'];
		$username = clean_input($_POST['username']);
	
		$password = password_hash($last_name, PASSWORD_DEFAULT);

		$data = [
		  	'fname'=>strtolower(ucfirst($first_name)), 
		  	'lname'=>strtolower(ucfirst($last_name)), 
		  	'phone'=>$phone, 
		  	'sex'=>$sex, 
		  	'region'=>strtolower(ucfirst($region)), 
		  	'district'=>strtolower(ucfirst($district)), 
		  	'address'=>$address,
		  	'type'=>$type, 
		  	'username'=>$username, 
		  	'password'=>$password
		];
    try {
      $sql = "INSERT INTO tbl_user (fname, lname, phone, sex, region, district, address, type, username, password) 
              VALUES (:fname, :lname, :phone, :sex, :region, :district, :address, :type, :username, :password)";
      $stmt = $dbconnect->prepare($sql);
      $stmt->execute($data);
     	if($stmt) {
				$_SESSION['success'] = "Account for $first_name $last_name created successfully";
				header("location:user.php");
			}

			else {
				$error ="Something Went wrong try again";
				$_SESSION['error'] = $error;
				header("location:user.php");
			}
    }

   	catch(Exception $e) {

     	$_SESSION['danger'] = "Invalid data phone number or username is already registred";
     	header("location:user.php");
     	echo 'phone and username';
   	}
	}
	else {
		//if user has no access to this file
   	$_SESSION['error'] = "You don't have access to add new user"; 
   	header("location:user.php");
   	echo 'phone and username';	
	}

?>