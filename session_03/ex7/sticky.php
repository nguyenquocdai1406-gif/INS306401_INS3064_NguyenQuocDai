<?php
// Khai báo biến
$name = $email = $age = $message = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // ===== Validation =====

    if ($name == "") {
        $errors["name"] = "Name is required.";
    }

    if ($email == "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }

    if ($age == "") {
        $errors["age"] = "Age is required.";
    } elseif (!is_numeric($age) || $age < 1) {
        $errors["age"] = "Age must be a positive number.";
    }

    if ($message == "") {
        $errors["message"] = "Message cannot be empty.";
    }
}

// XSS Prevention
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            width: 420px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1f2937;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        textarea {
            resize: none;
            height: 80px;
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
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #172554;
        }

        .success {
            margin-top: 15px;
            padding: 10px;
            background: #ecfdf5;
            color: #065f46;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Contact Form</h2>

    <form method="POST">

        <div class="field">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e($name); ?>">
            <?php if (isset($errors["name"])): ?>
                <div class="error"><?php echo $errors["name"]; ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo e($email); ?>">
            <?php if (isset($errors["email"])): ?>
                <div class="error"><?php echo $errors["email"]; ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label>Age</label>
            <input type="text" name="age" value="<?php echo e($age); ?>">
            <?php if (isset($errors["age"])): ?>
                <div class="error"><?php echo $errors["age"]; ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label>Message</label>
            <textarea name="message"><?php echo e($message); ?></textarea>
            <?php if (isset($errors["message"])): ?>
                <div class="error"><?php echo $errors["message"]; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Submit</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
        <div class="success">
            Form submitted successfully!
        </div>
    <?php endif; ?>

</div>

</body>
</html>
