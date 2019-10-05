<?php

  session_start();

  if(isset($_SESSION['myUserID']))
  {

  } else {
    header('location: index.php');
  }

  include("conn.php");



  if(isset($_SESSION['mysearch']))
  {
    $row = $_SESSION['mysearch'];
    $result = $conn->query($row);
    unset($_SESSION['mysearch']);
  } else {
    $getField = $conn->real_escape_string($_GET['filter']);
    $read = "SELECT * FROM ET_Books WHERE Field = '$getField' AND Buyer IS NULL";
    $result = $conn->query($read);
  }

  $read3 = "SELECT * FROM ET_Users";

  $result3 = $conn->query($read3);

  if(!$result) {
    echo $conn->error;
  }

  if(!$result3) {
    echo $conn->error;
  }

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

  <form action='search.php' method='post' enctype='multipart/form-data'>
  <div id=searchBar class='container'>
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

  <div id="itemList" class="container">
   	<?php

  		while($row = $result->fetch_assoc() ){

        $title_data = $row['Title'];
        $subj_data = $row['Subject'];
        $price_data = $row['Price'];
        $desc_data= $row['Description'];
        $bk_id = $row['id'];
        $image_data = $row['Image'];
        $buyer_data = $row['Buyer'];


  			echo "<div class='row cus'>

              <div class='col s2'>
                <img id='itemImage' src='bookImg/$image_data' alt='' class='responsive-img'>
              </div>

  						<div class='col s8'>
  							<h5>$title_data</h5>
                <span class='black-text'>
                <h6>$subj_data</h6>

                <br><h6>$desc_data</h6>
  							 <br>£$price_data
                 </span>
  						</div>

  						<div class='col s2'>
              <br>
              <br>
              <br>
  							<a href='textbook.php?book=$bk_id' class='btn-large waves-effect waves-light green lighten-1'>More</a>
  						</div>

  					</div>

  				<div class='divider'></div>";
  		}

  	?>

  </div>

  </body>

  </html>
