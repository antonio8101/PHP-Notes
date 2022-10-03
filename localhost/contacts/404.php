<?php
require_once "inc/config.inc.php";
require_once "inc/helper.inc.php";


class Rectangle {

	private float $width, $height;

	public function __construct( float $width, float $height ) {

		$this->width  = $width;
		$this->height = $height;

	}

	public function setWidth( $width ): void {
		$this->width = $width;
	}

	public function setHeight( $height ): void {
		$this->height = $height;
	}
}

class Square extends Rectangle {

	public function setWidth( $width ): void {
		parent::setWidth( $width );
		$this->width = $width;
	}

	public function setHeight( $height ): void {
		parent::setWidth( $height );
		$this->height = $height;
	}

}class Rectangle {

	private float $width, $height;

	public function __construct( float $width, float $height ) {

		$this->width  = $width;
		$this->height = $height;

	}

	public function setWidth( $width ): void {
		$this->width = $width;
	}

	public function setHeight( $height ): void {
		$this->height = $height;
	}
}

class Square extends Rectangle {

	public function setWidth( $width ): void {
		parent::setWidth( $width );
		$this->width = $width;
	}

	public function setHeight( $height ): void {
		parent::setWidth( $height );
		$this->height = $height;
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=getPageTitle()?></title>
</head>
<body>
404
</body>
</html>
