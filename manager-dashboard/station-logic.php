<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php 

	if (isset($_POST['delete'])) {

	    $bus_id = $_POST['bus_id'];

	    $delete_bus = $dbconnect->prepare("DELETE FROM tbl_bus WHERE bus_id=:bus_id");
	    $delete_bus->execute(['bus_id'=>$bus_id]);

	    //if user deleted successfully
	    if ($delete_bus) {
	        $_SESSION['success'] = "User Deleted Successfully";
	        header('location:buses.php');
	    } 
	    else {
	        $_SESSION['Error'] = "Fail please try agan";
	        header('location:buses.php');
	    }
	}

	else if(isset($_POST['save_station'])) {

		$station_name = $_POST['station_name'];
		$route = $_POST['route'];

		$data = [
			'station_name'=>strtolower($station_name), 
			'route'=>$route
		];


		try {
			$save_station_sql = "INSERT INTO tbl_station (station_name, route) VALUES(:station_name, :route)";
			$save_station_stmt = $dbconnect->prepare($save_station_sql);
			$save_station_stmt->execute($data);

			if($save_station_stmt) {
				$_SESSION['success'] = "station saved successfully";
				header("location:route.php");
			}

			else {
				$_SESSION['error'] = "station not saved successfully";
				header("location:route.php");
			}
		}

		catch(Exception $e) {
			$_SESSION['error'] = "$e";
			header("location:route.php");
			echo $e;
		}
	}

	else {
		header("location: ../logout.php");
	}
?>

