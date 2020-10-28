
<?php
    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
    $itemadd=$_GET['itemadd'];
    $orderstatus=$db->fetchOne("tblorder", "statusId=1 AND username="."'".$account."'"." ");

    if (isset($orderstatus)) {
      $data =["orderId"=>$orderstatus["orderId"], "itemId"=>$itemadd];
      $cartInsert=$db->insert("tblcart", $data);
      redirectUser("itemDisplay?account=".$account);
    }
    else {
      $data =["username"=>$account, "statusId"=>1];
      $orderInsert=$db->insert("tblorder", $data);
      $dataa=[];
      $orderstatuss=$db->fetchOne("tblorder", "statusId=1 AND username="."'".$account."'"." ");
      $dataa =["orderId"=>$orderstatuss["orderId"], "itemId"=>$itemadd];
      $cartInsert=$db->insert("tblcart", $dataa);
      redirectUser("itemDisplay?account=".$account);
    }


?>
