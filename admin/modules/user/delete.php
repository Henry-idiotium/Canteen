<?php
    require_once __dir__. "/../../autoload/autoload.php";
    if ($_GET['deletere']==1) {
      $deletere="/showadmin.php";
    }
    if ($_GET['deletere']==2) {
      $deletere="/showcaterer.php";
    }
    if ($_GET['deletere']==3) {
      $deletere="/showuser.php";
    }
    $id=intval(getInput("name"));
    $deleteAdmin=$db->fetchID("tbluser", "username", $id);
    if (empty($deleteAdmin)) {
        $_SESSION["error"]="Data is not exist";
        redirectCate("user".$deletere);
    }
    $idDelete = $db->delete("tbluser", "username", $id);
    if ($idDelete>0) {
        $_SESSION["success"]="<i class='fas fa-trash'></i> Delete category successfully";
        redirectCate("user".$deletere);
    }
    else{
        $_SESSION["error"]="Delete failed";
    }
?>
