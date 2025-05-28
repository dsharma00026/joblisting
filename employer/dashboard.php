<?php
require_once '../includes/auth_check.php';
if ($_SESSION['role'] !== 'employer') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard | Punjab Job Portal</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>This is your employer dashboard.</p>
    <ul>
        <li><a href="post-job.php">Post a Job</a></li>
        <li><a href="manage-jobs.php">Manage Jobs</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
</body>
</html>
