<?php header("Content-Type: text/html;charset=UTF-8"); ?>
<?php 
	$link=mysqli_connect("localhost","root","","shop");
	function getItemsCode($req){
		global $link;
		$data = mysqli_query($link, $req);
		$res = array();
		while ($temp = mysqli_fetch_assoc($data)) {
			$res[] = $temp;
		}
		$list = "<ul class='items'>";
		foreach ($res as $key => $value) {
			$title = $value['title'];
			$matches = array();
			preg_match_all("/([^A-Za-z]*)([A-Za-z]*)/", $title, $matches);
			$title = "{$matches[1][0]}<i>{$matches[2][0]}</i>";
			$price = number_format($value['price'], 2, ".", " ");
			$list .= "<li class='item' listed> 
						<a href='item/index.php?id={$value['id']}' atomic>
							<figure>
								<img atomic src='{$value['img']}'/>
								<figcaption>
									<h3 atomic> $title </h3>
									<p class='color' atomic> Цвет: {$value['color']} </p>
									<p class='size' atomic> Размер: {$value['size']}</p>
									<p class='price' atomic> $price р.</p>
								</figcaption>
							</figure>
						</a>
					</li>";
		}
		$list .= "</ul>";
		return $list;
	}

	$data=mysqli_query($link, "SELECT DISTINCT size FROM goods");
	$datalistSize = array();
	while ($temp=mysqli_fetch_assoc($data)) {
		$datalistSize[]=$temp;
	}
	$listSize="";
	foreach ($datalistSize as $key => $value) {
		$listSize.="<option>".$value['size']."</option>";
	}

	$data=mysqli_query($link, "SELECT DISTINCT color FROM goods");
	$datalistColors = array();
	while ($temp=mysqli_fetch_assoc($data)) {
		$datalistColors[]=$temp;
	}
	$listColors="";
	foreach ($datalistColors as $key => $value) {
		$listColors.="<option>".$value['color']."</option>";
	}

	$data=mysqli_query($link, "SELECT MIN(price) FROM goods");
	$min=mysqli_fetch_assoc($data);
	$min=round($min['MIN(price)'], 2)-0.01;
	$data=mysqli_query($link, "SELECT MAX(price) FROM goods");
	$max=mysqli_fetch_assoc($data);
	$max=round($max['MAX(price)'],2);

	if($_GET["name"] || $_GET["color"] || $_GET["size"] || $_GET["price_from"] || $_GET["price_to"]){
		$name=$_GET['name'];
		$color=$_GET['color'];
		$price_to=$_GET['price_to'];
		$price_from=$_GET['price_from'];
		$size=$_GET['size'];
		$find=getItemsCode("SELECT * FROM goods WHERE title LIKE '%{$name}' AND color='$color' AND price>=$price_from AND price<=$price_to AND size='$size'");
	}else{
		$find = getItemsCode("SELECT * FROM goods");
	}

?>

<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>
		
		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/catalog.css'/>

	</head>

	<body>
		<header>
			<a href=''>
				<img src='img/logo.png'/>
			</a>
			<nav>
				<ul>
					<li> <a href=''> Главная </a></li>
					<li> <a href='catalog/'> Каталог </a></li>
					<li> <a href='manager/'> Управление </a></li>

				</ul>
			</nav>
		</header>

		<main>
			<section class='search'>
				<form action='' method='get'>
					<label>
						<span> Название или часть названия </span>
						<input type='text' name='name' />
					</label>

					<label>
						<span> Цвет</span>
						<select name='color'>
							<?php echo $listColors; ?>
						</select>
					</label>

					<label>
						<span> Размер</span>
						<select name='size'>
							<?php echo $listSize; ?>
						</select>
					</label>

					<label>
						<span> Цена от</span>
						<input type='number' name='price_from' min='<?=$min ?>' value='<?=$min ?>' />
					</label>


					<label>
						<span> Цена до</span>
						<input type='number' name='price_to' max='<?=$max ?>' value='<?=$max ?>' />
					</label>

					<input type='submit' name='search' value='Поиск'/> 
				</form>
			</section>

			<section class='all'>
				<h2> Все товары в <i>Clothes Store</i></h2>
				<ul class='items'>
					<?php echo $find ?>
				</ul>
			</section>

		</main>

	</body>

</html>