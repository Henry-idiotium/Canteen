<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $order=$_GET['order'];
    $data=["statusId"=>2];
    $orderUpdate = $db->update("tblorder", $data, array("orderId"=>$order, "username"=>$account));
    $deleteCart=$db->dele("tblitem", "DELETE FROM tblcart WHERE tblcart.orderId=(SELECT tblorder.orderId FROM tblorder WHERE tblorder.orderId=".$order." AND tblorder.statusId=2 AND tblorder.username="."'".$account."'".")");

    if (isset($orderUpdate)) {
      $_SESSION['success']="Order successfully";
      redirectUser("itemDisplay?account=".$account);
    }
    else {
      $_SESSION['error']="Order failed";
      redirectUser("itemDisplay?account=".$account);
    }


?>
