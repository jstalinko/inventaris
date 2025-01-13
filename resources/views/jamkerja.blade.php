<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Terbatas</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .message-container {
            text-align: center;
        }
        h1 {
            font-size: 4rem;
            color: #ff0000;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.5rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Akses Dibatasi</h1>
        <p>{{ $message }}</p>
        <p>Silakan kembali selama jam kerja.</p>
    </div>
</body>
</html>
