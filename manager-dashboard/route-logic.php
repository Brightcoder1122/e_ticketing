<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php 

	if (isset($_POST['delete'])) {

	    $route_id = $_POST['route_id'];

	    $delete_route = $dbconnect->prepare("DELETE FROM tbl_route WHERE route_id=:route_id");
	    $delete_route->execute(['route_id'=>$route_id]);

	    //if user deleted successfully
	    if ($delete_route) {
	        $_SESSION['success'] = "User Deleted Successfully";
	        header('location:route.php');
	    } 
	    else {
	        $_SESSION['Error'] = "Fail please try agan";
	        header('location:route.php');
	    }
	}

		// activate user
	else if (isset($_POST['switch_on'])) {

	    $route_id = $_POST['route_id'];

	    $activate_route = $dbconnect->prepare("UPDATE tbl_route SET active = 1 WHERE route_id=:route_id");
    	$activate_route->execute(['route_id'=>$route_id]);

	    //if user activated successfully
	    if ($activate_route) {
	        $_SESSION['success'] = "User Activated Successfully";
	        header('location:route.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:route.php');
	    }
	}

	// deactivate route account
	else if (isset($_POST['switch_off'])) {

	    $route_id = $_POST['route_id'];

	    $deactivate_route = $dbconnect->prepare("UPDATE tbl_route SET active = 0 WHERE route_id=:route_id");
    	$deactivate_route->execute(['route_id'=>$route_id]);

	    //if route activated successfully
	    if ($deactivate_route) {
	        $_SESSION['success'] = "route Diactivated Successfully";
	        header('location:route.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:route.php');
	    }
	}


	else if(isset($_POST['save_route'])) {

		$origin = $_POST['origin'];
		$destination = $_POST['destination'];
		$price = $_POST['price'];

		$data = [
		  	'origin'=>strtolower(ucfirst($origin)), 
		  	'destination'=>strtolower(ucfirst($destination)), 
		  	'price'=>$price
		];

		if (strtolower($origin) == strtolower($destination)) {
			$_SESSION['error'] = "Origin can not be the same to destinantion";
			header("location:route.php");
		}
		else {
			try {
				$save_route_sql = "INSERT INTO tbl_route (origin, destination, price) VALUES(:origin, :destination, :price)";
				$save_route_stmt = $dbconnect->prepare($save_route_sql);
	      		$save_route_stmt->execute($data);

	      		if($save_route_stmt) {
	      			$_SESSION['success'] = "Route saved successfully";
					header("location:route.php");
	      		}

	      		else {
	      			$_SESSION['error'] = "Route not saved successfully";
					header("location:route.php");
	      		}
			}

			catch(Exception $e) {
				$_SESSION['error'] = "$e";
				header("location:route.php");
				echo $e;
			}
		}
	}

	else {
		header("location: ../logout.php");
	}
?>