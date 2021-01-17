<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
include ('admin_home.php');
$servername = "dbproject5.org";
$username = "Team2X_admin";
$password = "Team2X_admin";
$dbname = "Team2X_Project";
$conn = new mysqli($servername, $username, $password, $dbname);
function getstuff($inp){
    $get_capacity_sql = "select Category1Capacity, Category2Capacity, Category3Capacity, Category4Capacity, from SATDIUM where StadiumName = " . "'" . $inp . "'";
    $get_capacity = $GLOBALS["conn"]->query($get_capacity_sql);
    while($get_capacity_row = $get_capacity->fetch_assoc()){
        echo $get_capacity_row["numofseats"];
    }  
};
?>

<?php
$x = array();
$get_everything_sql = "select StadiumName, Category1Capacity, Category2Capacity, Category3Capacity, Category4Capacity from STADIUM";
$get_everything = $GLOBALS["conn"]->query($get_everything_sql);
while($get_everything_row = $get_everything->fetch_assoc()){
    $x[$get_everything_row["StadiumName"]] = array($get_everything_row["Category1Capacity"], $get_everything_row["Category2Capacity"], $get_everything_row["Category3Capacity"], $get_everything_row["Category4Capacity"]);
}
echo "<script> var s = [] </script>";
foreach($x as $key=>$value){
    echo "<script> var temp = [] </script>";
    echo "<script> temp[0] = $value[0] </script>";
    echo "<script> temp[1] = $value[1] </script>";
    echo "<script> temp[2] = $value[2] </script>";
    echo "<script> temp[3] = $value[3] </script>";
    echo "<script>" . "s['$key'] = temp" . "</script>";
}

$y = array();
$get_cities_sql = "select StadiumName, StadiumCity from STADIUM";
$get_cities = $GLOBALS["conn"]->query($get_cities_sql);
while($get_cities_row = $get_cities->fetch_assoc()){
    $y[$get_cities_row["StadiumName"]] = $get_cities_row["StadiumCity"];
}
echo "<script> var c = [] </script>";
foreach($y as $key=>$value){
    echo "<script>" . "c['$key'] = '$value'" . "</script>";
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<html>
    <form action="add_match.php" method="post">
        <label> Match Number: </label>
        <input type="number" name="matchnumber" required>
        <br/>
        <br/>
        <label> Match Date: </label>
        <input type="date" name="matchdate" required>
        <br/>
        <br/>
        <label> Match Time: </label>
        <input type="time" name="matchtime" required>
        <br/>
        <br/>
        <label> Team 1: </label>
        <select name="team1" required>
            <option disabled selected value> -- select an option -- </option>
            <?php
            $team1_sql = "select * from TEAM";
            $team1_options = $conn->query($team1_sql);
            while($team1_row = $team1_options->fetch_assoc()){
                echo "<option>". $team1_row["TeamName"] ."</option>";
            }
            ?>
        </select>
        <br/>
        <br/>
        <label> Team 2: </label>
        <select name="team2" required>
            <option disabled selected value> -- select an option -- </option>
            <?php
            $team2_sql = "select * from TEAM";
            $team2_options = $conn->query($team2_sql);
            while($team2_row = $team2_options->fetch_assoc()){
                echo "<option>". $team2_row["TeamName"] ."</option>";
            }
            ?>
        </select>
        <br/>
        <br/>
        <label> Stadium: </label>
        <script>
            function printing(){
                var z =$("#stadium_selection option:selected").text();
                document.getElementById("city").value = c[z];
                document.getElementById("cat1").value = s[z][0];
                document.getElementById("cat2").value = s[z][1];
                document.getElementById("cat3").value = s[z][2];
                document.getElementById("cat4").value = s[z][3];
            }
        </script>
        <select id="stadium_selection" name="stadium_selection" onchange="printing()" required>
        <option disabled selected value> -- select an option -- </option>
        <?php
        $stadium_sql = "select * from STADIUM";
        $stadium_options = $conn->query($stadium_sql);
        while($stadium_row = $stadium_options->fetch_assoc()){
            echo "<option>" ;
            echo $stadium_row["StadiumName"];
            echo "</option>";
        }
        ?>
        </select>
        <br/>
        <br/>
        <label>City: </label>
        <input id = "city" name="city" value="" readonly>
        <br/>
        <br/>
        <label>Category 1: </label>
        <input id = "cat1" name="cat1" value="" readonly>
        <br/>
        <br/>
        <label>Category 2: </label>
        <input id = "cat2" name="cat2" value="" readonly>
        <br/>
        <br/>
        <label>Category 3: </label>
        <input id = "cat3" name="cat3" value="" readonly>
        <br/>
        <br/>
        <label>Category 4: </label>
        <input id = "cat4" name="cat4" value="" readonly>
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</html>