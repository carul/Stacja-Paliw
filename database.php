<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  $db = new mysqli("localhost", "root", "password", "glancoil");
  if($db->connect_error)
  {
    die("Błąd łączenia z bazą danych: " . $db->connect_error);
  }
  //sprawdź standardowe rekordy bazy danych, które muszą być
  $workertable = "workers";
  $sql = "CREATE TABLE IF NOT EXISTS $workertable (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Login VARCHAR(100) NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Name text NOT NULL,
    Surname text NOT NULL
  )";
  $db->query($sql);
  $num = $db->query("SELECT * FROM $workertable")->num_rows;
  if($num == 0 ){
    $passwd = md5("test");
    $db->query("INSERT INTO $workertable (ID, Login, Password, Name, Surname)
    VALUES (NULL, 'test', '$passwd', 'Jan', 'Kowalski')");
  }
  $ordertable = "orders";
  $sql = "CREATE TABLE IF NOT EXISTS $ordertable (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SellerID INT(11) UNSIGNED NOT NULL,
    Products text NOT NULL,
    Discount INT(11) NOT NULL
  )";
  $db->query("$sql");
  $producttable = "products";
  $sql = "CREATE TABLE IF NOT EXISTS $producttable (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Cost float NOT NULL,
    Name text NOT NULL,
    Category text NOT NULL
  )";
  $db->query($sql);
  $num = $db->query("SELECT * FROM $producttable")->num_rows;
  if($num == 0){
    $db->query("INSERT INTO $producttable (ID, Cost, Name, Category)
    VALUES (NULL, 4.36, 'PB-95', 'Paliwo')");
    $db->query("INSERT INTO $producttable (ID, Cost, Name, Category)
    VALUES (NULL, 4.15, 'ON', 'Paliwo')");
    $db->query("INSERT INTO $producttable (ID, Cost, Name, Category)
    VALUES (NULL, 2, 'LPG', 'Paliwo')");
    $db->query("INSERT INTO $producttable (ID, Cost, Name, Category)
    VALUES (NULL, 4.6, 'PB-98', 'Paliwo')");
  }
 ?>
