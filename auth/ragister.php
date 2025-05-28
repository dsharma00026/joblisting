<?php
include("../dbconfig.php");

$errors = [];
if(isset($_REQUEST['submit'])){
    $name     = trim($_REQUEST['name']);
    $email    = trim($_REQUEST['email']);
    $password = $_REQUEST['password'];
    $role     = $_REQUEST['role'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $queary=("INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password','$role')");
    $rag=$con->prepare($queary);
    try {
         $rag->execute();
        header("Location: login.php?success=1");
        exit;
    } catch (\Throwable $th) {
        echo $th;
    }
   
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register | Punjab Job Portal</title>
</head>
<body>
    <h2>Register</h2>
    <?php foreach ($errors as $error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="jobseeker">Job Seeker</option>
            <option value="employer">Employer</option>
        </select><br>
        <button type="submit" name="submit">Register</button>
    </form>
    <p>Already have an account? <a href="../auth/login.php">Login</a></p>
</body>
</html>
