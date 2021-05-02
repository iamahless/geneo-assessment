<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geneo Contact Form</title>
</head>
<body>
<main>
    <p><strong>Name:</strong><br> {{ $payload['name'] }}</p>
    <p><strong>Email:</strong><br> {{ $payload['email'] }}</p>
    <p><strong>Message:</strong><br> {{ $payload['message'] }}</p>
    @if (isset($payload['file_link'], $payload['file_name']))
        <p><strong>File:</strong><br>
            <a href="{{ $payload['file_link'] }}" target="_blank"
               rel="nofollow noopener">{{ $payload['file_name'] }}</a>
        </p>
    @endif
</main>
</body>
</html>
