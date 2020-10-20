<?php
require 'header.php';

if(is_null($_SESSION['email'])){
	$_SESSION['msg']="You must log in first to view this site";
	header("location:index.php");

}

if($_SESSION['users'] != "students"){
	$_SESSION['msg']="You must log in first to view this site";
	header("location:index.php");

}

if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['email']);
	header("location:index.php");
 }
?>


<!DOCTYPE html>
<html>
<head>
	<title>add subject</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="header">
			<h2>Select Subject</h2>
		</div>
<?php
//
// $db="dmce";
// $servername = "localhost";
// $username1 = "root";
// $password = "";

// $conn=mysqli_connect($servername, $username1, $password,$db); 
$email = $_SESSION['email'];

$query = "SELECT student_id,department,class,semester FROM students WHERE email = '$email'";
$res = mysqli_query($conn, $query);
$obj = mysqli_fetch_array($res);
$student_id = $obj['student_id'];
$department = $obj['department'];
$class = $obj['class'];
$semester = $obj['semester'];


$sql = "SELECT * FROM subject WHERE department = '$department' and class = '$class'";
// $sql = "SELECT student_id FROM student_subject where $subject = 1 ";

// SELECT Orders.OrderID, Customers.CustomerName
// FROM Orders
// INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;
echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
                echo "<tr>";
                echo "<th scope='col'>subject_id</th>";
                echo "<th scope='col'>subject name</th>";
                echo "<th scope='col'>type</th>";
                echo "<th scope='col'>elective</th>";
                echo "<th scope='col'>select</th>";
            echo "</thead>";    
                
            echo "</tr>";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	echo "<form action='student_subject_action.php' method='POST'>";
        echo "<tbody>";
        
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            
                echo "<td>" . $row['subject_id'] . "</td>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['subject_type'] . "</td>";
                echo "<td>" . $row['elective'] . "</td>";
                
                $elect = $row['elective'];
                if ($elect == "elective"){
				echo" <td> <input type='checkbox' name=" . $row['subject_name']. " value=1> </td>";
				}
				else{
					echo "<input type='hidden'  name=" . $row['subject_name']. " value=1>";
				}
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<input type='hidden'  name='student_id' value=". $student_id .">";
        

        echo "<Button type='submit' name='submit' class='btn btn-primary'>Submit</button>";
        echo "</form>";
      
        mysqli_free_result($result);
    } 
    else{
        echo "No records matching your query were found.";
        
    }
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>







	
</body>
</html>