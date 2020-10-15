<?php
    $open="manageaccount";
    require_once __dir__. "/../../autoload/autoload.php";
?>
<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <ol class="breadcrumb m-4">
        <li class="breadcrumb-item">Manage account</li>
    </ol>
    <div class="container-fluid text-center">
      <a class="btn btn-xs btn-info" href="showadmin.php?"><i class="fas fa-eye"></i> Show admin</a>
      <a class="btn btn-xs btn-info" href="showcaterer.php?"><i class="fas fa-eye"></i> Show caterer</a>
      <a class="btn btn-xs btn-info" href="showuser.php?"><i class="fas fa-eye"></i> Show user</a>
    </div>

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
