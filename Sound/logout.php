<?php
    session_start();
    include("../config/connection.php");

    session_destroy();
    echo "<script>
    window.location.href = './index.php';
    </script>";
?>