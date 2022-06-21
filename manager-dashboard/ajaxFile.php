<?php
//Include database configuration file
include('../includes/config.php');

if(isset($_POST["route_id"])){
    //Get all route data
	$route_id= $_POST['route_id'];
    $query = "SELECT * FROM tbl_station WHERE route = '$route_id'";
	$run_query = mysqli_query($conn, $query);
    
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display states list
    if($count > 0){
        echo '<option value="">Select Station</option>';
        while($row = mysqli_fetch_array($run_query)){
    		$station_id=$row['station_id'];
    		$station_name=$row['station_name'];
            echo "<option value='$station_name'>$station_name</option>";
        }
    }
    else{
        echo '<option value="">Station not available</option>';
    }
}


?>