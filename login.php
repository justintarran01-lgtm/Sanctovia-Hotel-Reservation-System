<?php

session_start();

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT user_id, full_name, email, password, role
            FROM users
            WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user["password"])) {

            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["full_name"] = $user["full_name"];
            $_SESSION["role"] = $user["role"];

            if ($user["role"] == "admin") {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }

        } else {
            echo "Incorrect email or password.";
        }

    } else {
        echo "Incorrect email or password.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connection);

?>  THIS IS DB.PHP