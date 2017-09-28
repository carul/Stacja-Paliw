<?php
  session_start();
  include 'database.php';
  $report;
  $type = "alert-info";
  if(!isset($_SESSION["username"])){
    if(!empty($_POST["login"]) && !empty($_POST["password"])){
      $login = $_POST["login"];
      $password = $_POST["password"];
      $password = md5($password);
      $find = $db->query("SELECT * FROM $workertable WHERE Login = '$login' AND Password = '$password'");
      if($find->num_rows > 0){
        $_SESSION["username"] = $login;
        $report = "Zalogowano poprawnie";
        $type = "alert-success";
        header("Location:index.php?msg=$report&type=$type");
        exit();
      }
      else{
        $report = "Nie ma takiego konta";
      }
    }
    else{
      $report = "Nie podano wszystkich danych";
      $type = "alert-warning";
    }
  }
  else{
    unset($_SESSION["username"]);
    $report = "Wylogowano pomyślnie";
  }
  header("Location:index.php?page=login&msg=$report&type=$type");
  exit();
 ?>
