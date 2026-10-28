<?php
$name = "";
$email = "";
$message = "";
$success = "";
$error = "";
$sentMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name == "" || $email == "" || $message == "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $success = "Thank you, " . htmlspecialchars($name) .
                   "! Your message form was submitted successfully.";

     
        $sentMessage = $message;

      
        $name = "";
        $email = "";
        $message = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Sanctovia</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="signin.css">
</head>
<body>

    <header class="navbar">
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="AboutUs.html">About</a>
            <a href="booking.html">Room reservation</a>
            <a href="contact.php" class="active">Contact</a>
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

    <div class="page-wrapper"
         style="max-width: 600px; margin: 20px auto;">

        <div class="form-wrapper" style="width: 100%; flex: none;">

            <div class="brand-header">
                <h1>Sanctovia</h1>
                <p>We would love to hear from you.</p>
            </div>

            <h2>Contact Us</h2>

            <?php if ($success != ""): ?>
                <div style="color: green; text-align: center; margin-bottom: 20px;">
                    <p><?php echo $success; ?></p>

                    <p><strong>Your message:</strong></p>

                    <p style="color: #333; background-color: #f2f2f2;
                              padding: 14px; border-radius: 8px;
                              overflow-wrap: anywhere;">
                        <?php echo nl2br(htmlspecialchars($sentMessage)); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($error != ""): ?>
                <p style="color: red; text-align: center;">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>
               <form action="/hotelreservationproject/contact.php" method="POST">
                <div class="form-group">
                    <input
                        type="text"
                        id="contact-name"
                        name="name"
                        placeholder="FULL NAME"
                        value="<?php echo htmlspecialchars($name); ?>"
                        required>
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        id="contact-email"
                        name="email"
                        placeholder="ENTER EMAIL"
                        value="<?php echo htmlspecialchars($email); ?>"
                        required>
                </div>

                <div class="form-group">
                    <textarea
                        id="contact-message"
                        name="message"
                        placeholder="ENTER YOUR MESSAGE"
                        rows="4"
                        required
                        style="width: 100%; padding: 14px 18px; background-color: #dcdcdc; border: none; border-radius: 8px; font-size: 0.85rem; color: #333333; outline: none; letter-spacing: 0.5px; resize: vertical;"><?php echo htmlspecialchars($message); ?></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Send Message
                </button>

            </form>
        </div>
    </div>

</body>
</html>
