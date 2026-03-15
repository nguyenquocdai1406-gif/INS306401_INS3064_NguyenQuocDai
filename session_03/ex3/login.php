<?php
session_start();

$correctUsername = "admin";
$correctPassword = "123456";

if (!isset($_SESSION["attempts"])) {
    $_SESSION["attempts"] = 0;
}

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username === $correctUsername && $password === $correctPassword) {
        $message = "Login successful!";
        $messageClass = "success";
        $_SESSION["attempts"] = 0;
    } else {
        $_SESSION["attempts"]++;
        $message = "Login failed. Attempts: " . $_SESSION["attempts"];
        $messageClass = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login with Counter</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #eef2f3, #dfe9f3);
        }
        .box {
            width: 360px;
            margin: 110px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        h3 {
            text-align: center;
            color: #34495e;
            margin-bottom: 20px;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #dcdde1;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #5f7cff;
            box-shadow: 0 0 0 2px rgba(95,124,255,0.15);
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #5f7cff, #6a89ff);
            color: white;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            opacity: 0.95;
        }
        .success {
            color: #27ae60;
            text-align: center;
            margin-top: 15px;
            font-weight: 500;
        }
        .error {
            color: #e74c3c;
            text-align: center;
            margin-top: 15px;
            font-weight: 500;
        }
        .attempts {
            text-align: center;
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Sign In</h3>

    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <?php if ($message): ?>
        <div class="<?= $messageClass ?>"><?= $message ?></div>
        <div class="attempts">Failed attempts: <?= $_SESSION["attempts"] ?></div>
    <?php endif; ?>
</div>

</body>
</html>
