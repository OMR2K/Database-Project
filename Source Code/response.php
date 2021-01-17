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

$firstname = $_POST['fname']; 
$lastname = $_POST['lname']; 
$creditcardnumber = $_POST['creditcardnumber'];
$cvv = $_POST['CVV'];
$expiry = $_POST['expiry'];
$amount = $_SESSION['total_price'];
$numberOfTickets = $_SESSION['numberOfTickets'];

$sum = 0;

for ($i = 15; $i >= 0; $i--)
{
    $x = (int) substr($creditcardnumber, $i);
    $sum += $x;
    $creditcardnumber = substr($creditcardnumber, 0, $i);
}

if ($sum % 2 == 0) 
{

    echo "<p style='font-size:25px;text-align:center;'>You successfully purchased " . $numberOfTickets . " ticket(s), with a total price of QAR " . $amount . "</p>";

    $count = 1;
    while ($count < $_SESSION["numberOfTickets"] + 1)
    {
        // Add CUSTOMER or Add Guest
        if ($_SESSION["Customer"]["Guest_Ticket" . $count] == 'No')
        {
            
            $CustDOB = $_SESSION["Customer"]["CustDOB_Ticket" . $count];
            $CustTelNum = $_SESSION["Customer"]["CustTel_Ticket" . $count];
            $CustFanID = $_SESSION["Customer"]['CustFanID_Ticket' . $count];
            $CustEmail = $_SESSION["Customer"]["CustEmail_Ticket" . $count];
            $CustNationality = $_SESSION["Customer"]["CustNationality_Ticket" . $count];
            $CustFName = $_SESSION["Customer"]['CustFName_Ticket' . $count];
            $CustLName = $_SESSION["Customer"]['CustLName_Ticket' . $count];
            $CustAddress = $_SESSION["Customer"]["CustAddress_Ticket" . $count];

            $sql = "INSERT INTO CUSTOMER VALUES ('" . $CustDOB . "', " . $CustTelNum . ", " . $CustFanID . ", '" . $CustEmail . "', '" . $CustNationality . "', '" . $CustFName . "', '" . $CustLName . "', '" . $CustAddress . "')";
            
            $conn->query($sql);
            
        } else {
            // Add GUEST
            $GuestFanID = $_SESSION["Customer"]["CustFanID_Ticket" . $count];
            $GuestNationality = $_SESSION["Customer"]["CustNationality_Ticket" . $count];
            $GuestDOB = $_SESSION["Customer"]["CustDOB_Ticket" . $count];
            $GuestFName = $_SESSION["Customer"]["CustFName_Ticket" . $count];
            $GuestLName = $_SESSION["Customer"]["CustLName_Ticket" . $count];
            $CustFanID = $_SESSION["Customer"]["GuestCustFanID_Ticket" . $count];
            $GuestTelNum = $_SESSION["Customer"]["CustTel_Ticket" . $count];
            $GuestAddress = $_SESSION["Customer"]["CustAddress_Ticket" . $count];
            $GuestEmail = $_SESSION["Customer"]["CustEmail_Ticket" . $count];

            $sql = "INSERT INTO GUEST VALUES (" . $GuestFanID . ", '" . $GuestNationality . "', '" . $GuestDOB . "', '" . $GuestFName . "', '" . $GuestLName . "', " . $CustFanID . ", " . $GuestTelNum . ", '" . $GuestAddress . "', '" . $GuestEmail . "');";
            
            $conn->query($sql);
        }

        $count = $count + 1;
    }

    // Add CCDetails
    
    $creditcardtype = $_POST['creditcardtype'];
    $creditcardnumber = strval($_POST['creditcardnumber']);
    $cvv = $_POST['CVV'];
    $firstname = $_POST['fname']; 
    $lastname = $_POST['lname']; 
    $edate = $_POST['expiry'];
    $year = intval(str_split($edate, "4")[0]);
    $month = abs(intval(str_split($edate, "4")[1]));
    $fanid = $_POST['fanID'];
    $sql = "INSERT INTO CCDetails VALUES ('" . $creditcardtype . "', " . $creditcardnumber . ", " . $cvv . ", '" . $firstname. "', '" . $lastname . "', " . $month . ", " . $year  . ", ". $fanid .");";
    $conn->query($sql);

    $count = 1;
    while ($count < $_SESSION["numberOfTickets"] + 1)
    {
        
        $letter = chr(rand(65,90)); // Random letter from A - Z
        $ticketNumber = rand(100000, 999999);
        $TicketID = $letter . $ticketNumber;
        $MatchNumber = $_GET['matchnum'];
        $SeatCategory = $_SESSION["Customer"]["Category_Ticket" . $count];
        $TicketType = "individual";
        $Price = $_SESSION['cat'. $SeatCategory . 'price'];

        if ($_SESSION["Customer"]["Guest_Ticket" . $count] == "No")
        {
            $FanID = $_SESSION["Customer"]["CustFanID_Ticket" . $count];
        } else {
            $FanID = $_SESSION["Customer"]["GuestCustFanID_Ticket" . $count];
        }
        
        $TeamName = NULL;
        $SpecificStadiumName = NULL;
        $SeatPavillion = rand(1, 10);
        $SeatLevel = rand(1,20);
        $SeatBlock = chr(rand(65,90)) . rand(1,150);
        $SeatRow = rand(1,20);
        $SeatNumber = rand(1,20);
        $sql_stadiumname = "SELECT * FROM FOOTBALL_MATCH WHERE MatchNumber = " . $MatchNumber; 
        $result_stadiumname = $conn->query($sql_stadiumname);
        if ($result_stadiumname->num_rows > 0)
        {
            while($row = $result_stadiumname->fetch_assoc()) 
            {
                $SeatStadium = $row['StadiumName'];
                $team1 = $row['Team1'];
                $team2 = $row['Team2'];
                $matchtime = $row['KickOffTime'];
                $matchdate = $row['KickOffDate'];
            }
        }
        $CCNumber = $_POST['creditcardnumber'];

        $sql2 = "INSERT INTO SEAT VALUES (" . $SeatCategory . ", " . $SeatPavillion . ", " . $SeatLevel . ", '" . $SeatBlock . "', " . $SeatRow . ", " . $SeatNumber . ", '" . $SeatStadium . "', " . $Price . ");";
        $conn->query($sql2);

        $sql = "INSERT INTO TICKET VALUES ('" . $TicketID . "', " . $MatchNumber . ", " . $SeatCategory . ", '" . $TicketType. "', " . $Price . ", " . $FanID . ", NULL, NULL, " . $SeatPavillion  . ", ". $SeatLevel . ", '" . $SeatBlock . "', ". $SeatRow . ", " . $SeatNumber . ", '". $SeatStadium . "', '". $CCNumber ."');";
        $conn->query($sql);

        echo "<hr>";
        echo "<p style='font-size:15px;text-align:center;'>TicketID: " . $TicketID . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Category" . $SeatCategory . "  //  " . "QAR" . $Price . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Teams: " . $team1 . " VS " . $team2 . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Time and Date: " . $matchtime . "    " . $matchdate . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Stadium: " . $SeatStadium . "</p>";
        
        $sql_stadiumaddress = "SELECT StadiumAddress FROM STADIUM WHERE StadiumName = '" . $SeatStadium . "'"; 
        $result_stadiumaddress = $conn->query($sql_stadiumaddress);
        if ($result_stadiumaddress->num_rows > 0)
        {
            while($row = $result_stadiumaddress->fetch_assoc()) 
            {
                $stadiumaddress = $row['StadiumAddress'];
            }
        }

        echo "<p style='font-size:15px;text-align:center;'>Stadium Address: " . $stadiumaddress . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Pavillion: " . $SeatPavillion . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Level: " . $SeatLevel . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Block: " . $SeatBlock . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Seat Row: " . $SeatRow . "</p>";
        echo "<p style='font-size:15px;text-align:center;'>Seat Number: " . $SeatNumber . "</p>";

        $count = $count + 1;
    }

}

else {
    echo "<p style='font-size:25px;text-align:center;'>Failed to purchase the tickets. Could not validate credit card.</p><br>";
}

/*
// Send email
$msg = "Transaction ID: " . $transactionid . "\n" 
        . "Full Name: " . $firstname . " " . $lastname . "\n" 
        . "Date & Time of payment: " . $date . " // " . $time . "\n"
        . "Amount Paid: $" . $amount; 
        
mail($email, "Transaction Information", $msg);
*/
?>

</html>