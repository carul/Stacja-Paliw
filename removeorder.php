<?php
  session_start();
  error_reporting(E_ALL);
ini_set("display_errors", 1);
  include 'database.php';
  $report;
  $type = "alert-warning";
  if(!empty($_SESSION["username"])){
    if(!empty($_POST["tremove"])){
      $id = $_POST["tremove"];
      $db->query("DELETE FROM $ordertable WHERE ID=$id");
      $report = "Pomyślnie usunięto rekord";
      $type = "alert-success";
    }
    else{
      $report = "Nieprawidłowe zapytanie";
    }
  }
  else{
    $report = "Nie masz pozwolenia na wykonanie tej akcji!";
  }
  header("Location:index.php?page=history&msg=$report&type=$type");
  exit();
 ?>
