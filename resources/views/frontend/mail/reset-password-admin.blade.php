<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <h1 style="color: brown">Reset Password Admin</h1>
    <h2>Click the link below to reset your password !</h2>
    <h3>Your email: {{ $email }}</h3>
    <a style="font-size: 17px; color: red; margin-top: 30px" href="{{ route('admin.confirm_reset', $token) }}">
        Reset my password.
    </a>
</body>

</html>
