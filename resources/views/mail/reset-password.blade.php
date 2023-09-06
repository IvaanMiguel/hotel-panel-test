<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Ha solicitado un reinicio de su contraseña. Para continuar haga click</h3>
    <a href="{{ url('password-recover/'.$token.'/'.$email) }}">=>AQUI</a>
</body>
</html>