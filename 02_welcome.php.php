<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INS3064 Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px;
            text-align: center;
        }
        h1 { color: #667eea; margin-bottom: 20px; }
        .info { background: #f0f0f0; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .info p { margin: 10px 0; text-align: left; }
        .label { font-weight: bold; color: #667eea; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to INS3064</h1>
        
        <?php
            // Student Information
            $name = "Nguyen Quoc Dai";        // Thay bằng tên của bạn
            $studentId = "23070023";       // Thay bằng MSSV của bạn
            $class = "INS3064-01";         // Thay bằng lớp của bạn
            $email = "23070023@vnu.edu.vn"; // Thay bằng email của bạn
            
            // Current date and time
            $currentDate = date("l, F j, Y"); // Format: Monday, January 16, 2026
            $currentTime = date("H:i:s");     // Format: 14:30:45
        ?>
        
        <div class="info">
            <p><span class="label">Name:</span> <?php echo $name; ?></p>
            <p><span class="label">Student ID:</span> <?php echo $studentId; ?></p>
            <p><span class="label">Class:</span> <?php echo $class; ?></p>
            <p><span class="label">Email:</span> <?php echo $email; ?></p>
            <p><span class="label">Date:</span> <?php echo $currentDate; ?></p>
            <p><span class="label">Time:</span> <?php echo $currentTime; ?></p>
        </div>
    </div>
</body>
</html>