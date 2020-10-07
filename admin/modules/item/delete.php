<?php

    require_once __dir__. "/../../autoload/autoload.php";
    $id=intval(getInput("id"));
    $editItem=$db->fetchID("tblitem", "itemId", $id);
    if (empty($editItem)) {
        $_SESSION["error"]="Data is not exist";
        redirectCate("item");
    }
    $idDelete = $db->delete("tblitem", "itemId", $id);
    if ($idDelete>0) {
        $_SESSION["success"]="<i class='fas fa-trash'></i> Delete category successfully";
        redirectCate("item");
    }
    else{
        $_SESSION["error"]="Delete failed";
    }

?>
