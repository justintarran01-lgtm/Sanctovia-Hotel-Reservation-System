<?php
session_start();
include "db.php";


if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$user_id = (int) $_SESSION["user_id"];


$sql = "SELECT
            reservation.reservation_it,
            room.room_name,
            room.price,
            reservation.address,
            reservation.contact_number,
            reservation.check_in,
            reservation.Check_out
        FROM reservation
        INNER JOIN room
        ON reservation.room_id = room.room_id
        WHERE reservation.user_id = ?";

$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    die("Could not load reservations: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations - Sanctovia</title>
</head>
<body>

    <h1>My Reservations</h1>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <table border="1" cellpadding="10">
            <tr>
                <th>Room</th>
                <th>Price</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td>
                        <?php echo htmlspecialchars($row["room_name"]); ?>
                    </td>

                    <td>
                        ₱<?php echo htmlspecialchars($row["price"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["address"] ?? ""); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["contact_number"] ?? ""); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["check_in"] ?? ""); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["Check_out"] ?? ""); ?>
                    </td>

                    <td>
                        <a href="edit_reservation.php?reservation_id=<?php echo (int)$row["reservation_it"]; ?>">
                            Edit
                        </a>

                        |

                        <form
                            action="delete_reservation.php"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Are you sure you want to delete this reservation?');"
                        >
                            <input
                                type="hidden"
                                name="reservation_id"
                                value="<?php echo (int)$row["reservation_it"]; ?>"
                            >

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <p>You have no reservations yet.</p>

    <?php } ?>

    <p>
        <a href="booking.html">Make Another Reservation</a>
    </p>

    <p>
        <a href="index.php">Back to Homepage</a>
    </p>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
