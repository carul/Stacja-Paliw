<?php
  session_start();
  error_reporting(E_ALL);
ini_set('display_errors', 1);
  $report = "";
  $type = "";
  if(!empty($_SESSION["username"])){
    include 'database.php';
    $injson = json_decode($_POST["added"]);
    if(json_last_error() != 0){
      $report = "Coś poszło nie tak przy analizie zapytania";
      $type = "alert-warning";
    }
    else{
      $usr = $_SESSION["username"];
      $np = $_POST["added"];
      $disc = $_POST["discount"];
      if(empty($disc))
        $disc = 0;
      $userid = $db->query("SELECT ID from $workertable where Login = '$usr'")->fetch_row()[0];
      if($db->query("INSERT INTO $ordertable (ID, SellerID, Products, Discount) VALUES (NULL, $userid, '$np', $disc)") == true){
        $report = "Pomyślnie dodano zamówienie";
        $type = "alert-success";
      }
      else{
        $report = "Coś poszło nie tak przy analizie zapytania"  . mysqli_error($db);
        $type = "alert-warning";
      }
    }
  }
  else{
    $report = "Nie możesz tego zrobić jako użytkownik niezalogowany";
    $type = "alert-warning";
  }
  header("Location:index.php?msg=$report&type=$type");
  exit();
 ?>
