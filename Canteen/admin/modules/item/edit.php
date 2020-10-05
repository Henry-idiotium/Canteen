<?php

    $open="manageitem";
    require_once __dir__. "/../../autoload/autoload.php";
    $category=$db->fetchAll("tblcategory");
    $status=$db->fetchAll("tblstatus");
    $id=intval(getInput("id"));
    $edititem=$db->fetchID("tblitem", "itemId", $id);
    if (empty($edititem)) {
        $_SESSION["error"]="Data is not exist";
        redirectCate("item");
    }
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

            $idUpdate = $db->update("tblitem", $data, array("itemId"=>$id));
            if ($idUpdate>0) {
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION["success"]="Update successfully";
                redirectCate("item");
            }
            else {
                $_SESSION["error"]="Update canceled";
                redirectCate("item");
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
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <?php require_once __dir__. "/../../../partials/notification.php"; ?>
    <!-- Content Row -->
    <!-- DataTales Example -->
    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemCategory" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-8">
                <select class="form-control" name="categoryId">
                    <?php foreach ($category as $item): ?>
                    <option value="<?php echo $item["categoryId"]; ?>" <?php echo $edititem["categoryId"]==$item["categoryId"] ? "selected='selected' " : ""; ?>><?php echo $item["name"]; ?></option>
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
                <input type="text" class="form-control" id="inputItemName" name="name" placeholder="Item name" value="<?php echo $edititem["name"] ?>">
                <?php if (isset($error["name"])): ?>
                <p class="text-danger ">&nbsp <?php echo $error["name"]; ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemPrice" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="inputItemPrice" name="price" placeholder="100" value="<?php echo $edititem["price"] ?>">
                <?php if (isset($error["price"])): ?>
                <p class="text-danger ">&nbsp <?php echo $error["price"]; ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemCategory" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-8">
                <select class="form-control" name="statusId">
                    <?php foreach ($status as $item): ?>
                    <option value="<?php echo $item["statusId"]; ?>" <?php echo $edititem["statusId"]==$item["statusId"] ? "selected='selected' " : ""; ?>><?php echo $item["name"]; ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (isset($error["statusId"])): ?>
                <p class="text-danger ">&nbsp <?php echo $error["statusId"]; ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemSale" class="col-sm-2 col-form-label">Sale</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="inputItemSale" name="sale" placeholder="10%" value="<?php echo $edititem["sale"] ?>">
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
                <img src="<?php echo uploads().$edititem['image']; ?>" width="200px" height="200px" alt="">
            </div>
            <div class="col-sm-4"></div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputCategoryDes" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control" id="inputCategoryDes" name="description" placeholder="Description"><?php echo $edititem["description"] ?></textarea>
                <?php if (isset($error["description"])): ?>
                <p class="text-danger ">&nbsp <?php echo $error["description"]; ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto">
            <label for="inputCategoryDes" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</button>
            </div>
        </div>
    </form>
</div>

<!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>