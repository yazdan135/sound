<?php
include("./components/header.php");
$Id = $_GET['id'];

$sql = "select * from songs where id = $Id";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);
?>

<!--Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Update Song</div>
                        <hr>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="input-1">Title:</label>
                                <input value="<?php echo $rows['song_title'] ?>" type="text" class="form-control" name="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Image:</label>
                                <span><?php echo $rows['song_img'] ?></span>
                                <input type="file" value="<?php echo $rows['song_img'] ?>" class="form-control input-file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Song:</label>
                                <span><?php echo $rows['song_path'] ?></span>
                                <input type="file" value="<?php echo $rows['song_path'] ?>" class="form-control input-file" name="song">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Author Name:</label>
                                <input value="<?php echo $rows['author'] ?>" type="text" class="form-control" name="author_name" placeholder="Enter Author Name">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Category:</label> <br>
                                <select name="cat_id" class="form-control">
                                    < <?php
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row['title'];?>"><?php echo $row['title'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-light px-5" name="submit">Add</button>
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
        $img_tmp = $_FILES["image"]["tmp_name"];
        move_uploaded_file($img_tmp, "../images/" . $img_name);
    }
    if ($_FILES['song']) {
        $song_name = $_FILES["song"]["name"];
        $song_tmp = $_FILES["song"]["tmp_name"];
        move_uploaded_file($song_tmp, "../songs/" . $song_name);
    }
    $current_date = date("Y-m-d");
    $author_name = $_POST['author_name'];
    $cat_id = $_POST['cat_id'];

    $sql = "UPDATE `songs` SET `song_title`='$title',`song_img`='$img_name',`song_path`='$song_name',`author`='$author_name',`song_category_id_FK`='$cat_id' WHERE id=$Id";
    $result = mysqli_query($conn, $sql);
}
?>