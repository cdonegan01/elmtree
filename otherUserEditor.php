<?php

    session_start();

    if(isset($_SESSION['adminStuff']))
    {

    } else {
      header('location: index.php');
    }

    include("conn.php");

    $uploads_dir = '/img';

    $userId = $_SESSION['editingUser'];

    $numberData = $conn->real_escape_string($_POST["phoneNumber"]);
    $emaildata = $conn->real_escape_string($_POST["email"]);

    $filename = $_FILES['uploadimg']['name'];

    $filetmp = $_FILES['uploadimg']['tmp_name'];

    move_uploaded_file($filetmp, "img/".$filename);

    $insertsql = "UPDATE ET_Users SET Email = '$emaildata', Phone_Number = '$numberData', Profile_Picture = '$filename' WHERE User_ID = '$userId'";

    $result = $conn->query($insertsql);


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

  <?php
  if(!$result){
    echo $conn->error;
  }else{
    echo "<div id='index-banner' class='container'>
      <div class='section no-pad-bot'>
        <div class='container'>
          <h1 class='header center green-text text-lighten-2'>This user has been successfully edited.</h1>
          <div class='row center'>
            <div class='row center'>
              <a href='otherUser.php?otherUserID=$userId' class='btn-large waves-effect waves-light green lighten-1'>Check it Out</a>
            </div>
          </div>
        </div>
      </div>
    </div>";
  }

   ?>

</body>

</html>
