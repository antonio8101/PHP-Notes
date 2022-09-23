<?php

/**
 * @throws ReflectionException
 */
function displayClasses(): void {
	$classes = get_declared_classes();

	foreach ( $classes as $class ) {
		echo "<strong>Showing info about {$class} </strong><br>";
		echo "<br>";

		$reflection  = new ReflectionClass( $class );
		$isAnonymous = $reflection->isAnonymous() ? "Yes" : "No";

		echo "Is Anonymous: {$isAnonymous} <br>";

		echo "<br>" . "<strong>Class methods:</strong> <br>";

		$methods = $reflection->getMethods( ReflectionMethod::IS_STATIC );

		if ( ! count( $methods ) ) {
			echo "<strong>None</strong><br>";
		} else {
			foreach ( $methods as $method ) {
				echo "<strong>{$method}</strong><br>";
			}
		}

		echo "<br>" . "<strong>Class properties:</strong> <br>";

		$properties = $reflection->getProperties();

		if ( ! count( $properties ) ) {
			echo "<strong>None</strong><br>";
		} else {
			$propertyNames = array_map( function(ReflectionProperty $p) { return $p->name; }, $properties );
			foreach ($propertyNames as $property ) {
				echo "<strong>${property}</strong><br>";
			}
		}

		echo "<br>" . "<hr>";
	}
}

try {
	displayClasses();
} catch ( ReflectionException $e ) {
	die("Reflection error " . $e->getMessage());
}