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
    
        /* li {
        float: left;
        } */
    
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
    <title> Home </title>
    </head>

    <body>

        <div style="width:100%;">
            <p style="text-align: right;">
                Copyright: Team 2X
            </p>
        </div>
        <h1 style="width: 100%; text-align:center;">Home</h1>
        <ul>
        <li style="float:left;"><a href="customer_home.php">Home</a></li>
        <li style="float:left;"><a href="match_booking.php">Match Booking</a></li>
        <li style="float:left;"><a href="purchases.php">Purchases</a></li>
        <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <hr>
        <br>
        <br>

        <p style='font-size:25px;text-align:center;'>Please choose the ticket type:</p>

        <ul>
            <li style="float:center;"><a href="match_booking.php">Book Match Ticket</a></li>
            <li style="float:center;"><a href="customer_home.php">Book Team Ticket</a></li>
            <li style="float:center;"><a href="customer_home.php">Book Venue Ticket</a></li>
        </ul>

        <?php 
            session_start();
            if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] <> 1){
                header("location: home.html");
                return;
            }

        ?>

    </body>

</html>