<?php include("../includes/header.php"); ?>

<?php
session_start();
include("../dbconfig.php");
$errors = [];
if(isset($_REQUEST["login"])){

     
    $email    = trim($_REQUEST['email']);
    $password = $_REQUEST['password'];

    $query="SELECT * FROM users WHERE email = '$email'";
    $log=$con->prepare($query);
    $log->execute();
    $userData=$log->fetch();

    if($userData['email']== $email && $userData['password'] == $password ){
       $_SESSION['user_id'] = $userData['id'];
        $_SESSION['role']    = $userData['role'];
        $_SESSION['name']    = $userData['name'];

        echo"here";
        //redirect on based on role
        if ($userData['role'] == "employer") {
            header("Location: ../employer/dashboard.php");
        } else {
            header("Location: ../jobseeker/dashboard.php");
        }
    } else {
        $errors[] = "Invalid credentials.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="../assests/style.css">
    <title>Login | Punjab Job Portal</title>
      
</head>
<body>
    <h2>Login</h2>
    <?php foreach ($errors as $error) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (isset($_REQUEST['success'])) echo "<p style='color:green;'>Registered successfully! Please login.</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="../auth/ragister.php">Register</a></p>
</body>
</html>
<?php include("../includes/footer.php"); ?>