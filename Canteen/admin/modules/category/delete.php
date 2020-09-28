<?php
  require_once __dir__. "/../../autoload/autoload.php";
  $id=intval(getInput("id"));
  $idDelete = $db->delete("category", $id);
  if ($idDelete>0) {
    $_SESSION["success"]="Delete category successfully";
    redirectCate("category");
  }
  else{
    $_SESSION["error"]="Delete failed";
  }
?>
