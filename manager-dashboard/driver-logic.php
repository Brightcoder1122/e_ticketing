<?php require_once('../includes/config.php') ?>

<?php require_once('../includes/mustlogin.php') ?>

<?php include('new-driver-notification.php') ?>


<?php

	// activate driver
	if(isset($_POST['restore_driver'])){
		$user_id = $_POST['user_id'];

		$restore_driver = $dbconnect->prepare("UPDATE tbl_user SET is_deleted = 0 WHERE id=:user_id");
		$restore_driver->execute(['user_id'=>$user_id]);
		header('location:driver.php');
	}





	if (isset($_POST['delete'])) {

		$user_id = $_POST['user_id'];
		$bus_id = $_POST['bus'];

		//user soft delete
		$delete_user = $dbconnect->prepare("UPDATE tbl_user SET is_deleted = 1 WHERE id=:user_id");
		$delete_user->execute(['user_id'=>$user_id]);

		//if user deleted
		if(!$delete_user) {
			$_SESSION['error'] = "Fail to delete user";
			header('location:driver.php');
		}

		else {
			//set bus free
			$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken = 0 WHERE bus_id=:bus_id");
			$update_bus->execute(['bus_id'=>$bus_id]);

			if(!$update_bus) {
				$_SESSION['error'] = "Fail to update bus";
				header('location:driver.php');
			}

			else {
				$set_null = $dbconnect->prepare("UPDATE tbl_driver SET bus = 6 WHERE user=:user_id");
				$set_null->execute(['user_id'=>$user_id]);

				//if user deleted successfully
				if  ($set_null) {
					$_SESSION['success'] = "Driver Deleted Successfully";
					header('location:driver.php');
				} 
			}
		}
	}

	else if (isset($_POST['allocate_driver'])) {

		$driver_id = $_POST['driver_id'];
		$bus_id = $_POST['bus_id'];

		//user soft delete
		$driver_allocation = $dbconnect->prepare("UPDATE tbl_driver SET bus = :bus_id WHERE driver_id=:driver_id");
		$driver_allocation->execute(['driver_id'=>$driver_id, 'bus_id'=>$bus_id]);

		//if user deleted
		if(!$driver_allocation) {
			$_SESSION['error'] = "Fail to delete user";
			header('location:driver.php');
		}

		else {
			//set bus free
			$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken = 1 WHERE bus_id=:bus_id");
			$update_bus->execute(['bus_id'=>$bus_id]);

			if(!$update_bus) {
				$_SESSION['error'] = "Fail to update bus";
				header('location:driver.php');
			}

			else {
				$_SESSION['success'] = "Driver allocated success";
				header('location:driver.php');
			}
		}
	}




	// activate user
	else if (isset($_POST['switch_on'])) {

	    $user_id = $_POST['user_id'];

	    $activate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 1 WHERE id=:user_id");
    	$activate_user->execute(['user_id'=>$user_id]);

	    //if user activated successfully
	    if ($activate_user) {
	        $_SESSION['success'] = "Driver Activated Successfully";
	        header('location:driver.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:driver.php');
	    }
	}

	// deactivate user account
	else if (isset($_POST['switch_off'])) {

	    $user_id = $_POST['user_id'];
	    $bus_id = $_POST['bus'];

	    $deactivate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 0 WHERE id=:user_id");
    	$deactivate_user->execute(['user_id'=>$user_id]);

    	//set bus free
    	$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken = 0 WHERE bus_id=:bus_id");
    	$update_bus->execute(['bus_id'=>$bus_id]);

    	//remove car from driver
    	$update_driver = $dbconnect->prepare("UPDATE tbl_driver SET bus = NULL WHERE user=:user_id");
    	$update_driver->execute(['user_id'=>$user_id]);


	    //if user activated successfully
	    if ($deactivate_user && $update_bus && $update_driver) {
	        $_SESSION['success'] = "Driver Diactivated Successfully";
	        header('location:driver.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:driver.php');
	    }
	}

	else if(isset($_POST['register'])) {

		$first_name = clean_input($_POST['first_name']);
		$last_name = clean_input($_POST['last_name']);
		$phone = clean_input($_POST['phone']);
		$sex = clean_input($_POST['sex']);
		$type = "driver";
		$region = clean_input($_POST['region']);
		$district = clean_input($_POST['district']);
		$address = $_POST['address'];
		$licence_no = $_POST['licence_no'];
		$bus = $_POST['bus'];
		$username = clean_input($_POST['username']);

		// format name 
		$first_name = strtolower($first_name);
		$last_name = strtolower($last_name);
		$password = $last_name;

		
		//validate phone number
		if(!preg_match("/^255+[67]+[12345678]+[1-9]/", $phone)) {//query bus and its route
			$_SESSION['error'] = "Required format is 255762506012 must start with 255 the 7 0r six";
			header("location:driver.php");
		}

		else {

			$find_bus_stmt = $dbconnect->prepare("SELECT tbl_bus.plate_no, tbl_route.origin, tbl_route.destination FROM tbl_route, tbl_bus
			WHERE tbl_bus.route = tbl_route.route_id AND tbl_bus.bus_id = :bus_id");
			$find_bus_stmt->execute(["bus_id"=>$bus]);
			$bus_detail =  $find_bus_stmt->fetch();

			// message paramiters
			$plate_no = $bus_detail['plate_no'];
			$route = "$bus_detail[origin] - $bus_detail[destination]";
			$first_name = ucfirst($first_name);
			$last_name = ucfirst($last_name);
			$fullname = "$first_name $last_name ";
			$body = "Dear $fullname your Registration successfully saved \n your route is $route \n username: $username, \n password: $password \n url: https://luggiestar.kvm.co.tz";

			$password = password_hash($password, PASSWORD_DEFAULT);

			//array that hold user data
			$user_data = [
				'fname'=>$first_name, 
				'lname'=>$last_name, 
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
				$stmt->execute($user_data);
				$driver_id = $dbconnect->lastInsertId();

				if($stmt) {

					//array that hold driver data
					$driver_data = [
						'licence_no'=>$licence_no,
						'bus'=>$bus,
						'user'=>$driver_id 
					];

					//save driver detail
					$save_driver_sql = "INSERT INTO tbl_driver(licence_no, bus, user) VALUES(:licence_no, :bus, :user)";
					$save_driver_stmt = $dbconnect->prepare($save_driver_sql);
					$save_driver_stmt->execute($driver_data);

					if($save_driver_stmt) {

						//set bus as taken
						$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken=1 WHERE bus_id = :bus_id");
						$update_bus->execute(['bus_id'=>$bus]);

						//notify driver
						newDriverNotification($phone, $body);

						//redirct user to drivers pages
						$_SESSION['success'] = "Account for $first_name $last_name created successfully";
						
						// $_SESSION['success'] = $body;
						header("location:driver.php");
					}

					else {
						//redirct user to drivers pages
						$error ="Driver not saved";
						$_SESSION['error'] = $error;
						header("location:driver.php");
					}
				}

				else {
					//redirct user to drivers pages
					$error ="User not saved successfully";
					$_SESSION['error'] = $error;
					header("location:driver.php");
				}
			}

			catch(Exception $e) {
				//redirct user to drivers pages
				$warning = "System Error please contact System admin";
				$_SESSION['warning'] = $warning; 
				header("location:driver.php");
				echo 'phone and username';
			}
		}
	}

?>