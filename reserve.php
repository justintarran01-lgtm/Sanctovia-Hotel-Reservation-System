<?php
session_start();
include "db.php";


if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: booking.html");
    exit;
}

$user_id = (int) $_SESSION["user_id"];

$room_id = $_POST["room_id"] ?? "";
$address = trim($_POST["address"] ?? "");
$contact_number = trim($_POST["contact_number"] ?? "");
$check_in = trim($_POST["checkin"] ?? "");
$check_out = trim($_POST["checkout"] ?? "");


if (
    $room_id === "" ||
    $address === "" ||
    $contact_number === "" ||
    $check_in === "" ||
    $check_out === ""
) {
    die("Please complete all booking fields.");
}


if (!ctype_digit((string) $room_id) || (int) $room_id < 1) {
    die("Please select a valid room.");
}

$room_id = (int) $room_id;


$check_in_date = DateTime::createFromFormat("!Y-m-d", $check_in);
$check_out_date = DateTime::createFromFormat("!Y-m-d", $check_out);

if (
    !$check_in_date ||
    !$check_out_date ||
    $check_in_date->format("Y-m-d") !== $check_in ||
    $check_out_date->format("Y-m-d") !== $check_out
) {
    die("Please enter valid check-in and check-out dates.");
}

$today = date("Y-m-d");

if ($check_in < $today) {
    die("Check-in cannot be in the past.");
}

if ($check_out <= $check_in) {
    die("Check-out must be after check-in.");
}


$room_sql = "SELECT room_id FROM room WHERE room_id = ?";
$room_stmt = mysqli_prepare($connection, $room_sql);

if (!$room_stmt) {
    die("Could not check the selected room.");
}

mysqli_stmt_bind_param($room_stmt, "i", $room_id);
mysqli_stmt_execute($room_stmt);
$room_result = mysqli_stmt_get_result($room_stmt);

if (mysqli_num_rows($room_result) === 0) {
    mysqli_stmt_close($room_stmt);
    die("The selected room does not exist.");
}

mysqli_stmt_close($room_stmt);

$sql = "INSERT INTO reservation
        (user_id, room_id, address, contact_number, check_in, Check_out)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    die("Could not prepare the reservation: " .
        mysqli_error($connection));
}

mysqli_stmt_bind_param(
    $stmt,
    "iissss",
    $user_id,
    $room_id,
    $address,
    $contact_number,
    $check_in,
    $check_out
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    header("Location: view_reservation.php");
    exit;
}

$error = mysqli_stmt_error($stmt);

mysqli_stmt_close($stmt);
mysqli_close($connection);

die("Could not save your reservation: " . htmlspecialchars($error));
?>
