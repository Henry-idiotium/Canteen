<?php

    $open="manageitem";
    require_once __dir__. "/../../autoload/autoload.php";
    $category=$db->fetchAll("tblcategory");

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <a href="add.php" class="d-none d-sm-inline-block btn btn-mds btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> ADD CATEGORY</a>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../item">Manage item</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="clearfix"></div>
        <!-- notification -->
        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category listboard</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Create at</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Create at</th>
                        <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $num=1; foreach ($category as $item): ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo $item["name"] ?></td>
                            <td><?php echo $item["slug"] ?></td>
                            <td><?php echo $item["createAt"] ?></td>
                            <td>
                            <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item["categoryId"]; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-xs btn-info" href="delete.php?id=<?php echo $item["categoryId"]; ?>"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php $num++; endforeach ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
