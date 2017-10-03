<div class="text-center container">
<?php
  if(isset($_SESSION['username']))
  {
    include 'optionsforms.php';

  }
  else {
    echo "<h2>Sekcja dostępna tylko dla zalogowanych użytkowników</h2>";
  }
 ?>
</div>
