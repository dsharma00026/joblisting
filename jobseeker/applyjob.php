<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'jobseeker') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
    $job_id = (int)$_POST['job_id'];
    $seeker_id = $_SESSION['user_id'];

    // Check if already applied
    $check = $pdo->prepare("SELECT * FROM applications WHERE job_id = ? AND seeker_id = ?");
    $check->execute([$job_id, $seeker_id]);

    if ($check->rowCount() == 0) {
        $stmt = $pdo->prepare("INSERT INTO applications (job_id, seeker_id) VALUES (?, ?)");
        $stmt->execute([$job_id, $seeker_id]);
        header("Location: view-jobs.php?applied=1");
    } else {
        header("Location: view-jobs.php?already=1");
    }
    exit;
}
