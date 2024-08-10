<?php
    function checkPage($pageName) {
        if ($pageName == $_SESSION["page"]) {
            echo "active";
        }
    }
?>