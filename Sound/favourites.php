<?php
session_start();

include("./components/login_checker.php");

if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'favourites';

$user_id = $_SESSION['user_id'];

include("./components/header.php");
?>

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Favourite Songs</h4>
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
                                        INNER JOIN 
                                            favourites ON songs.id = favourites.song_id_FK
                                        WHERE 
                                            songs.type = 'song' 
                                            AND favourites.favouriter_user_id_FK = $user_id
                                        GROUP BY 
                                            songs.id;
                                        ";
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
                            <h5>Favourite Videos</h5>
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
                                            INNER JOIN 
                                                favourites ON songs.id = favourites.song_id_FK
                                            WHERE 
                                                songs.type = 'video' 
                                                AND favourites.favouriter_user_id_FK = $user_id;
                                            ";
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
    </div>
</section>
<!-- Product Section End -->

<?php
include("./components/footer.php");
?>