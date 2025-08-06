<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background-color: #0d6efd;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>{{ $title }}</h2>
        <p>{{ $content }}</p>

        <a href="https://ktech.id.vn" class="btn">Truy cập KTECH</a>

        <p style="margin-top: 20px;">Trân trọng,<br><strong>KTECH Team</strong></p>
    </div>
</body>

</html>
