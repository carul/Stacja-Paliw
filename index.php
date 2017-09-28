<?php session_start();
 include 'database.php';
 $id = -1;
 $nm = "";
 if(!empty($_SESSION["username"])){
   $nm = $_SESSION["username"];
   $find = $db->query("SELECT * FROM $workertable WHERE Login = '$nm'");
   $id = $find->fetch_row()[0];
 }
 ?>
<!DOCTYPE html>
<html lang="pl">
<html>
  <head>
    <title>GlancOil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&amp;subset=latin-ext" rel="stylesheet">
  </head>
  <style>
    .dbtn{
      display: block;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAACSVBMVEUAAACqqqrhQBTRX0CqqqrhQBSWlpbW1tbr6+uZmZnV1dWVlZXg4OCcnJzX19e+vr7l5eWampq/v7+7u7uXl5fDw8PZ2dm6urqlpaX39/fCwsLq6urj4+Pf39/3kSvv7++np6fY2Nj2hyjwWRqhoaHGxsaFhYXBwcHk5OTe3t6QkJCHh4fo6OiMjIzAwMCdnZ2BgYH8/Pzt7e3c3NympqaLi4vs7OypqanZ3eDS1tn6uW3V2dyYmJjvTxfU2Nva2tqkpKTX3N6ioqLQ1djV2t2IiIjb29u9vb2RkZHd3d3////5smuEhISvr6/9/f2Tk5P2k2HEZUvQ0NDLy8vT09PFxcWoqKji4uL5q2l/f3+rq6ve4+ba3uH1i1/KbFLh4eGgoKCJiYnzcCGbm5v0fCXPz8/yZB3U1NSKiorP1Nb5+fmjpqicnqHz8/P09PTAwsPU2dzi5ee/wMHp6eni5ujEyMu4uLjp7O3S1di/wcLJzdDR1de5vb/MzMy3ubrP09bg5Obn6+3Hx8fp6+7m5+lkZGSusrTj5+l3d3fj5ebM0NO8vLzAwcPIzM7BxMd2dna8v8K3u76zt7nO0dSorK+SkpKfoqSjo6OUlJTn6et1dXW3uLmenp7Jycmtra2NjY20uLrTdFq9wcTDxsnGyczRc1no6+3U19rZ293IyMjKysrHaU/w8PDGaE6xsbGurq6ysrK2trZ9fX36+vrYeV/x8fG0tLSxsrTb3d7Ozs6Ghoba3+Lm5uby8vL4+Pj+/v7JalHEZUyAgID9XftqAAAABHRSTlMAlpbU7KiZiQAAAiBJREFUeF690kO3HEEYBuCZm6rm2LatS9u2Edu2bdu27V+W6u6Zi0nm5GSTd1G9qOfUW/1186aGD5Lh8/4csKBwaHD14FAhyAgAm0mQfnQXB6xpVfxLlfklVeUrDq4EhzfdXbd+Gdhwal9eeVVJ/lZOgG0syNt+Yceu3R5JgCD0Bz6xoJLrshxZc/T4iZN7Ty86u5ikMenlCsvVd9c337x1e6OFBc337gsMgdjjJdqF0ZaGhpboK+3SN7FVktH3y5uTd+zROMIk7QtWuyL9EVd10EeTYYemZ3IguWvVteKQrrvbKe24Eu8V1OMVbrf4UO7kANRinbNzzjxRKXgQAygB8NCpE4OpQLlzSwdlrZEB4PbW1AJ1ZxqQhV+WWSnhnjHCMLA/4aUs/WPK6eBjXbYKvxg5Rhj8viYjda21Og2ccShUuEvhJzx0RasRJ8+dnwbkMrpMqhKNz8rOkZAJTIALEwql7N8AxoD5HFAwoOg/giwIs4D8BoTtGS4JCwrgyB1mzQRMpkYIG00mqMIRIDwIGFkgTlXYbH19Nhts54ChSIMZKaGGA5yYjQIfSa3UuJQFtDcNzESBT56KqGfYc32v3PFCBgAY0E1UtM1FaYOvmR+mXjAaQrtmrRm8TQI4bLdDaLcPww9duCpuDAGtHsQF5s8gBYqL4YwRZpXkfPka/Qb0CJRqEQD8iUHx+N8h/IHVBf1NP0nUkAAoucz+3/MLCpKJYL8vq+0AAAAASUVORK5CYII=') no-repeat;
      width: 32px;
      height: 32px;
      padding-left: 32px;
    }

    html, body{
      font-family: 'Titillium Web', sans-serif;
      height: 100%;
    }
    #leftpane{
      background-color: #e3e3e3;
    }
    @keyframes notifanim {
      0%{top: 90%;}
      50%{top: 90%;}
      100%{top: 120%;}
    }
    #notification{
      position: fixed;
      top: 90%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -webkit-transform: translate(-50%, -50%);
      animation: notifanim 3s forwards;
    }
  </style>
  <body>
    <div class="row" style="height: 100%; margin-right: 0px;">
      <div class="col-md-3" id="leftpane">
        <div class="jumbotron text-center" style="margin: 1rem;">
          <h1>GlancOil</h1>
          <b>Panel kontrolny GlancOil</b>
        </div>
        <div class="container">
          <div class="btn-group-vertical justified" style="width: 100%">
            <button type="button" onclick="location.href = '/';" class="btn btn-default">Strona główna</button>
            <?php
              if(isset($_SESSION['username']))
              {
                echo "<button type=\"button\" onclick=\"document.location.href = 'linout.php';\" class=\"btn btn-default\">Wyloguj</button>";
                echo '<button type="button" onclick="location.href = \'?page=new\';" class="btn btn-default">Nowy zakup</button>';
                echo '<button type="button" onclick="location.href = \'?page=history\';" class="btn btn-default">Historia zakupów</button>';
                echo '<button type="button" onclick="location.href = \'?page=options\';" class="btn btn-default">Opcje</button>';
              }
              else {
                echo "<button type=\"button\" onclick=\"location.href = '?page=login';\" class=\"btn btn-default\">Logowanie</button>";
                echo '<button type="button" onclick="location.href = \'?page=new\';" class="btn disabled btn-default">Nowy zakup</button>';
                echo '<button type="button" onclick="location.href = \'?page=history\';" class="btn disabled btn-default">Historia zakupów</button>';
                echo '<button type="button" onclick="location.href = \'?page=options\';" class="btn disabled btn-default">Opcje</button>';
              }

             ?>

          </div>
        </div>
        <div class="container text-center">
          <small style="width: 100%">
            <br/>
            Zalogowano jako:
            <?php
              if(isset($_SESSION['username']))
                echo $nm;
              else {
                echo "<i>Nie zalogowany</i>";
              }
             ?>
          </small>
        </div>
      </div>
      <div class="col-md-9">
        <?php
          if(empty($_GET["page"]) || !$_GET["page"])
            include 'main.php';
          else if($_GET["page"] == "login")
            include 'login.php';
          else if($_GET['page'] == "new")
            include 'neworder.php';
          else if($_GET['page'] == "history")
            include 'history.php';
          else if($_GET['page'] == "options")
            include 'options.php';
        ?>
      </div>
    </div>
    <?php
      if(!empty($_GET["msg"])){
        $type = "alert-info";
        $report = $_GET["msg"];
        if(!empty($_GET["type"])){
          $type = $_GET["type"];
        }
        echo '<div class="alert '.$type.'" id="notification">'.$report.'</div>';
      }
     ?>
  </body>
</html>
