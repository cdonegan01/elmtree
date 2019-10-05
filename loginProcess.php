<?php

  session_start();

  include("conn.php");

  $user = $_POST['username'];
  $pass = $_POST['password'];

  $checkuser = "SELECT * FROM ET_Users WHERE Username='$user'";

  $result = $conn->query($checkuser);

  $num = $result -> num_rows;

  if($num > 0 ) {
    $read = "SELECT * FROM ET_Users WHERE Username = '$user'";
    $result = $conn->query($read);

    while($row = $result->fetch_assoc()){
         $name = $row['Username'];
         $password = $row['Password'];
         $email = $row['Email'];
         $institute = $row['Learning_Institute'];
         $Phone_Number = $row['Phone_Number'];
         $ProfilePic = $row['Profile_Picture'];
    }

    if ($password == "$pass"){
          unset($_SESSION['loginError']);
          $_SESSION['myusername'] = $user;
          $_SESSION['myPassword'] = $pass;

          header('location: user.php');
    }else{
      $_SESSION['loginError'] = "Apologies, that password is not the one registered to that username.";
      header('location: login.php');
    }
  }else{
    $_SESSION['loginError'] = "That Username/Password combination is not recognized.";
    header('location: login.php');
  }

?>
