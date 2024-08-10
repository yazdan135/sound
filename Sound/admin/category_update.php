<?php
include("./components/header.php");

$Id = $_GET['id'];

$sql = "select * from categories where id = $Id";
$result = mysqli_query($conn , $sql);
$rows = mysqli_fetch_assoc($result);
?>

<!--Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Update Category</div>
                        <hr>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="input-1">Title:</label>
                                <input value="<?php echo $rows['title']?>" type="text" class="form-control" name="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Image:</label>
                                <span><?php echo $rows['category_img']?></span>
                                <input type="file" value="<?php echo $rows['category_img']?>" class="form-control input-file" name="image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-light px-5" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->
</div>
<!--End content-wrapper-->

<?php
include("./components/footer.php");

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    if ($_FILES['image']) {
        $img_name = $_FILES["image"]["name"];
        if($img_name != "") {
            $img_tmp = $_FILES["image"]["tmp_name"];
            move_uploaded_file($img_tmp, "../images/".$img_name);
        } else {
            $img_name = $rows['category_img'];
        }
    }
    $sql = "update categories set title = '$title', category_img = '$img_name' where id = $Id";
    $result = mysqli_query($conn,$sql);
}
?>