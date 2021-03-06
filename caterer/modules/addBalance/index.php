<?php

    $open="addbalance";
    require_once __dir__. "/../../autoload/autoload.php";
    $department=$db->fetchAll("tbldepartment");
    if (isset($_GET['de'])) {
      $de=$_GET['de'];
    }
    else {
      $de=1;
    }

    if (isset($_GET['page'])) {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    $sql="SELECT tbluser.*, tbldepartment.name as namede FROM tbluser LEFT JOIN tbldepartment on tbldepartment.departmentId=tbluser.departmentId WHERE tbluser.departmentId=$de ORDER BY name DESC ";
    $user=$db->fetchJone("tbluser", $sql, $p, 2, true, "username","WHERE departmentId=".$de);
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
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Add balance</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add balance</h1>
        </div>
        <div class="clearfix"></div>
        <!-- notification -->
        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php foreach ($department as $item):
                    if ($item["departmentId"]==$de): ?>
                      Department: <?php echo $item["name"]; ?>
                  <?php endif; endforeach ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php foreach ($department as $item): ?>
                    <a class="dropdown-item" href="index.php?de=<?php echo $item["departmentId"] ?>"><?php echo $item["name"]; ?></a>
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
                      <th>Username</th>
                      <th>Fullname</th>
                      <th>Department</th>
                      <th>Current balance</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                      <th>Number</th>
                      <th>Username</th>
                      <th>Fullname</th>
                      <th>Department</th>
                      <th>Current balance</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php $num=1; foreach ($user as $item): ?>
                      <tr>
                          <td><?php echo $num ?></td>
                          <td><?php echo $item["username"] ?></td>
                          <td><?php echo $item["fullname"] ?></td>
                          <td><?php echo $item["namede"] ?></td>
                          <td>$<?php echo $item["currentBalance"] ?></td>
                          <td><?php echo $item["email"] ?></td>
                          <td><?php echo $item["phone"] ?></td>
                          <td>
                            <a class="btn btn-xs btn-info" href="add.php?name=<?php echo $item["username"]; ?>"><i class="fas fa-trash"></i> Add balance</a>
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
          <a href="/Canteen/admin/modules/addBalance?de=<?php echo $de ?>&page=<?php echo $p-1; ?>" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
          </li>
          <?php $NoP=1; for ($i=0; $i < $pageMax  ; $i++): ?>
          <li class="paginate_button page-item <?php echo isset($p) && $p==$NoP ? "active" : "" ?>">
              <a href="/Canteen/admin/modules/addBalance?de=<?php echo $de ?>&page=<?php echo $NoP; ?>" aria-controls="dtBasicExample" data-dt-idx="3" tabindex="0" class="page-link"><?php echo $NoP; ?></a>
          </li>
          <?php $NoP++; endfor?>
          <li class="paginate_button page-item next <?php echo isset($p) && $p==$pageMax ? "disabled" : "" ?>" id="dtBasicExample_next">
          <a href="/Canteen/admin/modules/addBalance?de=<?php echo $de ?>&page=<?php echo $p+1; ?>" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
          </li>
      </ul>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
