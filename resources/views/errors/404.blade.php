<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            background-color: #212121;
        }
        .swag{
            color: ghostwhite;
            margin-top: 35vh;
        }
        hr { display: block; height: 1px;
            border: 0; border-top: 1px solid #fff;
            margin: 1em 0; padding: 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-7 swag">
        <h1>404 - Stránka nenalezena :(</h1>
        <p>Tudy bohužel cesta nevede..</p>
            <hr>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">Návrat zpět</a>
    </div>
</div>
</body>
</html>
