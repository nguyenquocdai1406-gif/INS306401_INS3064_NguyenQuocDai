<?php
/**
 * Exercise 5: Self-Processing Contact Form
 * Pattern: Logic at the top – View at the bottom
 */

$isSubmitted = false;
$errors = [];

// Default form data
$data = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'message' => ''
];

// Detect request method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize input data
    $data['name']    = trim($_POST['name'] ?? '');
    $data['email']   = trim($_POST['email'] ?? '');
    $data['phone']   = trim($_POST['phone'] ?? '');
    $data['message'] = trim($_POST['message'] ?? '');

    // Basic validation
    if ($data['name'] === '') {
        $errors[] = "Name is required.";
    }

    if ($data['email'] === '') {
        $errors[] = "Email is required.";
    }

    if ($data['message'] === '') {
        $errors[] = "Message is required.";
    }

    // If no errors, mark as submitted
    if (empty($errors)) {
        $isSubmitted = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --bg: #f1f5f9;
    --text: #1f2937;
    --border: #e5e7eb;
    --error: #dc2626;
    --success: #16a34a;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--bg);
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    background: #ffffff;
    width: 100%;
    max-width: 480px;
    padding: 32px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

h2 {
    margin-top: 0;
    margin-bottom: 20px;
    color: var(--primary);
    text-align: center;
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: var(--text);
}

input, textarea {
    width: 100%;
    padding: 12px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 14px;
    transition: 0.2s;
}

input:focus, textarea:focus {
    outline: none;
    border-color: var(--secondary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

textarea {
    resize: vertical;
}

button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 8px;
    background: var(--primary);
    color: #ffffff;
    font-weight: 600;
    cursor: pointer;
    font-size: 15px;
    transition: 0.2s;
}

button:hover {
    background: var(--secondary);
}

.error-box {
    background: #fef2f2;
    border-left: 4px solid var(--error);
    padding: 12px;
    margin-bottom: 20px;
}

.error-box p {
    margin: 0;
    color: var(--error);
    font-size: 14px;
}

.success-box {
    text-align: center;
}

.success-icon {
    font-size: 48px;
    color: var(--success);
}

.success-box p {
    color: #374151;
    font-size: 14px;
}

.back-link {
    display: inline-block;
    margin-top: 20px;
    color: var(--secondary);
    text-decoration: none;
    font-weight: 600;
}
</style>
</head>

<body>

<div class="card">

<?php if ($isSubmitted): ?>

    <div class="success-box">
        <div class="success-icon">✔</div>
        <h2>Message Sent Successfully</h2>
        <p>Thank you <strong><?= htmlspecialchars($data['name']) ?></strong> for contacting us.</p>
        <p>We will reply to you via <strong><?= htmlspecialchars($data['email']) ?></strong>.</p>
        <a class="back-link" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">Send another message</a>
    </div>

<?php else: ?>

    <h2>Contact Us</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <?php foreach ($errors as $error): ?>
                <p>• <?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="message" rows="4"><?= htmlspecialchars($data['message']) ?></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>

<?php endif; ?>

</div>

</body>
</html>
