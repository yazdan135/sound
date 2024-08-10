<?php
    include("./components/header.php");

    $sql_song_show = "SELECT * FROM songs WHERE type='song';";
    $result_song_show = mysqli_query($conn, $sql_song_show);

    $sql_video_show = "SELECT * FROM songs WHERE type='video';";
    $result_video_show = mysqli_query($conn, $sql_video_show);

    $sql_category_show = "SELECT * FROM categories;";
    $result_category_show = mysqli_query($conn, $sql_category_show);

    $sql_admin_show = "SELECT * FROM users WHERE user_role='admin';";
    $result_admin_show = mysqli_query($conn, $sql_admin_show);
?>

<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <!--Start Dashboard Content-->
        <div class="card mt-3">
            <div class="card-content">
                <div class="row row-group m-0">
                    <div class="col-lg-6 col-xl-6 border-light p-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Songs <span class="float-right"><i class="fa-solid fa-music"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_song_show);?></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 border-light p-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Videos <span class="float-right"><i class="fa-solid fa-video"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_video_show);?></h1>
                        </div>
                    </div>
                </div>
                <div class="row row-group m-0">
                    <div class="col-lg-6 col-xl-6 border-light p-4">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Categories <span class="float-right"><i class="fa-solid fa-table-list"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_category_show);?></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 border-light p-4">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Admins <span class="float-right"><i class="fa-solid fa-circle-question"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_admin_show);?></h1>
                        </div>
                    </div>
                </div>
                <!-- <div class="row row-group m-0">
                    <div class="col-lg-6 col-xl-6 border-light p-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Songs <span class="float-right"><i class="fa-solid fa-music"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_song_show);?></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 border-light p-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Videos <span class="float-right"><i class="fa-solid fa-video"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_video_show);?></h1>
                        </div>
                    </div>
                </div>
                <div class="row row-group m-0">
                    <div class="col-lg-6 col-xl-6 border-light p-4">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Categories <span class="float-right"><i class="fa-solid fa-table-list"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_category_show);?></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 border-light p-4">
                        <div class="card-body">
                            <h5 class="text-white mb-4">Total Requests <span class="float-right"><i class="fa-solid fa-circle-question"></i></span></h5>
                            <h1 class="text-white text-center" style="font-size: 5rem;"><?php echo mysqli_num_rows($result_admin_show);?></h1>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        User Requests
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-borderless">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Photo</th>
                                    <th>Product ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Shipping</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Iphone 5</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405822</td>
                                    <td>$ 1250.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 90%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Earphone GL</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405820</td>
                                    <td>$ 1500.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 60%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>HD Hand Camera</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405830</td>
                                    <td>$ 1400.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 70%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Clasic Shoes</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405825</td>
                                    <td>$ 1200.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Hand Watch</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405840</td>
                                    <td>$ 1800.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 40%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Clasic Shoes</td>
                                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                                    <td>#9405825</td>
                                    <td>$ 1200.00</td>
                                    <td>03 Aug 2017</td>
                                    <td>
                                        <div class="progress shadow" style="height: 3px;">
                                            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->

        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

    </div>
    <!-- End container-fluid-->

</div><!--End content-wrapper-->

<?php include("./components/footer.php"); ?>