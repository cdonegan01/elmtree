<?php

  session_start();

  if(isset($_SESSION['myUserID']))
  {

  } else {
    header('location: index.php');
  }

  include("conn.php");
  $getid = $conn->real_escape_string($_GET['book']);

  $_SESSION['currentBook'] = $getid;

  $read =  "SELECT * FROM ET_Books WHERE id = '$getid'";

            //"SELECT ET_Books.id, ET_Users.Username, ET_Users.User_ID, ET_Books.Field, ET_Books.Title, ET_Books.Subject, ET_Books.Description,
           //ET_Books.Image, ET_Books.Price, ET_Books.Date_Posted, ET_Books.Interested_Party, ET_Books.Buyer FROM ET_Books
           //INNER JOIN
           //ET_Users
           //ON
           //ET_Books.id = ET_Users.User_ID
           //WHERE id = '$getid'";

  $read2 = "SELECT ET_Comments.Comment_ID, ET_Users.Username, ET_Comments.Comment, ET_Users.User_ID, ET_Comments.Assoc_Book, ET_Comments.Poster FROM ET_Comments
            INNER Join
            ET_Users
            ON
            ET_Comments.Poster = ET_Users.User_ID
            WHERE Assoc_Book = '$getid'";

  $result = $conn->query($read);

  if(!$result){
    echo $conn->error;
  }

    $username = $_SESSION['myusername'];

    $result2 = $conn->query($read2);
    $result3 = $conn->query($read2);

    if(!$result2){
      echo $conn->error;
    }

    $myUserID = $_SESSION['myUserID'];

    $buyer_Data = 0;

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

  <div id="itemPage" class="container">
    <?php
      while($row = $result->fetch_assoc() ){

        $title_data = $row['Title'];
        $subj_data = $row['Subject'];
        $price_data = $row['Price'];
        $desc_data= $row['Description'];
        $bk_id = $row['id'];
        $image_data = $row['Image'];
        $interest_data = $row['Interested_Party'];
        $buyer_data = $row['Buyer'];
        $date = $row['Date_Posted'];
        $sellerId = $row['Seller'];


        echo "<div class='row'>
              <div class='col s12'>
                <div class 'col s6'>
                <img id='itemImageOnPage' src='bookImg/$image_data' alt='' class='responsive-img'>
                </div>

                <div id='itemdata' class='col s6'>
                  <div class ='row cus'>
                  <h1 class='header center green-text text-lighten-2'>$title_data</h1>
                  <h3 class='header center col s12 light'>Subject: $subj_data</h3>
                  </div>
                  <div class = 'row cus cardItem'>
                  <P>Date Posted: $date
                  <p>Description: $desc_data
                  <p>Asking Price: £$price_data
                  <br>
                  <a href='otherUser.php?otherUserID=$sellerId' class='btn-large waves-effect waves-light green lighten-1'>Seller Page</a>
                  <br>";
                  if ($sellerId == $myUserID) {
                    if ($buyer_data == 0) {
                      echo "<form action='setBuyer.php' method='post'>
                      <div class='row cus signin'>
                        <h3>Set Buyer</h3>
                        <p>If you have agreed a sale with a buyer in the comment selection below, confirm the sale by selecting them below.</p>
                        <div class='col s8 input-field'>
                        <select class='browser-default' name='buyer' required>
                          <option value='' disabled selected>Choose Buyer</option>";
                            while($row = $result2->fetch_assoc() ){

                             $no = $row['User_ID'];
                             $name = $row['Username'];

                             echo "<option value='$no'>$name</option>";
                          }
                        echo "</select>
                      </div>
                         <button class='btn waves-effect waves-light green lighten-1' type='submit' name='submit'>Submit</button>
                      </div>
                    </form>";
                  } else {
                    echo "<h3>This Book has been Purchased!</h3>";
                  }

                  }
                  echo "</div>

                </div>

              </div>
              </div>";


      }

    ?>
        </div>

    <div class="container">
      <h3 class="header center green-text text-lighten-2">Comments</h3>
        <div class="row center">
          <h5 class="header col s12 light">Here, you may discuss this item, and make offers to the seller.</h5>
          <h5 class="header col s12 light">You must have made at least one comment to be considered!</h5>
        </div>
        <form action='commenter.php' method='post' enctype='multipart/form-data'>
        <div id=commentBar class='container'>
        <div class='row col s12'>
          <div class='col s9 signin'>
            <label for='comment'><b>Enter your comment below, then hit submit!</b></label>
            <input type='text' placeholder='Join the conversation about this textbook!' name='comment' required>
          </div>
          <div class='col s2'>
            <button class='btn waves-effect waves-light green lighten-1' type='submit' name='submit'>Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="container">

      <?php
      while($row = $result3->fetch_assoc()){

        $poster_id = $row['User_ID'];
        $comment = $row['Comment'];
        $poster = $row['Username'];

        echo "<div class='row cus'>

              <div class='col s2'>
                <h6>$poster: </h6>
              </div>

              <div class='col s10'>
                <p>$comment</p>
              </div>

            </div>

          <div class='divider'></div>";
      }
       ?>
    </div>

</body>

</html>
