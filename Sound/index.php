<?php
session_start();
if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'index';
include("./components/header.php");
?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            <?php
            $sql_get_video = "SELECT * FROM `songs` WHERE type='video' AND is_featured=1;";
            $result_get_video = mysqli_query($conn, $sql_get_video);
            while ($row = mysqli_fetch_assoc($result_get_video)) {
                $video_id = $row['id'];
                $video_title = $row['song_title'];
                $video_img = $row['song_img'];
                $video_category = $row['song_category_id_FK'];
            ?>
                <div class="hero__items set-bg" data-setbg="./images/<?php echo $video_img; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label"><?php echo $video_category; ?></div>
                                <h2><?php echo $video_title; ?></h2>
                                <a href="./watch_video.php?id=<?php echo $video_id; ?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Songs</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="./songs.php" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // $sql_get_song = "SELECT songs.*, COUNT(comments.id) AS comment_count FROM songs LEFT JOIN comments ON songs.id = comments.song_id_FK WHERE songs.type = 'song' GROUP BY songs.id ORDER BY RAND() LIMIT 3;";
                        $sql_get_song = "SELECT 
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
                                            songs.type = 'song'
                                        GROUP BY 
                                            songs.id
                                        ORDER BY 
                                            RAND()
                                        LIMIT 3;";
                        $result_get_song = mysqli_query($conn, $sql_get_song);
                        while ($row = mysqli_fetch_assoc($result_get_song)) {
                            $song_id = $row['id'];
                            $song_title = $row['song_title'];
                            $song_img = $row['song_img'];
                            $song_category = $row['song_category_id_FK'];
                            $views_count = $row['views_count'];
                            $comment_count = $row['comment_count'];
                        ?>
                            <a href="./listen_song.php?id=<?php echo $song_id; ?>" class="col-lg-4 col-md-6 col-sm-6">
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
                <div class="popular__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Most Commented Songs</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="./songs.php" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // $sql_get_song = "SELECT songs.*, COUNT(comments.id) AS comment_count FROM songs LEFT JOIN comments ON songs.id = comments.song_id_FK WHERE songs.type = 'song' GROUP BY songs.id ORDER BY comment_count DESC LIMIT 3;";
                        $sql_get_song = "SELECT 
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
                                            songs.type = 'song'
                                        GROUP BY 
                                            songs.id
                                        ORDER BY 
                                            comment_count DESC
                                        LIMIT 3;";
                        $result_get_song = mysqli_query($conn, $sql_get_song);
                        while ($row = mysqli_fetch_assoc($result_get_song)) {
                            $song_id = $row['id'];
                            $song_title = $row['song_title'];
                            $song_img = $row['song_img'];
                            $song_category = $row['song_category_id_FK'];
                            $views_count = $row['views_count'];
                            $comment_count = $row['comment_count'];
                        ?>
                            <a href="./listen_song.php?id=<?php echo $song_id; ?>" class="col-lg-4 col-md-6 col-sm-6">
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
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    <div class="product__sidebar__view">
                        <div class="section-title">
                            <h5>Most Viewed Videos</h5>
                        </div>
                        <div class="filter__gallery">
                            <?php
                            // $sql_get_video = "SELECT * FROM `songs` WHERE type='video' ORDER BY views_count DESC LIMIT 4;";
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
                                            ORDER BY 
                                                views_data.views_count DESC
                                            LIMIT 4;";
                            $result_get_video = mysqli_query($conn, $sql_get_video);
                            while ($row = mysqli_fetch_assoc($result_get_video)) {
                                $video_id = $row['id'];
                                $video_title = $row['song_title'];
                                $video_img = $row['song_img'];
                                $video_category = $row['song_category_id_FK'];
                                $views_count = $row['views_count'];
                            ?>
                                <a href="./watch_video.php?id=<?php echo $video_id; ?>" class="product__sidebar__view__item set-bg mix day years d-block" data-setbg="./images/<?php echo $video_img; ?>">
                                    <div class="view"><i class="fa fa-eye"></i> <?php echo $views_count; ?></div>
                                    <h5 style="color: #ffffff; font-weight: 700; line-height: 26px;"><?php echo $video_title; ?></h5>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Videos</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="./videos.php" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // $sql_get_video = "SELECT songs.*, COUNT(comments.id) AS comment_count FROM songs LEFT JOIN comments ON songs.id = comments.song_id_FK WHERE songs.type = 'video' GROUP BY songs.id ORDER BY RAND() LIMIT 2;";
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
                                            songs.id
                                        ORDER BY 
                                            RAND()
                                        LIMIT 2;";
                        $result_get_video = mysqli_query($conn, $sql_get_video);
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