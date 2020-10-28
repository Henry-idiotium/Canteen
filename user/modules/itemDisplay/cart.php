<?php

  require_once __dir__. "/../../autoload/autoload.php";
  $account=$_GET['account'];
  $sql="SELECT tblcart.*, tblitem.name as nameitem, tblitem.image as img, tblorder.orderId as id FROM tblcart
    LEFT JOIN tblitem on tblcart.itemId=tblitem.itemId
    LEFT JOIN tblorder on tblorder.orderId=tblcart.orderId
    WHERE tblorder.statusId=1 AND tblorder.username="."'".$account."'"." ORDER BY tblorder.createAt DESC ";
  $cart=$db->fetchJone("tblcart", $sql, 0, 10, false, "username","WHERE tblorder.statusId=1 AND tbluser.username="."'".$account."'");

?>


<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container">
            <a class="btn btn-xs btn-info display-inline-block ml-auto" href="index.php?account=<?php echo $account; ?>"><i class="fas fa-cart"></i> Back</a>
            <div class="card shadow mb-4 col">
                <div class="card-header py-3 text-center">
                    <h1 class="d-inline-block m-0 font-weight-bold text-primary">Cart</h1>
                    <!-- Item Search -->
                </div>
                <?php foreach ($cart as $item): ?>
                  <div class="card-body row align-self-center">
                    <div class="col-6">
                      <img src="<?php echo uploads().$item['img']; ?>" width="50%" alt="">
                    </div>
                    <div class="col-6">
                      <?php echo $item['nameitem']; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
            <?php foreach ($cart as $item){
              $passcart=$item;
              break;
            } ?>
            <a class="confirmbuy btn btn-xs btn-info display-inline-block ml-auto" href="buy.php?account=<?php echo $account; ?>&order=<?php echo $passcart["id"]; ?>"><i class="fas fa-cart"></i> Buy</a>

    </div>
    <!-- End of Main Content -->


<?php require_once __dir__. "/../../layouts/footer.php"; ?>
