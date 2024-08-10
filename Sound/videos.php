<?php
session_start();
if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'videos';
include("./components/header.php");

// $sql_get_video = "SELECT songs.*, COUNT(comments.id) AS comment_count FROM songs LEFT JOIN comments ON songs.id = comments.song_id_FK WHERE songs.type = 'video' GROUP BY songs.id ORDER BY RAND() LIMIT 2;";
if (isset($_GET['search_input'])) {
    $search_input = $_GET['search_input'];
    $sql_get_video = "SELECT 
                            songs.*, 
                            IFNULL(comments_data.comment_count, 0) AS comment_count, 
                            IFNULL(views_data.views_count, 0) AS views_count
                        FROM 
                            songs
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS comment_count
                        FROM 
                            comments
                        GROUP BY 
                            song_id_FK
                        ) AS comments_data ON songs.id = comments_data.song_id_FK
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS views_count
                        FROM 
                            views
                        GROUP BY 
                            song_id_FK
                        ) AS views_data ON songs.id = views_data.song_id_FK
                        WHERE 
                            songs.type = 'video' AND songs.song_title LIKE '%$search_input%'
                        GROUP BY 
                            songs.id;";
} elseif (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql_get_video = "SELECT 
                            songs.*, 
                            IFNULL(comments_data.comment_count, 0) AS comment_count, 
                            IFNULL(views_data.views_count, 0) AS views_count
                        FROM 
                            songs
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS comment_count
                        FROM 
                            comments
                        GROUP BY 
                            song_id_FK
                        ) AS comments_data ON songs.id = comments_data.song_id_FK
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS views_count
                        FROM 
                            views
                        GROUP BY 
                            song_id_FK
                        ) AS views_data ON songs.id = views_data.song_id_FK
                        WHERE 
                            songs.type = 'video' AND songs.song_category_id_FK = '$category'
                        GROUP BY 
                            songs.id;";
} else {
    $sql_get_video = "SELECT 
                            songs.*, 
                            IFNULL(comments_data.comment_count, 0) AS comment_count, 
                            IFNULL(views_data.views_count, 0) AS views_count
                        FROM 
                            songs
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS comment_count
                        FROM 
                            comments
                        GROUP BY 
                            song_id_FK
                        ) AS comments_data ON songs.id = comments_data.song_id_FK
                        LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS views_count
                        FROM 
                            views
                        GROUP BY 
                            song_id_FK
                        ) AS views_data ON songs.id = views_data.song_id_FK
                        WHERE 
                            songs.type = 'video'
                        GROUP BY 
                            songs.id;";
}
$result_get_video = mysqli_query($conn, $sql_get_video);
$total_result = mysqli_num_rows($result_get_video);
?>

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="trending__product">
                    <div class="row d-flex justify-content-between align-items-center" style="margin-bottom: 30px;">
                        <div>
                            <div class="section-title" style="margin: 0;">
                                <h4>Videos</h4>
                            </div>
                        </div>
                        <div>
                            <div class="tag"><?php echo $total_result; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($result_get_video)) {
                            $song_id = $row['id'];
                            $song_title = $row['song_title'];
                            $song_img = $row['song_img'];
                            $song_category = $row['song_category_id_FK'];
                            $views_count = $row['views_count'];
                            $comment_count = $row['comment_count'];
                        ?>
                            <a href="./watch_video.php?id=<?php echo $song_id; ?>" class="col-lg-6 col-md-9 col-sm-12">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="./images/<?php echo $song_img; ?>">
                                        <div class="comment"><i class="fa fa-comments"></i> <?php echo $comment_count; ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $views_count; ?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li class="tag"><?php echo $song_category; ?></li>
                                        </ul>
                                        <h5 class="text-white"><?php echo $song_title; ?></h5>
                                    </div>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
include("./components/footer.php");
?>