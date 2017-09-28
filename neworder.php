<div class="text-center container">
<?php
  if(isset($_SESSION['username']))
  {
    echo '<div class="container"><hr/>';
      include 'buyform.php';
    echo '<hr/></div>';
  }
  else {
    echo "<h2>Sekcja dostępna tylko dla zalogowanych użytkowników</h2>";
  }
 ?>
</div>
