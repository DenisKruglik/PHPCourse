<?php
	header("Content-Type: text/html;charset=utf-8");

	// class Dier
	// {
	// 	private $name;

	// 	function __construct($name)
	// 	{
	// 		$this->name = $name;
	// 	}

	// 	public function __destruct(){
	// 		echo 'рип';
	// 	}

	// 	function __call($method, $args){
	// 		echo $method;
	// 		print_r($args);
	// 	}

	// 	function __get($name){
	// 		return 'qwerty';
	// 	}
	// }

	// $h = new Dier('Alex');
	// $h->toot('O','E');
	// echo $h->weight;


	// class AssocObject
	// {
		
	// 	private $data = array();

	// 	function __get($val){
	// 		if (isset($this->data[$val])) {
	// 			return $this->data[$val];
	// 		}else{
	// 			return null;
	// 		}	
	// 	}

	// 	function __set($field, $val){
	// 		$this->data[$field] = $val;
	// 	}
		
	// 	function __toString(){
	// 		$res = array();
	// 		foreach ($this->data as $key => $value) {
	// 			$res[] = $key.' = '.$value;
	// 		}
	// 		$res = implode(', ', $res);
	// 		return $res;
	// 	}
	// }

	// $a = new AssocObject();
	// $a->name = 'Den';
	// echo $a->name;
	// $a->age = 18;
	// echo $a;


	// class Human
	// {
		
	// 	function __construct($name, $age)
	// 	{
	// 		$this->name = $name;
	// 		$this->age = $age;
	// 		self::$amount++;
	// 		self::$sum_ages += $this->age;
	// 	}

	// 	private $name;
	// 	private $age;
	// 	private static $sum_ages = 0;
	// 	private static $amount = 0;
	// 	public function avg_age(){
	// 		return self::$sum_ages / self::$amount;
	// 	}
	// }

	// $a = new Human('Den', 18);
	// $b = new Human('Kurt', 27);
	// echo Human::avg_age();


	// class Counter
	// {
		
	// 	function sum()
	// 	{
	// 		$args = func_get_args();
	// 		foreach ($args as $value) {
	// 			$res += $value;
	// 		}
	// 		return $res;
	// 	}
	// }

	// $c = new Counter();
	// echo $c->sum(1, 2, 3);

	require_once "comments_model.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<ul>
		<?php
			$model = new CommentsModel();
			$comments = $model->getAllComments();
			foreach ($comments as $c) {
				echo "<li><b>".$c->getTime()."</b> <span>".$c->getText()."</span></li>";
			}
		?>
	</ul>
	<form action="add.php" method="post">
		<textarea name="text"></textarea>
		<input type="submit">
	</form>
</body>
</html>