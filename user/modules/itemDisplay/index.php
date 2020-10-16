<?php

    require_once __dir__. "/../../autoload/autoload.php";

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>


    <!-- Begin Page Content -->
    <div class="container">
        <div class="row">
            <div class="card shadow mb-4 col-7">
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



                <div class="card-body row">
                    <div class="col-4">
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                    </div>
                    <div class="col-4">
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                    </div>
                    <div class="col-4">
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                        <article>
                            <img src="../../../public/uploads/product/Eg8bkhoUwAA0qV1.png" width="100%">
                        </article>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 col-5">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Recommendations</h4>
                </div>
                <div class="card-body row">
                    <div class="col-6">
                        <article>
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                        <article>
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                    </div>
                    <div class="col-6">
                        <article>
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                        <article>
                            <img src="../../../public/uploads/product/75250981_p0.jpg" width="100%">
                        </article>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End of Main Content -->


<?php require_once __dir__. "/../../layouts/footer.php"; ?>


