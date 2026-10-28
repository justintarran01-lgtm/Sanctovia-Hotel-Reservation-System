
<?php
session_start();
include "db.php";

date_default_timezone_set("Asia/Manila");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$user_id = (int) $_SESSION["user_id"];

if (!isset($_GET["reservation_id"]) ||
    !ctype_digit($_GET["reservation_id"])) {
    die("Invalid reservation ID.");
}

$reservation_id = (int) $_GET["reservation_id"];

$sql = "SELECT reservation_it, room_id, address, contact_number,
               DATE_FORMAT(check_in, '%Y-%m-%d') AS check_in,
               DATE_FORMAT(Check_out, '%Y-%m-%d') AS check_out
        FROM reservation
        WHERE reservation_it = ? AND user_id = ?";

$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    die("Could not load reservation: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "ii", $reservation_id, $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$reservation = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$reservation) {
    die("Reservation not found.");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $room_id = (int) ($_POST["room_id"] ?? 0);
    $address = trim($_POST["address"] ?? "");
    $contact_number = trim($_POST["contact_number"] ?? "");
    $check_in = trim($_POST["check_in"] ?? "");
    $check_out = trim($_POST["check_out"] ?? "");

    if ($room_id < 1 || $room_id > 6 ||
        $address === "" || $contact_number === "" ||
        $check_in === "" || $check_out === "") {
        die("Please complete all fields.");
    }

    $check_in_date = DateTime::createFromFormat("!Y-m-d", $check_in);
    $check_out_date = DateTime::createFromFormat("!Y-m-d", $check_out);

    if (!$check_in_date || !$check_out_date ||
        $check_in_date->format("Y-m-d") !== $check_in ||
        $check_out_date->format("Y-m-d") !== $check_out) {
        die("Please enter valid dates.");
    }

    $today = date("Y-m-d");

if ($check_in < $today) {
    die("Check-in cannot be in the past. Please select today or a future date.");
}

    if ($check_out_date <= $check_in_date) {
        die("Check-out must be after check-in.");
    }

    $sql = "UPDATE reservation
            SET room_id = ?, address = ?, contact_number = ?,
                check_in = ?, Check_out = ?
            WHERE reservation_it = ? AND user_id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        die("Could not prepare update: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "issssii",
        $room_id,
        $address,
        $contact_number,
        $check_in,
        $check_out,
        $reservation_id,
        $user_id
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($connection);
        header("Location: view_reservation.php");
        exit;
    }

    die("Could not update reservation: " . mysqli_stmt_error($stmt));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation - Sanctovia</title>
</head>
<body>

    <h1>Edit Your Reservation</h1>

    <form action="edit_reservation.php?reservation_id=<?php echo $reservation_id; ?>"
          method="POST">

        <label for="room_id">Select Room:</label><br>
        <select name="room_id" id="room_id" required>
            <option value="1" <?php if ($reservation["room_id"] == 1) echo "selected"; ?>>Single Room - ₱1,000</option>
            <option value="2" <?php if ($reservation["room_id"] == 2) echo "selected"; ?>>Double Room - ₱1,300</option>
            <option value="3" <?php if ($reservation["room_id"] == 3) echo "selected"; ?>>Deluxe Room - ₱1,500</option>
            <option value="4" <?php if ($reservation["room_id"] == 4) echo "selected"; ?>>Family Room - ₱2,500</option>
            <option value="5" <?php if ($reservation["room_id"] == 5) echo "selected"; ?>>Executive Suite - ₱3,500</option>
            <option value="6" <?php if ($reservation["room_id"] == 6) echo "selected"; ?>>Honeymoon Suite - ₱4,000</option>
        </select>

        <br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"
               value="<?php echo htmlspecialchars($reservation["address"] ?? ""); ?>"
               required>

        <br><br>

        <label for="contact_number">Contact Number:</label><br>
        <input type="tel" id="contact_number" name="contact_number"
               value="<?php echo htmlspecialchars($reservation["contact_number"] ?? ""); ?>"
               required>

        <br><br>

        <label for="check_in">Check-in:</label><br>
        <input type="date" id="check_in" name="check_in"
               value="<?php echo htmlspecialchars($reservation["check_in"] ?? ""); ?>"
               required>

        <br><br>

        <label for="check_out">Check-out:</label><br>
        <input type="date" id="check_out" name="check_out"
               value="<?php echo htmlspecialchars($reservation["check_out"] ?? ""); ?>"
               required>

        <br><br>

        <button type="submit">Save Changes</button>
    </form>

    <p><a href="view_reservation.php">Back to My Reservations</a></p>
    <p><a href="index.php">Back to Homepage</a></p>

</body>
</html>

<?php
mysqli_close($connection);
?>
