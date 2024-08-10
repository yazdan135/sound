<?php
    session_start();
    include("./config/connection.php");

    $user_id = $_SESSION['user_id'];
    $song_id = $_GET['id'];
    $type = $_GET['type'];

    if (!$song_id and !$type) {
        header("Location: ../login.php");
        die();
    }

    if ($type == 'song') {
        $page = 'listen_song';
    } elseif($type == 'video') {
        $page = 'watch_video';
    }

    $sql_check = "SELECT * FROM likes WHERE song_id_FK='$song_id' AND liker_user_id_FK='$user_id';";
    $result_check = mysqli_num_rows(mysqli_query($conn, $sql_check));

    if ($result_check>0) {
        $sql_like = "DELETE FROM likes WHERE song_id_FK='$song_id' AND liker_user_id_FK='$user_id';";
    } else {
        $sql_like = "INSERT INTO likes(liker_user_id_FK, song_id_FK) VALUES($user_id, $song_id);";
    }

    $result_like = mysqli_query($conn, $sql_like);
    echo "<script>
    window.location.href = './$page.php?id=$song_id';
    </script>";
?>