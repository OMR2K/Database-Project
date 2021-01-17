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

        <p style='font-size:25px;text-align:center;'>Please choose the amount of seats for each category:</p><br>

    </body>

<?php

session_start();

if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] <> 1){
    header("location: home.html");
    return;
}

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

$sql_cat1 = "SELECT s.SeatPrice, s.SeatCategory, st.Category1Capacity FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 1 GROUP BY s.SeatCategory";
$sql_cat2 = "SELECT s.SeatPrice, s.SeatCategory, st.Category2Capacity FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 2 GROUP BY s.SeatCategory";
$sql_cat3 = "SELECT s.SeatPrice, s.SeatCategory, st.Category3Capacity FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 3 GROUP BY s.SeatCategory";
$sql_cat4 = "SELECT s.SeatPrice, s.SeatCategory, st.Category4Capacity FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 4 GROUP BY s.SeatCategory";

$result_cat1 = $conn->query($sql_cat1);
$result_cat2 = $conn->query($sql_cat2);
$result_cat3 = $conn->query($sql_cat3);
$result_cat4 = $conn->query($sql_cat4);

if ($result_cat1->num_rows > 0 && $result_cat2->num_rows > 0 && $result_cat3->num_rows > 0 && $result_cat4->num_rows > 0) {
  echo "<form action='insert_ticket_info.php?matchnum=" . $_GET['matchnum'] . "' method='post'><table width=100%><tr>
                   <td>Category</td>
                   <td>Price</td>
                   <td>Available Seats</td></tr>";
  // output data of each row
  while($row = $result_cat1->fetch_assoc()) {
    echo "<tr><td>" . $row['SeatCategory'] . "</td>" .
         "<td>".$row["SeatPrice"] . "</td>" .
         "<td>".$row["Category1Capacity"] . "</td>" . 
         "<td> <input type='number' name='cat1amount' id='cat1amount' value='0' min='0' max='4'> </td></tr>";
  }
  while($row = $result_cat2->fetch_assoc()) {
    echo "<tr><td>" . $row['SeatCategory'] . "</td>" .
         "<td>".$row["SeatPrice"] . "</td>" .
         "<td>".$row["Category2Capacity"] . "</td>" . 
         "<td> <input type='number' name='cat2amount' id='cat2amount' value='0' min='0' max='4'> </td></tr>";
  }
  while($row = $result_cat3->fetch_assoc()) {
    echo "<tr><td>" . $row['SeatCategory'] . "</td>" .
         "<td>".$row["SeatPrice"] . "</td>" .
         "<td>".$row["Category3Capacity"] . "</td>" . 
         "<td> <input type='number' name='cat3amount' id='cat3amount' value='0' min='0' max='4'> </td></tr>";
  }
  while($row = $result_cat4->fetch_assoc()) {
    echo "<tr><td>" . $row['SeatCategory'] . "</td>" .
         "<td>".$row["SeatPrice"] . "</td>" .
         "<td>".$row["Category4Capacity"] . "</td>" . 
         "<td> <input type='number' name='cat4amount' id='cat4amount' value='0' min='0' max='4'> </td></tr>";
  }
  echo "</table><br><input type='submit' value='Next'></form>";
} else {
  echo "<p style='font-size:25px;text-align:center;'>There are no available seats.</p>";
}

$conn->close();

?>

</html>