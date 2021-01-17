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
                $get_team_sql = "select * from TEAM;";
                $get_team = $conn->query($get_team_sql);
                if($get_team->num_rows == 0)
                {
                    echo "There are no teams to display.";
                }
                
                else{
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Team Name</th>";
                    echo "<th>Functions</th>";
                    echo "</tr>";

                    while($get_team_row = $get_team->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $get_team_row["TeamName"] . "</td>";
                        echo "<td>" . "<ul><li><a href='delete_team.php?TeamName=" . $get_team_row["TeamName"] . "'> Delete </a></li></ul>" . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>

    </body>
</html>