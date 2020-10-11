<?php
  require_once __dir__. "/../../autoload/autoload.php";
  $id=intval(getInput("name"));
  $deleteAdmin=$db->fetchID("tbluser", "username", $id);
  if (empty($deleteAdmin)) {
    $_SESSION["error"]="Data is not exist";
    redirectCate("user");
  }
  $idDelete = $db->delete("tbluser", "username", $id);
  if ($idDelete>0) {
    $_SESSION["success"]="<i class='fas fa-trash'></i> Delete category successfully";
    redirectCate("user");
  }
  else{
    $_SESSION["error"]="Delete failed";
  }
?>
