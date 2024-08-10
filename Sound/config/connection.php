<?php

    $conn = new mysqli("localhost", "root", "", "sound");

    if (!$conn) {
        die("Connection Failed");
    }

?>