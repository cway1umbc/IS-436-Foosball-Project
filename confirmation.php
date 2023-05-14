<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Confirmation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'EB Garamond';
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
        }

        p {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 30px;
            text-align: justify;
        }

        #tagline {
            font-size: 24px;
            color: #D1B000;
            font-style: italic;
            font-weight: bold;
            text-align: left;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D1B000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="container">
        <p id="tagline">Retriever</p>
        <h1>Signup Confirmation</h1>
        <p>Thank you for signing up! Your account has been created successfully. You can now log in using the email address and password you provided during signup.</p>
        <div style="text-align: center;">
            <a href="login.html" class="btn">Log in</a>
        </div>
    </div>
</body>
</html>
