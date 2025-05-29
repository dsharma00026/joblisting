<?php include("../includes/header.php"); ?>

<?php
include("../dbconfig.php");
session_start();
// Fetch all jobs
$query="SELECT jobs.*, users.name AS employer_name 
        FROM jobs JOIN users ON jobs.employer_id = users.id 
        ORDER BY posted_at DESC";

$data=$con->prepare($query);
$data->execute();
$jobs=$data->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="../assests/style.css">
    <title>Browse Jobs | Job Seeker Dashboard</title>
</head>
<body>
    <h2><?php
if (isset($_REQUEST['applied'])) {
    echo "<p style='color:green;'>Applied successfully!</p>";
}
if (isset($_REQUEST['already'])) {
    echo "<p style='color:red;'>You have already applied for this job.</p>";
}
?>

            Browse Jobs</h2>

    <p><a href="./dashboard.php">← Back to Dashboard</a></p>

    <?php foreach ($jobs as $job): ?>
        <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px;">
            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($job['employer_name']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($job['category']); ?></p>
            <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
            <form method="POST" action="./applyjob.php">
                <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                <button type="submit">Apply</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
<?php include("../includes/footer.php"); ?>