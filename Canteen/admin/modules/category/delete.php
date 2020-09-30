
<?php
  require_once __dir__. "/../../autoload/autoload.php";
  $id=intval(getInput("id"));
  $editCategory=$db->fetchID("tblcategory", "categoryId", $id);
  if (empty($editCategory)) {
    $_SESSION["error"]="Data is not exist";
    redirectCate("category");
  }

  //check ref
  $isItem=$db->fetchOne("tblitem"," categoryId=$id ");
  if ($isItem==NULL) {
    $idDelete = $db->delete("tblcategory", "categoryId", $id);
    if ($idDelete>0) {
      $_SESSION["success"]="<i class='fas fa-trash'></i> Delete category successfully";
      redirectCate("category");
    }
    else{
      $_SESSION["error"]="Delete failed";
    }
  }
  else {
    $_SESSION["error"]="Delete failed because it's referenced";
    redirectCate("category");
  }


?>
