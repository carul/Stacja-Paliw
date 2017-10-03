<?php session_Start();
  $report = "";
  $type = "alert-warning";
  include 'database.php';
  if(empty($_SESSION["username"])){
    $report = "Nie masz pozwolenia na wykonanie tej akcji!";
  }
  else{
    if(
      empty($_POST["pswd1"]) ||
      empty($_POST["pswd2"])
    ){
      $report = "Nie podano wszystkich informacji!";
    }
    else if ($_POST["pswd1"] != $_POST["pswd2"]){
      $report = "Podane hasła nie zgadzają się!";
    }
    else{
      $pswd = md5($_POST["pswd1"]);
      $lgd = $_SESSION["username"];
      $db->query("UPDATE $workertable SET Password='$pswd' WHERE Login='$lgd'");
      $report = "Pomyślnie zmieniono hasło!";
      $type = "alert-success";
    }
  }
  header("Location:index.php?page=options&msg=$report&type=$type");
  exit();
  ?>
