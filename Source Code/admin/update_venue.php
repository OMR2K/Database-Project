<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
include('admin_home.php');
$servername = "dbproject5.org";
$username = "Team2X_admin";
$password = "Team2X_admin";
$dbname = "Team2X_Project";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select * from STADIUM where StadiumName = '" . $_GET["StadiumName"] . "';";
$things = $conn->query($sql)->fetch_assoc();
$_SESSION["StadiumName"] = $things['StadiumName'];
?>
<html>
    <form action="confirm_venue_update.php" method="post">
        <label> Stadium Name </label>
        <input type="text" name="StadiumName" value="<?php echo $things['StadiumName']; ?>" readonly>
        <br/>
        <br/>
        <label> Category 1 Capacity </label>
        <input type="number" name="Category1Capacity" value="<?php echo $things['Category1Capacity']; ?>" required>
        <br/>
        <br/>
        <label> Category 2 Capacity </label>
        <input type="number" name="Category2Capacity" value="<?php echo $things['Category2Capacity']; ?>" required>
        <br/>
        <br/>
        <label> Category 3 Capacity </label>
        <input type="number" name="Category3Capacity" value="<?php echo $things['Category3Capacity']; ?>" required>
        <br/>
        <br/>
        <label> Category 4 Capacity </label>
        <input type="number" name="Category4Capacity" value="<?php echo $things['Category4Capacity']; ?>" required>
        <br/>
        <br/>
        <label>Stadium City</label>
        <input type="text" name="StadiumCity" value="<?php echo $things['StadiumCity']; ?>" required>
        <br/>
        <br/>
        <label>Stadium Address</label>
        <input type="text" name="StadiumAddress" value="<?php echo $things['StadiumAddress']; ?>" required>
        <br/>
        <br/>
        <input type="submit" value="Update">
    </form>
</html>