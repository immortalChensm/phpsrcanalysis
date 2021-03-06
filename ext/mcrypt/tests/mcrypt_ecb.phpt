--TEST--
mcrypt_ecb
--SKIPIF--
<?php if (!extension_loaded("mcrypt")) print "skip"; ?>
--FILE--
<?php
$key      = "0123456789012345";
$secret   = "PHP Testfest 2008";
$cipher   = MCRYPT_RIJNDAEL_128;

$iv       = mcrypt_create_iv(mcrypt_get_iv_size($cipher, MCRYPT_MODE_ECB), MCRYPT_RAND);
$enc_data = mcrypt_encrypt($cipher, $key, $secret, MCRYPT_MODE_ECB, $iv);

// we have to trim as AES rounds the blocks and decrypt doesnt detect that
echo trim(mcrypt_decrypt($cipher, $key, $enc_data, MCRYPT_MODE_ECB, $iv)) . "\n";

// a warning must be issued if we don't use a IV on a AES cipher, that usually requires an IV
mcrypt_decrypt($cipher, $key, $enc_data, MCRYPT_MODE_ECB);
--EXPECTF--
Deprecated: Function mcrypt_get_iv_size() is deprecated in %s%emcrypt_ecb.php on line 6

Deprecated: Function mcrypt_create_iv() is deprecated in %s%emcrypt_ecb.php on line 6

Deprecated: Function mcrypt_encrypt() is deprecated in %s%emcrypt_ecb.php on line 7

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_ecb.php on line 10
PHP Testfest 2008

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_ecb.php on line 13
