<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body,
    html {
        height: 100%;
        overflow: hidden;
    }

    .bg-gradient {
        background-image: url("../images/erorr_page.png");
        background-size: cover;
        background-position: center;
        color: white;
    }

    .error-container {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .error-code {
        font-size: calc(4rem + 2vw);
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
        font-style: normal;
        font-weight: 600;
        color: black;
    }

    .error-message {
        font-size: calc(1rem + 1vw);
        margin-bottom: 30px;
    }

    .btn-home {
        background-color: aqua;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: calc(0.8rem + 0.5vw);
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .btn-home:hover {
        background-color: aqua;
        opacity: 90%;
        color: #fff;
        border-radius: 10px;
        /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
    }

    a {
        text-decoration: none;
    }
    </style>
</head>

<body class="bg-gradient">
    <div class="container error-container">
        <div class="error-code">404</div>
        <div class="error-message"><mark>Oops! The page you're looking for doesn't exist.</mark></div>
        <a href="index.php" class="btn btn-home mt-3">Go to Homepage</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>