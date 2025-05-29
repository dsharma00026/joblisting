<?php
session_start();
include("../dbconfig.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['job_id'])) {
    $job_id = (int)$_POST['job_id'];
    $seeker_id = $_SESSION['user_id'];

    // Check if already applied
    $query="SELECT * FROM applications WHERE job_id = '$job_id' AND seeker_id = '$seeker_id'";
    $check=$con->prepare($query);
    $check->execute();
   
    if ($check->rowCount() == 0) {
        $query="INSERT INTO applications (job_id, seeker_id) VALUES ('$job_id','$seeker_id')";
        $stmt=$con->prepare($query);
        $stmt->execute();
        echo "here";
        header("Location: viewJob.php?applied=1");
    } else {
        header("Location: viewJob.php?already=1");
    }
    exit;
}
