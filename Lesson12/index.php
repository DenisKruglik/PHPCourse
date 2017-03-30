<?php


	require_once "first.php";
	header('Content-Type: text/html;charset=utf-8');
	#use First;

	// require_once "second.php";
	// Second\log_name();


	// class Person{
	// 	private $name = 'No name';
	// 	var $age;
	// 	var $address;
	// 	var $salary;
	// 	var $city;
	// 	public function rename($newName){
	// 		$this->name = $newName;
	// 	}
	// 	public function Person($name, $age = 0){
	// 		echo "Я родился!";
	// 		$this->name = $name;
	// 		$this->age = $age;
	// 	}
	// }

	// $h1 = new Person('Max');
	// // $h1->rename('Alex');
	// // $h1->age = 17;
	// print_r($h1);




	$first = new ComplexFloat(2, 1);
	print_r($first);
	$second = new ComplexFloat(4, -1);
	$first->addComplex($second);
	print_r($first);
	echo $second->abs();

?>