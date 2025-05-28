<?php
$host="localhost";
$user="root";
$pass=null;
$db_name="joblisting";

$con=new PDO("mysql:host=$host;dbname=$db_name",$user,$pass);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


?>