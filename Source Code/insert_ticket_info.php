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

    $count = 1;
    $sumOfTickets = $_POST['cat1amount'] + $_POST['cat2amount'] + $_POST['cat3amount'] + $_POST['cat4amount'];

    if ($sumOfTickets == 0)
    {
          echo "<p style='font-size:25px;text-align:center;'>You must select at least 1 seat.</p>";
          return;
    }
    
    $cat1price = 0;
    $cat2price = 0;
    $cat3price = 0;
    $cat4price = 0;

    // Calculate Cat1 price
    $sql_cat1price = "SELECT s.SeatPrice FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 1";
    $result_cat1price = $conn->query($sql_cat1price);

    if ($result_cat1price->num_rows > 0)
    {
        while($row = $result_cat1price->fetch_assoc()) 
        {
            $cat1price = $row['SeatPrice'];
            $_SESSION["cat1price"] = $cat1price;
        }
    }

    // Calculate Cat2 price
    $sql_cat2price = "SELECT s.SeatPrice FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 2";
    $result_cat2price = $conn->query($sql_cat2price);

    if ($result_cat2price->num_rows > 0)
    {
        while($row = $result_cat2price->fetch_assoc()) 
        {
            $cat2price = $row['SeatPrice'];
            $_SESSION["cat2price"] = $cat2price;
        }
    }

    // Calculate Cat3 price
    $sql_cat3price = "SELECT s.SeatPrice FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 3";
    $result_cat3price = $conn->query($sql_cat3price);

    if ($result_cat3price->num_rows > 0)
    {
        while($row = $result_cat3price->fetch_assoc()) 
        {
            $cat3price = $row['SeatPrice'];
            $_SESSION["cat3price"] = $cat3price;
        }
    }

    // Calculate Cat4 price
    $sql_cat4price = "SELECT s.SeatPrice FROM SEAT s, STADIUM st WHERE s.StadiumName = st.StadiumName AND s.SeatCategory = 4";
    $result_cat4price = $conn->query($sql_cat4price);

    if ($result_cat4price->num_rows > 0)
    {
        while($row = $result_cat4price->fetch_assoc()) 
        {
            $cat4price = $row['SeatPrice'];
            $_SESSION["cat4price"] = $cat4price;
        }
    }

    $_SESSION["total_price"] = $_POST['cat1amount'] * $cat1price + $_POST['cat2amount'] * $cat2price + $_POST['cat3amount'] * $cat3price + $_POST['cat4amount'] * $cat4price;
    $_SESSION["numberOfTickets"] = $sumOfTickets;
    
    echo "<form action='confirmation.php?matchnum=" . $_GET['matchnum'] . "' method='post'>";

    while ($count < $_POST['cat1amount'] + 1)
    {

        echo "<h1>" . "Ticket " . $count . " Details</h1>";
        echo "<label>Category:</label><br>
              <input type='text' name='Category_Ticket" . $count . "' value='1' readonly><br>";

        echo "<label>Guest?</label><br>
              <select name='Guest_Ticket" . $count . "' required>
              <option> Yes </option>
              <option> No </option>
              </select><br/>";
      
        echo "<label> If yes, enter Customer FanID: </label><br>";
        echo "<input type='text' name='GuestCustFanID_Ticket" . $count . "'><br>";
        
        echo "<label>FanID:</label><br>
              <input type='number' name='CustFanID_Ticket" . $count . "' required><br>";

        echo "<label>First name:</label><br>
              <input type='text' name='CustFName_Ticket" . $count . "' required><br>";

        echo "<label>Last name:</label><br>
              <input type='text' name='CustLName_Ticket" . $count . "' required><br>";

        echo "<label>Date of Birth:</label><br>
              <input type='date' name='CustDOB_Ticket" . $count . "' required><br>";

        echo "<label>Nationality:</label><br>
              <input type='text' name='CustNationality_Ticket" . $count . "' required><br>";
        
        echo "<label>Address:</label><br>
              <input type='text' name='CustAddress_Ticket" . $count . "' required><br>";
        
        echo "<label>Telephone Number:</label><br>
              <input type='number' name='CustTel_Ticket" . $count . "' required><br>";

        echo "<label>Email:</label><br>
              <input type='text' name='CustEmail_Ticket" . $count . "' required><br>";

        echo "<br>";

        $count = $count + 1;

    }

    while ($count < $_POST['cat1amount'] + $_POST['cat2amount'] + 1)
    {

        echo "<h1>" . "Ticket " . $count . " Details</h1>";
        echo "<label>Category:</label><br>
              <input type='text' name='Category_Ticket" . $count . "' value='2' readonly><br>";

        echo "<label>Guest?</label><br>
        <select name='Guest_Ticket" . $count . "' required>
        <option> Yes </option>
        <option> No </option>
        </select><br/>";

        echo "<label> If yes, enter Customer FanID: </label><br>";
        echo "<input type='text' name='GuestCustFanID_Ticket" . $count . "'><br>";
        
        echo "<label>FanID:</label><br>
              <input type='number' name='CustFanID_Ticket" . $count . "' required><br>";

        echo "<label>First name:</label><br>
              <input type='text' name='CustFName_Ticket" . $count . "' required><br>";

        echo "<label>Last name:</label><br>
              <input type='text' name='CustLName_Ticket" . $count . "' required><br>";

        echo "<label>Date of Birth:</label><br>
              <input type='date' name='CustDOB_Ticket" . $count . "' required><br>";

        echo "<label>Nationality:</label><br>
              <input type='text' name='CustNationality_Ticket" . $count . "' required><br>";
        
        echo "<label>Address:</label><br>
              <input type='text' name='CustAddress_Ticket" . $count . "' required><br>";
        
        echo "<label>Telephone Number:</label><br>
              <input type='number' name='CustTel_Ticket" . $count . "' required><br>";
      
        echo "<label>Email:</label><br>
              <input type='text' name='CustEmail_Ticket" . $count . "' required><br>";

        echo "<br>";

        $count = $count + 1;

    }

    while ($count < $_POST['cat1amount'] + $_POST['cat2amount'] + $_POST['cat3amount']  + 1)
    {

        echo "<h1>" . "Ticket " . $count . " Details</h1>";
        echo "<label>Category:</label><br>
              <input type='text' name='Category_Ticket" . $count . "' value='3' readonly><br>";

        echo "<label>Guest?</label><br>
        <select name='Guest_Ticket" . $count . "' required>
        <option> Yes </option>
        <option> No </option>
        </select><br/>";

        echo "<label> If yes, enter Customer FanID: </label><br>";
        echo "<input type='text' name='GuestCustFanID_Ticket" . $count . "'><br>";
        
        echo "<label>FanID:</label><br>
              <input type='number' name='CustFanID_Ticket" . $count . "' required><br>";

        echo "<label>First name:</label><br>
              <input type='text' name='CustFName_Ticket" . $count . "' required><br>";

        echo "<label>Last name:</label><br>
              <input type='text' name='CustLName_Ticket" . $count . "' required><br>";

        echo "<label>Date of Birth:</label><br>
              <input type='date' name='CustDOB_Ticket" . $count . "' required><br>";

        echo "<label>Nationality:</label><br>
              <input type='text' name='CustNationality_Ticket" . $count . "' required><br>";
        
        echo "<label>Address:</label><br>
              <input type='text' name='CustAddress_Ticket" . $count . "' required><br>";
        
        echo "<label>Telephone Number:</label><br>
              <input type='number' name='CustTel_Ticket" . $count . "' required><br>";
      
        echo "<label>Email:</label><br>
              <input type='text' name='CustEmail_Ticket" . $count . "' required><br>";

        echo "<br>";

        $count = $count + 1;

    }
    
    while ($count < $_POST['cat1amount'] + $_POST['cat2amount'] + $_POST['cat3amount'] + $_POST['cat4amount'] + 1)
    {

        echo "<h1>" . "Ticket " . $count . " Details</h1>";
        echo "<label>Category:</label><br>
              <input type='text' name='Category_Ticket" . $count . "' value='4' readonly><br>";

        echo "<label>Guest?</label><br>
        <select name='Guest_Ticket" . $count . "' required>
        <option> Yes </option>
        <option> No </option>
        </select><br/>";

        echo "<label> If yes, enter Customer FanID: </label><br>";
        echo "<input type='text' name='GuestCustFanID_Ticket" . $count . "'><br>";
        
        echo "<label>FanID:</label><br>
              <input type='number' name='CustFanID_Ticket" . $count . "' required><br>";

        echo "<label>First name:</label><br>
              <input type='text' name='CustFName_Ticket" . $count . "' required><br>";

        echo "<label>Last name:</label><br>
              <input type='text' name='CustLName_Ticket" . $count . "' required><br>";

        echo "<label>Date of Birth:</label><br>
              <input type='date' name='CustDOB_Ticket" . $count . "' required><br>";

        echo "<label>Nationality:</label><br>
              <input type='text' name='CustNationality_Ticket" . $count . "' required><br>";
        
        echo "<label>Address:</label><br>
              <input type='text' name='CustAddress_Ticket" . $count . "' required><br>";
        
        echo "<label>Telephone Number:</label><br>
              <input type='number' name='CustTel_Ticket" . $count . "' required><br>";
      
        echo "<label>Email:</label><br>
              <input type='text' name='CustEmail_Ticket" . $count . "' required><br>";

        echo "<br>";

        $count = $count + 1;

    }

    echo "<input type='submit' value='Pay Now'></form>";
    echo "<br><br><br>"
?>

</html>