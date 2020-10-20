<?php 
require 'header.php';


if(is_null($_SESSION['email'])){
    $_SESSION['msg']="You must log in first to view this site";
    header("location:index.php");

}

if($_SESSION['users'] != 'students'){
    $_SESSION['msg']="You must log in first to view this site";
    header("location:index.php");
}



$student_id = $_POST['student_id'];




// echo $table_name;
// $_1 = $_POST['1'];
// $_2 = $_POST['2'];
// $_3 = $_POST['3'];
// $_4 = $_POST['10'];
// echo $teacher_id;
// echo $subject;

// $loop = " `1`,`2`,`3`,`4` ";
// $loop_values = "'$_1','$_2','$_3','$_4'";

$columns = "";
$values = "";

foreach($_POST as $key => $value){
    // echo "<br>";
    // echo " ". $key." is ".$value;

    if(($key != "submit") && ($key != "student_id" )){
        // echo "<br>";
        // echo " ". $key." is ".$value;
        $columns .= ",".$key."";
        $values .= ",'".$value."'";
    }

    } 
// echo "<br>";    
// echo $columns; 
// echo "<br>";   
// echo $values;

 $query = "INSERT INTO student_subject(student_id".$columns.") VALUES ('$student_id'".$values.")";
    
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
// echo $query;
// echo $_POST['submit'];
 ?>