<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $order=$_GET['order'];
    $data=["statusId"=>3];
    $orderUpdate = $db->update("tblorder", $data, array("orderId"=>$order, "username"=>$account));

    if (isset($orderUpdate)) {
      $_SESSION['notification']="Your order is waiting for accept";
      redirectUser("item?account=".$account);
    }
    else {
      $_SESSION['error']="Order failed";
      redirectUser("item?account=".$account);
    }

?>
