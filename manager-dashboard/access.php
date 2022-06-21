<?php 
    $user_detail = "SELECT * FROM tbl_user WHERE id = :user_id"; 
    $user_detail_q = $dbconnect->prepare($user_detail);
    $user_detail_q->execute(['user_id'=>$_SESSION['UserID']]);
    $user_profile = $user_detail_q->fetch(); 
?>