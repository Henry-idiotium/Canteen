<?php

    require_once __dir__. "/../../autoload/autoload.php";
    $account=$_GET['account'];

    $sql="  SELECT 
                tblcart.*
                ,tblitem.name as nameitem
                ,tblitem.price as priceitem
                ,tblitem.image as img
                ,tblorder.orderId as id 
                ,tblcart.quantity as qty 
                ,tblcategory.name as catename
            FROM tblcart
                LEFT JOIN tblitem on tblcart.itemId=tblitem.itemId
                LEFT JOIN tblorder on tblorder.orderId=tblcart.orderId
                LEFT JOIN tblcategory on tblitem.categoryId=tblcategory.categoryId
            WHERE tblorder.statusId=11 AND tblorder.username="."'".$account."'"." ORDER BY tblorder.createAt DESC ";
    $cart=$db->fetchJone("tblcart", $sql, 0, 10, false, "username","WHERE tblorder.statusId=1 AND tbluser.username="."'".$account."'");

    $totalcart=0;
    foreach ($cart as $item)
        $totalcart += $item["priceitem"] * $item["qty"];
    
?>


<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow mb-4 col">
            <div class="card-header py-3 text-center">
                <h1 class="d-inline-block m-0 font-weight-bold text-primary">Cart</h1>
            </div>
            <div class="card-body container">
                <div class="row">
                    <div class="table-responsive col-8">

                        <table class="table table-borderless cus-tbl-1" id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item): ?>
                                    <tr>
                                        <td class="td-cus-name">
                                            <div class="item-img-cart-box">
                                                <div class="item-img-cart" style="background-image: url('<?php echo uploads().$item['img']; ?>');">
                                                </div>
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <?php echo $item["nameitem"] ?>
                                            <br>
                                            <span><?php echo $item["catename"] ?></span>
                                        </td>
                                        <td class="td-cus">$<?php echo $item["priceitem"] ?></td>
                                        <td class="td-cus"><?php echo $item["qty"] ?></td>
                                        <td class="td-cus">$<?php echo number_format ( $item["priceitem"] * $item["qty"], 2 , "." , "," ); ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <span id="addanote">add a note</span>
                                        <div class="wrap-input100 validate-input">
                                            <input class="input100" type="text" value=""  id="inputItemName" name="description" placeholder="Description">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="side-tab-box col-4">
                        <hr>
                        <div class="side-tab">
                            <span>
                                cart total
                            </span>
                            <h4>
                                $<?php echo number_format ( $totalcart , 2 , "." , "," ); ?>
                            </h4>
                            <br>
                            <p>
                                Shipping & taxes calculated at purchase
                            </p>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    Purchase<span></span><i class="fas fa-money-bill-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->





<?php require_once __dir__. "/../../layouts/footer.php"; ?>
