<?php
session_start();
if (isset($_SESSION["page"])) {
    unset($_SESSION["page"]);
}
$_SESSION["page"] = 'categories';
include("./components/header.php");

// $sql_get_category = "SELECT songs.*, COUNT(comments.id) AS comment_count FROM songs LEFT JOIN comments ON songs.id = comments.song_id_FK WHERE songs.type = 'video' GROUP BY songs.id ORDER BY RAND() LIMIT 2;";
$sql_get_category = "SELECT 
                    c.*,
                    COUNT(CASE WHEN s.type = 'song' THEN 1 END) AS song_count,
                    COUNT(CASE WHEN s.type = 'video' THEN 1 END) AS video_count
                  FROM 
                    categories c
                  LEFT JOIN 
                    songs s ON s.song_category_id_FK = c.title
                  GROUP BY 
                    c.id;
                  ";
$result_get_category = mysqli_query($conn, $sql_get_category);
$total_result = mysqli_num_rows($result_get_category);
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
                                <h4>Categories</h4>
                            </div>
                        </div>
                        <div>
                            <div class="tag"><?php echo $total_result; ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <?php
                            while ($row = mysqli_fetch_assoc($result_get_category)) {
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                                $category_img = $row['category_img'];
                                $song_count = $row['song_count'];
                                $video_count = $row['video_count'];
                            ?>
                                <div class="category-card col-lg-6 col-md-9 col-sm-12">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="./images/<?php echo $category_img; ?>">
                                            <div class="hover-elem">
                                                <a href="./songs.php?category=<?php echo $category_title; ?>">Songs</a>
                                                <a href="./videos.php?category=<?php echo $category_title; ?>">Videos</a>
                                            </div>
                                            <div class="comment"><i class="fa-solid fa-music"></i> <?php echo $song_count; ?></div>
                                            <div class="view"><i class="fa-solid fa-video"></i> <?php echo $video_count; ?></div>
                                        </div>
                                        <div class="product__item__text">
                                            <h5 class="text-white"><?php echo $category_title; ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
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