<?php
require_once '../includes/auth_check.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'employer') {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['job_id'])) {
    header("Location: manage-jobs.php");
    exit;
}

$job_id = (int)$_GET['job_id'];

// Validate the job belongs to this employer
$check = $pdo->prepare("SELECT * FROM jobs WHERE id = ? AND employer_id = ?");
$check->execute([$job_id, $_SESSION['user_id']]);
$job = $check->fetch();

if (!$job) {
    echo "<p style='color:red;'>Invalid job or permission denied.</p>";
    exit;
}

// Fetch applicants
$stmt = $pdo->prepare("
    SELECT users.name, users.email, applications.applied_at
    FROM applications
    JOIN users ON applications.seeker_id = users.id
    WHERE applications.job_id = ?
    ORDER BY applications.applied_at DESC
");
$stmt->execute([$job_id]);
$applicants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Applicants for <?php echo htmlspecialchars($job['title']); ?></title>
</head>
<body>
    <h2>Applicants for "<?php echo htmlspecialchars($job['title']); ?>"</h2>
    <p><a href="manage-jobs.php">← Back to Manage Jobs</a></p>

    <?php if (count($applicants) === 0): ?>
        <p>No applications yet.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($applicants as $applicant): ?>
            <li>
                <strong><?php echo htmlspecialchars($applicant['name']); ?></strong> 
                (<?php echo htmlspecialchars($applicant['email']); ?>) - 
                Applied on <?php echo htmlspecialchars($applicant['applied_at']); ?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
