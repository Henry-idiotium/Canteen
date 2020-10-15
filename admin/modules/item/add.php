<?php

    $open="manageitem";
    require_once __dir__. "/../../autoload/autoload.php";
    $category=$db->fetchAll("tblcategory");
    $status=$db->fetchAll("tblstatus");
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
            "slug"=>slugify(postInput("name")),
            "price"=>postInput("price"),
            "categoryId"=>postInput("categoryId"),
            "statusId"=>postInput("statusId"),
            "description"=>postInput("description")
        ];

        $error = [];

        if (postInput("name")=="") {
            $error["name"]="Please enter a name";
        }
        if (postInput("categoryId")=="") {
            $error["categoryId"]="Please choose a category";
        }
        if (postInput("statusId")=="") {
            $error["statusId"]="Please choose a status";
        }
        if (postInput("price")=="") {
            $error["price"]="Please enter the item price";
        }
        if (postInput("description")=="") {
            $error["description"]="Please enter a description";
        }
        if (! isset($_FILES["image"])) {
        $error["image"]="Please choose an image";
        }

        if (empty($error)) {
            if (isset($_FILES["image"])) {
                $file_name=$_FILES["image"]["name"];
                $file_tmp=$_FILES["image"]["tmp_name"];
                $file_type=$_FILES["image"]["type"];
                $file_erro=$_FILES["image"]["error"];
            }

            if ($file_erro==0) {
                $part=ROOT."product/";
                $data["image"]=$file_name;
            }

            $idInsert=$db->insert("tblitem", $data);
            if (isset($idInsert)) {
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION["success"]="Add successfully";
                redirectCate("item");
            }
            else {
                $_SESSION["error"]="Add failed";
            }
        }
    }

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Manage item</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add item</h1>
        </div>
        <div class="clearfix"></div>
        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemCategory" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-8">
                    <select class="form-control" name="categoryId">
                        <option value="">Please choose a category</option>
                        <?php foreach ($category as $item): ?>
                        <option value="<?php echo $item["categoryId"]; ?>"><?php echo $item["name"]; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php if (isset($error["categoryId"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["categoryId"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemName" class="col-sm-2 col-form-label">Item name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputItemName" name="name" placeholder="Item name">
                    <?php if (isset($error["name"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["name"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemCategory" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-8">
                    <select class="form-control" name="statusId">
                    <option value="">Please choose a status</option>
                        <?php foreach ($status as $item): ?>
                        <option value="<?php echo $item["statusId"]; ?>"><?php echo $item["name"]; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php if (isset($error["statusId"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["statusId"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemPrice" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="inputItemPrice" name="price" placeholder="100">
                    <?php if (isset($error["price"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["price"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemSale" class="col-sm-2 col-form-label">Sale</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="inputItemSale" name="sale" placeholder="10%" value="0">
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemImage" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control p-1" id="inputItemImage" name="image">
                    <?php if (isset($error["image"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["image"]; ?></p>
                    <?php endif ?>
                </div>
            <div class="col-sm-4"></div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputCategoryDes" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="inputCategoryDes" name="description" placeholder="Description"></textarea>
                    <?php if (isset($error["description"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["description"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto">
                <label for="inputCategoryDes" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
