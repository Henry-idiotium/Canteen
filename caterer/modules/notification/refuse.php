<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $order=$_GET['order'];
    $data=["statusId"=>1];
    $orderrefuse = $db->update("tblorder", $data, array("orderId"=>$order, "username"=>$account));

    if (isset($orderrefuse)) {
      $_SESSION['notification']="Your order is refused";
      redirectcaterer("notification");
    }

?>
