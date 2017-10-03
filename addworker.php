<?php session_Start();
  $report = "";
  $type = "alert-warning";
  include 'database.php';
  if(empty($_SESSION["username"])){
    $report = "Nie masz pozwolenia na wykonanie tej akcji!";
  }
  else{
    $login = $_POST["login"];
    if(
      empty($_POST["login"]) ||
      empty($_POST["password"]) ||
      empty($_POST["password2"]) ||
      empty($_POST["name"]) ||
      empty($_POST["surname"])
    ){
      $report = "Nie podano wszystkich informacji!";
    }
    else if($_POST["password"] != $_POST["password2"]){
      $report = "Podane hasła nie zgadzają się!";
    }
    else if(($db->query("SELECT * FROM $workertable WHERE Login='$login'")->num_rows) > 0){
      $report = "Użytkownik o takim loginie już istnieje!";
    }
    else{
      $login = $_POST["login"];
      $password = md5($_POST["password"]);
      $name = $_POST["name"];
      $surname = $_POST["surname"];
      $db->query("INSERT INTO $workertable (ID, Login, Password, Name, Surname)
        VALUES (NULL, '$login', '$password', '$name', '$surname')");
      $report = "Pomyślnie dodano użytkownika!";
      $type = "alert-success";
    }
  }
  header("Location:index.php?page=login&msg=$report&type=$type");
  exit();
  ?>
