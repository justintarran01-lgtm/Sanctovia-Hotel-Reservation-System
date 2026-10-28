```php
<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

if (
    $_SERVER["REQUEST_METHOD"] !== "POST" ||
    !isset($_POST["reservation_id"]) ||
    !ctype_digit($_POST["reservation_id"])
) {
    header("Location: view_reservation.php");
    exit;
}

$user_id = (int) $_SESSION["user_id"];
$reservation_id = (int) $_POST["reservation_id"];

$sql = "DELETE FROM reservation
        WHERE reservation_it = ? AND user_id = ?";

$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    die("Could not prepare delete: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "ii", $reservation_id, $user_id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    header("Location: view_reservation.php");
    exit;
}

die("Could not delete reservation: " . mysqli_stmt_error($stmt));
?>
```