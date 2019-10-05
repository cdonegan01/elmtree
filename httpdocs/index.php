<?php

  $host = "cdonegan01.lampt.eeecs.qub.ac.uk";
  $username = "cdonegan01";
  $password = "HlXYJ2W1k3FytTkv";
  $database = "cdonegan01";

  $mysqli = new mysqli($host, $username, $password, $database);

  if ($mysqli->connect_errno) {
    echo "Cannot connect to database".$mysqli->connect_errno;
  }

  $result = $mysqli->query("SELECT * FROM 64_Books ORDER BY bookPrice ASC");

 ?>


<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>64 Books</title>
  </head>
  <body>
    <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo right">books64sale</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="navText">Sale</a></li>
        <li><a href="navText">Books</a></li>
      </ul>
    </div>
  </nav>

  <script>
  $("https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js").ready(function(){
  $('.tooltipped').tooltip();
  });
  M.AutoInit();
  </script>

  <div class="container">

    <script>
    $(document).ready(function(){
    $('.tooltipped').tooltip();
  });
  </script>

    <?php

      while ($row=$result->fetch_assoc()) {
        $id = $row['id'];
        $title = $row['bookTitle'];
        $blurb = $row['bookDesc'];
        $price = $row['bookPrice'];

        echo "<div class='row'>
        <div class='col s10'>
        <h5>$title</h5>
        <p><b>£$price</b></p>
        </div>
         <div class='col s2'>
         <a class='btn tooltipped' data-position='left' data-tooltip=$blurb>More</a>
         </div>
        </div>";
      }

     ?>
   </div>
  </body>
</html>
