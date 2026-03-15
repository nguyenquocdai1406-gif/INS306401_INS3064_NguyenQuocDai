<?php
session_start();

$errors = [];

// Load users
if (!file_exists("data/users.json")) {
    file_put_contents("data/users.json", "[]");
}

$users = json_decode(file_get_contents("data/users.json"), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm"];

    // Validate
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    foreach ($users as $u) {
        if ($u["email"] === $email) {
            $errors[] = "Email already exists.";
            break;
        }
    }

    // Nếu không có lỗi
    if (empty($errors)) {

        $users[] = [
            "username" => $username,
            "email"    => $email,
            "password" => $password,
            "bio"      => "",
            "avatar"   => ""
        ];

        file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="card">
<h2>Register</h2>

<form method="POST">
    Username:
    <input type="text" name="username" required>

    Email:
    <input type="email" name="email" required>

    Password:
    <input type="password" name="password" required>

    Confirm Password:
    <input type="password" name="confirm" required>

    <button type="submit">Register</button>
</form>

<p style="text-align:center;">
    Already have account? <a href="login.php">Login</a>
</p>

<?php
foreach ($errors as $e) {
    echo "<p class='error'>$e</p>";
}
?>

</div>

</body>
</html>