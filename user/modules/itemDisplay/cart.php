<?php

    require_once __dir__. "/../../autoload/autoload.php";

    $status=$db->fetchAll("tblstatus");
    if (isset($_GET['status'])) $statusid=$_GET['status'];
    else {
        $statusid=0;
    }

    $category=$db->fetchAll("tblcategory");
    if (isset($_GET['cate'])) {
        $cateid=$_GET['cate'];
        $cate="tblitem.categoryId=".$cateid;
    }
    else {
        $cateid=0;
        $cate="tblitem.categoryId=tblitem.categoryId";
    }

    if ($cateid==0) {
        $cate="tblitem.categoryId=tblitem.categoryId";
    }

    if (isset($_GET['orderby'])) {
        $orderby=$_GET['orderby'];
        $asd=$_GET['asd'];
    }
    else {
        $orderby="ORDER BY name DESC";
        $asd=3;
    }

    $sql="SELECT tblitem.*, tblcategory.name as namecate, tblstatus.name as namestatus FROM tblitem LEFT JOIN tblcategory on tblitem.categoryId=tblcategory.categoryId LEFT JOIN tblstatus on tblitem.statusId=tblstatus.statusId WHERE ".$cate." AND tblitem.statusId=$statusid"." ".$orderby;

    $product=$db->fetchJone("tblitem", $sql, 0, 0, false, "itemId", "WHERE ".$cate." AND tblitem.statusId=$statusid");

    $itemDisplay=array_partition($product, 3);

    $recommendation=array_partition($product, 2);

?>

<?php $totalItem=0; foreach ($product as $item): ?><?php $totalItem++; endforeach ?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container">
        <div class="row">
            <div class="card shadow mb-4 col">
                <div class="card-header py-3 text-center">
                    <h1 class="d-inline-block m-0 font-weight-bold text-primary">Cart</h1>
                    <!-- Item Search -->
                </div>
                <div class="card-body row align-self-center">
                    <?php foreach ($itemDisplay as $col => $innerCol): ?>
                    <div class="col-xl-4 col-lg-6">
                        <?php foreach ($innerCol as $item): ?>
                        <article class="d-item mb-5 mt-2">
                            <img src="<?php echo uploads().$item['image']; ?>" width="100%">
                            <div class="item-overlay d-flex text-center justify-content-center">
                                <div class="d-inline-block my-auto align-self-center">
                                    <h3><?php echo $item['name']; ?></h3>
                                    <button class="item-func item-view fas fa-eye"></button>
                                    <button class="item-func item-buy fas fa-usd"></button>
                                    <button class="item-func item-cart fas fa-shopping-cart"></button>
                                </div>
                            </div>
                        </article>
                        <?php endforeach ?>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


<?php require_once __dir__. "/../../layouts/footer.php"; ?>
