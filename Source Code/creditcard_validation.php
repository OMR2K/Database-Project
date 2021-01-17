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

        <p style='font-size:25px;text-align:center;'>Please fill in the payment information:</p><br>

    </body>

<?php 
    session_start();

    if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] <> 1){
        header("location: home.html");
        return;
    }
?>

<?php echo "<form method='POST' action='response.php?matchnum=" . $_GET['matchnum'] . "'>" ?>

<label>Please input your first name:</label><br>
<input type="text" name="fname" required><br><br>

<label>Please input your last name:</label><br>
<input type="text" name="lname" required><br><br>

<label>Please input your credit card type:</label><br>
<select name="creditcardtype" required>
    <option>
        Visa
    </option>
    <option>
        Master
    </option>
    <option>
        American
    </option>
</select><br><br>

<label>Please input your credit card number:</label><br>
<input type="tel" name="creditcardnumber" maxlength="16" pattern="[0-9]{16}" required><br><br>

<label>Please input your CVV:</label><br>
<input type="tel" name="CVV" maxlength="3" pattern="[0-9]{3}" required><br><br>

<label>Please input expiry date of credit card:</label><br>
<input type="month" name="expiry" min="2020-11" required><br><br>

<label>Please input your FanID:</label><br>
<input type="number" name="fanID" required><br><br><br>

<input type="submit" value="Pay Now"> 
</form> 
</body>

</html>