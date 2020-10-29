<?php

    $open="notification";
    require_once __dir__. "/../../autoload/autoload.php";
    $string="";
    $sql="SELECT tblorder.*, tbluser.username as username, tbluser.fullname as fullname, tbldepartment.name as dename FROM tblorder
            LEFT JOIN tbluser ON tblorder.username=tbluser.username
            LEFT JOIN tbldepartment ON tbldepartment.departmentId=tbluser.departmentId
              WHERE tblorder.statusId=3 ORDER BY tblorder.createAt ASC ";
    $order=$db->fetchJone("tbluser", $sql, 0, 10, false, "username","WHERE tblorder.statusId=3");
    $items=[];
    foreach ($order as $key) {
      $sqll="SELECT tblcart.*, tblitem.name as itemname FROM tblcart
              LEFT JOIN tblorder ON tblorder.orderId=tblcart.orderId
              LEFT JOIN tblitem ON tblitem.itemId=tblcart.itemId
                WHERE tblcart.orderId=".$key["orderId"]." ORDER BY tblorder.createAt ASC ";
      $orderitem=$db->fetchJone("tbluser", $sqll, 0, 10, false, "username","WHERE tblcart.orderId=".$key["orderId"]);
      foreach ($orderitem as $item) {
        $string=$string.$item["itemname"].", ";
      }
      $string=substr($string, 0, -2);
      $items += array($key["orderId"]=>$string);
      $string="";
    }

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Notification</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order</h1>
        </div>
        <div class="clearfix"></div>
        <!-- notification -->
        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                      <th>OrderId</th>
                      <th>Fullname</th>
                      <th>Department</th>
                      <th>Items</th>
                      <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                      <th>OrderId</th>
                      <th>Fullname</th>
                      <th>Department</th>
                      <th>Items</th>
                      <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php $num=1; foreach ($order as $item): ?>
                      <tr>
                          <td><?php echo $item["orderId"] ?></td>
                          <td><?php echo $item["fullname"] ?></td>
                          <td><?php echo $item["dename"] ?></td>
                          <td>
                            <?php
                              foreach ($items as $key => $value) {
                                if ($key==$item["orderId"]) {
                                  echo $value;
                                }
                              }
                            ?>
                          </td>
                          <td>
                              <a class="btn btn-xs btn-info" href="accept.php?order=<?php echo $item["orderId"]; ?>&account=<?php echo $item["username"]; ?>"><i class="fas fa-edit"></i> Accept</a>
                              <a class="btn btn-xs btn-danger" href="refuse.php?order=<?php echo $item["orderId"]; ?>&account=<?php echo $item["username"]; ?>"><i class="fas fa-trash"></i> Refuse</a>
                          </td>
                      </tr>
                      <?php $num++; endforeach ?>
                  </tbody>
                  </table>
              </div>
            </div>
      </div>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
