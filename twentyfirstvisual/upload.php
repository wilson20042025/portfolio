<?php
require_once 'db.php';


$cloud_name = 'diqqmnnkv';
$api_key = '237424285515973';
$api_secret = 'QExOLKwVun1CKdlB2KM-92cRl_I';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d');
    $imagename = $_POST['imagename'] ?? '';
    $category = $_POST['category'] ?? '';


    $file_path = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];

    $timestamp = time();
    $params_to_sign = "timestamp=$timestamp$api_secret";
    $signature = sha1($params_to_sign);

    $post_fields = [
        'file' => new CURLFile($file_path, mime_content_type($file_path), $file_name),
        'api_key' => $api_key,
        'timestamp' => $timestamp,
        'signature' => $signature,
    ];

    $url = "https://api.cloudinary.com/v1_1/$cloud_name/image/upload";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $message = 'Curl error: ' . curl_error($ch);
    } else {
        $result = json_decode($response, true);

        if (isset($result['secure_url'])) {
            $imageUrl = $result['secure_url'];

            $stmt = $conn->prepare("INSERT INTO images (image, location, date, imagename, category) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $imageUrl, $location, $date, $imagename, $category);

            if ($stmt->execute()) {
                $message = "✅ Image uploaded and saved successfully!";
            } else {
                $message = "❌ DB Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "❌ Upload failed: " . ($result['error']['message'] ?? 'Unknown error');
        }
    }

    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <a href="logout.php" style="float:right;">Logout</a>

    <title>Upload Image to Cloudinary</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 2rem;
            margin-top: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 450px;
        }
        h1 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #333;
            text-align: center;
        }
        form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #444;
        }
        form input[type="file"],
        form input[type="text"],
        form input[type="date"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #43a047;
        }
        .message {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            background-color: #e0f7fa;
            color: #006064;
            text-align: center;
        }
        @media (max-width: 500px) {
            .container {
                margin: 1rem;
                padding: 1.25rem;
            }
            h1 {
                font-size: 1.25rem;
            }
        }
        form select {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    background-color: white;
    color: #333;
    appearance: none; /* Remove default arrow on some browsers */
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Image</h1>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
    <label for="image">Select Image</label>
    <input type="file" name="image" id="image" required>

    <label for="location">Location</label>
    <input type="text" name="location" id="location">

    <label for="date">Date</label>
    <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>">

    <label for="imagename">Image Name</label>
    <input type="text" name="imagename" id="imagename">

    <!-- ✅ New Category Field -->
    <label for="category">Category</label>
    <select name="category" id="category" required>
        <option value="">-- Select Category --</option>
        <option value="Portrait">Portrait</option>
        <option value="Nature">Nature</option>
        <option value="Events">Events</option>
    </select>

    <button type="submit">Upload</button>
</form>

    
    </div>
</body>
</html>
