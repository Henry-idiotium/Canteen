
<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $itemadd=$_GET['itemadd'];
    $order=$_GET['id'];
    $deleteItem=$db->dele("tblitem", "DELETE FROM tblcart WHERE tblcart.orderId=(SELECT tblorder.orderId FROM tblorder WHERE tblorder.orderId=".$order." AND tblorder.statusId=1 AND tblorder.username="."'".$account."'".") AND tblcart.itemId="."'".$itemadd."'");
    redirectUser("itemDisplay/cart.php?account=".$account);
?>
