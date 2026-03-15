<?php
session_start();

$name = $email = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($name === "") {
        $errors["name"] = "Name is required.";
    }

    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }

    if (empty($errors)) {
        $_SESSION["registration"] = [
            "name" => $name,
            "email" => $email
        ];

        header("Location: step2.php");
        exit();
    }
}

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration - Step 1</title>
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
        <span class="active">Step 1</span> → Step 2
    </div>

    <h2>Basic Information</h2>

    <form method="POST">
        <div class="field">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e($name); ?>">
            <?php if(isset($errors["name"])) echo "<div class='error'>{$errors["name"]}</div>"; ?>
        </div>

        <div class="field">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo e($email); ?>">
            <?php if(isset($errors["email"])) echo "<div class='error'>{$errors["email"]}</div>"; ?>
        </div>

        <button type="submit">Continue</button>
    </form>
</div>

</body>
</html>
