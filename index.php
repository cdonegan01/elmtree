<?php

  include("conn.php");

  session_start();

  if(isset($_SESSION['myUserID']))
  {
    header('location: user.php');
  }

  $read = "SELECT * FROM ET_Books WHERE Buyer IS NULL ORDER BY Date_Posted DESC";

  $read2 = "SELECT * FROM ET_Fields ORDER BY Field_Name";

  $result = $conn->query($read);
  $result2 = $conn->query($read2);

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

  <div id="index-banner" class="container">
    <div class="section no-pad-bot">
      <div class="container">
        <h1 class="header center green-text text-lighten-2">Welcome to ElmTree, Northern Ireland's No.1 Pre-Loved Textbook marketplace.</h1>
        <div class="row center">
          <h5 class="header col s12 light">The life of a student is a stressful one. Why add to that stress worrying about expensive textbooks?</h5>
          <h5 class="header col s12 light">That's why we offer USED TEXBOOKS from your fellow students at low prices.</h5>
          <h5 class="header col s12 light">Whether you're a new student looking to save some money on your reading list, or a graduate looking to offload their old burdens, ELMTREE is the place to be.</h5>
        </div>
        <div class="row center">
          <a href="login.php" class="btn-large waves-effect waves-light green lighten-1">Join Now</a>
        </div>
      </div>
    </div>
  </div>s

<div id="itemList" class="container">

  <div class="row">
    <h3>Our Newest Items</h3>
  </div>
 	<?php

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

						<div class='col s10'>
							<h5>$title_data</h5>
              <br><h6>$book_d</h6>
							 <br>&pound$p_data
						</div>

					</div>

				<div class='divider'></div>";
		}

	?>

</div>

</body>

</html>
