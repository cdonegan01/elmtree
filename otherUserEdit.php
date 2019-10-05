<?php

  session_start();

  include("conn.php");

  if(isset($_SESSION['adminStuff']))
  {

  } else {
    header('location: index.php');
  }

  $getid = $conn->real_escape_string($_GET['otherUserID']);

  $_SESSION['editingUser'] = $getid;

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

    <div class="nav-wr-apper container">
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
    echo "<form action='otherUserEditor.php' method='post' enctype='multipart/form-data'>
    <div class='container'>
    <h1 class='header center green-text text-lighten-2'>Admin: Editing Other User</h1>
    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class='col s8 signin'>
        <label for='email'><b>E-Mail</b></label>
        <input type='text' placeholder='Enter E-Mail' name='email' required>
      </div>
      <div class='col s2'>
        &nbsp
      </div>
    </div>

    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class='col s8 signin'>
        <label for='phoneNumber'><b>Phone Number</b></label>
        <input type='number' placeholder='Enter Phone Number' name='phoneNumber' required>
      </div>
      <div class='col s2'>
        &nbsp
      </div>
    </div>

    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class='file-field input-field'>
        <div class='btn waves-effect waves-light green lighten-1'>
          <span>Profile Picture</span>
          <input type='file' name='uploadimg' accept='image/*' required>
        </div>
        <div class='file-path-wrapper'>
          <input class='file-path validate' type='text'>
        </div>
      </div>
      <div class='col s2'>
        <button class='btn waves-effect waves-light green lighten-1' type='submit' name='submit'>Submit</button>
      </div>
    </div>

    </div>
    </form>";

   ?>

</body>

</html>
