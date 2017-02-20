<?php header("Content-Type: text/html; charset=UTF-8");?>
<?php
	$s=file_get_contents("http://retarcorp.by/edu/php/data.csv");
	$people=explode("\n", $s);
	$firstrow=explode(";", array_shift($people));
	$person_length=count($firstrow);
	$people_length=count($people);
	for ($i=0; $i < $people_length; $i++) { 
		$people[$i]=explode(";", $people[$i]);
		for ($j=0; $j < $person_length; $j++) { 
			$people[$i][$firstrow[$j]]=$people[$i][$j];
			unset($people[$i][$j]);
		}
	}
	for ($i=0; $i < $people_length; $i++) { 
		$people[$i][name]=explode(" ", $people[$i][name]);
		$people[$i][name][last_name]=$people[$i][name][0];
		$people[$i][name][first_name]=$people[$i][name][1];
		$people[$i][name][third_name]=$people[$i][name][2];
		for ($j=0; $j < 3; $j++) { 
			unset($people[$i][name][$j]);
		}
	}
	array_pop($people);



	$longest_third_name=$people[0][name][third_name];
	$greatest_balance=$people[0][balance];

	for ($i=1; $i < $people_length; $i++) { 
		$longest_third_name= strlen($people[$i][name][third_name]) > strlen($longest_third_name) ? $people[$i][name][third_name] : $longest_third_name;
		$greatest_balance=$people[$i][balance] > $greatest_balance ? $people[$i][balance] : $greatest_balance;
	}

	$third_name_counter=0;
	$wealthy_people="";
	$no_children=0;
	$one_child=0;
	$two_children=0;
	$three_children=0;
	$four_children=0;
	$five_children=0;
	$journalists=0;
	$professions=array();
	$professions_res=array();
	$cities=array();
	$biggest_city=array();
	$longest_name_city=array();
	$N=20;
	$all_children=0;
	$all_balance=0;
	$poor_people=0;

	for ($i=0; $i < $people_length; $i++) {

		if ($people[$i][name][third_name] == $longest_third_name) {
			$third_name_counter++;
		}
	}

	for ($i=0; $i < $people_length; $i++) { 
		switch ($people[$i][children]) {
			case 0:
				$no_children++;
				break;
			case 1:
				$one_child++;
				break;
			case 2:
				$two_children++;
				break;
			case 3:
				$three_children++;
				break;
			case 4:
				$four_children++;
				break;
			case 5:
				$five_children++;
				break;
		}
	}

	for ($i=0; $i < $people_length; $i++) { 
		if ($people[$i][balance] == $greatest_balance) {
			$wealthy_people.=$people[$i][name][last_name]." ".$people[$i][name][first_name]." ".$people[$i][name][third_name]."; ";
		}
	}

	for ($i=0; $i < $people_length; $i++) { 
		if ($people[$i][job] == "Журналист") {
			$journalists++;
		}
	}

	for ($i=0; $i < $people_length; $i++) { 
		$professions[$people[$i][job]]++;
	}

	foreach ($professions as $key => $value) {
		if ($value == $N) {
			array_push($professions_res, $key);
		}
	}
	$professions_res=implode("; ", $professions_res);

	foreach ($people as $key => $value) {
		if (!is_array($cities[$value[city]][citizens])) {
			$cities[$value[city]][citizens]=array();
		}
		array_push($cities[$value[city]][citizens], implode(" ", $value[name]));
	}
	foreach ($cities as $key => $value) {
		if (count($value[citizens]) > count($biggest_city[citizens])) {
			$biggest_city[name] = $key;
			$biggest_city[citizens] = $value[citizens];
		}
	}
	$biggest_city[citizens] = implode("; ", $biggest_city[citizens]);

	foreach ($cities as $key => $value) {
		if (strlen($key) > strlen($longest_name_city[name])) {
			$longest_name_city[name] = $key;
			$longest_name_city[citizens] = $value[citizens];
		}
	}

	function compare($a,$b){
		if ($b[balance] > $a[balance]) {
			return -1;
		}else return 1;
	}
	usort($people, "compare");
	if (count($people) % 2 == 0) {
		$median = ($people[round(count($people)/2, 0, PHP_ROUND_HALF_DOWN)][balance]+$people[round(count($people)/2, 0, PHP_ROUND_HALF_UP)][balance])/2;
	}else $median = $people[count($people)/2][balance];

	foreach ($people as $key => $value) {
		$all_balance+=$value[balance];
		$all_children+=$value[children];
	}
	$avg_income=$all_balance/(count($people)+$all_children);
	foreach ($people as $key => $value) {
		if ($value[balance] <= $avg_income*0.3333333333333333333333333) {
			$poor_people++;
		}
	}
	$avg_income=round($avg_income, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre><?php
		echo "		Самое длинное отчество - $longest_third_name, их количество - $third_name_counter<br>
		Людей без детей - $no_children<br>
		Людей с одним ребёнком - $one_child<br>
		Людей с двумя детьми - $two_children<br>
		Людей с тремя детьми - $three_children<br>
		Людей с четырьмя детьми - $four_children<br>
		Людей с пятью детьми - $five_children<br>
		Самый большой бюджет - $greatest_balance, его обладатели - $wealthy_people<br>
		Журналистов - $journalists<br>
		Профессии, в которых задействовано $N человек - $professions_res<br>
		Город с максимальным населением - $biggest_city[name], его жители - $biggest_city[citizens]<br>
		Город с самым длинным названием - $longest_name_city[name], его население - ".count($longest_name_city[citizens])."<br>
		Медианное значние баланса людей - $median<br>
		Средний доход на душу населения - $avg_income, кол-во людей за чертой бедности - $poor_people";
	?></pre>
</body>
</html>