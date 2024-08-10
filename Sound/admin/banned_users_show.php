<?php
include("./components/header.php");
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Banned Users</h5>
            <div class="table-responsive" style="overflow-x: hidden;">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date Banned</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_users_show = "SELECT * FROM banned_users;";
                  $result_users_show = mysqli_query($conn, $sql_users_show);
                  $serial_number = 1;
                  if ($result_users_show) {
                    if (mysqli_num_rows($result_users_show) > 0) {
                      while ($row = mysqli_fetch_assoc($result_users_show)) {
                  ?>
                    <tr>
                      <th scope="row"><?php echo $serial_number;?></th>
                      <td><?php echo $row['full_name'];?></td>
                      <td><?php echo $row['username'];?></td>
                      <td><?php echo $row['email'];?></td>
                      <td><?php echo $row['date_banned'];?></td>
                      <td>
                        <a href="./user_unban.php?id=<?php echo $row["id"];?>" type="submit" class="btn btn-light px-3"><i class="fa-solid fa-check"></i></a>
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