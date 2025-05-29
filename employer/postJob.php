<?php include("../includes/header.php"); ?>

<?php
session_start();
include("../dbconfig.php");

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location    = trim($_POST['location']);
    $category    = trim($_POST['category']);
    $salary      = trim($_POST['salary']);

    if (!$title || !$description || !$location || !$category || !$salary) {
        $errors[] = "All fields are required.";
    } else {
        $stmt = $con->prepare("INSERT INTO jobs (employer_id, title, description, location, category, salary) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $title,
            $description,
            $location,
            $category,
            $salary
        ]);

        header("Location: dashboard.php?job_posted=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
       <link rel="stylesheet" href="../assests/style.css">
    <title>Post a Job | Employer Dashboard</title>
</head>
<body>
    <h2>Post a Job</h2>
    <?php foreach ($errors as $error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" required><br>
        <textarea name="description" placeholder="Job Description" required></textarea><br>
        <input type="text" name="location" placeholder="Location (e.g. Ludhiana)" required><br>
        <input type="text" name="category" placeholder="Category (e.g. IT, Finance)" required><br>
        <input type="text" name="salary" placeholder="Salary (e.g. ₹15,000 - ₹30,000)" required><br>
        <button type="submit">Post Job</button>
    </form>

    <p><a href="../employer/dashboard.php">Back to Dashboard</a></p>
</body>
</html>
<?php include("../includes/footer.php"); ?>