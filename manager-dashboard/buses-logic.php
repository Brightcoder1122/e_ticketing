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

	else if(isset($_POST['save_bus'])) {

		$plate_no = $_POST['plate_no'];
		$capacity = $_POST['capacity'];
		$route = $_POST['route'];

		if(!preg_match("/^T+[ 0-9]+[ A-Z]/", $plate_no)) {
			$_SESSION['error'] = "Invalid plate number allowed format T 232 ABC";
			header("location:buses.php");
		}

		else {

			$data = [
				'plate_no'=>strtoupper(ucfirst($plate_no)), 
				'capacity'=>($capacity), 
				'route'=>$route
			];


			try {
				$save_bus_sql = "INSERT INTO tbl_bus (plate_no, capacity, route) VALUES(:plate_no, :capacity, :route)";
				$save_bus_stmt = $dbconnect->prepare($save_bus_sql);
				$save_bus_stmt->execute($data);

				if($save_bus_stmt) {
					$_SESSION['success'] = "Bus saved successfully";
					header("location:buses.php");
				}

				else {
					$_SESSION['error'] = "Bus not saved successfully";
					header("location:buses.php");
				}
			}

			catch(Exception $e) {
				$_SESSION['error'] = "$e";
				header("location:buses.php");
				echo $e;
			}
		}
	}

	else {
		header("location: ../logout.php");
	}
?>

