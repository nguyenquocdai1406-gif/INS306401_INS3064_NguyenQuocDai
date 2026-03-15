<?php
session_start();

$error = "";

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $file = "data/users.json";

    if (file_exists($file)) {

        $users = json_decode(file_get_contents($file), true);

        foreach ($users as $user) {

            if ($user["email"] == $email && $user["password"] == $password) {

                $_SESSION["user"] = $user;
                header("Location: profile.php");
                exit();
            }
        }

        $error = "Sai email hoặc mật khẩu!";
    } else {
        $error = "Không tìm thấy file dữ liệu!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="card">
<h2>Login</h2>

<form method="POST">
    Email:
    <input type="email" name="email" required>

    Password:
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<p style="text-align:center;">
    No account? <a href="register.php">Register</a>
</p>
</div>

</body>
</html>