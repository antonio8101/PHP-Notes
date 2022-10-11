<?php
//
//
//trait AddSomething {
//
//	public $test1;
//
//	public function doSomethingSpecial(): void {
//		//
//	}
//
//	abstract function absSomething():void;
//}
//
//trait AddSomething2 {
//
//	public $test1;
//
//	public function doSomethingSpecial(): void {
//		//
//	}
//
//}
//
//class Person2 {
//
//	public $test2;
//
//	public function doSomethingBase(): void{
//
//	}
//
//}
//
//class Person extends Person2{
//
//	public $test2;
//
//	public function doSomethingBase(): void{
//
//	}
//
//}
//
//
//class Employee extends Person {
//
//	use AddSomething, AddSomething2 {
//		AddSomething::doSomethingSpecial as special;
//		AddSomething2::doSomethingSpecial insteadof AddSomething;
//	}
//
//	public function doSomethingElse(): void {
//
//		$this->doSomethingSpecial();
//
//	}
//
//}
//
//class Cat extends Animal {
//
//	use AddSomething;
//
//}
//
//$person = new Employee();
//
//$person->doSomethingBase(); // ereditato da classe base
//$person->doSomethingSpecial(); // del trait
//$person->special();
//$person->doSomethingElse(); // della classe
//
//
//
interface Printable {

	function printOut(): void;

}
//
//
//abstract class PrintableBase implements Printable {
//
//	function log(string $message){
//		echo "log -> " . $message;
//	}
//
//	abstract protected function internalPrintOut(): string;
//
//	public function printOut(): void {
//		$this->log('init');
//		echo $this->internalPrintOut();
//		$this->log('end');
//	}
//}
//
//class ImageComponent extends PrintableBase {
//
//	private string $path;
//
//	public function __construct(string $path) {
//		$this->path = $path;
//	}
//
//	protected function internalPrintOut(): string {
//		return "print-IMAGE";
//	}
//}
//
//class TextComponent extends PrintableBase {
//
//	protected function internalPrintOut(): string {
//		return "print-TEXT";
//	}
//}
//
//# SERVICE
////class ImageComponent {
////	function printOut(): void;
////}
//
//
//# CLIENT
//function someMethod(Printable $printable){
//	$printable->printOut();
//}
//
//$img = new ImageComponent('');
//someMethod(new ImageComponent(''));
//someMethod(new TextComponent());
//
//
class Player {

	public string $name = "default";

	public int $score = 0;

	public function __construct( string $name = "default" ) {

		$this->name = $name;

	}

}

class DbConfig {


}

class TennisGame {

	public Player $player1;

	public Player $player2;

	public int $state;

	private DbConfig $db_config;
	private ?mysqli $db;

	public function __construct( DbConfig $db_config, string $player1, string $player2 ) {

		$this->player1 = new Player();

		$this->player2 = new Player( $player2 );

		$this->state = 0;
	}

	public function __destruct() {

		$this->db = null;

		// log

	}

	public function __clone(): void {

		$this->player1 = clone $this->player1;

		$this->player2 = clone $this->player2;

		$this->state = 0;

	}

	/**
	 * @return void
	 */
	public function increasePoint( Player $player ): void {

		try {
			$this->db = new mysqli( '', '', '', '', 0 );
			$query    = $this->db->prepare();

			$query->execute();
			$this->db->close();
		} catch ( Exception $e ) {

		}

	}

}


$game1 = new TennisGame( new DbConfig(), 'Luca', 'Manuel' );
$game2 = new TennisGame( new DbConfig(), 'Luca', 'Manuel' );
# TennisGame
$game1 = "fklfdlkfldi03490394";
$game1 = null;
echo "all ok";


$anonymous = new class() extends TennisGame implements Printable {

	public function getTest(){

	}

	function printOut(): void {
		echo $this->player1->name . ' / ' . $this->player1->score;
		echo $this->player2->name . ' / ' . $this->player2->score;
	}
};

$anonymous->getTest();

# primitive
$pro1 = 0;
$pro2 = $pro1;
$pro2 = 5;

# reference
$pro3 = new TennisGame();
$pro4 = clone $pro3;

$pro3->state = 2;