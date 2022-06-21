<?php $title = "User-Profile" ?>

<?php include('includes/sidebar.php'); ?>

<div class="main_container">
    <?php include('includes/messages.php') ?>
        <div class="row justify-content-center">
            <div class="col-xl-10 pb-3">
                <div class="card">
                    <div class="card-body">
                         <center><img class="img-profile rounded-circle" src="../assets/img/tz_logo.png"></center>
                         
                         <table class="table mt-2">
                            <tr>
                                <th>First Name</th>
                                <td><?php echo $user_profile['fname'] ?></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td><?php echo $user_profile['lname'] ?></td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td><?php echo $user_profile['sex'] ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td><?php echo $user_profile['phone'] ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $user_profile['address'] ?></td>
                            </tr>
                            <tr>
                                <th>Region</th>
                                <td><?php echo $user_profile['region'] ?></td>
                            </tr>

                            <tr>
                                <th>District</th>
                                <td><?php echo $user_profile['district'] ?></td>
                            </tr>

                            <tr>
                                <th>Role</th>
                                <td><?php echo $user_profile['type'] ?></td>
                            </tr>
                         </table>
                         <a href="edit-profile.php" class="btn btn-sm btn-info">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include('includes/footer.php'); ?>

