<?php
    $open="manageaccount";
    require_once __dir__. "/../../autoload/autoload.php";
    if (isset($_GET['page'])) {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    $sql="SELECT tbluser.*, tblrole.name as namerole FROM tbluser LEFT JOIN tblrole on tbluser.roleId=tblrole.roleId ORDER BY createAt DESC ";
    $user=$db->fetchJone("tbluser", $sql, $p, 2, true, "username");
    $pageMax=$user["page"];
    if (isset($user['page'])) {
        $pageNo=$user['page'];
        unset($user['page']);
    }
?>
<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Item</h1>
            <a href="add.php" class="d-none d-sm-inline-block btn btn-mds btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> ADD ITEM</a>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../../index.php">Menu</a></li>
            <li class="breadcrumb-item"><a href="../../manageItem.php">Manage item</a></li>
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
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Number</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $num=1; foreach ($user as $item): ?>
                    <tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $item["username"] ?></td>
                        <td><?php echo $item["fullname"] ?></td>
                        <td><?php echo $item["email"] ?></td>
                        <td><?php echo $item["phone"] ?></td>
                        <td><?php echo $item["namerole"] ?></td>
                        <td>
                        <a class="btn btn-xs btn-info" href="edit.php?name=<?php echo $item["username"]; ?>"><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-xs btn-info" href="delete.php?name=<?php echo $item["username"]; ?>"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $num++; endforeach ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        <ul class="pagination">
            <li class="paginate_button page-item previous <?php echo isset($p) && $p==1 ? "disabled" : "" ?>" id="dtBasicExample_previous">
            <a href="/Canteen/admin/modules/item/?page=<?php echo $p-1; ?>" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
            </li>
            <?php $NoP=1; for ($i=0; $i < $pageMax  ; $i++): ?>
            <li class="paginate_button page-item <?php echo isset($p) && $p==$NoP ? "active" : "" ?>">
                <a href="/Canteen/admin/modules/item/?page=<?php echo $NoP; ?>" aria-controls="dtBasicExample" data-dt-idx="3" tabindex="0" class="page-link"><?php echo $NoP; ?></a>
            </li>
            <?php $NoP++; endfor?>
            <li class="paginate_button page-item next <?php echo isset($p) && $p==$pageMax ? "disabled" : "" ?>" id="dtBasicExample_next">
            <a href="/Canteen/admin/modules/item/?page=<?php echo $p+1; ?>" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
            </li>
        </ul>
        <!-- End of Main Content -->
    </div>

<?php require_once __dir__. "/../../layouts/footer.php"; ?>