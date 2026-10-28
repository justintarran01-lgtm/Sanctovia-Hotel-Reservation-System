<?php

$connection = mysqli_connect(
    "localhost",
    "root",
    "",
    "hotel_reservation"
);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>