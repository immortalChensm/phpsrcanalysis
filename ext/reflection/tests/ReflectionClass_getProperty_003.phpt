--TEST--
ReflectionClass::getProperty()
--CREDITS--
Robin Fernandes <robinf@php.net>
Steve Seear <stevseea@php.net>
--FILE--
<?php
class A {
	static public $pubC = "pubC in A";
	static protected $protC = "protC in A";
	static private $privC = "privC in A";

	static public $pubA = "pubA in A";
	static protected $protA = "protA in A";
	static private $privA = "privA in A";
}

class B extends A {
	static public $pubC = "pubC in B";
	static protected $protC = "protC in B";
	static private $privC = "privC in B";

	static public $pubB = "pubB in B";
	static protected $protB = "protB in B";
	static private $privB = "privB in B";
}

class C extends B {
	static public $pubC = "pubC in C";
	static protected $protC = "protC in C";
	static private $privC = "privC in C";
}

class X {
	static public $pubC = "pubC in X";
	static protected $protC = "protC in X";
	static private $privC = "privC in X";
}

$myC = new C;
$rc = new ReflectionClass("C");

function showInfo($name) {
	global $rc, $myC;
	echo "--- (Reflecting on $name) ---\n";
	try {
		$rp = $rc->getProperty($name);
	} catch (Exception $e) {
		echo $e->getMessage() . "\n";
		return;
	}
	try {
		var_dump($rp);
		var_dump($rp->getValue($myC));
	} catch (Exception $e) {
		echo $e->getMessage() . "\n";
		return;
	}
}


showInfo("pubA");
showInfo("protA");
showInfo("privA");

showInfo("pubB");
showInfo("protB");
showInfo("privB");

showInfo("pubC");
showInfo("protC");
showInfo("privC");
showInfo("doesntExist");

showInfo("A::pubC");
showInfo("A::protC");
showInfo("A::privC");

showInfo("B::pubC");
showInfo("B::protC");
showInfo("B::privC");

showInfo("c::pubC");
showInfo("c::PUBC");
showInfo("C::pubC");
showInfo("C::protC");
showInfo("C::privC");

showInfo("X::pubC");
showInfo("X::protC");
showInfo("X::privC");
showInfo("X::doesntExist");

showInfo("doesntexist::doesntExist");

?>
--EXPECTF--
--- (Reflecting on pubA) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubA"
  [%u|b%"class"]=>
  %unicode|string%(1) "A"
}
%unicode|string%(9) "pubA in A"
--- (Reflecting on protA) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protA"
  [%u|b%"class"]=>
  %unicode|string%(1) "A"
}
Cannot access non-public member C::protA
--- (Reflecting on privA) ---
Property privA does not exist
--- (Reflecting on pubB) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubB"
  [%u|b%"class"]=>
  %unicode|string%(1) "B"
}
%unicode|string%(9) "pubB in B"
--- (Reflecting on protB) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protB"
  [%u|b%"class"]=>
  %unicode|string%(1) "B"
}
Cannot access non-public member C::protB
--- (Reflecting on privB) ---
Property privB does not exist
--- (Reflecting on pubC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
%unicode|string%(9) "pubC in C"
--- (Reflecting on protC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
Cannot access non-public member C::protC
--- (Reflecting on privC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "privC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
Cannot access non-public member C::privC
--- (Reflecting on doesntExist) ---
Property doesntExist does not exist
--- (Reflecting on A::pubC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubC"
  [%u|b%"class"]=>
  %unicode|string%(1) "A"
}
%unicode|string%(9) "pubC in A"
--- (Reflecting on A::protC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protC"
  [%u|b%"class"]=>
  %unicode|string%(1) "A"
}
Cannot access non-public member A::protC
--- (Reflecting on A::privC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "privC"
  [%u|b%"class"]=>
  %unicode|string%(1) "A"
}
Cannot access non-public member A::privC
--- (Reflecting on B::pubC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubC"
  [%u|b%"class"]=>
  %unicode|string%(1) "B"
}
%unicode|string%(9) "pubC in B"
--- (Reflecting on B::protC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protC"
  [%u|b%"class"]=>
  %unicode|string%(1) "B"
}
Cannot access non-public member B::protC
--- (Reflecting on B::privC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "privC"
  [%u|b%"class"]=>
  %unicode|string%(1) "B"
}
Cannot access non-public member B::privC
--- (Reflecting on c::pubC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
%unicode|string%(9) "pubC in C"
--- (Reflecting on c::PUBC) ---
Property PUBC does not exist
--- (Reflecting on C::pubC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(4) "pubC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
%unicode|string%(9) "pubC in C"
--- (Reflecting on C::protC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "protC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
Cannot access non-public member C::protC
--- (Reflecting on C::privC) ---
object(ReflectionProperty)#%d (2) {
  [%u|b%"name"]=>
  %unicode|string%(5) "privC"
  [%u|b%"class"]=>
  %unicode|string%(1) "C"
}
Cannot access non-public member C::privC
--- (Reflecting on X::pubC) ---
Fully qualified property name X::pubC does not specify a base class of C
--- (Reflecting on X::protC) ---
Fully qualified property name X::protC does not specify a base class of C
--- (Reflecting on X::privC) ---
Fully qualified property name X::privC does not specify a base class of C
--- (Reflecting on X::doesntExist) ---
Fully qualified property name X::doesntExist does not specify a base class of C
--- (Reflecting on doesntexist::doesntExist) ---
Class doesntexist does not exist
