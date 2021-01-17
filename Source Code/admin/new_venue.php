<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
include ('admin_home.php');
?>
<html>
    <form action="add_venue.php" method=POST>
        <label>Stadium Name: </label>
        <input type="text" name="StadiumName" required>
        <br/>
        <br/>
        <label> Category 1 Capacity: </label>
        <input type="number" name="Category1Capacity" required>
        <br/>
        <br/>
        <label> Category 2 Capacity: </label>
        <input type="number" name="Category2Capacity" required>
        <br/>
        <br/>
        <label> Category 3 Capacity: </label>
        <input type="number" name="Category3Capacity" required>
        <br/>
        <br/>
        <label> Category 4 Capacity: </label>
        <input type="number" name="Category4Capacity" required>
        <br/>
        <br/>
        <label> Stadium City: </label>
        <input type="text" name="StadiumCity" required>
        <br/>
        <br/>
        <label> Stadium Address: </label>
        <input type="text" name="StadiumAddress" required>
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</html>