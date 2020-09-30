<?php

  require_once __dir__. "/autoload/autoload.php";
  $category= $db->fetchAll("tblcategory");

?>
<?php require_once __dir__. "/layouts/header.php"; ?>
<h1>Menu</h1>
                    <a href="manageItem.php">Manage Item</a>
                    <a href="">User</a>
                    <a href="">Order</a>
                    <a href="">View statistic</a>

<?php require_once __dir__. "/layouts/footer.php"; ?>
