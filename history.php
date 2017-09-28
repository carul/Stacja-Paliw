<div class="text-center container">
<form action="removeorder.php" method="post" id="history" onsubmit="passrem(); return false;">
<?php
  if(isset($_SESSION['username']))
  {
    echo "<h2>Historia zakupów</h2>";
    echo "<table class=\"table\">";
    echo "<thead><tr>";
    echo "<td class=\"col-md-1\">Numer Zamówienia</td>";
    echo "<td class=\"col-md-2\">Sprzedawca</td>";
    echo "<td class=\"col-md-5\">Lista produktów</td>";
    echo "<td class=\"col-md-2\">Zniżka</td>";
    echo "<td class=\"col-md-1\">Usuń zamówienie</td>";
    echo "</tr></thead><tbody>";
    $orders = $db->query("SELECT * FROM $ordertable");
    while($row = $orders->fetch_row()){
      echo "<tr>";
      echo "<td>" . $row[0] . "</td>";
      $worker = $db->query("SELECT * FROM $workertable WHERE ID=$row[1]")->fetch_row();
      $prods = json_decode($row[2]);
      $out = "";
      for($i = 0; $i < count($prods); $i++){
        $id = $prods[$i]->id;
        $ann = $prods[$i]->amm;
        $prod = $db->query("SELECT * FROM $producttable WHERE ID=$id")->fetch_row();
        $out .= $ann . " x " . $prod[2] . "<br/>";
      }
      echo "<td>" . $worker[3] . " " . $worker[4] . "</td>";
      echo "<td>" . $out . "</td>";
      echo "<td>" . $row[3] . "%</td>";
      echo "<td><button type=\"button\" onclick=\"deleteOrder($row[0])\"><img class=\"dbtn\"></button></td>";
      echo "</tr>";
    }
    echo "</tbody></table>";
  }
  else {
    echo "<h2>Sekcja dostępna tylko dla zalogowanych użytkowników</h2>";
  }
 ?>
 <input type="hidden" value="-1" name="tremove">
 </form>
 <script type="text/javascript">
  od = "";
  function deleteOrder(order){
    od = order;
    document.forms.history.tremove.value = od;
    document.forms.history.submit();
  }
  function passrem(){
    document.forms.history.tremove.value = od;
    return false;
  }
 </script>
</div>
