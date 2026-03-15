<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST["num1"] ?? "";
    $num2 = $_POST["num2"] ?? "";
    $operation = $_POST["operation"] ?? "";

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Please enter valid numeric values.";
    } else {

        $num1 = (float)$num1;
        $num2 = (float)$num2;

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 == 0) {
                    $error = "Cannot divide by zero.";
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = "Invalid operation.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Arithmetic Calculator</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            width: 360px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            background-color: #f9fafb;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #1e3a8a;
            background-color: #ffffff;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #172554;
        }

        .result {
            margin-top: 18px;
            padding: 10px;
            background: #ecfdf5;
            color: #065f46;
            border-radius: 6px;
            font-weight: 600;
        }

        .error {
            margin-top: 18px;
            padding: 10px;
            background: #fef2f2;
            color: #991b1b;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Arithmetic Calculator</h2>

    <form method="POST">
        <input type="text" name="num1" placeholder="Enter first number" required>

        <select name="operation" required>
            <option value="add">Addition (+)</option>
            <option value="subtract">Subtraction (-)</option>
            <option value="multiply">Multiplication (×)</option>
            <option value="divide">Division (÷)</option>
        </select>

        <input type="text" name="num2" placeholder="Enter second number" required>

        <button type="submit">Calculate</button>
    </form>

    <?php if ($error != ""): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($result !== ""): ?>
        <div class="result">Result: <?php echo $result; ?></div>
    <?php endif; ?>
</div>

</body>
</html>
