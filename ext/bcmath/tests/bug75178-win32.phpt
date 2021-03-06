--TEST--
Bug #75178 (bcpowmod() misbehaves for non-integer base or modulus)
--SKIPIF--
<?php
if (!extension_loaded('bcmath')) die('skip bcmath extension is not available');
if (substr(PHP_OS, 0, 3) != 'WIN') {
    die('skip valid only for windows');
}
$cur = PHP_WINDOWS_VERSION_MAJOR.'.'.PHP_WINDOWS_VERSION_MINOR.'.'.PHP_WINDOWS_VERSION_BUILD;
$req = "10.0.17134";
if (version_compare($cur, $req) >= 0) {
	echo "skip Only for Windows systems < $req";
}
?>
--FILE--
<?php
var_dump(bcpowmod('4.1', '4', '3', 3));
var_dump(bcpowmod('4', '4', '3.1', 3));
?>
===DONE===
--EXPECTF--
%Astring(5) "1.000"
%Astring(5) "1.000"
===DONE===%A
