<?php
include("./components/header.php");

$Id = $_GET['id'];
$current_date = date("Y-m-d");

$sql_get_user = "SELECT * FROM users WHERE id=$Id";
$result_get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_get_user));

$sql_ban_user = "INSERT INTO banned_users (" . implode(', ', array_keys($result_get_user)) . ", date_banned) ";
$sql_ban_user .= "VALUES ('" . implode("', '", $result_get_user) . "', '$current_date')";
$result_ban_user = mysqli_query($conn, $sql_ban_user);

$sql = "delete from users where id = $Id";
$result = mysqli_query($conn, $sql);

echo "<script>
    window.location.href = 'users_show.php';
    </script>";
?>