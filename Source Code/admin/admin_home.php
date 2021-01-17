<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
?>
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
    /* line 20-45 derived from https://www.w3schools.com/css/tryit.asp?filename=trycss_navbar_horizontal_black_right*/

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
</style>
<link href="https://fonts.googleapis.com/css?family=Quicksand&amp;display=swap" rel="stylesheet">
<head>
<title> Admin Privileges </title>
</head>
<body>
<div style="width:100%;">
    <p style="text-align: right;">
        Copyright: Team 2X
    </p>
</div>
<h1 style="width: 100%; text-align:center;">Admin Priveleges</h1>
<ul>
  <li><a href="admin_home.php">Home</a></li>
  <li><a href="new_match.php">Add New Match</a></li>
  <li><a href="new_venue.php">Add New Venue</a></li>
  <li><a href="new_team.php">Add New Team</a></li>
  <li><a href="list_match.php">List Matches</a></li>
  <li><a href="list_venue.php">List Venues</a></li>
  <li><a href="list_team.php">List Teams</a></li>
  <li><a href="list_ticket.php">List Tickets</a></li> 
  <li><a href="list_customer.php">List Customers</a></li> <!-- to be completed -->
  <li><a href="list_guest.php">List Guests</a></li> 
  <li style="float:right"><a href="../logout.php">Log Out</a></li>
</ul>
<hr>
<br>
<br>

</body>

<!-- Copyright section -->
</html>
