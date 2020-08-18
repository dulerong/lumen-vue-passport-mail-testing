<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Email</title>
</head>
<body>
    <h1>Dear {{ $username }}</h1>
    <p>Please click the following url link to reset your password.</p>
    <p><a href="{{ $url }}">{{ $url }}<a></p>
    <p>Please do not reply to this email.</p>
    <p>Thank you</p>
</body>
</html>