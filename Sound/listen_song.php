<?php
session_start();

include("./components/login_checker.php");

if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'listen-song';

include("./components/header.php");

$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$likes_count = 0;
$views_count = 0;

$sql_get_song = "SELECT 
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
                    songs.id = $id AND songs.type = 'song';
                ";

$result_get_song = mysqli_fetch_assoc(mysqli_query($conn, $sql_get_song));

$likes_count = $result_get_song['likes_count'];
$views_count = $result_get_song['views_count'];

$liker_user_ids = explode(',', $result_get_song['liker_user_id']);
$viewer_user_ids = explode(',', $result_get_song['viewer_user_id']);
$favouriter_user_ids = explode(',', $result_get_song['favouriter_user_id']);

if (!in_array($user_id, $viewer_user_ids)) {
    $sql_view = "INSERT INTO views(viewer_user_id_FK, song_id_FK) VALUES($user_id, $id);";
    $result_view = mysqli_query($conn, $sql_view);
}
?>

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="anime__details__pic set-bg" style="height: 100%;" data-setbg="./images/<?php echo $result_get_song['song_img']; ?>"></div>
                </div>
                <div class="col-lg-6">
                    <div class="anime__details__text">
                        <div class="d-flex">
                            <div class="anime__details__title" style="width: 100%;">
                                <h3>Author: <?php echo $result_get_song['author']; ?></h3>
                                <span class="tag"><?php echo $result_get_song['song_category_id_FK']; ?></span>
                            </div>
                            <div class="section-info" style="text-wrap: nowrap;">
                                <a href="add_to_favourite.php?id=<?php echo $result_get_song['id']; ?>&type=song" class="favourite-btn my-btn my-btn-hover text-white <?php if (in_array($user_id, $favouriter_user_ids)) {
                                                                                                                                                                            echo 'my-btn-active';
                                                                                                                                                                        } ?>"><i class="fa-solid fa-star"></i></a>
                            </div>
                        </div>
                        <div class="controls">
                            <div class="title">
                                <div class="title-tag"><?php echo $result_get_song['song_title']; ?></div>
                            </div>
                            <div class="bar">
                                <div class="bar-progress">
                                    <div class="bar-progress-active"></div>
                                </div>
                                <div class="bar-time">
                                    <span class="tag progress-timer">00:00</span>
                                    <span class="tag duration">00:00</span>
                                </div>
                            </div>
                            <div class="control-btns">
                                <button class="control-btn previous-btn" onclick="goBack()">
                                    <i class="fa-solid fa-backward-step"></i>
                                </button>
                                <button class="control-btn play-btn" onclick="play(this)">
                                    <i class="fa-solid fa-play"></i>
                                    <audio src="./songs/<?php echo $result_get_song["song_path"] ?>" ontimeupdate="updateProgress()"></audio>
                                </button>
                                <a href="#" class="control-btn next-btn">
                                    <i class="fa-solid fa-forward-step"></i>
                                </a>
                            </div>
                        </div>
                        <div class="section-info d-flex align-items-center" style="gap: .7vw;">
                            <a href="./like.php?id=<?php echo $id; ?>&type=song" class="like-btn text-white my-btn my-btn-hover <?php if (in_array($user_id, $liker_user_ids)) {
                                                                                                                                    echo 'my-btn-active';
                                                                                                                                } ?>"><i class="fa-solid fa-thumbs-up"></i> <?php echo $likes_count; ?></a>
                            <div class="like-btn text-white my-btn"><i class="fa fa-eye"></i> <?php echo $views_count; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
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
            <div class="col-lg-3">
                <div class="trending__product more-songs">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>More Songs</h4>
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
                                        LIMIT 2;";
                        $result_get_song = mysqli_query($conn, $sql_get_song);
                        while ($row = mysqli_fetch_assoc($result_get_song)) {
                            $song_id = $row['id'];
                            $song_title = $row['song_title'];
                            $song_img = $row['song_img'];
                            $song_category = $row['song_category_id_FK'];
                            $views_count = $row['views_count'];
                            $comment_count = $row['comment_count'];
                        ?>
                            <a href="./listen_song.php?id=<?php echo $song_id; ?>" class="col-lg-12">
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
<!-- Anime Section End -->



<?php
include("./components/footer.php");

if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $commenter_user_id_FK = $user_id;

    $sql_add_comment = "INSERT INTO comments(comment, commenter_user_id_FK, song_id_FK) VALUES('$comment', $commenter_user_id_FK, $id)";
    $result_add_comment = mysqli_query($conn, $sql_add_comment);
    echo "<script>
    window.location.href = './listen_song.php?id=$id';
    </script>";
}
?>