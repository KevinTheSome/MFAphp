<?php

use RobThree\Auth\TwoFactorAuth;

use RobThree\Auth\Providers\Qr\EndroidQrCodeProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$qrCodeProvider = new EndroidQrCodeProvider();
// using Endroid

$tfa = new TwoFactorAuth($qrCodeProvider, 'Test', 6, 30);

$secret = $tfa->createSecret();

?>
<p>Please enter the following code in your app: '<?php echo chunk_split($secret, 4, ' '); ?>'</p>
<img src="<?php echo $tfa->getQRCodeImageAsDataUri('test', $secret); ?>">

<?php
$code = $tfa->getCode($secret);
?>

<form action="check.php" method="post">
    <input type="hidden" name="secret" value="<?= $secret ?>">
    <input type="text" name="code" value="<?= $code ?>">
    <input type="submit">
</form>