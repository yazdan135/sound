<?php
include("./components/header.php");

$Id = $_GET['id'];

$sql_get_user = "SELECT * FROM banned_users WHERE id=$Id";
$result_get_user = mysqli_fetch_assoc(mysqli_query($conn, $sql_get_user));

unset($result_get_user['date_banned']);

$sql_unban_user = "INSERT INTO users (" . implode(', ', array_keys($result_get_user)) . ") ";
$sql_unban_user .= "VALUES ('" . implode("', '", $result_get_user) . "')";
$result_unban_user = mysqli_query($conn, $sql_unban_user);

$sql = "delete from banned_users where id = $Id";
$result = mysqli_query($conn, $sql);

echo "<script>
    window.location.href = 'banned_users_show.php';
    </script>";
?>