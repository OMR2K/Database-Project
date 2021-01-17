<!DOCTYPE html>

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
    <title> Book </title>
    </head>

    <body>

        <div style="width:100%;">
            <p style="text-align: right;">
                Copyright: Team 2X
            </p>
        </div>
        <h1 style="width: 100%; text-align:center;">Book</h1>
        <ul>
        <li><a href="customer_home.php">Home</a></li>
        <li><a href="book.php">Match Booking</a></li>
        <li><a href="purchases.php">Purchases</a></li>
        <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <hr>
        <br>
        <br>

        <p style='font-size:25px;text-align:center;'>Please confirm the following information:</p><br>

    </body>

<?php
session_start();

if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] <> 1){
    header("location: home.html");
    return;
}

$_SESSION["Customer"] = $_POST;
$count = 1;

echo 
"<table width=100%>
    <tr>
        <td>Category</td>
        <td>Guest</td>
        <td>Customer Fan ID if Guest</td>
        <td>Fan ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>DOB</td>
        <td>Nationality</td>
        <td>Address</td>
        <td>Telephone Number</td>
        <td>Email</td>
    </tr>";
foreach($_POST as $key => $value) {
    if (substr($key, 0, 8) == "Category"){
        echo "<tr>";
    }
    
    echo "<td>" . $value . "</td>";

    if(substr($key, 0, 10)== "CustEmail"){
        echo "</tr>";
    }
}

echo "</table>";
echo "<br>";
echo "<br>";
echo "Total Price: QAR " . $_SESSION["total_price"];

echo "<br>
      <br>
      <button> <a href='creditcard_validation.php?matchnum=" . $_GET['matchnum'] . "'> Proceed to Payment </a></button>";

?>

</html>