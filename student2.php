<?php
require 'header.php';
// session_start();
if(is_null($_SESSION['email'])){
  $_SESSION['msg']="You must log in first to view this site";
  header("location:index.php");

}

if($_SESSION['users'] != 'students'){
  $_SESSION['msg']="You must log in first to view this site";
    header("location:index.php");
}

if(isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['email']);
  header("location:index.php");
}

//
// $db="dmce";
// $servername = "localhost";
// $username1 = "root";
// $password = "";

// $conn=mysqli_connect($servername, $username1, $password,$db); 
// //

?>

<!DOCTYPE html>
<html>
<head>
  <title>Student</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .header {
  background-color: #f1f1f1;
  padding: 30px;
  text-align: center;

}
  </style>

  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
  <style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

#Home {background-color: white;}
#News {background-color: white;}
#Contact {background-color: white;}
#About {background-color: white;}
</style>
</head>
<body>


  <?php
  $email=$_SESSION['email'];
  $table = $_SESSION['users'];
  //$user_check_query="SELECT * FROM $users WHERE username='$username' or email='$email' LIMIT 1";

  $user_check_query = "SELECT * FROM $table where email='$email'";
  $results=mysqli_query($conn,$user_check_query);
  $row=mysqli_fetch_assoc($results);

  // $result = mysql_query("SELECT * FROM $table where email='$id'");
  // while($row = mysql_fetch_array($result))
  // { 
  $fname=$row['fname'];
  $lname=$row['lname'];
  $email=$row['email'];
  $users=$row['usertype'];
  $password=$row['password'];
  $student_id=$row['student_id'];
  $istatus=$row['istatus'];
  $age=$row['age'];
  $dob=$row['dob'];
  $rollno=$row['roll_no'];
  $div=$row['division'];
  $class=$row['class'];
  $caste=$row['caste'];
  $fees=$row['fees'];
  $_SESSION['id'] = $student_id;
  $_SESSION['usertype']=$users;
  $_SESSION['email']=$email;
  // }
  ?>
  <div class="header">
    <h1>Datta Meghe College Of Engineering,Airoli</h1>
    <p></p>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="student.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Faculty</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Departments
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="feedback/feedback_form_student.php">Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <span class="navbar-text">
      <label><?php echo "<B style='color:black;'>".$fname." ".$lname."</B>";?></label>
      <button type="button" class="btn btn-primary"><a href="logout.php" style="text-decoration: none;color: white;">Logout</a></button>
    </span>

  </div>
</nav>
<button class="tablink" onclick="openPage('profile', this, 'blue')" id="defaultOpen">Profile</button>
<button class="tablink" onclick="openPage('attendance', this, 'blue')" >Attendance</button>
<button class="tablink" onclick="openPage('esection', this, 'blue')">Examination Section</button>
<button class="tablink" onclick="openPage('concession', this, 'blue')">Railway Concession</button>

<!-- <div class="row" > -->
  <!-- <div class="col-3" style="max-width:19%;">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

          <a class="nav-link active" id="v-pills-Profile-tab" data-toggle="pill" href="#v-pills-Profile" role="tab" aria-controls="v-pills-Profile" aria-selected="true" >Profile</a>

          <a class="nav-link" id="v-pills-Examination-tab" data-toggle="pill" href="#v-pills-Examination" role="tab" aria-controls="v-pills-Examination" aria-selected="false">Examination Section</a>

          <a class="nav-link" id="v-pills-Attendance-tab" data-toggle="pill" href="#v-pills-Attendance" role="tab" aria-controls="v-pills-Attendance" aria-selected="false">Attendance</a>

          <a class="nav-link" id="v-pills-Railway-tab" data-toggle="pill" href="#v-pills-Railway" role="tab" aria-controls="v-pills-Railway" aria-selected="false">Railway Concession</a>

          <a class="nav-link" id="v-pills-subject-tab" data-toggle="pill" href="#v-pills-subject" role="tab" aria-controls="v-pills-subject" aria-selected="false">Select Subject</a>
    </div>
  </div> -->


                                                <!--  -->
                                       <!--      Profile     -->
                                                <!--  -->      
      <div id="profile" class="tabcontent">
          <div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <!-- <img src="/w3images/avatar_hat.jpg" style="width:100%" alt="Avatar"> -->
          <?php if($istatus==0){echo "<img src='uploads/default.png' style='width:100%'' alt='Avatar'><br>
                <center><form action='uploadi2.php' method='POST' enctype='multipart/form-data'>
            <input type='file' name='file' class='btn btn-primary'></center>
            <br><br>

    <center><Button type='submit' name='submit1' class='btn btn-primary'>Upload Image</button></center>
  </form>";
      }
      else{
        echo "<img src='uploads/profile".$users.$student_id.".png' style='width:100%'' alt='Avatar'>";
      }?>
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><?php if($istatus==0){echo "";} else {echo $fname." ".$lname;} ?></h2>
          </div>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-blue"></i>Designer</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-blue"></i>London, UK</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-blue"></i><?php echo $email; ?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-blue"></i><?php echo $row['Mobile_NO']?></p>
          <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-blue"></i><?php echo $row['dob']?></p>
          <hr>

          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-blue"></i>Skills</b></p>
          <p>Adobe Photoshop</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-blue" style="width:90%">90%</div>
          </div>
          <p>Photography</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-blue" style="width:80%">
              <div class="w3-center w3-text-white">80%</div>
            </div>
          </div>
          <p>Illustrator</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-blue" style="width:75%">75%</div>
          </div>
          <p>Media</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <div class="w3-container w3-center w3-round-xlarge w3-blue" style="width:50%">50%</div>
          </div>
          <br>

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-blue"></i>Languages</b></p>
          <p>English</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-blue" style="height:24px;width:100%"></div>
          </div>
          <p>Spanish</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-blue" style="height:24px;width:55%"></div>
          </div>
          <p>German</p>
          <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-blue" style="height:24px;width:25% ;"></div>
          </div>
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-blue"></i>Work Experience</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Front End Developer / w3schools.com</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - <span class="w3-tag w3-blue w3-round">Current</span></h6>
          <p>Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Web Developer / something.com</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mar 2012 - Dec 2014</h6>
          <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2010 - Mar 2012</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
        </div>
      </div>

      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-blue"></i>Education</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
          <p>Web Development! All I need to know in one place</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>London Business School</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
          <p>Master Degree</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>School of Coding</b></h5>
          <h6 class="w3-text-blue"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
          <p>Bachelor Degree</p><br>
        </div>
      </div><br>
<button class="btn btn-primary" ><a href="update_profile_student.php" style="text-decoration:none;color: #ffffff ">Update Profile</a></button>
     <span>
     <button class="btn btn-primary" onclick="openPage('ssubject', this, 'blue')">Select Subject</button></span>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>


  
     <footer class="w3-container w3-blue w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

  
</div>


                                                <!--  -->
                                       <!--      Examination     -->
                                                <!--  -->  

      <div id="esection" class="tabcontent">...</div>



                                                <!--  -->
                                       <!--      Attendance     -->
                                                <!--  -->  

      <div id="attendance" class="tabcontent"> 
     
<br>
<center><div id="piechart"></div></center>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Detailed Attendance
  </button>
  <div class="collapse" id="collapseExample">
  <div class="card card-body">
       <?php
            $email=$_SESSION['email'];
    $table = $_SESSION['users'];

    $user_check_query = "SELECT * FROM $table where email='$email'";
    $res2=mysqli_query($conn,$user_check_query);
    $row3=mysqli_fetch_assoc($res2);

    $department=$row3['department'];
    $class=strtolower($row3['class']);
    $division=$row3['division'];
    $student_id=$row3['student_id'];

    $table_name = $department."_".$class."_".$division;
    $count1=0;
    $count=0;
    


$sql = "SELECT DISTINCT(date) FROM $table_name";

            // echo "</tr>";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      
        while($row = mysqli_fetch_array($result)){

            // echo $row['date'] ;
            
            echo"<div> <table border = '1' style='float:left;margin-right:10px'>";
            $date = $row['date'];
            $nameOfDay = date('D', strtotime($date));
            echo "<th style='background-color:DodgerBlue;'>".$nameOfDay."<br>".$row['date']."</th>";


            $query = "SELECT subject , `$student_id` FROM $table_name where date = '$date'";
            $res = mysqli_query($conn, $query);

            if(mysqli_num_rows($res) > 0){
                while($row2 = mysqli_fetch_array($res)){
                    $count1=$count1+1;
                    echo "<tr>";
                    if ($row2[$student_id] == 1){
                        echo "<td style='background-color:MediumSeaGreen;'>" . $row2['subject'] . "</td>";
                        $count=$count+1;
                    }
                    else{
                        echo "<td style='background-color:Tomato;'>" . $row2['subject'] . "</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table></div>";




        }

      
        mysqli_free_result($result);
    } 
    else{
        echo "No records matching your query were found.";
        
    }
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
echo "<br>";
$atpercent=($count/$count1)*100;
            echo "<p style='color:black;'>Your attendance is ".round($atpercent)."%<br></p>";
            if($atpercent<75){
            echo "<p style='color:black;'>You need 75% attendance.</p>";
          }

// echo "</table>";
//  echo $teacher_id;
//  echo $subject;
//  echo $sql;
// echo  date("Y-m-d");
// Close connection
mysqli_close($conn);
?>
    
  </div>
</div>

      </div>
      <div id="ssubject" class="tabcontent" >
      <iframe id="myFrame" src="student_subject.php" style="height:400px;width:100%"></iframe> </div>

                                                <!--  -->
                                       <!--      messages     -->
                                                <!--  -->  
    


                                                <!--  -->
                                       <!--      Railway     -->
                                                <!--  -->  
    <div id="concession" class="tabcontent">


<?php
$db="dmce";
$servername = "localhost";
$username1 = "root";
$password = "";

$conn=mysqli_connect($servername, $username1, $password,$db); 
    $email=$_SESSION['email'];
    $table = $_SESSION['users'];
    $q2="SELECT * FROM concession_list where email='$email' ORDER BY time DESC ";
    $r=mysqli_query($conn,$q2);
    // $row = mysqli_fetch_array($result);

    if($fees != "paid"){
      echo "<p style='color:black;'>You have not paid fees.</p>" ;
    }

    elseif(mysqli_num_rows($r) > 0)
      {
          $row2 = mysqli_fetch_array($r);
          $date=$row2['date'];
          $expiry_date=$row2['expiry_date'];
          date_default_timezone_set("Asia/Calcutta");
          $current_date = date('Y-m-d');
      // $row2=mysqli_fetch_assoc($r);
      // if($row2){
          if ($expiry_date >= $current_date)
          {
            // echo "".$expiry_date." > ".$current_date."";            
            echo "<p style='color:black;'>You have already applied for the railway concession on ".$date.". You can apply again after ".$expiry_date.".</p>";
          }

          else{
            // echo "".$expiry_date." < ".$current_date."";
            echo '<br> <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">Apply for Concession</a>';
          }

      // $msg1="You have already applied for the railway concession";
      // // $date=$row2['date'];
   // //    $expiry_date=$row2['expiry_date'];
      // echo $msg1." On ".$date.". You can apply again after ".$expiry_date.".";

    }    
    else
    {
        echo '<br><a class="btn btn-primary" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">Apply for Concession</a>';
    }
        
?>


         <br><div class="collapse" id="collapseExample1">
  <div class="card card-body">
    <form action="concession_student_action.php" method="POST" name="form1">
      <table>
        <tr>
          <td><label for="source" style="color:black">Source:</label></td>
          <td><input type="text" name="source" required class="form-control"></td>
        </tr>
        <tr>
          <td><label for="train_class" style="color:black">Train class:</label></td>
          <td><select name="train_class" class="form-control" required>
              <option value="first_class">First class</option>
              <option value="second_class">Second class</option>
          </select></td>
        </tr>
        <tr>
          <td><label for="period" style="color:black">Period:</label></td>
          <td> <select name="period" class="form-control" required>
              <option value="monthly">Monthly</option>
              <option value="quarterly">Quarterly</option>
          </select></td>
        </tr>
        <tr>
          <td><label for="previous_pass_ticket_no" style="color:black">Previous Pass Ticket No:</label></td>
          <td><input type="number" name="previous_pass_ticket_no" class="form-control"></td>
        </tr>
        <tr>
          <td><label for="previous_pass_issue_date" style="color:black">Previous Pass Issue Date:</label></td>
          <td><input type="date"  class="form-control" name="previous_pass_issue_date" ></td>
        </tr>
        <tr>
          <td><label for="previous_pass_expiry_date" style="color:black">Previous Pass Expiry Date:</label></td>
          <td><input type="date" class="form-control" name="previous_pass_expiry_date"></td>
        </tr>
        <tr>
          <td><label for="previous_pass_class" style="color:black">Previous Pass Class:</label></td>
          <td>
        <select name="previous_pass_class" class="form-control">
          <option value="">none</option>
              <option value="first_class">First class</option>
              <option value="second_class">Second class</option>
          </select></td>
        </tr>
      </table>
      <div>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </div>
    <!-- <div>
        <label for="source">Source:</label>
        <input type="text" name="source" required>
      </div>
      
      <div>
        <label for="train_class">Train class:</label>
        <select name="train_class" required>
              <option value="first_class">First class</option>
              <option value="second_class">Second class</option>
          </select>
      </div>
      
      <div>
        <label for="period">Period:</label>
        <select name="period" required>
              <option value="monthly">Monthly</option>
              <option value="quarterly">Quarterly</option>
          </select>
      </div>
      

      <div>
        <label for="previous_pass_ticket_no">Previous Pass Ticket No:</label>
        <input type="number" name="previous_pass_ticket_no">
      </div>

      <div>
        <label for="previous_pass_issue_date">Previous Pass Issue Date:</label>
        <input type="date" name="previous_pass_issue_date" >
      </div>


      <div>
        <label for="previous_pass_expiry_date">Previous Pass Expiry Date:</label>
        <input type="date" name="previous_pass_expiry_date">
      </div>

      <div>
        <label for="previous_pass_class">Previous Pass Class:</label>
        <select name="previous_pass_class">
          <option value="">none</option>
              <option value="first_class">First class</option>
              <option value="second_class">Second class</option>
          </select>
      </div>


      <div>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </div> -->
    </form>
  </div>
</div >
        </div>


                                                <!--  -->
                                       <!--      Select Subject     -->
                                                <!--  -->  
  
                                                




      
  </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Attendance', ''],
  ['Present', <?php echo round($atpercent);?>],
  ['Absent', <?php echo 100-round($atpercent);?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Average Attendance', 'width':600, 'height':450};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>