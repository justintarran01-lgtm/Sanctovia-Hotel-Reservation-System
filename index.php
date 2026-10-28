<?php
session_start();

$isLoggedIn = isset($_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Grand Horizon Hotel</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <header class="navbar">
        <nav class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="AboutUs.html">About</a>
            <a href="booking.html">Room reservation</a>
            <a href="contact.php">Contact</a>

            <?php if ($isLoggedIn) { ?>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.html">Login</a>
            <?php } ?>
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

            <?php if ($isLoggedIn) { ?>
                <a href="view_reservation.php" class="icon-link"
                   title="My Reservations">
                    My Reservations
                </a>
            <?php } else { ?>
                <a href="login.html" class="icon-link"
                   title="Login">
                    Login
                </a>
            <?php } ?>
        </div>
    </header>

    <main class="main-container">
        <section class="hero-section">
            <div class="hero-image-container">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1400&q=80"
                     alt="Sanctovia Horizon Room">
            </div>

            <div class="hero-overlay-content">
                <h2>The Sanctova Horizon Room</h2>
                <p>The best views in the house, guaranteed</p>
                <a href="booking.html" class="btn-book-now">Book Now</a>
            </div>
        </section>

        <section class="gallery-section">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=600&q=80"
                     alt="Interior Lounge">
            </div>

            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=600&q=80"
                     alt="Modern Kitchen">
            </div>

            <div class="gallery-item promo-card">
                <h3>Find A Best Spot?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate gravida dapibus.</p>

                <div class="promo-buttons">
                    <a href="booking.html" class="btn-outline">Buy Now!</a>
                    <a href="AboutUs.html" class="btn-outline">See More</a>
                </div>
            </div>

            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80"
                     alt="Outdoor Patio">
            </div>
        </section>
    </main>

</body>
</html>
