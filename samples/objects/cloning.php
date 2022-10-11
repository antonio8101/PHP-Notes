<?php

enum RaceStatus {
	case waiting;
	case ended;
}

enum Manufacturer {

	case Mercedes;
	case Ferrari;
	case Renault;
	case Honda;
	case RedBull;
	case Williams;
	case Bmw;

}

enum RacingTeamFlag {

	case AlfaRomeo;
	case AlphaTauri;
	case Alpine;
	case AstonMartin;
	case Ferrari;
	case Haas;
	case McLaren;
	case Mercedes;
	case RedBull;
	case Williams;

}

enum Country {

	case Italy;
	case Germany;
	case Usa;
	case Monaco;
	case Mexico;
	case NetherLands;
	case Austria;
	case UnitedKingdom;
	case Spain;
	case France;
	case Brazil;
	case India;
	case Finland;
	case Denmark;
	case Australia;
	case Japan;
	case China;
	case Canada;
	case Thailand;
}

class Car {


	public int $state = 0;
	private int $number;
	private Driver $driver;
	private RacingTeam $racing_team;
	private Engine $engine;

	public function __construct(int $number, Driver $driver, RacingTeam $racing_team, Engine $engine) {

		$this->number = $number;
		$this->racing_team = $racing_team;
		$this->engine = $engine;
		$this->driver = $driver;
	}

	public function __toString(): string {

		$team = $this->racing_team->getFlag()->name;
		$engine = $this->engine->getManufacturer()->name;
		$rtCountry = $this->getRacingTeam()->getCountry()->name;

		return "$this->driver :: $this->number, $team ($engine) :: $rtCountry";
	}

	public function setNewDriver($number, $name, $surname, $country): void{
		$this->number = $number;
		$this->driver->setName($name);
		$this->driver->setSurname($surname);
		$this->driver->setCountry($country);
	}

	public function setNewEngine(Manufacturer $manufacturer): void{
		$this->engine->setManufacturer($manufacturer);
	}

	public function __clone(): void {
		$this->driver = clone $this->driver;
		$this->driver->setName('Default');
		$this->driver->setSurname('Default');
		$this->driver->setCountry(Country::Italy);
	}

	/**
	 * @return RacingTeam
	 */
	public function getRacingTeam(): RacingTeam {
		return $this->racing_team;
	}
}

class RacingTeam {

	private RacingTeamFlag $flag;
	private Country $country;

	public function __construct(RacingTeamFlag $flag, Country $country) {

		$this->flag = $flag;
		$this->country = $country;
	}

	/**
	 * @return RacingTeamFlag
	 */
	public function getFlag(): RacingTeamFlag {
		return $this->flag;
	}

	/**
	 * @return Country
	 */
	public function getCountry(): Country {
		return $this->country;
	}

	/**
	 * @param Country $country
	 */
	public function setCountry( Country $country ): void {
		$this->country = $country;
	}

}

class Engine {

	private Manufacturer $manufacturer;

	public function __construct(Manufacturer $manufacturer) {
		$this->manufacturer = $manufacturer;
	}

	/**
	 * @return Manufacturer
	 */
	public function getManufacturer(): Manufacturer {
		return $this->manufacturer;
	}

	/**
	 * @param Manufacturer $manufacturer
	 */
	public function setManufacturer( Manufacturer $manufacturer ): void {
		$this->manufacturer = $manufacturer;
	}


}

class Driver {

	private string $name;
	private string $surname;
	private Country $country;

	public function __construct(string $name, string $surname, Country $country) {

		$this->name = $name;
		$this->surname = $surname;
		$this->country = $country;
	}

	public function __toString(): string {

		$country = $this->country->name;

		return "$this->name $this->surname ($country)";
	}

	/**
	 * @param string $name
	 */
	public function setName( string $name ): void {
		$this->name = $name;
	}

	/**
	 * @param string $surname
	 */
	public function setSurname( string $surname ): void {
		$this->surname = $surname;
	}

	/**
	 * @param Country $country
	 */
	public function setCountry( Country $country ): void {
		$this->country = $country;
	}
}

class CarFactory {

	public static function getCar(
		int $number,
		string $name,
		string $surname,
		Country $driverCountry,
		RacingTeam $racingTeam,
		Manufacturer $manufacturer
	): Car {

		$driver     = new Driver( $name, $surname, $driverCountry );
//		$racingTeam = new RacingTeam( $racingTeam, $carCountry );
		$engine     = new Engine( $manufacturer );

		return new Car( $number, $driver, $racingTeam, $engine );
	}
}

class RaceFactory {

	public static function getRace( string $name, Country $country ): Race {
		return new Race( $name, $country, self::getCars() );
	}

	private static function getCars(): array {
		return [
			CarFactory::getCar(
				1,
				"Max",
				"Verstappen",
				Country::NetherLands,
				RacingTeamFlag::RedBull,
				Manufacturer::RedBull
			),
			CarFactory::getCar(
				16,
				"Charles",
				"Leclerc",
				Country::Monaco,
				RacingTeamFlag::Ferrari,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				3,
				"Sergio",
				"Perez",
				Country::Mexico,
				RacingTeamFlag::RedBull,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				4,
				"George",
				"Russel",
				Country::UnitedKingdom,
				RacingTeamFlag::Mercedes,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				55,
				"Carlos",
				"Sainz",
				Country::Spain,
				RacingTeamFlag::Ferrari,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				44,
				"Lewis",
				"Hamilton",
				Country::UnitedKingdom,
				RacingTeamFlag::Mercedes,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				4,
				"Lando",
				"Norris",
				Country::UnitedKingdom,
				RacingTeamFlag::McLaren,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				31,
				"Esteban",
				"Ocon",
				Country::France,
				RacingTeamFlag::Alpine,
				Manufacturer::Renault
			),
			CarFactory::getCar(
				77,
				"Valteri",
				"Bottas",
				Country::Finland,
				RacingTeamFlag::AlfaRomeo,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				14,
				"Fernando",
				"Alonso",
				Country::Spain,
				RacingTeamFlag::Alpine,
				Manufacturer::Renault
			),
			CarFactory::getCar(
				20,
				"Kevin",
				"Magnussen",
				Country::Denmark,
				RacingTeamFlag::Haas,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				3,
				"Daniel",
				"Ricciardo",
				Country::Australia,
				RacingTeamFlag::McLaren,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				10,
				"Pierre",
				"Gasly",
				Country::France,
				RacingTeamFlag::AlphaTauri,
				Manufacturer::RedBull
			),
			CarFactory::getCar(
				5,
				"Sebastian",
				"Vettel",
				Country::Germany,
				RacingTeamFlag::AstonMartin,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				47,
				"Mick",
				"Schumacher",
				Country::Germany,
				RacingTeamFlag::Haas,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				22,
				"Yuki",
				"Tsunoda",
				Country::Japan,
				RacingTeamFlag::AlphaTauri,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				24,
				"Zhou",
				"Guanyu",
				Country::China,
				RacingTeamFlag::AlfaRomeo,
				Manufacturer::Ferrari
			),
			CarFactory::getCar(
				23,
				"Alexander",
				"Albon",
				Country::Thailand,
				RacingTeamFlag::Williams,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				6,
				"Nicholas",
				"Latifi",
				Country::Canada,
				RacingTeamFlag::Williams,
				Manufacturer::Mercedes
			),
			CarFactory::getCar(
				27,
				"Nico",
				"Hulkenberg",
				Country::Germany,
				RacingTeamFlag::AstonMartin,
				Manufacturer::Mercedes
			),
		];
	}
}

class Race {

	private string $name;
	private Country $country;
	private array $cars;
	private RaceStatus $status;

	public function __construct( string $name, Country $country, array $cars ) {

		$this->name    = $name;
		$this->country = $country;
		$this->cars    = $cars;
		$this->status  = RaceStatus::waiting;
	}

	public function go(): void {
		shuffle( $this->cars );
		$this->status = RaceStatus::ended;
	}

	public function getCarList(): array {
		return $this->cars;
	}

	public function getResult(): string {

		$country = $this->country->name;

		$result = "Race result of Grand Prix: $this->name ($country)" . PHP_EOL;

		if ( $this->status == RaceStatus::ended ) {

			$winner = $this->cars[0];
			$second = $this->cars[1];
			$third  = $this->cars[2];

			return  $result
			        . "1" . " - " . $winner . PHP_EOL
			        . "2" . " - " . $second . PHP_EOL
			        . "3" . " - " . $third . PHP_EOL;
		}

		return $result . "Race not started";
	}
}


# Cloning Showcase
$ferrari = new RacingTeam(RacingTeamFlag::Ferrari, Country::Italy);

$car0 = CarFactory::getCar(
	16,
	"Charles",
	"Leclerc",
	Country::Monaco,
	$ferrari,
	Manufacturer::Ferrari
);

echo PHP_EOL;
echo "::: \$car0 INITIAL VALUE". PHP_EOL;
echo PHP_EOL;
echo displayCar($car0);

$car1 = clone $car0;
$car1->setNewDriver(30,"Carlos", "Sainz", Country::Spain);

echo PHP_EOL;
echo "::: \$car0 DRIVER NOT CHANGED (because of __clone() implementation)" . PHP_EOL;
echo PHP_EOL;
echo displayCar($car0);
echo displayCar($car1);

$car1->setNewEngine(Manufacturer::Honda);

echo PHP_EOL;
echo "::: \$car0 ENGINE CHANGED TOO!!! (because it is not handled in the __clone() implementation)" . PHP_EOL;
echo PHP_EOL;
echo displayCar($car0);
echo displayCar($car1);


echo "::: \$car0 COUNTRY CHANGED TOO!!! (because it is not handled in the __clone() implementation)" . PHP_EOL;
echo PHP_EOL;
$ferrari->setCountry(Country::France);
echo displayCar($car0);
echo displayCar($car1);


function displayCar(string $car): string{
	return " - " . $car . PHP_EOL;
}

echo get_class($ferrari) . PHP_EOL;
echo method_exists($ferrari, 'get') ? 'si' : 'no';
var_dump(get_object_vars($car0));
var_dump(get_class_methods(RacingTeam::class));