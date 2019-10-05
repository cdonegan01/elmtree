<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['myUserID']))
  {
    header('location: user.php');
  }

  $read = "SELECT * FROM ET_Books ORDER BY Date_Posted";

  $read2 = "SELECT * FROM ET_Fields ORDER BY Field_Name";

  $read3 = "SELECT * FROM ET_Institutions ORDER BY Institution_ID";

  $result = $conn->query($read);
  $result2 = $conn->query($read2);
  $result3 = $conn->query($read3);

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
        <li><form>
       </form></li>
      </ul>
    </div>
  </nav>
 </div>

 <div class="loginRegister container">

     <div class="row signinThing">
       <form action="loginProcess.php" method="post">
       <div class="col s6 signin">
         <h3>Login</h3>
         <h4>Please enter your details to login to an existing account.</h4>
         <?php
         if(isset($_SESSION['loginError']))
         {
            echo("<h5>{$_SESSION['loginError']}"."</h5>");
         }
         ?>
         <hr>
         <label for="username"><b>Username</b></label>
         <input type="text" placeholder="Enter Username" name="username" required>

         <label for="password"><b>Password</b></label>
         <input type="password" placeholder="Enter Password" name="password" required>

         <button class="btn waves-effect waves-light green lighten-1" type="submit" name="submit">Submit</button>
       </div>
     </form>
     <form action="register1.php" method="post">
     <div class="col s6 signin">
       <h3>Register</h3>
       <h4>Please fill in this form to create an account.</h4>
       <?php
       if(isset($_SESSION['registerError']))
       {
          echo("<h5>{$_SESSION['registerError']}"."</h5>");
       }
       ?>
       <hr>
       <label for="username"><b>Username</b></label>
       <input type="text" placeholder="Enter Username" name="username" required>

       <label for="password"><b>Password</b></label>
       <input type="password" placeholder="Enter Password" name="password" required>

       <div class="col s8 input-field">
       <select class="browser-default" name="instiution" required>
         <option value="" disabled selected>Choose your Learning Instiution</option>
         <?php

           while($row = $result3->fetch_assoc() ){

            $no = $row['Institution_ID'];
            $name = $row['Institution_Name'];

            echo "<option value='$no'>$name</option>";
         }
          ?>
       </select>
     </div>
        <button class="btn waves-effect waves-light green lighten-1" type="submit" name="submit">Submit</button>
     </div>
   </form>

     </div>

 </div>



</body>

</html>
