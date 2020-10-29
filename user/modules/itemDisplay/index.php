<?php

    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];
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
            <div class="card shadow mb-4 col-xl-7 col-lg-8 col-12">
                <div class="card-header py-3">
                    <h4 class="d-inline-block m-0 font-weight-bold text-primary">Drinks</h4>
                    <!-- Item Search -->
                    <?php
                        $con=mysqli_connect("localhost","root","","Canteen");
                        $products = mysqli_query($con, "SELECT * FROM tblitem ORDER BY name ASC ");
                        $forsearch=array();
                        foreach ($products as $item) {
                            array_push($forsearch, $item['name']);
                        }
                    ?>
                    <form autocomplete="off" method="GET" class="float-right d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input id="myInput" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                            value="<?=isset($_GET['searchname']) ? $_GET['searchname'] : ""?>" name="searchname">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header py-3 justify-content-between">
                  <div class="dropdown d-inline-block">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php $a=0; foreach ($category as $item):
                            if ($item["categoryId"]==$cateid): ?>
                            Category: <?php echo $item["name"]; ?>
                            <?php $a++ ?>
                            <?php else: ?>
                        <?php endif; endforeach ?>
                        <?php if ($a==0): ?>
                            Category: All
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php foreach ($category as $item): ?>
                            <a class="dropdown-item" href="index.php?cate=<?php echo $item["categoryId"] ?>&orderby=<?php echo $orderby; ?>&asd=<?php echo $asd; ?>&status=<?php echo $statusid ?>"><?php echo $item["name"]; ?></a>
                        <?php endforeach ?>
                    </div>
                  </div>
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
                                    <a href="itemDisplay.php?itemId=<?php echo $item['itemId'] ?>">
                                        <button class="item-func item-view fas fa-eye"></button>
                                    </a>
                                    <a href="addCart.php?itemadd=<?php echo $item['itemId']; ?>&account=<?php echo $account; ?>">
                                        <button class="item-func item-cart fas fa-shopping-cart"></button>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php endforeach ?>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="card shadow mb-4 col-xl-5 col-lg-4 col-12">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Notifications</h4>
                </div>
                <div class="card-body row align-self-center">
                  <?php if (isset($_SESSION["notification"])):  ?>
                    <div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <?php echo $_SESSION["notification"]; unset($_SESSION["notification"]); ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Recommendations</h4>
                </div>
                <div class="card-body row align-self-center">
                    <?php foreach ($recommendation as $col => $innerCol): ?>
                    <div class="col-xl-6 col-12">
                        <?php foreach ($innerCol as $item): ?>
                        <article class="d-item mb-5 mt-2">
                            <img src="<?php echo uploads().$item['image']; ?>" width="100%">
                            <div class="item-overlay d-flex text-center justify-content-center">
                                <div class="d-inline-block my-auto align-self-center">
                                    <h3 class=""><?php echo $item['name']; ?></h3>
                                    <a href="itemDisplay.php?itemId=<?php echo $item['itemId'] ?>">
                                        <button class="item-func item-view fas fa-eye"></button>
                                    </a>
                                    <a href="addCart.php?itemadd=<?php echo $item['itemId']; ?>&account=<?php echo $account; ?>">
                                        <button class="item-func item-cart fas fa-shopping-cart"></button>
                                    </a>
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
