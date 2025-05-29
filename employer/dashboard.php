<?php include("../includes/header.php"); ?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="../assests/style.css">
    <title>Employer Dashboard | Punjab Job Portal</title>

</head>
<body>
    <h2>Welcome, <?php //echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>This is your employer dashboard.</p>
    <ul>
        <li><a href="./postJob.php">Post a Job</a></li>
        <li><a href="./managejob.php">Manage Jobs</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
</body>
</html>
<?php include("../includes/footer.php"); ?>