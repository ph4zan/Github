<?php
session_start();

$captchaText = '';
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
for ($i = 0; $i < 5; $i++) {
    $captchaText .= $chars[rand(0, strlen($chars) - 1)];
}
$_SESSION['captcha_text'] = $captchaText;

$width = 360;
$height = 120;
$image = imagecreatetruecolor($width, $height);

$bg = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 100, 100, 100);
$noiseColor = imagecolorallocate($image, 160, 180, 255);

imagefill($image, 0, 0, $bg);

$font = __DIR__ . '/Abbieshire.ttf';
$fontSize = 48;

// Рисуем текст
$x = 20;
$y = rand(70, 90);
for ($i = 0; $i < strlen($captchaText); $i++) {
    $letter = $captchaText[$i];
    $angle = rand(-30, 30);
    imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $font, $letter);
    $x += rand(50, 70);
}

// Линии 
imagesetthickness($image, 2);
for ($i = 0; $i < 10; $i++) {
    $lineColor = imagecolorallocate($image, rand(100,200), rand(100,200), rand(100,200));
    imageline(
        $image,
        rand(0, $width), rand(0, $height),
        rand(0, $width), rand(0, $height),
        $lineColor
    );
}

for ($i = 0; $i < 500; $i++) {
    $x1 = rand(0, $width);
    $y1 = rand(0, $height);
    $size = rand(1, 2);
    imagefilledrectangle($image, $x1, $y1, $x1 + $size, $y1 + $size, $noiseColor);
}

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
