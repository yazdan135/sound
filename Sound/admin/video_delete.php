<?php
include("./components/header.php");
$Id = $_GET['id'];
$sql = "delete from songs where id = $Id";
$result = mysqli_query($conn, $sql);

echo "<script>
    window.location.href = 'users_show.php';
    </script>";
?>