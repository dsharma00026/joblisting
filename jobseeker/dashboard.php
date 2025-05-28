<?php
include("../dbconfig.php");
if ($_SESSION['role'] !== 'jobseeker') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<?php
include("../includes/auth_check.php");
include("../includes/header.php");
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
<p>This is your job seeker dashboard.</p>
<ul>
    <li><a href="view-jobs.php">Browse Jobs</a></li>
    <li><a href="applied-jobs.php">My Applications</a></li>
    <li><a href="../auth/logout.php">Logout</a></li>
</ul>



<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Dashboard | Punjab Job Portal</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>This is your job seeker dashboard.</p>
    <ul>
        <li><a href="view-jobs.php">Browse Jobs</a></li>
        <li><a href="applied-jobs.php">My Applications</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
</body>
</html>


<?php include("../includes/footer.php"); ?>
