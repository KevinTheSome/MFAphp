<?php

use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\EndroidQrCodeProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$qrCodeProvider = new EndroidQrCodeProvider();
// using Endroid

$tfa = new TwoFactorAuth($qrCodeProvider, 'Test', 6, 30);

if (empty($_POST['secret'])) {
    echo 'Missing secret';
    exit;
}
if (empty($_POST['code'])) {
    echo 'Missing code';
    exit;
}

$secret = $_POST['secret'];
$code = trim($_POST['code']);

if ($tfa->verifyCode($secret, $code) === true) {
    echo 'OK';
} else {
    echo 'FAIL';
}
