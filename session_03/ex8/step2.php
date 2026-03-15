<?php
session_start();

// Flow Control
if (!isset($_SESSION["registration"])) {
    header("Location: step1.php");
    exit();
}

$data = $_SESSION["registration"];
$name = htmlspecialchars($data["name"], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8');

$age = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $age = trim($_POST["age"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($age === "" || !is_numeric($age) || $age <= 0) {
        $errors["age"] = "Valid age is required.";
    }

    if (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {

        echo "<h2>Registration Completed Successfully!</h2>";
        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Age: " . htmlspecialchars($age) . "<br>";

        session_destroy();
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration - Step 2</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            width: 420px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .progress {
            font-size: 14px;
            margin-bottom: 20px;
            color: #6b7280;
        }
        .active {
            font-weight: bold;
            color: #1e3a8a;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }
        .field {
            margin-bottom: 15px;
        }
        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 4px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #172554;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="progress">
        Step 1 → <span class="active">Step 2</span>
    </div>

    <h2>Additional Information</h2>

    <form method="POST">

        <div class="field">
            <label>Age</label>
            <input type="text" name="age">
            <?php if(isset($errors["age"])) echo "<div class='error'>{$errors["age"]}</div>"; ?>
        </div>

        <div class="field">
            <label>Password</label>
            <input type="password" name="password">
            <?php if(isset($errors["password"])) echo "<div class='error'>{$errors["password"]}</div>"; ?>
        </div>

        <button type="submit">Finish Registration</button>
    </form>
</div>

</body>
</html>
