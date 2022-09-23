<?php

class Person {

	private int $id;
	public int $age;
	public array $emails = [];
	protected string $something;

	public function __construct() {

		$this->age = 0;
	}

	public function incrementAge(): void {

		$this->age += 1;
		$this->ageChanged();
	}

	protected function decrementAge(): void {

		$this->age -= 1;
		$this->ageChanged();
	}

	private function ageChanged(): void {

		echo "Age changed to {$this->age}";
	}

}

class SuperNaturalPerson extends Person {

	public function incrementAge(): void {

		// ages in reverse
		$this->decrementAge();
	}
}

$person = new Person();
$person->incrementAge();
$person->decrementAge(); // wrong - not allowed
$person->ageChanged(); // wrong - not allowed

$superPerson = new SuperNaturalPerson();
$superPerson->incrementAge(); // calls decrementAge under the hood

class HTMLStuff {
	static function startTable(){
		echo "<table border='1'>\n";
	}

	static function endTable(){
		echo "</table>\n";
	}
}

HTMLStuff::startTable();
	// print HTML Table
HTMLStuff::endTable();

$klaus = new Person; // Parametri

# Parameter class name
$class = "Person";
$klaus1 = new $class; // Parametri


echo "Klaus is {$klaus->age} years old"; // property access
$klaus->birthday(); // method call
$klaus->setAge(21); // method call with arguments

$type = Person::$prop;

echo $klaus1;