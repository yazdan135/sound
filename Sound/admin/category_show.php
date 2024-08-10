<?php
include("./components/header.php");
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <a href="./category_add.php" type="submit" class="btn btn-light px-5 m-3">Add</a>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Categories</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_category_show = "SELECT * FROM categories;";
                  $result_category_show = mysqli_query($conn, $sql_category_show);
                  $serial_number = 1;
                  if ($result_category_show) {
                    if (mysqli_num_rows($result_category_show) > 0) {
                      while ($row = mysqli_fetch_assoc($result_category_show)) {
                  ?>
                    <tr>
                      <th scope="row"><?php echo $serial_number;?></th>
                      <td><?php echo $row['title'];?></td>
                      <td><div class="cat_img" style="width: 50px; height: 50px; border-radius: 10px;"><img src="../images/<?php echo $row['category_img'];?>" style="object-fit: cover; overflow: hidden; width: 100%; height: 100%;" alt=""></div></td>
                      <td>
                        <a href="./category_update.php?id=<?php echo $row["id"];?>" type="submit" class="btn btn-light px-3"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="./category_delete.php?id=<?php echo $row["id"];?>" type="submit" class="btn btn-light px-3"><i class="fa-solid fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                        $serial_number++;
                      }
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!--End Row-->
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->

  </div>
  <!-- End container-fluid-->

</div><!--End content-wrapper-->

<?php
include("./components/footer.php");
?>