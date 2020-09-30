<?php
  $open="manageitem";
  require_once __dir__. "/../../autoload/autoload.php";
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // if(isset($_POST["name"]) && $_POST["name"]!=NULL)
    // {
    //   $name=$_POST["name"];
    // }

    // $name=postInput("name");
    // echo $name;

    $data =
    [
      "name"=>postInput("name"),
      "description"=>postInput("description"),
      "slug"=>slugify(postInput("name"))
    ];

    $error = [];

    if (postInput("name")=="") {
      $error["name"]="Please enter a category name";
    }

    if (empty($error)) {

      $isset=$db->fetchOne("tblcategory", " name= '".$data["name"]."' ");
      if (count($isset)>0) {
        $_SESSION["error"]="The category has already existed";
      }
      else {
        $idInsert = $db->insert("tblcategory", $data);
        if ($idInsert>0) {
          $_SESSION["success"]="<i class='fas fa-plus'></i> Add category successfully";
          redirectCate("category");
        }
        else{
          $_SESSION["error"]="Add failed";
          redirectCate("category");
        }
      }

    }
  }

?>
<?php require_once __dir__. "/../../layouts/header.php"; ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Category</h1>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Manage item</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Category</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                        <div class="clearfix"></div>
                        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
                        <!-- Content Row -->
                        <!-- DataTales Example -->
                        <form action="" method="POST" class="form-horizontal">
                          <div class="form-group row mr-auto ml-auto justify-content-center">
                            <label for="inputCategoryName" class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputCategoryName" name="name" placeholder="Category name">
                              <?php if (isset($error["name"])): ?>
                                <p class="text-danger ">&nbsp <?php echo $error["name"]; ?></p>
                              <?php endif ?>
                            </div>
                          </div>
                          <div class="form-group row mr-auto ml-auto justify-content-center">
                            <label for="inputCategoryDes" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-8">
                              <textarea type="text" class="form-control" id="inputCategoryDes" name="description" placeholder="Description"></textarea>
                            </div>
                          </div>
                          <div class="form-group row mr-auto ml-auto">
                            <label for="inputCategoryDes" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                            </div>
                          </div>
                        </form>

                <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
