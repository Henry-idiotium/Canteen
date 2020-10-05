<?php

    $open="manageitem";
    require_once __dir__. "/autoload/autoload.php";
    $category= $db->fetchAll("tblcategory");

?>

<?php require_once __dir__. "/layouts/header.php"; ?>

    <h1>Manage Item</h1>


    <ol class="breadcrumb mb-4"><?php require_once __dir__. "/modules/breadcrumb.php"; ?></ol>

    <a href="modules/item/index.php"><h2>Item</h2></a>
    <hr>
    <a href="modules/category/index.php"><h2>Category</h2></a>

<?php require_once __dir__. "/layouts/footer.php"; ?>
