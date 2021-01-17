
<html>

<style>
    html{
        color: white;
        background-color: #8a1538;
        font-family: 'Quicksand', sans-serif;
    }
    
    ul {
    width: 100%;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #8a1538;
    }

    li {
    float: left;
    }

    li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px; 
    text-decoration: none;
    }

    li a:hover:not(.active) {
    background-color: white;
    border-radius: 15px;
    color: #e2b33a;
    }
    
    table,td,th{
        text-align:center; 
        border: 1px white solid;
        border-radius: 15px;
        padding: 5px;
    }

    input{
        border: 1px solid #e2b33a;
        border-radius: 15px;
    }

    select{
        border: 1px solid #e2b33a;
        border-radius: 15px;
    }

    .center {
    text-align: center;
    }
</style>

<link href="https://fonts.googleapis.com/css?family=Quicksand&amp;display=swap" rel="stylesheet">
<head>
<title> Login </title>
</head>

<body>

    <div style="width:100%;">
        <p style="text-align: right;">
            Copyright: Team 2X
        </p>
    </div>
    <h1 style="width: 100%; text-align:center;">Login</h1>
    <ul>
    <li><a href="home.html">Home</a></li>
    <li><a href="login_page.html">Login</a></li>
    <li><a href="register_page.html">Register</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>
    <hr>
    <br>
    <br>

</body>

<?php

session_start();
$_SESSION["login_status"] = 0;

$servername = "dbproject5.org";
$username = "Team2X_customer";
$password = "Team2X_customer";
$dbname = "Team2X_Project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$customer_login = "SELECT UserEmail, UserPassword FROM USERS WHERE UserEmail ='" . $email . "'" . "and UserPassword='" . $password ."' and UserRole = 'Customer';";
$customer_result = $conn->query($customer_login);

$admin_login = "SELECT UserEmail, UserPassword FROM USERS WHERE UserEmail ='" . $email . "'" . "and UserPassword='" . $password ."' and UserRole = 'Admin';";
$admin_result = $conn->query($admin_login);

if ($customer_result->num_rows > 0){
    $_SESSION["login_status"] = 1;
    $_SESSION["email"] = $email;
    header("location: customer_home.php");
}

else if ($admin_result->num_rows > 0){
    $_SESSION["admin_login_status"] = 1;
    $_SESSION["admin_email"] = $email;
    header("location: admin/admin_home.php");
}

else{
    echo "<p style='font-size:25px;text-align:center;'> Email and Password do not match. Please try again.</p>";
}

?>

</html>