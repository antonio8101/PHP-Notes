<?php

/**
 * @throws ReflectionException
 */
function getCallableMethods( $object ): array {
	$reflection = new ReflectionClass( $object );

	return $reflection->getMethods();
}

/**
 * @throws ReflectionException
 */
function getLineage( $object ): array {
	$reflection = new ReflectionClass( $object );

	if ( $reflection->getParentClass() ) {
		$parent = $reflection->getParentClass();

		$lineage   = getLineage( $parent );
		$lineage[] = $reflection->getName();
	} else {
		$lineage = array( $reflection->getName() );
	}

	return $lineage;
}

/**
 * @throws ReflectionException
 */
function getChildClasses( $object ): array {
	$reflection = new ReflectionClass( $object );

	$classes = get_declared_classes();

	$children = array();

	foreach ( $classes as $class ) {
		$checkedReflection = new ReflectionClass( $class );

		if ( $checkedReflection->isSubclassOf( $reflection->getName() ) ) {
			$children[] = $checkedReflection->getName();
		}
	}

	return $children;
}

/**
 * @throws ReflectionException
 */
function getProperties( $object ): array {
	$reflection = new ReflectionClass( $object );

	return $reflection->getProperties();
}

/**
 * @throws ReflectionException
 */
function printObjectInfo( $object ): void {
	$reflection = new ReflectionClass($object);
	echo "<h2>Class</h2>";
	echo "<p>{$reflection->getName()}</p>";

	echo "<h2>Inheritance</h2>";

	echo "<h3>Parents</h3>";
	$lineage = getLineage($object);
	array_pop($lineage);

	if (count($lineage) > 0) {
		echo "<p>" . join(" -&gt; ", $lineage) . "</p>";
	}
	else {
		echo "<i>None</i>";
	}

	echo "<h3>Children</h3>";
	$children = getChildClasses($object);
	echo "<p>";

	if (count($children) > 0) {
		echo join(', ', $children);
	}
	else {
		echo "<i>None</i>";
	}

	echo "</p>";

	echo "<h2>Methods</h2>";
	$methods = getCallableMethods($object);

	if (!count($methods)) {
		echo "<i>None</i><br />";
	}
	else {
		foreach($methods as $method) {
			echo "<b>{$method}</b>();<br />";
		}
	}

	echo "<h2>Properties</h2>";
	$properties = getProperties($object);

	if (!count($properties)) {
		echo "<i>None</i><br />";
	}
	else {
		foreach(array_keys($properties) as $property) {
			echo "<b>\${$property}</b> = " . $object->$property . "<br />";
		}
	}

	echo "<hr />";
}


class A {
	public $foo = "foo";
	public $bar = "bar";
	public $baz = 17.0;

	function firstFunction() { }

	function secondFunction() { }

	public function __sleep(): array {
		// TODO: Implement __sleep() method.
	}
}

class B extends A {
	public $quux = false;

	function thirdFunction() { }
}

class C extends B { }

$a = new A();
$a->foo = "sylvie";
$a->bar = 23;

$b = new B();
$b->foo = "bruno";
$b->quux = true;

$c = new C();

printObjectInfo($a);
printObjectInfo($b);
printObjectInfo($c);