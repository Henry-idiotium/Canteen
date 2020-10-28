<?php

    require_once __dir__. "/../../autoload/autoload.php";

    $itemId = $_GET['itemId'];


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

    $product=$db->fetchOne("tblitem", "itemId = $itemId ");

?>

<?php $totalItem=0; foreach ($product as $item): ?><?php $totalItem++; endforeach ?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container-main">
        <div class="container">
            <div class="row">
                <div class="card shadow mb-4 col-12">
                    <div class="card-body row">
                        <div class="item-img-col col-7">
                            <div class="item-img-cus" style="background-image: url('<?php echo uploads().$product['image']; ?>');"></div>
                        </div>
                        <div class="item-des-col col-5">
                            <h5>
                                <?php foreach ($category as $itemCate)
                                    if ($itemCate['categoryId'] == $product['categoryId'])
                                        echo $itemCate['name'];
                                ?>
                            </h5>
                            <h3><?php echo $product['name'] ?></h3>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <hr>
                            <p>$<?php echo $product['price'] ?></p>
                            <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus">
                                <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                <input type="button" value="+" class="plus">
                            </div>
                            <button class="add-to-cart-btn">Add to cart</button>
                            <div class="item-info">
                                <h4>Description</h4>
                                <hr>
                                <p><?php echo $product['description'] ?></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


<?php require_once __dir__. "/../../layouts/footer.php"; ?>