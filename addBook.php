<?php

  session_start();

  if(isset($_SESSION['sellerStuff']))
  {

  } else {
    header('location: index.php');
  }


  include("conn.php");

  $username = $_SESSION['myusername'];
  $password = $_SESSION['myPassword'];

  $read = "SELECT * FROM ET_Users WHERE Username = '$username'";
  $result = $conn->query($read);

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


    "<div id='index-banner' class='container'>
      <div class='section no-pad-bot'>
        <div class='container'>
          <h1 class='header center green-text text-lighten-2'>Adding New Book</h1>
        </div>
      </div>
    </div>

    <form action='bookAdder.php' method='post' enctype='multipart/form-data'>
    <div class='container'>
    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class='col s8 signin'>
        <label for='title'><b>Title of Book</b></label>
        <input type='text' placeholder='Please enter the title of the book' name='title' required>
      </div>
      <div class='col s2'>
        &nbsp
      </div>
    </div>

    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class="col s8 input-field">
        <select class="browser-default" name="field" required>
          <option value="" disabled selected>Choose which field best suits the textbook</option>
          <option value='1'>Arts & Humanities</option>
          <option value='2'>Business & Management</option>
          <option value='3'>Engineering & Technology</option>
          <option value='4'>Science & Medicine</option>
        </select>
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
        <label for='subject'><b>Book Subject</b></label>
        <input type='text' placeholder='Please enter what subject the textbook is based in' name='subject' required>
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
        <label for='description'><b>Description</b></label>
        <input type='text' placeholder='Please enter a somewhat detailed description of the item (author, condition, etc)' name='description' required>
      </div>
      <div class='col s2'>
        &nbsp
      </div>
    </div>

    <div class='row'>
      <div class='col s2'>
        &nbsp
      </div>
      <div class='col s8 file-field input-field'>
        <div class='btn waves-effect waves-light green lighten-1'>
          <span>Image of Item</span>
          <input type='file' name='uploadimg' required>
        </div>
        <div class='file-path-wrapper'>
          <input class='file-path validate' type='text'>
        </div>
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
        <label for='price'><b>Price</b></label>
        <input type='number' placeholder='Please enter your chosen price of the item in format 00.00' name='price' step=".01" required>
      </div>
      <div class='col s2'>
        &nbsp
      </div>
    </div>

    <div class='row'>
      <div class='col s5'>
        &nbsp
      </div>
      <div class='col s2'>
        <button class='btn waves-effect waves-light green lighten-1' type='submit' name='submit'>Submit</button>
      </div>
      <div class='col s5'>
        &nbsp
      </div>
    </div>

    </div>
    </form>

</body>

</html>
