<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
</head>
<body>
    <h1>QR Code with Image</h1>
    <img src="data:image/png;base64, {!! base64_encode($qrCodeWithImage) !!} " alt="QR Code">
</body>
</html>


<!-- Route::get('qr-code', [UserController::class, 'generateQrCode']); -->




<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>QR Code with Image</h1>
    <img src="data:image/png;base64, {!! base64_encode($qrCodeWithImage) !!} " alt="QR Code">

</body>
</html> -->