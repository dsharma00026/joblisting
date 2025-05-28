<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'jobseeker') {
    header("Location: ../auth/login.php");
    exit;
}

// Fetch all jobs
$stmt = $pdo->query("SELECT jobs.*, users.name AS employer_name FROM jobs JOIN users ON jobs.employer_id = users.id ORDER BY posted_at DESC");
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse Jobs | Job Seeker Dashboard</title>
</head>
<body>
    <h2><?php
if (isset($_GET['applied'])) {
    echo "<p style='color:green;'>Applied successfully!</p>";
}
if (isset($_GET['already'])) {
    echo "<p style='color:red;'>You have already applied for this job.</p>";
}
?>

            Browse Jobs</h2>

    <p><a href="dashboard.php">← Back to Dashboard</a></p>

    <?php foreach ($jobs as $job): ?>
        <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px;">
            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($job['employer_name']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($job['category']); ?></p>
            <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
            <form method="POST" action="apply-job.php">
                <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                <button type="submit">Apply</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
