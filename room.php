<?php

include "db.php";

$sql = "SELECT * FROM room";

$result = mysqli_query($connection, $sql);


while ($row = mysqli_fetch_assoc($result)) {
    echo $row["room_name"] . " - ₱" . $row["price"] . "<br>";
}




?>
