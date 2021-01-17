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

$sql = "SELECT t.TicketID, t.SeatCategory, t.Price, m.Team1, m.Team2, m.KickOffTime, m.KickOffDate, t.StadiumName, t.SeatPavillion, t.SeatLevel, t.SeatBlock, t.SeatRow, t.SeatNumber 
        FROM TICKET t, FOOTBALL_MATCH m, CUSTOMER c
        WHERE t.MatchNumber = m.MatchNumber AND t.FanID = c.CustFanID  AND c.CustEmail = '" . $_SESSION['email'] . "';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

   echo "<p style='font-size:25px;text-align:center;'>Your purchases:</p><br>";

   echo "<table width=100%><tr>
                    <td>TicketNumber</td>
                    <td>TicketCategory</td>
                    <td>TicketPrice</td>
                    <td>Team1</td>
                    <td>Team2</td>
                    <td>MatchTime</td>
                    <td>MatchDate</td>
                    <td>StadiumName</td>
                    <td>SeatPavillion</td>
                    <td>SeatLevel</td>
                    <td>SeatBlock</td>
                    <td>SeatRow</td>
                    <td>SeatNumber</td></tr>";
   // output data of each row
   while($row = $result->fetch_assoc()) {
     echo "<tr><td>" . $row["TicketID"] . "</td>" .
          "<td>".$row["SeatCategory"] . "</td>" .
          "<td>".$row["Price"] . "</td>" .
          "<td>".$row["Team1"] . "</td>" .
          "<td>".$row["Team2"] . "</td>" .
          "<td>".$row["KickOffTime"] . "</td>" . 
          "<td>".$row["KickOffDate"] . "</td>" .
          "<td>".$row["StadiumName"] . "</td>" .
          "<td>".$row["SeatPavillion"] . "</td>" .
          "<td>".$row["SeatLevel"] . "</td>" .
          "<td>".$row["SeatBlock"] . "</td>" .
          "<td>".$row["SeatRow"] . "</td>" .
          "<td>".$row["SeatNumber"] . "</td>" ."</tr>";
   }
   echo "</table>";
} else {
   echo "<p style='font-size:25px;text-align:center;'>You have not purchased any tickets yet.</p>";
}

 $conn->close();
 
 ?>

</html>