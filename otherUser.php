<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['myUserID']))
  {

  } else {
    header('location: index.php');
  }

  $getid = $conn->real_escape_string($_GET['otherUserID']);

  if($getid == $_SESSION['myUserID']) {
    header('location: user.php');
  } else {

  }

  $read = "SELECT * FROM ET_Users WHERE User_ID = '$getid'";
  $result = $conn->query($read);

  $myId = $_SESSION['myType'];


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Page Title -->
  <title>ElmTree</title>

	<!-- Compiled and minified CSS -->
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

	<script>
	   $(function(){
      $(".dropdown-trigger").dropdown();
			$('.tooltipped').tooltip();
	   });
	</script>

<body>
  <div class="navbar-fixed">
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="booklist.php?filter=1">Arts & Humanities</a></li>
      <li><a href="booklist.php?filter=2">Business & Management</a></li>
      <li><a href="booklist.php?filter=3">Engineering & Technology</a></li>
      <li><a href="booklist.php?filter=4">Science & Medicine</a></li>
    </ul>
    <nav role="navigation">

    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo left"><i class="material-icons">nature_people</i>Elmtree</a>
       <ul id="nav-mobile" class="right">
         <?php
         if(isset($_SESSION['myusername']))
         {
           echo "<li><a href='user.php'>My Profile</a></li>";
         } else {
           echo "<li><a href='login.php'>Log In/Register</a></li>";
         }
          ?>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Categories<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><form>
       </form></li>
      </ul>
    </div>
  </nav>
 </div>

  <div class="container">
    <div class="row">
      <?php

		    while($row = $result->fetch_assoc()){

			       $name = $row['Username'];
             $email = $row['Email'];
             $institute = $row['Learning_Institute'];
             $Phone_Number = $row['Phone_Number'];
             $ProfilePic = $row['Profile_Picture'];
             $userType = $row['User_Type'];
             $userId = $row['User_ID'];
             $userRating = $row['User_Rating'];

			          echo "<div class='col s12'>
                      <div class='card-panel grey lighten-5 z-depth-1'>
                      <div class='row valign-wrapper'>
                      <div class='col s2'>
                      <img src='img/$ProfilePic' alt='' class='circle responsive-img'>
                      </div>
                      <div class='col s6 signin'>
                      <span class='black-text'>
                        <h1>$name</h1>";

                        $read2 = "SELECT * FROM ET_Institutions WHERE Institution_ID = '$institute'";
                        $result2 =$conn->query($read2);
                        while($row = $result2->fetch_assoc()){
                          $institute = $row['Institution_Name'];
                          echo "<p class='title'>Studying at $institute</p>";
                        }

                  echo "<p>Phone Number: $Phone_Number</p>
                        <p>Email: $email</p>
                        <p>Likes: $userRating</p>
                        </span>
                        </div>";
                        if($myId == "3") {
                          echo "<div class='col s4 signin'>";
                          if(isset($_SESSION['likedUser']))
                          {
                             echo "<a href='userLiker.php?otherUserID=$getid' class='disabled btn-large waves-effect waves-light green lighten-1'>Like User</a>";
                          } else {
                            echo "<a href='userLiker.php?otherUserID=$getid' class='btn-large waves-effect waves-light green lighten-1'>Like User</a>";
                          }
                          echo "<br>
                            <br>
                            <a href='otherUserEdit.php?otherUserID=$getid' class='btn-large waves-effect waves-light green lighten-1'>Alter User Info</a>
                            <br>
                            <br>
                          </div>";
                        } else {
                          echo "<div class='col s4 signin'>
                            <br>
                            <br>
                            <br>";
                            if(isset($_SESSION['likedUser']))
                            {
                               echo "<a href='userLiker.php?otherUserID=$getid' class='disabled btn-large waves-effect waves-light green lighten-1'>Like User</a>";
                            } else {
                              echo "<a href='userLiker.php?otherUserID=$getid' class='btn-large waves-effect waves-light green lighten-1'>Like User</a>";
                            }
                            echo "<br>
                            <br>
                            <br>
                          </div>";
                        }
                      echo
                      "</div>
                      </div>
                      </div>
                      ";

		   }
	?>
  </div>
</div>

</body>

</html>
