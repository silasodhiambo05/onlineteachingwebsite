<?php
include 'core/init.php';
$myktf= $_SESSION['myktf'];
$mypassword=$_SESSION['mypassword'];
  
    if (empty($myktf)===true) {
      header("location: coach_login.php");
    }
    else
    {

      $sqls="SELECT names,dan_number FROM  coach WHERE dan_number='$myktf'";
          $results=mysqli_query($con,$sqls) or die(mysql_error());
          while($rows=mysqli_fetch_array($results))
              {
               $user=$rows['names'];
               $dan_number=$rows['dan_number'];
               
              }
        $_SESSION['myuser']=$user; 

      $sqls="SELECT club_name,county,coach,date_registered FROM  club WHERE coach_id='$myktf'";
          $results=mysqli_query($con,$sqls) or die(mysql_error());
          while($rows=mysqli_fetch_array($results))
              {
               $club=$rows['club_name'];
               $date_reg=$rows['date_registered'];
               $county=$rows['county'];
               
              }
         $_SESSION['club']=$club;
        $sqls="SELECT * FROM athlete WHERE club='$club'";
          $results=mysqli_query($con,$sqls) or die(mysql_error());
          $athletes=0;
          while($rows=mysqli_fetch_array($results))
              {
               $athletes=$athletes+1;
              }
         date_default_timezone_set('Africa/Nairobi');
      $now = new DateTime();
      $time = $now->format('H:i');
      $date = $now->format('Ymd');
       $sql="SELECT * FROM events WHERE counter_date>'$date'";
                  $result=mysqli_query($con,$sql) or die(mysql_error());
                  $events=0;
                  while($row=mysqli_fetch_array($result))
                   {
                       $events=$events+1;
                     } 

       $sql="SELECT * FROM club WHERE coach_id='$myktf'";
                  $result=mysqli_query($con,$sql) or die(mysql_error());
                  while($row=mysqli_fetch_array($result))
                   // $k=0;
                   {
                       $k=$row['coach_id'];
                       $statuss=$row['status'];
                       //$k=$k+1;
                     }                                   
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="bs/css/bootstrap.min.css">
<link rel="stylesheet" href="fa/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script src="bs/js/jquery-3.3.1.js"></script>
  <script src="jquery/cdnjs/jquery.min.js"></script>
  <script src="bs/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
  <script src="bs/js/bootstrapValidator.min.js"></script>
    <title>Complete Coach LTD</title>
    
</head>
<style>
    @media(max-width: 1000px){

      #rightlogo{
         display: none;
         width: 0px;
      }
</style>
<body>
<div id="heade">
<div class="container-fluid" id="header" style="margin-bottom:-10px;">


<div class="col-md-8">

<h3 style="color:black">Complete Coach LTD</h3>
<h4>Coach Panel</h4>

</div>

</div>
</div>
<div class="container-fluid">
  <h5 class="btn-success" style="text-align:right;"><span class="glyphicon glyphicon-user"></span> <?php echo $user;?> <a href="coach_login.php" style="color:red;"><span class="glyphicon glyphicon-off" ></span>...</a></h5> 
   
</div>
<div class="container-fluid" id="toolbar">
<nav class="navbar navbar-inverse" style="margin-top:-20px;">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span style="color:white;">Menu</span>
                               
      </button>
     
    <div class="collapse navbar-collapse" id="myNavbar" >
      <ul class="nav navbar-nav">
        <li class="active"><a href=""><span class="glyphicon glyphicon-home"></span> Home</a></li>
         <li class="dropdown" style="color:red;">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> My Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
               <li><a href="coach_details.php"><button class="btn" style="width:100%;border:none;">View Profile </button></a></li>
              
              
              <li><a href="edit_coach_details.php"><button class="btn" style="width:100%;border:none;">Edit Profile </button></a></li>
              <form action="" method="post">
              <li><input type="submit" class="btn" name="changePassword" value="Change Password" style="width:100%;border:none;"></li>
              
              </form>
          </ul>
          </li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-check"></span> Help<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <form action="" method="post">
              <li></li>
              
              </form>
          </ul>
          </li>
        
      </ul>
      
    </div>
    
  </div>
</nav>

</div>
<div class="container-fluid" style="margin-top:-20px;">

<div class="col-md-8">
<br>
<div id="magement_panel">
<?php
if (empty($k)=== true) {
  echo '<h3 class="btn-info">You seem to have no registered club. You need to register your club. </h3>';
  ?>
   <form action="" method="POST" style="text-align:center">
   <br>
   <br>
   <br>
     <input type="submit" value="Register your Club now" name="registerClub" class="btn btn-primary">
   </form>
  <?php
}
else
{
  if ($statuss=='0') {
    echo "<p class='btn-warning' style='text-align:center;'>Dear Coach ".$user.", your club ".$club." have not been approved because you have not paid club registration fees. Make this payment to activate your club which will also enable your member to register under this club.<br>Registration fees: Ksh.1000<br>Paybill number: 290***<br> Account number: ".$club."<br> Thanks</p>";
    
  }
  else
  {
  echo '<h3 class="btn-info">You are currently coach for '.$club.' Taekwondo.</h3>';
  
  ?>
  <br>
  <br>
  <div class="row">
  <div class="col-md-1 img-circle">
    
  </div>
  <div class="col-md-2 img-circle btn-primary" style="min-height:100px;color:white;text-align:center;font-size:2em;">
  <?php echo $athletes;?><br>Athletes
    
  </div>
  <div class="col-md-1 img-circle">
    
  </div>
  <div class="col-md-2 img-circle btn-primary" style="min-height:100px;color:white;text-align:center;font-size:2em;">
  <?php echo $events;?><br>Events
    
  </div>
  <div class="col-md-1 img-circle">
    
  </div>
  <div class="col-md-2 img-circle btn-primary" style="min-height:100px;color:white;text-align:center;font-size:2em;">
  <?php echo 0;?><br>Tickets
    
  </div>
  <div class="col-md-1 img-circle">
    
  </div>
    
  </div>

  <?php
}
}
//-------------------------------------------------------------------------management files
include 'viewAthlete.php';
include 'club_profile.php';
include 'coach_view_events.php';
include 'coach_post_message.php';
include 'club_registration.php';
//-------------------------------------------------------------------------management files

?>


</div>
</div>
<div class="col-md-2" style="min-height:450px;background:#ABC2CA" >
<h4 class="btn-info"><span class="glyphicon glyphicon-calendar"></span> Upcoming events</h4>
<?php
include 'current_event_posting.php';
?>
 
</div>
</div>
<div class="container-fluid">
    
    
</div>

<div class="container-fluid">

</div>

</body>
</html>
<?php
}
?>