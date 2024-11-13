<?php
$servername = "localhost"; // Database server name, often 'localhost'
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "tekaya_db"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo "fool el fol <br>" ;
    $id=1;
    $sql="select * from user where Id=$id";
    $EmployeeDataSet = $conn->query($sql);
    if ($row = mysqli_fetch_array($EmployeeDataSet))
		{
          
            echo "".$row["email"]."<br>";
        }
        echo "waiting" ;
   
    }
?>
