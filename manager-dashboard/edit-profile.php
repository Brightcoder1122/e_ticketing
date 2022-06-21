<?php 
    session_start();
    $title = "User-dashboard";
    include('includes/sidebar.php'); 

    if(isset($_POST['save_changes'])) {

        $first_name = clean_input($_POST['first_name']);
        $last_name = clean_input($_POST['last_name']);
        $sex = clean_input($_POST['sex']);
        $region = clean_input($_POST['region']);
        $district = clean_input($_POST['district']);
        $address = $_POST['address'];

        $data = [
            'fname'=>$first_name, 
            'lname'=>$last_name, 
            'sex'=>$sex, 
            'region'=>$region, 
            'district'=>$district, 
            'address'=>$address,
        ];


        try {
            $sql = "UPDATE tbl_user SET fname = :fname, lname = :lname, sex = :sex, 
            region = :region, district = :district, address = :address";
            $stmt = $dbconnect->prepare($sql);
            $stmt->execute($data);
            $user_id = $dbconnect->lastInsertId();

            if($stmt) {
                $_SESSION['success'] = "Profile Updated successfully";
                // header("location: profile.php");
                echo "<script> window.location= 'profile.php' </script>";
            }

            else {
                $error ="Fail to update";
                $_SESSION['error'] = $error;
                echo "<script> window.location= 'edit-profile..php' </script>";
            }
        }
        catch(Exception $e) {
            $_SESSION['warning'] = "$e"; 
            echo "<script> window.location= 'edit-profile..php' </script>";
            echo 'phone and username';
        }
    }
?>

<div class="main_container"> 
    <?php include('includes/messages.php') ?>
    
    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8 col-xs-12 wow fadeIn login-form-mobile card card-body" id="registration-card"> 
            <div class="bg-white pb-1">
                <h4 class="text-center"><strong class="text-info">BRT E-TICKETING EDIT PROFILE</strong></h4>
            </div>
            <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
                <?php include_once('includes/messages.php') ?>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>First Name</label>
                            <input required type="text" name="first_name" class="form-control" value="<?php echo $user_profile['fname'] ?>">
                        </div>
                        <div class="col-xl-6">
                            <label>Last Name</label>
                            <input required type="text" name="last_name" class="form-control" value="<?php echo $user_profile['lname'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Sex</label>
                            <select name="sex" class="form-control" required>
                                <option value="<?php echo $user_profile['sex'] ?>"><?php echo $user_profile['sex'] ?></option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label>Phone</label>
                            <input required type="number" name="phone" class="form-control" value="<?php echo $user_profile['phone'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Region</label>
                            <input required type="text" name="region" class="form-control" value="<?php echo $user_profile['region'] ?>">
                        </div>
                        <div class="col-xl-6">
                            <label>District</label>
                            <input required type="text" name="district" class="form-control" value="<?php echo $user_profile['district'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Address</label>
                            <input required type="text" name="address" class="form-control" value="<?php echo $user_profile['address'] ?>">
                        </div>
                        <div class="col-xl-6">
                            <label>Username</label>
                            <input required type="text" name="username" class="form-control" value="<?php echo $user_profile['username'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="save_changes" class="btn btn-info">Save Changes</button>
                </div>     
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>