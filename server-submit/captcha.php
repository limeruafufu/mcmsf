<?php
session_start();

$code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 4);
$_SESSION['captcha'] = $code;

$img = imagecreatetruecolor(100, 36);
$bg  = imagecolorallocate($img, 245, 247, 250);
$fg  = imagecolorallocate($img, 60, 60, 60);

imagefill($img, 0, 0, $bg);
imagestring($img, 5, 22, 10, $code, $fg);

header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);