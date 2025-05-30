<?php include("../includes/header.php"); ?>

<?php
session_start();
include("../dbconfig.php");

// Fetch jobs posted by this employer
$stmt = $con->prepare("SELECT * FROM jobs WHERE employer_id = ? ORDER BY posted_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="../assests/style.css">
    <title>Manage Jobs | Employer Dashboard</title>
</head>
<body>
    <h2>Manage Posted Jobs</h2>
    <p><a href="./dashboard.php">← Back to Dashboard</a></p>

    <?php foreach ($jobs as $job): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
            <p><strong>Posted:</strong> <?php echo htmlspecialchars($job['posted_at']); ?></p>
            <p><a href="./view-applicants.php?job_id=<?php echo $job['id']; ?>">View Applicants</a></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
<?php include("../includes/footer.php"); ?>