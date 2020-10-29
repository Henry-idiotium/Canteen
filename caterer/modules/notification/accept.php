<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $order=$_GET['order'];
    $data=["statusId"=>2];
    $orderaccept = $db->update("tblorder", $data, array("orderId"=>$order, "username"=>$account));
    $deleteCart=$db->dele("tblitem", "DELETE FROM tblcart WHERE tblcart.orderId=(SELECT tblorder.orderId FROM tblorder WHERE tblorder.orderId=".$order." AND tblorder.statusId=2 AND tblorder.username="."'".$account."'".")");

    if (isset($orderaccept)) {
      $_SESSION['notification']="Your order has been accepted";
      redirectcaterer("notification");
    }

?>
