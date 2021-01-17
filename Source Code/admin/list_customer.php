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
                $get_customer_sql = "select * from CUSTOMER";
                $get_customer = $conn->query($get_customer_sql);
                if($get_customer->num_rows == 0)
                {
                    echo "There are no customer to display.";
                }
                
                else{
                    echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Search for Customer..' title='Type in a FanID'>";
                    echo "<br>";
                    echo "<br>";
                    echo "<table id='myTable'>";
                    echo "<tr>";
                    echo "<th>Customer Fan ID</th>";
                    echo "<th>Customer First Name</th>";
                    echo "<th>Customer Last Name</th>";
                    echo "<th>Customer DOB</th>";
                    echo "<th>Customer Email</th>";
                    echo "<th>Customer Nationality</th>";
                    echo "<th>Customer Telephone Number</th>";
                    echo "<th>Customer Address</th>";
                    echo "</tr>";

                    while($get_customer_row = $get_customer->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $get_customer_row["CustFanID"] . "</td>";
                        echo "<td>" . $get_customer_row["CustFname"] . "</td>";
                        echo "<td>" . $get_customer_row["CustLName"] . "</td>";
                        echo "<td>" . $get_customer_row["CustDOB"] . "</td>";
                        echo "<td>" . $get_customer_row["CustEmail"] . "</td>";
                        echo "<td>" . $get_customer_row["CustNationality"] . "</td>";
                        echo "<td>" . $get_customer_row["CustTelNumber"] . "</td>";
                        echo "<td>" . $get_customer_row["CustAddress"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
        <script>
        //derived from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_filter_table
        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) == 0 ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        }
        }
    </script>
    </body>
</html>