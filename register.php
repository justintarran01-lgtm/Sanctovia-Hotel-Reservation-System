
<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $check_sql = "SELECT user_id FROM users WHERE email = ?";
    $check_stmt = mysqli_prepare($connection, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo "This email is already registered.";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (full_name, email, password)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($connection, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $full_name,
            $email,
            $hashed_password
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful! ";
            echo '<a href="login.html">Log in here</a>';
        } else {
            echo "Registration failed. Please try again.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($check_stmt);
}

mysqli_close($connection);

?>
