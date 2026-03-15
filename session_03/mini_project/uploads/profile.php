<?php
session_start();

/* =========================
   ACCESS CONTROL
========================= */
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

/* =========================
   LOAD USER DATA
========================= */
$users = json_decode(file_get_contents("data/users.json"), true);

foreach ($users as $index => $u) {
    if ($u["email"] === $_SESSION["user"]) {
        $currentUser = $u;
        $userIndex = $index;
        break;
    }
}

$message = "";
$error = "";

/* =========================
   HANDLE FORM SUBMISSION
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // XSS protection
    $bio = htmlspecialchars(trim($_POST["bio"]));

    // ===== AVATAR UPLOAD =====
    if (!empty($_FILES["avatar"]["name"])) {

        $fileName = $_FILES["avatar"]["name"];
        $fileTmp  = $_FILES["avatar"]["tmp_name"];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Reject dangerous files
        if (in_array($fileExt, ["exe", "pdf"])) {
            $error = "File type not allowed (.exe, .pdf blocked).";
        }
        // Only allow image files
        elseif (!in_array($fileExt, ["jpg", "jpeg", "png", "gif"])) {
            $error = "Only image files allowed (jpg, png, gif).";
        }
        else {
            $newName = time() . "_" . $fileName;
            move_uploaded_file($fileTmp, "uploads/" . $newName);
            $users[$userIndex]["avatar"] = $newName;
        }
    }

    if (!$error) {
        $users[$userIndex]["bio"] = $bio;

        file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));
        $message = "Profile updated successfully!";

        // reload updated data
        $currentUser = $users[$userIndex];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-card {
            width: 420px;
        }
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #2a5298;
        }
        .info {
            margin-bottom: 15px;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #c0392b;
        }
    </style>
</head>

<body>

<div class="card profile-card">

    <h2>My Profile</h2>

    <?php if ($currentUser["avatar"]) : ?>
        <img src="uploads/<?= htmlspecialchars($currentUser["avatar"]) ?>" class="avatar">
    <?php endif; ?>

    <div class="info">
        <strong>Username:</strong> <?= htmlspecialchars($currentUser["username"]) ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($currentUser["email"]) ?><br>
    </div>

    <?php if ($currentUser["bio"]) : ?>
        <div class="info">
            <strong>Bio:</strong><br>
            <?= htmlspecialchars($currentUser["bio"]) ?>
        </div>
    <?php endif; ?>

    <hr>

    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <?php if ($message) echo "<p class='success'>$message</p>"; ?>

    <form method="POST" enctype="multipart/form-data">

        Bio:
        <textarea name="bio"><?= htmlspecialchars($currentUser["bio"]) ?></textarea>

        Upload Avatar:
        <input type="file" name="avatar">

        <button type="submit">Update Profile</button>
    </form>

    <a href="logout.php" class="logout">Logout</a>

</div>

</body>
</html>