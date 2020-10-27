<?php

    $open="manageitem";
    require_once __dir__. "/../../autoload/autoload.php";
    if (isset($_GET['page'])) {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    $status=$db->fetchAll("tblstatus");
    if (isset($_GET['status'])) {
      $statusid=$_GET['status'];
    }
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
    
    $product=$db->fetchJone("tblitem", $sql, $p, 3, true, "itemId", "WHERE ".$cate." AND tblitem.statusId=$statusid");
    
    $pageMax=$product["page"];
    if (isset($product['page'])) {
        $pageNo=$product['page'];
        unset($product['page']);
    }

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Manage item</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Item</h1>
            <a href="../category" class="d-none d-sm-inline-block btn btn-mds btn-success shadow-sm ml-auto mr-2"><i class="fas fa-edit fa-sm text-white-50"></i> MANAGE CATEGORY</a>
            <a href="add.php" class="d-none d-sm-inline-block btn btn-mds btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> ADD ITEM</a>
        </div>
        <div class="clearfix"></div>
        <!-- notification -->
            <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Item listboard</h4>
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
              <div class="dropdown d-inline-block">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if ($asd==1): ?>
                    New created
                  <?php elseif ($asd==2): ?>
                    Old created
                  <?php elseif ($asd==3): ?>
                    Name Z-A
                  <?php else: ?>
                    Name A-Z
                  <?php endif; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="index.php?cate=<?php echo $cateid ?>&orderby=ORDER BY createAt DESC&asd=1&status=<?php echo $statusid ?>">New created</a>
                  <a class="dropdown-item" href="index.php?cate=<?php echo $cateid ?>&orderby=ORDER BY createAt ASC&asd=2&status=<?php echo $statusid ?>">Old created</a>
                  <a class="dropdown-item" href="index.php?cate=<?php echo $cateid ?>&orderby=ORDER BY name DESC&asd=3&status=<?php echo $statusid ?>">Name A-Z</a>
                  <a class="dropdown-item" href="index.php?cate=<?php echo $cateid ?>&orderby=ORDER BY name ASC&asd=4&status=<?php echo $statusid ?>">Name Z-A</a>
                </div>
              </div>
              <div class="dropdown d-inline-block ml-auto mr-0 float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php foreach ($status as $item):
                    if ($item["statusId"]==$statusid): ?>
                      Status: <?php echo $item["name"]; ?>
                  <?php endif; endforeach ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php foreach ($status as $item): ?>
                    <a class="dropdown-item" href="index.php?cate=<?php echo $cateid ?>&orderby=<?php echo $orderby; ?>&asd=<?php echo $asd; ?>&status=<?php echo $item["statusId"] ?>"><?php echo $item["name"]; ?></a>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php $num=1; foreach ($product as $item): ?>
                        <tr>
                        <td><?php echo $num ?></td>
                        <td><?php echo $item["name"] ?></td>
                        <td><?php echo $item["namecate"] ?></td>
                        <td><?php echo $item["namestatus"] ?></td>
                        <td><?php echo $item["slug"] ?></td>
                        <td><img src="<?php echo uploads().$item['image']; ?>" width="160px" height="200px"></td>
                        <td><?php echo $item["createAt"] ?></td>
                        <td>
                            <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item["itemId"]; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-xs btn-info" href="delete.php?id=<?php echo $item["itemId"]; ?>"><i class="fas fa-trash"></i> Delete</a>
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
                <a href="/Canteen/admin/modules/item/?cate=<?php echo $cateid ?>&page=<?php echo $p-1; ?>&orderby=<?php echo $orderby; ?>&asd=<?php echo $asd; ?>&status=<?php echo $statusid ?>" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
            </li>
            <?php $NoP=1; for ($i=0; $i < $pageMax  ; $i++): ?>
                <li class="paginate_button page-item <?php echo isset($p) && $p==$NoP ? "active" : "" ?>">
                    <a href="/Canteen/admin/modules/item/?cate=<?php echo $cateid ?>&page=<?php echo $NoP; ?>&orderby=<?php echo $orderby; ?>&asd=<?php echo $asd; ?>&status=<?php echo $statusid ?>" aria-controls="dtBasicExample" data-dt-idx="3" tabindex="0" class="page-link"><?php echo $NoP; ?></a>
                </li>
            <?php $NoP++; endfor?>
            <li class="paginate_button page-item next <?php echo isset($p) && $p==$pageMax ? "disabled" : "" ?>" id="dtBasicExample_next">
                <a href="/Canteen/admin/modules/item/?cate=<?php echo $cateid ?>&page=<?php echo $p+1; ?>&orderby=<?php echo $orderby; ?>&asd=<?php echo $asd; ?>&status=<?php echo $statusid ?>" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
            </li>
        </ul>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
