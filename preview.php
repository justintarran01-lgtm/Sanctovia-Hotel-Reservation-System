
<?php
session_start();
include "db.php";

$booking = null;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT reservation_it, check_in, Check_out
            FROM reservation
            WHERE user_id = ?
            ORDER BY reservation_it DESC
            LIMIT 1";

    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $booking = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Previews & CRUD - Sanctovia</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="booking.css">
</head>
<body>

    <header class="navbar">
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="AboutUs.html">About</a>
            <a href="booking.html" class="active">Room reservation</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="brand-logo">
            <h1>Sanctovia</h1>
        </div>

        <div class="nav-actions">
            <a href="preview.php" class="icon-link">
                <svg width="18" height="18" fill="none"
                     stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
            </a>

            <a href="login.html" class="icon-link">
                <svg width="18" height="18" fill="none"
                     stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </a>
        </div>
    </header>

    <main class="booking-page-container">

        <div class="booking-header-title">
            <h2>Room Previews & Descriptions</h2>
            <p>Explore our luxury accommodations.</p>
        </div>

        <form>
            <table class="room-table">
                <thead>
                    <tr>
                        <th>Room Preview</th>
                        <th>Details & Description</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" alt="Room 1">
                        </td>
                        <td>
                            <small><strong>Single Room:</strong> Price: ₱1,000 | Coziest choice for solo travelers with essential amenities.</small>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=600&q=80" alt="Room 2">
                        </td>
                        <td>
                            <small><strong>Double Room:</strong> Price: ₱1,300 | Spacious layout featuring comfortable bedding for two.</small>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=600&q=80" alt="Room 3">
                        </td>
                        <td>
                            <small><strong>Deluxe Room:</strong> Price: ₱1,500 | Enhanced elegance with modern decor and stunning views.</small>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=600&q=80" alt="Room 4">
                        </td>
                        <td>
                            <small><strong>Family Room:</strong> Price: ₱2,500 | Perfect for families, offering extra space and multi-bed setups.</small>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" alt="Room 5">
                        </td>
                        <td>
                            <small><strong>Executive Suite:</strong> Price: ₱3,500 | Premium suite designed for business and ultimate relaxation.</small>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=600&q=80" alt="Room 6">
                        </td>
                        <td>
                            <small><strong>Honeymoon Suite:</strong> Price: ₱4,000 | Romantic luxury ambiance tailored for unforgettable couple getaways.</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <div class="booking-header-title" style="margin-top: 30px;">
            <h2>Your Booking Management</h2>
            <p>Manage your active room reservation below.</p>
        </div>

        <?php if (!isset($_SESSION["user_id"])): ?>

            <p>Please log in to manage your reservation.</p>
            <a href="login.html">Login</a>

        <?php elseif ($booking): ?>

            <form>
                <p>
                    Your Current Booking:<br>
                    <input
                        type="text"
                        value="Reservation ID: <?php echo (int)$booking["reservation_it"]; ?> - Check-in: <?php echo htmlspecialchars($booking["check_in"]); ?>"
                        readonly
                        style="background-color: #e8e8e8; cursor: not-allowed;">
                </p>

                <p>Manage Reservation:</p>

                <div class="action-buttons-group">

                    <a href="view_reservation.php"
                       class="btn-action-custom btn-view">View</a>

                    <a href="edit_reservation.php?reservation_id=<?php echo (int)$booking["reservation_it"]; ?>"
                       class="btn-action-custom btn-edit">Edit</a>

                    <a href="view_reservation.php"
                       class="btn-action-custom btn-delete">Delete</a>

                </div>

                <small>
                    <strong>Options:</strong>
                    View, modify, or delete your personal booking.
                    Use the Delete button beside your reservation on
                    the next page to remove it.
                </small>
            </form>

        <?php else: ?>

            <p>You don't have any reservations yet.</p>
            <a href="booking.html">Make a Reservation</a>

        <?php endif; ?>

    </main>

</body>
</html>
