<?php
require 'header.php';// session_start();
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
   ?>    <script type="text/javascript">
                      alert("You successfully Logout.");
                      window.location = "index.php";
                  </script>
             <?php      
}
?>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>STUDENT</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
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
  $Department=$row['department'];
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
  <div class="w3-top">
    <div class="w3-bar w3-white w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="studenttest.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue" >HOME</a>
    <a href="attendancefront_student.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-blue">ATTENDANCE</a>
    <a href="examfront2.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-blue">EXAMINATION</a>
    <a href="feedback/feedback_form_student2.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-blue">FEEDBACK</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More"><i class="fa fa-train"></i>RAILWAY CONCESSION</button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <?php
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
            echo '<a class="w3-bar-item w3-button" href="railwayformfront.php" style="text-decoration:none;">Apply for Concession</a>';
          }

      // $msg1="You have already applied for the railway concession";
      // // $date=$row2['date'];
   // //    $expiry_date=$row2['expiry_date'];
      // echo $msg1." On ".$date.". You can apply again after ".$expiry_date.".";

    }    
    else
    {
        echo '<a class="w3-bar-item w3-button" href="railwayformfront.php" style="text-decoration:none;">Apply for Concession</a>';
    }
        
?>

        <!-- <a href="#" class="w3-bar-item w3-button">Merchandise</a>
        <a href="#" class="w3-bar-item w3-button">Extras</a>
        <a href="#" class="w3-bar-item w3-button">Media</a> -->
      </div>
    </div>
    <!-- <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-blue">MANAGE CLASSROOM</a> -->
    <!-- <button class="w3-button w3-blue w3-right w3-padding-large w3-hide-small w3-hover-grey w3-round-xlarge" ><a href="logout.php" style="text-decoration: none;color: white;">Logout</a></button> -->
    <div class="w3-dropdown-hover w3-hide-small w3-right">
      <button class="w3-padding-large w3-button" title="More"><i class="fa fa-user"></i><?php echo " ".$fname." ".$lname ;?></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="logout.php" class="w3-bar-item w3-button" style="text-decoration: none;">Logout</a>
         <a href="cpass.php" class="w3-bar-item w3-button" style="text-decoration: none;">Change Password</a>
      </div>
    </div>
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px;">
  <a href="attendancefront_student.php" class="w3-bar-item w3-button w3-padding-larg w3-hover-blue " >ATTENDANCE</a>
  <a href="examfront2.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue" >EXAMINATION</a>
  <a href="cpass.php" class="w3-bar-item w3-button w3-padding-large w3-hover-blue" >CHANGE PASSWORD</a>
 

  <button class="w3-bar-item w3-button w3-white w3-padding-large  w3-hover-blue"><a href="logout.php" style="text-decoration: none;color: black;">LOGOUT</a></button>
  <div class="w3-dropdown-hover ">
  <button class="w3-padding-large w3-button" title="More"><i class="fa fa-train"></i>RAILWAY CONCESSION </button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <?php
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
            echo '<a class="w3-bar-item w3-button" href="railwayformfront.php" style="text-decoration:none;">Apply for Concession</a>';
          }

      // $msg1="You have already applied for the railway concession";
      // // $date=$row2['date'];
   // //    $expiry_date=$row2['expiry_date'];
      // echo $msg1." On ".$date.". You can apply again after ".$expiry_date.".";

    }    
    else
    {
        echo '<a class="w3-bar-item w3-button" href="railwayformfront.php" style="text-decoration:none;">Apply for Concession</a>';
    }
        
?>
      </div>
  </div>
</div>

<!-- Page content -->

<div class=" w3-content w3-theme  w3-padding-64 " style="max-width:2000px;margin-top:46px" >

  <!-- Automatic Slideshow Images -->
  

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
     
  
<div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <center><div class="w3-display-container" style="width:50%;">
        <br>
          <!-- <img src="/w3images/avatar_hat.jpg" style="width:100%" alt="Avatar"> -->
          <?php if($istatus==0){echo "<img src='uploads/default.png' style='width:100%'' alt='Avatar'><br>
                <center><form action='uploadi2.php' method='POST' enctype='multipart/form-data'>
            <input type='file' name='file' class='btn btn-primary'></center>
            <br><br>

    <center><Button type='submit' name='submit1' class='btn btn-primary'>Upload Image</button></center>
  </form>";
      }
      else{
        echo "<img src='uploads/profile".$users.$student_id.".png' style='width:100%'' alt='Avatar'><br>";
      }?>
          
        <br></div></center>
        <div class="w3-container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-blue"></i>Student</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-blue"></i>Mumbai,India</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-blue"></i><?php echo $email; ?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-blue"></i><?php echo $row['Mobile_NO']?></p>
          <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-blue"></i><?php echo $row['dob']?></p>
          <hr>

          <br>

          
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <br>
         <table class="table">
        <tr>
          <td ><B>Student Id:</B></td>
          <td><?php echo $student_id;?></td>
        </tr>
        <tr>
          <td><B>Name:</B></td>
          <td><?php echo $fname." ".$lname;?></td>
        </tr>  
        <tr>
          <td><B>Email:</B></td>
          <td><?php echo $email; ?></td>
        </tr>
        <tr>
          <td><i class="fa fa-phone"></i><B>Mobile Number:</B></td>
          <td><?php echo $row['Mobile_NO']; ?></td>
        </tr>
        <tr>
          <td><B>Department:</B></td>
          <td><?php echo $Department ;?></td>
        </tr>
        <tr>
          <td><B>Class:</B></td>
          <td><?php echo $class ;?></td>
        </tr>
        <tr>
          <td><B>Division:</B></td>
          <td><?php echo $div ;?></td>
        </tr>
        <tr>
          <td><B>Roll number:</B></td>
          <td><?php echo $rollno ;?></td>
        </tr>
        <tr>
          <td><i class="fa fa-calender"></i><B>Birthdate:</B></td>
          <td><?php echo $dob ;?></td>
        </tr>
        <tr>
          <td><B>Caste</B></td>
          <td><?php echo $caste;?></td>
        </tr>
      </table>

      </div>

      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-blue"></i>Education</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>10th/SSC </b></h5>
          <h6 class="w3-text-blue"><?php echo $row['ssc']." %"; ?></h6>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>HSC/Diploma</b></h5>
          <h6 class="w3-text-blue"><?php echo $row['hsc']."%" ?></h6>
          
          <hr>
        </div>
      </div>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>



  
     <footer class="w3-container w3-blue w3-center w3-margin-top">
  <p>Datta Meghe College of Engineering</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by DMCE</p>
</footer>

  



  <script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>