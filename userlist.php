<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['adminStuff']))
  {

  } else {
    header('location: index.php');
  }

  $read = "SELECT * FROM ET_Users ORDER BY User_ID DESC";

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

<div id="itemList" class="container">

  <ul class="collection with-header">
    <li class="collection-header"><h4>Users</h4></li>
 	<?php

		while($row = $result->fetch_assoc() ){

			$id = $row['User_ID'];
			$u_data = $row['Username'];

			echo "<a href='otherUser.php?otherUserID=$id' class='collection-item'>$u_data</a>";
		}

	?>

</div>

</body>

</html>
