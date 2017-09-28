<?php
  class Item{
    public $id;
    public $name;
    public $cost;
    public $group;
  }
  $items = $db->query("SELECT * FROM $producttable");
  $listed = array();
  $empty = new Item();
  array_push($listed, $empty);
  while($item = $items->fetch_row()){
    $i = new Item();
    $i->id = $item[0];
    $i->name = $item[2];
    $i->cost = $item[1];
    $i->group = $item[3];
    array_push($listed, $i);
  }
  $fuelindexes = [0, 0, 0, 0];
  for($i = 0; $i < count($listed); $i++){
    switch($listed[$i]->name){
      case "PB-95":
        $fuelindexes[0] = $i;
        break;
      case "ON":
        $fuelindexes[1] = $i;
        break;
      case "LPG":
        $fuelindexes[2] = $i;
        break;
      case "PB-98":
        $fuelindexes[3] = $i;
        break;
    }
  }
 ?>
<script type="text/javascript">
  function product(){
    this.id;
    this.name;
    this.cost;
    this.group;
  }
  fuelindexes = [
    <?php echo $fuelindexes[0]-1?>,
    <?php echo $fuelindexes[1]-1?>,
    <?php echo $fuelindexes[2]-1?>,
    <?php echo $fuelindexes[3]-1?>
  ];
  products = [
    <?php
      for($i = 1; $i < count($listed); $i++){
        echo "{id: ". $listed[$i]->id .", name: \"". $listed[$i]->name ."\", cost: ". $listed[$i]->cost .", group: \"". $listed[$i]->group ."\"},\n\t";
      }
     ?>
  ];
</script>
<h2>Nowe zamówienie</h2>
<form class="form-horizontal" id="shop" method="post" onsubmit="calcup(); return false;" action="processbuy.php">
  <div class="form-group">
    <label for="fuel">Ilość paliwa w litrach</label>
    <input id="fuelamm" type="number" step="0.01" class="form-control" name="fuel">
    <label for="fueltype">Rodzaj paliwa</label><br/>
    <div class="radio text-left">
      <input checked="checked" type="radio" name="fueltype" value="<?php echo $fuelindexes[0]?>">
       PB95 - <?php echo $listed[$fuelindexes[0]]->cost . "zł/l" ?></input><br/>
      <input type="radio" name="fueltype" value="<?php echo $fuelindexes[1]?>">
       ON - <?php echo $listed[$fuelindexes[1]]->cost . "zł/l" ?></input><br/>
      <input type="radio" name="fueltype" value="<?php echo $fuelindexes[2]?>">
       LPG - <?php echo $listed[$fuelindexes[2]]->cost . "zł/l" ?></input><br/>
      <input type="radio" name="fueltype" value="<?php echo $fuelindexes[3]?>">
       PB98 - <?php echo $listed[$fuelindexes[3]]->cost . "zł/l" ?></input>
    </div>
  </div>
  <div class="form-group">
  <h2>Dodatkowe produkty</h2>
    <table class="table">
        <thead>
          <tr>
            <th class="">ID</th>
            <th class="col-md-4">Nazwa Produktu</th>
            <th class="col-md-2">Cena</th>
            <th class="col-md-1">Ilość</th>
            <th class="col-md-4">Suma</th>
            <th class="col-md-1"></th>
          </tr>
        </thead>
        <tbody id="items">
        </tbody>
    </table>
    </hr>
  </div>
  <div class="form-group text-justify" id="addNew">
    <table>
      <tbody id="addNewBody">
      </tbody>
    </table>
    <div id="jsnotif">
      Uwaga! Musisz włączyć obsługę JavaScript aby dodawać zamówienia!
    </div>
  </div>
  <div class="form-group text-right">
    <label>Zniżka [%]: &nbsp </label>
    <input name="discount" type="number" max="100" min="0" value="0">
  </div>
  <div class="form-group text-right">
    <label>Suma: &nbsp</label><span id="sum"></span>
  </div>
  <input type="hidden" name="added" >
  <button style="btn btn-default" onclick="calcup" type="submit" >Zatwierdź</button>
</form>
<script type="text/javascript">
  newPositionID = 0;
  var label = "<td><label>Dodaj produkt: &nbsp</label></td>";
  var select = "<td><select id=\"product-content\" style=\"width: 200px;\" class=\"selectpicker\"></select></td>";
  var label2 = "<td><label>W ilości: &nbsp</label></td>";
  var ammount = "<td><input style=\"width: 200px;\" type=\"number\" name=\"offtoadd\"></td>";
  var button = "<td><button class=\"btn\" onclick=\"add()\" type=\"button\">Dodaj produkt</button></td>";
  document.getElementById("addNewBody").innerHTML = "<tr>" + label + select +
      "</tr><tr>" + label2 + ammount + "</tr><tr>" + button + "</tr>";
  document.getElementById("jsnotif").innerHTML = "";
</script>
<script type="text/javascript">
  opttypes = [];

  for(var i = 0; i < products.length; i++){
    var isfuel = false;
    for(var f = 0; f < fuelindexes.length; f++){
      if (i == fuelindexes[f]){
        isfuel = true;
        break;
      }
    }
    if(isfuel)
      continue;
    var set = false;
    for(var j = 0; j < opttypes.length; j++){
      if(opttypes[j] == products[i].group){
        set = true;
        break;
      }
    }
    if(!set){
      opttypes.push(products[i].group);
    }
  }

  for(var i = 0; i < opttypes.length; i++){
    var optc = "<optgroup id=\"opt" + opttypes[i] + "\" label=\"" + opttypes[i] + "\"></optgroup>";
    document.getElementById("product-content").innerHTML+= optc;
  }

  for(var i = 0; i < products.length; i++){
    var isfuel = false;
    for(var f = 0; f < fuelindexes.length; f++){
      if (i == fuelindexes[f]){
        isfuel = true;
        break;
      }
    }
    if(isfuel)
      continue;
    else{
      document.getElementById("opt" + products[i].group).innerHTML+=
      "<option value=\""+ i +"\">" + products[i].name + "</option>";
    }
  }

  var checkedfield = -1;

  window.setInterval(function(){
    var sum = 0;
    var radios = document.getElementsByName("fueltype");
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            checkedfield = i;
            break;
        }
    }
    if(document.forms.shop.fuel.value != "")
      sum += products[checkedfield].cost * document.forms.shop.fuel.value;

    var shopped = document.getElementsByClassName("tosum");
    for(var g = 0; g < shopped.length; g++){
      sum += parseFloat(shopped[g].innerHTML);
    }
    sum *= (100.0-document.forms.shop.discount.value)/100;
    document.getElementById("sum").innerHTML = sum.toFixed(2) + " zł";
  }, 1000);


  function add(){
    var which = parseInt(document.getElementById("product-content").value);
    var out = "<tr>";
    out += "<td class=\"tbids\">" + products[which].id + "</td>";
    out += "<td>" + products[which].name + "</td>";
    out += "<td>" + products[which].cost + " zł</td>";
    out += "<td class=\"tbnums\">" + document.forms.shop.offtoadd.value + "</td>";
    out += "<td class=\"tosum\">" + (document.forms.shop.offtoadd.value* products[which].cost).toFixed(2) + " zł</td>";
    out += "<td><img class=\"dbtn\" onclick=\"deleterow(this)\"></td>";
    out += "</tr>";
    document.getElementById("items").innerHTML += out;
  }

  function saveUnit(){
    this.id;
    this.amm;
  }

  function calcup(){
    var outString = "{\n";
    var ids = document.getElementsByClassName("tbids");
    var nums = document.getElementsByClassName("tbnums");
    var outarr = [];
    for(var i = 0; i < ids.length; i++){
      var ts = new saveUnit();
      ts.id = ids[i].innerHTML;
      ts.amm = nums[i].innerHTML;
      outarr.push(ts);
      /*outString += "{";
      outString += "\"ID\": \"" + ids[i].innerHTML + "\",\n";
      outString += "\"SUM\": \"" + nums[i].innerHTML + "\"";
      if(i == ids.length-1 && document.forms.shop.fuel.value == "")
        outString += "}\n";
      else {
        outString += "},\n";
      }*/
    }
    if(checkedfield > -1 && document.forms.shop.fuel.value != ""){
      var ts = new saveUnit();
      ts.id = products[checkedfield].id;
      ts.amm = document.forms.shop.fuel.value;
      outarr.push(ts);
      /*outString += "{";
      outString += "\"ID\": \"" + products[checkedfield].id + "\",\n";
      outString += "\"SUM\": \"" + document.forms.shop.fuel.value + "\"";
      outString += "}\n";*/
    }
    //outString += "}";
    outString = JSON.stringify(outarr);
    document.forms.shop.added.value = outString;
    document.forms.shop.submit();
    return false;
  }
  function deleterow(e){
    e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
  }
</script>
