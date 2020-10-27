
<?php
  require_once __dir__. "/../autoload/autoload.php";
  $con=mysqli_connect("localhost","root","","Canteen");
  $search = isset($_GET['name']) ? $_GET['name'] : "";
  if ($search) {
      $where = "WHERE `name` LIKE '%" . $search . "%'";
  }
  if ($search) {
      $products = mysqli_query($con, "SELECT * FROM tblcategory WHERE name LIKE '%" . $search . "%' ORDER BY name ASC ");
  } else {
      $products = mysqli_query($con, "SELECT * FROM tblcategory ORDER BY name ASC ");
  }
?>
<?php require_once "header.php"; ?>
<div id="wrapper-product" class="container">
    <form id="product-search" method="GET">
        <label>Tìm kiếm sản phẩm</label>
        <input type="text" value="<?=isset($_GET['name']) ? $_GET['name'] : ""?>" name="name" />
        <input type="submit" value="Tìm kiếm" />
    </form>
    <div class="product-items">
        <?php
          foreach ($products as $item) {
            echo $item['name'];
          }
        ?>
    </div>
</div>
<div class="d-flex flex-wrap">
  ...
</div>
<?php require_once "footer.php"; ?>
