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
    <form action="add_team.php" method=POST>
        <label>Team Name: </label>
        <input type="text" name="TeamName" required>
        <br>
        <br>
        <input type="submit" value="Submit">
    <form>
<html>