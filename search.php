<?php
    session_start();

    if(isset($_SESSION['myUserID']))
    {

    } else {
      header('location: index.php');
    }

    include("conn.php");

    $query = $conn->real_escape_string($_POST['query']);
    $getFilter = $conn->real_escape_string($_POST['filter']);

    $raw_results = "SELECT ET_Books.id, ET_Fields.Field_Name, ET_Books.Field, ET_Books.id, ET_Books.Title, ET_Books.Subject, ET_Books.Description, ET_Books.Image, ET_Books.Price, ET_Books.Buyer
             FROM ET_Books
             INNER JOIN
             ET_Fields
             ON
             ET_Books.id = ET_Fields.id WHERE Title LIKE '%$query%' OR Subject LIKE '%$query%' OR Description LIKE '%$query%' AND Buyer = NULL AND Field = $getFilter";

      $_SESSION['mysearch'] = $raw_results;

      header('location: booklist.php');

 ?>
