<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['myusername']))
  {

  } else {
    header('location: index.php');
  }

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

             $_SESSION['myUserID'] = $userId;
             $_SESSION['myType'] = $userType;

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
                        if($userType == "3") {
                          $_SESSION['adminStuff'] = 3;
                          echo "<div class='col s4 signin'>
                            <a href='userlist.php' class='btn-large waves-effect waves-light green lighten-1'>Manage Users</a>
                            <br>
                            <br>
                            <a href='userEdit.php' class='btn-large waves-effect waves-light green lighten-1'>Edit Info</a>
                            <br>
                            <br>
                            <a href='addBook.php' class='btn-large waves-effect waves-light green lighten-1'>Sell New Textbook</a>
                            <br>
                            <br>
                            <a href='signout.php' class='btn-large waves-effect waves-light green lighten-1'>Sign Out</a>
                          </div>";
                        }
                        if($userType == "2") {
                          $_SESSION['sellerStuff'] = 2;
                          echo "<div class='col s4 signin'>
                            <br>
                            <br>
                            <a href='userEdit.php' class='btn-large waves-effect waves-light green lighten-1'>Edit Info</a>
                            <br>
                            <br>
                            <a href='addBook.php' class='btn-large waves-effect waves-light green lighten-1'>Sell New Textbook</a>
                            <br>
                            <br>
                            <a href='signout.php' class='btn-large waves-effect waves-light green lighten-1'>Sign Out</a>
                            <br>
                            <br>
                          </div>";
                        }
                        if($userType == "1") {
                          echo "<div class='col s4 signin'>
                            <a href='userEdit.php' class='btn-large waves-effect waves-light green lighten-1'>Complete Registration</a>
                            <br>
                            <br>
                            <a href='signout.php' class='btn-large waves-effect waves-light green lighten-1'>Sign Out</a>
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

  <div class="container">

    <div id="buttonHolder" class = "col s12 row card-panel grey lighten-5 z-depth-1">
      <div id="myBooksButton" class="col s6 signin">
        <a href='myBooks.php' class='btn-large waves-effect waves-light green lighten-1'>My Listed Items</a>
      </div>
      <div id="myPurchasesButton" class="col s6 signin">
        <a href='myPurchases.php' class='btn-large waves-effect waves-light green lighten-1'>My Purchased Items</a>
      </div>
    </div>

    <h1 class="header center green-text text-lighten-2">The Marketplace</h1>

    <!--
    <div class="input-field">
      <input id="search" type="search" required>
      <label class="label-icon" for="search"><i class="material-icons">search</i></label>
      <i class="material-icons">close</i>
    </div>
  -->

  <form action='search.php' method='post' enctype='multipart/form-data'>
  <div id=searchBarUser class='container'>
  <div class='row'>
    <div class='col s6 signin'>
      <label for='query'><b>Enter keyword(s) to search our database of textbooks.</b></label>
      <input type='text' placeholder='What would you like to search for?' name='query' required>
    </div>
    <div class="col s4 input-field">
    <select class="browser-default" name="filter" required>
      <option value="" disabled selected>Choose which field to search in</option>
      <option value='1'>Arts & Humanities</option>
      <option value='2'>Business & Management</option>
      <option value='3'>Engineering & Technology</option>
      <option value='4'>Science & Medicine</option>
    </select>
  </div>
    <div class='col s2'>
      <button class='btn waves-effect waves-light green lighten-1' type='submit' name='submit'>Submit</button>
    </div>
  </div>
</div>
</form>

    <div class="row signinBar">
      <div id="humanities" class="col s6 signin">
        <h4>Arts & Humanities</h4>
        <h5>Starving artist? Click here for deals on Humanities textbooks!</h5>
          <a href='booklist.php?filter=1' class='btn waves-effect waves-light green lighten-1'>Browse</a>
      </div>

      <div id="business" class="col s6 signin">
        <h4>Business & Management</h4>
        <h5>Prove how good you are with money by makin use of these deals!</h5>
        <a href='booklist.php?filter=2' class='btn waves-effect waves-light green lighten-1'>Browse</a>
      </div>
  </div>
  <div id="wan" class="row signinBar">
    <div id="technology" class="col s6 signin">
      <h4>Engineering & Technology</h4>
      <h5>Don't let the gears of capitalism grind you down! Save on textbooks today!</h5>
        <a href='booklist.php?filter=3' class='btn waves-effect waves-light green lighten-1'>Browse</a>
    </div>

    <div id="science" class="col s6 signin">
      <h4>Science & Medicine</h4>
      <h5>It's not rocket science: but these textbooks are, and they're yours for cheap!</h5>
      <a href='booklist.php?filter=4' class='btn waves-effect waves-light green lighten-1'>Browse</a>
    </div>
  </div>

</body>

</html>
