<?php
  $open="manageitem";
  require_once __dir__. "/autoload/autoload.php";
  $category= $db->fetchAll("category");

?>
<?php require_once __dir__. "/layouts/header.php"; ?>
<h1>Manage Item</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="index.php">Menu</a></li>
  <li class="breadcrumb-item active">Manage item</li>
</ol>

<a href=""><h2>Item</h2></a>
<hr>
<a href="modules/category/index.php"><h2>Category</h2></a>

<?php require_once __dir__. "/layouts/footer.php"; ?>
