<?php

class Post {

	public int $id;

	public string $title;

	public string $abstract;

	public string $body;

	public array $comments;

}

class Comment {

	public string $body;

	public string $author;

	public string $ts;

}

$post = new Post(); // SELECT post con id x
//$post->comments = unserialize($comments);


// tb_posts
// id INT
// title VARCHAR(150)
// abstract VARCHAR(150)
// body
// comments LONGTEXT


class Person {

	public string $name;

	public string $surname;

	public string $age;

	public int $serialized_at = 0;

	public function __construct( string $name, string $surname, int $age ) {
		$this->name    = $name;
		$this->surname = $surname;
		$this->age     = $age;
	}

	public function __sleep(): array {

		$this->serialized_at = time();

		return [
			'name',
			'surname',
			'age',
			'serialized_at'
		];
	}

	public function __wakeup(): void {

		$this->serialized_at = 0;

	}

	public function getFromJson(array $assoc): Person{

	}
}

$p1 = new Person( 'Antonio', 'Bruno', 20 );
$serializedP1 = json_encode( $p1 );
var_dump( $serializedP1 );
var_dump( json_decode( $serializedP1 ) );

// JSON_OBJECT_AS_ARRAY
$arrP1 = ["test1" => 1223, "test2" => 122020];

$serializedJsonP1 = json_encode($arrP1);

var_dump($serializedJsonP1);
var_dump(json_decode($serializedJsonP1, JSON_OBJECT_AS_ARRAY));

# ARRAY ASSOCIATIVO php
# non puoi decodificarlo in json come ARRAY..
# puoi decodificare un json object in un array associativo..