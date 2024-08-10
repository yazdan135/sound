<?php
include("./components/header.php");
?>

<!--Start content-wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Song</div>
                        <hr>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="input-1">Title:</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Image:</label>
                                <input type="file" class="form-control input-file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Song:</label>
                                <input type="file" class="form-control input-file" name="song">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Author Name:</label>
                                <input type="text" class="form-control" name="author_name" placeholder="Enter Author Name">
                            </div>
                            <div class="form-group">
                                <label for="input-1">Category:</label> <br>
                                <select name="cat_id" class="form-control">
                                <?php
                                    $sql_category_show = "SELECT * FROM categories;";
                                    $result_category_show = mysqli_query($conn, $sql_category_show);
                                    if ($result_category_show) {
                                        if(mysqli_num_rows($result_category_show) > 0){
                                            while ($row = mysqli_fetch_assoc($result_category_show)) {
                                                ?>
                                                    <option value="<?php echo $row['title'];?>"><?php echo $row['title'];?></option>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
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
        move_uploaded_file($img_tmp, "../images/".$img_name);
    }
    if ($_FILES['song']) {
        $song_name = $_FILES["song"]["name"];
        $song_tmp = $_FILES["song"]["tmp_name"];
        move_uploaded_file($song_tmp, "../songs/".$song_name);
    }
    $current_date = date("Y-m-d");
    $author_name = $_POST['author_name'];
    $cat_id = $_POST['cat_id'];
    $adder_admin = $_SESSION["admin"];

    $sql = "INSERT INTO songs (song_title, song_img, song_path, type, date_added, author, song_category_id_FK, adder_admin) VALUES ('$title', '$img_name', '$song_name', 'song', '$current_date', '$author_name', '$cat_id', '$adder_admin')";
    $result = mysqli_query($conn, $sql);
}
?>