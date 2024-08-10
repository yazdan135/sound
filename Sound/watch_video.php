<?php
session_start();

include("./components/login_checker.php");

if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'watch-video';

include("./components/header.php");

$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$likes_count = 0;
$views_count = 0;

$sql_get_video = "SELECT 
                        songs.*, 
                        IFNULL(likes_data.likes_count, 0) AS likes_count,
                        IFNULL(likes_data.liker_user_id, '') AS liker_user_id,
                        IFNULL(views_data.views_count, 0) AS views_count,
                        IFNULL(views_data.viewer_user_id, '') AS viewer_user_id,
                        IFNULL(favourites_data.favourites_count, 0) AS favourites_count,
                        IFNULL(favourites_data.favouriter_user_id, '') AS favouriter_user_id
                    FROM 
                        songs
                    LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS likes_count, 
                            GROUP_CONCAT(liker_user_id_FK) AS liker_user_id
                        FROM 
                            likes
                        GROUP BY 
                            song_id_FK
                    ) AS likes_data ON songs.id = likes_data.song_id_FK
                    LEFT JOIN (
                        SELECT 
                            song_id_FK, 
                            COUNT(id) AS views_count, 
                            GROUP_CONCAT(viewer_user_id_FK) AS viewer_user_id
                        FROM 
                            views
                        GROUP BY 
                            song_id_FK
                    ) AS views_data ON songs.id = views_data.song_id_FK
                    LEFT JOIN (
                    SELECT 
                        song_id_FK, 
                        COUNT(id) AS favourites_count, 
                        GROUP_CONCAT(favouriter_user_id_FK) AS favouriter_user_id
                    FROM 
                        favourites
                    GROUP BY 
                        song_id_FK
                    ) AS favourites_data ON songs.id = favourites_data.song_id_FK
                    WHERE 
                        songs.id = $id AND songs.type = 'video';
                    ";

$result_get_video = mysqli_fetch_assoc(mysqli_query($conn, $sql_get_video));

$likes_count = $result_get_video['likes_count'];
$views_count = $result_get_video['views_count'];

$liker_user_ids = explode(',', $result_get_video['liker_user_id']);
$viewer_user_ids = explode(',', $result_get_video['viewer_user_id']);
$favouriter_user_ids = explode(',', $result_get_video['favouriter_user_id']);

if (!in_array($user_id, $viewer_user_ids)) {
    $sql_view = "INSERT INTO views(viewer_user_id_FK, song_id_FK) VALUES($user_id, $id);";
    $result_view = mysqli_query($conn, $sql_view);
}
?>

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="anime__video__player" style="margin-bottom: 0;">
                    <video id="player" playsinline controls data-poster="./images/<?php echo $result_get_video['song_img']; ?>">
                        <source src="./videos/<?php echo $result_get_video['song_path']; ?>" />
                        <!-- Captions are optional -->
                        <track kind="captions" label="English captions" src="#" srclang="en" default />
                    </video>
                </div>
                <div class="d-flex justify-content-between align-items-center" style="margin-top: 35px; margin-bottom: 70px;">
                    <div class="section-title m-0">
                        <h5><?php echo $result_get_video['song_title'] ?></h5>
                        <h5>Author: <?php echo $result_get_video['author']; ?></h5>
                    </div>
                    <div class="section-info d-flex align-items-center" style="gap: .7vw;">
                        <a href="add_to_favourite.php?id=<?php echo $result_get_video['id']; ?>&type=video" class="favourite-btn my-btn my-btn-hover text-white <?php if (in_array($user_id, $favouriter_user_ids)) {
                                                                                                                                                                    echo 'my-btn-active';
                                                                                                                                                                } ?>"><i class="fa-solid fa-star"></i></a>
                        <a href="./like.php?id=<?php echo $id; ?>&type=video" class="like-btn text-white my-btn my-btn-hover <?php if (in_array($user_id, $liker_user_ids)) {
                                                                                                                                    echo 'my-btn-active';
                                                                                                                                } ?>"><i class="fa-solid fa-thumbs-up"></i> <?php echo $likes_count; ?></a>
                        <div class="views-btn text-white my-btn"><i class="fa fa-eye"></i> <?php echo $views_count; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="anime__details__form" style="margin-bottom: 30px;">
                    <div class="section-title">
                        <h5>Your Comment</h5>
                    </div>
                    <form method="POST">
                        <textarea placeholder="Your Comment" name="comment"></textarea>
                        <button type="submit" name="submit"><i class="fa fa-location-arrow"></i> SEND</button>
                    </form>
                </div>
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Comments</h5>
                    </div>
                    <?php
                    $sql_get_comments = "SELECT comments.*, users.profile_pic, users.username FROM comments INNER JOIN users ON comments.commenter_user_id_FK = users.id WHERE comments.song_id_FK=$id;";
                    $result_get_comments = mysqli_query($conn, $sql_get_comments);
                    while ($rows = mysqli_fetch_assoc($result_get_comments)) {
                        $comment = $rows['comment'];
                        $date_commented = $rows['date_commented'];
                        $username = $rows['username'];
                        $profile_pic = $rows['profile_pic'];
                    ?>
                        <div class="anime__review__item">
                            <div class="anime__review__item__pic">
                                <img src="./images/<?php echo $profile_pic; ?>" alt="">
                            </div>
                            <div class="anime__review__item__text">
                                <h6>@<?php echo $username ?> - <span><?php echo $date_commented; ?></span></h6>
                                <p><?php echo $comment; ?></p>
                            </div>
                        </div>
                    <?php } ?>
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
                                            LIMIT 3;";
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
<!-- Anime Section End -->

<?php
include("./components/footer.php");

if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $commenter_user_id_FK = $user_id;

    $sql_add_comment = "INSERT INTO comments(comment, commenter_user_id_FK, song_id_FK) VALUES('$comment', $commenter_user_id_FK, $id)";
    $result_add_comment = mysqli_query($conn, $sql_add_comment);
    echo "<script>
    window.location.href = 'watch_video.php?id=$id';
    </script>";
}
?>