<!DOCTYPE html>
<html lang="en">

<head>

    <title>Page not found</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f1f1;
        }

        .vertical-center {
            min-height: 100%;
            min-height: 100vh;

            display: flex;
            align-items: center;
        }
    </style>

</head>

<body>

<div class="vertical-center">
    <div class="container">
        <div id="notfound" class="text-center ">
            <h1>😮</h1>
            <h2>Oops! Page Not Be Found</h2>
            <p>Sorry but the page you are looking for does not exist.</p>
            <a href="{{ route('client.home') }}">Back to homepage</a>
        </div>
    </div>
</div>

</body>

</html>
