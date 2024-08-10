<?php
    session_start();
    include("./config/connection.php");

    $user_id = $_SESSION['user_id'];
    $song_id = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'song') {
        $page = 'listen_song';
    } elseif($type == 'video') {
        $page = 'watch_video';
    }

    $sql_check = "SELECT * FROM favourites WHERE song_id_FK='$song_id' AND favouriter_user_id_FK='$user_id';";
    $result_check = mysqli_num_rows(mysqli_query($conn, $sql_check));

    if ($result_check>0) {
        $sql_favourite = "DELETE FROM favourites WHERE song_id_FK='$song_id' AND favouriter_user_id_FK='$user_id';";
    } else {
        $sql_favourite = "INSERT INTO favourites(favouriter_user_id_FK, song_id_FK) VALUES($user_id, $song_id);";
    }

    $result_favourite = mysqli_query($conn, $sql_favourite);
    echo "<script>
    window.location.href = './$page.php?id=$song_id';
    </script>";
?>