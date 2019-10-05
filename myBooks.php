<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['myUserID']))
  {

  } else {
    header('location: index.php');
  }

  $userId = $_SESSION['myUserID'];

  $read = "SELECT * FROM ET_Books WHERE Seller = '$userId' ORDER BY Date_Posted DESC";

  $result = $conn->query($read);

  $num2 = $result -> num_rows;

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

  <div class="row">
    <h1 class="header center green-text text-lighten-2">Your Listed Books</h1>
  </div>
 	<?php
    if($num2 < 1 ) {
      echo "<h5 class='header col s12 center light'>You haven't listed any items yet!</h5>";
    }else{
      while($row = $result->fetch_assoc() ){

  			$title_data = $row['Title'];
  			$p_data = $row['Price'];
  			$book_d= $row['Description'];
  			$bk_id = $row['id'];
        $bk_seller = $row['Seller'];
        $image_data = $row['Image'];

  			echo "<div class='row cus'>

              <div class='col s2'>
                <img id='itemImage' src='bookImg/$image_data' alt='' class='responsive-img'>
              </div>

  						<div class='col s8'>
  							<h5>$title_data</h5>
                <br><h6>$book_d</h6>
  							 <br>&pound$p_data
  						</div>

  						<div class='col s2'>
              <br>
              <br>
  							<a href='textbook.php?book=$bk_id' class='btn-large waves-effect waves-light green lighten-1'>More</a>
  						</div>

  					</div>

  				<div class='divider'></div>";
  		}

    }

	?>

</div>

</body>

</html>
