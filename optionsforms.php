<hr/><h2>Zmiana hasła</h2><br/>
<form class="form" action="chpasswd.php" method="post">
  <div class="form-group center">
    <table class="table text-center">
    <tr><td><label>Nowe haslo: </label></td><td><input type="password" name="pswd1"></input></td><br/>
    <tr><td><label>Powtórz: </label></td><td><input type="password" name="pswd2"></input><br/>
    <tr><td><input class="btn btn-submit "type="submit" value="Zatwierdź"></input></td></tr>
    </table>
  </div>
</form>
<hr/>
<hr/><h2>Dodawanie nowego produktu</h2><br/>
<hr/>
<form class="form" action="addproduct.php" method="post">
  <div class="form-group center">
    <table class="table text-center">
    <tr><td><label>Nazwa produktu: </label></td><td><input type="text" name="name"></input></td><br/>
    <tr><td><label>Cena (zł): </label></td><td><input type="number" step="0.01" name="price"></input><br/>
    <tr><td><label>Kategoria: </label></td><td><input type="text" name="type"></input><br/>
    <tr><td><input class="btn btn-submit "type="submit" value="Zatwierdź"></input></td></tr>
    </table>
  </div>
</form>
<hr/>
<hr/><h2>Dodawanie nowego pracownika</h2><br/>
<hr/>
<form class="form" action="addworker.php" method="post">
  <div class="form-group center">
    <table class="table text-center">
    <tr><td><label>Login: </label></td><td><input type="text" name="login"></input></td><br/>
    <tr><td><label>Hasło: </label></td><td><input type="password" name="password"></input><br/>
    <tr><td><label>Powtórz hasło: </label></td><td><input type="password" name="password2"></input><br/>
    <tr><td><label>Imię: </label></td><td><input type="text" name="name"></input><br/>
    <tr><td><label>Nazwisko: </label></td><td><input type="text" name="surname"></input><br/>
    <tr><td><input class="btn btn-submit "type="submit" value="Zatwierdź"></input></td></tr>
    </table>
  </div>
</form>
<hr/>
