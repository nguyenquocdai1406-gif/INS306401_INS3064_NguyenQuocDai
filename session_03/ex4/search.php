<?php
// Lấy dữ liệu từ query string (GET)
$search = $_GET['q'] ?? "";

// XSS Prevention
$safeSearch = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Query Echo</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            width: 380px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1f2937;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1e3a8a;
        }

        button {
            width: 100%;
            margin-top: 12px;
            padding: 12px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #172554;
        }

        .result {
            margin-top: 20px;
            padding: 12px;
            background: #f9fafb;
            border-left: 4px solid #1e3a8a;
            color: #111827;
        }

        .hint {
            margin-top: 10px;
            font-size: 13px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Search</h2>

    <!-- GET Method -->
    <form method="GET">
        <input 
            type="text" 
            name="q" 
            placeholder="Enter your search query..."
            value="<?php echo $safeSearch; ?>"
        >
        <button type="submit">Search</button>
    </form>

    <?php if ($search !== ""): ?>
        <div class="result">
            You searched for: <strong><?php echo $safeSearch; ?></strong>
        </div>
    <?php endif; ?>

    <div class="hint">
        URL Example: <br>
        <code>?q=php+security</code>
    </div>
</div>

</body>
</html>
