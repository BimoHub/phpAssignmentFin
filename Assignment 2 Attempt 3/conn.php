<?php
    $conn = mysqli_connect("localhost", "root", "") or die("Connection failed cuz: " . mysqli_connect_error());
    mysqli_select_db($conn, "php_forum") or die("Database connection failed cuz: " . mysqli_connect_error());