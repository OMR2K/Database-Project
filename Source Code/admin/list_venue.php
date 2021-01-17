<html>
<?php include('admin_home.php');
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["admin_login_status"]) || $_SESSION["admin_login_status"] <> 1){
    header("location: ../home.html");
    return;

}
    ?>
    <body>
            <?php
                $servername = "dbproject5.org";
                $username = "Team2X_admin";
                $password = "Team2X_admin";
                $dbname = "Team2X_Project";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $get_stadiums_sql = "select * from STADIUM;";
                $get_stadiums = $conn->query($get_stadiums_sql);
                if($get_stadiums->num_rows == 0)
                {
                    echo "There are no stadiums to display.";
                }
                
                else{
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Stadium Name</th>";
                    echo "<th>Category 1 Capacity</th>";
                    echo "<th>Category 2 Capacity</th>";
                    echo "<th>Category 3 Capacity</th>";
                    echo "<th>Category 4 Capacity</th>";
                    echo "<th>Stadium City</th>";
                    echo "<th>Stadium Address</th>";
                    echo "<th>Functions</th>";
                    echo "</tr>";

                    while($get_stadiums_row = $get_stadiums->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $get_stadiums_row["StadiumName"] . "</td>";
                        echo "<td>" . $get_stadiums_row["Category1Capacity"] . "</td>";
                        echo "<td>" . $get_stadiums_row["Category2Capacity"] . "</td>";
                        echo "<td>" . $get_stadiums_row["Category3Capacity"] . "</td>";
                        echo "<td>" . $get_stadiums_row["Category4Capacity"] . "</td>";
                        echo "<td>" . $get_stadiums_row["StadiumCity"] . "</td>";
                        echo "<td>" . $get_stadiums_row["StadiumAddress"] . "</td>";
                        echo "<td>" . "<ul><li><a href='update_venue.php?StadiumName=" . $get_stadiums_row["StadiumName"] . "'> Update </a></li>" . 
                            "<li><a href='delete_venue.php?StadiumName=" . $get_stadiums_row["StadiumName"] . "'> Delete </a></li></ul>" . "
                            </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>

    </body>
</html>