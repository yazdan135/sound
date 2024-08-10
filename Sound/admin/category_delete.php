<?php


include("./components/header.php");
$Id = $_GET['id'];
$sql = "delete from categories where id = $Id";
$result = mysqli_query($conn, $sql);

echo "<script>
    alert('category Deleted Successfully');
    window.location.href = 'category_show.php';
    </script>";
?>