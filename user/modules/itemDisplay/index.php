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

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container">
        <div class="row">
            <div class="card shadow mb-4 col-xl-7 col-lg-8 col-12">
                <div class="card-header py-3">
                    <h4 class="d-inline-block m-0 font-weight-bold text-primary">Drinks</h4>
                    <!-- Item Search -->
                    <form class="float-right d-inline-block d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header py-3 justify-content-between">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category: All
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">ASDASDASD</a>
                        </div>
                    </div>
                </div>
                <div class="card-body row align-self-center">
                    <div class="col-xl-4 col-lg-6">
                        <?php $num=1; foreach ($product as $item): ?>
                            <article class="d-item mb-5 mt-2">
                                <img src="<?php echo uploads().$item['image']; ?>" width="100%">
                                <div class="item-overlay">
                                    <h3><?php echo $item['name']; ?></h3>
                                    <button class="item-func item-view fas fa-eye"></button>
                                    <button class="item-func item-buy fas fa-usd"></button>
                                    <button class="item-func item-cart fas fa-shopping-cart"></button>
                                </div>
                            </article>
                        <?php $num++; endforeach ?>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article class="d-item mb-4">
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Egf6BckU4AA05UR.jpg" width="100%">
                        </article>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Egf6BckU4AA05UR.jpg" width="100%">
                        </article>
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Egf6BckU4AA05UR.jpg" width="100%">
                        </article>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 col-xl-5 col-lg-4 col-12">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Recommendations</h4>
                </div>
                <div class="card-body row align-self-center">
                    <div class="col-xl-6 col-12">
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/Egf6BckU4AA05UR.jpg" width="100%">
                        </article>
                        <article class="d-item mb-5 mt-2">
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                    </div>
                    <div class="col-xl-6 col-12">
                        <article class="mb-4 d-item">
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                        <article class="mb-4 d-item">
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End of Main Content -->


<?php require_once __dir__. "/../../layouts/footer.php"; ?>


