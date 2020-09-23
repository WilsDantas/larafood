<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QRCODE</title>
</head>
<body>
    <div class="visible-print" style="text-align: center;">
        {!! QrCode::size(300)->generate($uri); !!}
        <p>{{ $uri }}</p>
    </div>
</body>
</html>