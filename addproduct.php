<?php session_Start();
  $report = "";
  $type = "alert-warning";
  include 'database.php';
  if(empty($_SESSION["username"])){
    $report = "Nie masz pozwolenia na wykonanie tej akcji!";
  }
  else{
    if(
      empty($_POST["name"]) ||
      empty($_POST["price"]) ||
      empty($_POST["type"])
    ){
      $report = "Nie podano wszystkich informacji!";
    }
    else{
      $name = $_POST["name"];
      $price = $_POST["price"];
      $category = $_POST["type"];
      $db->query("INSERT INTO $producttable (ID, Cost, Name, Category) VALUES
        (NULL, $price, '$name', '$category')");
      $report = "Pomyślnie dodano produkt!";
      $type = "alert-success";
    }
  }
  header("Location:index.php?page=new&msg=$report&type=$type");
  exit();
  ?>
